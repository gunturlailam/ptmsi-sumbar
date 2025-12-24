<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class ApiController extends ResourceController
{
    protected $format = 'json';

    /**
     * Get athlete statistics
     */
    public function getAtletStats($idAtlet)
    {
        try {
            $atletModel = new \App\Models\AtletModel();
            $rankingModel = new \App\Models\RankingModel();
            $ratingModel = new \App\Models\RatingAtletModel();

            $atlet = $atletModel->find($idAtlet);
            if (!$atlet) {
                return $this->failNotFound('Atlet tidak ditemukan');
            }

            $ranking = $rankingModel->where('id_atlet', $idAtlet)
                ->orderBy('tanggal_berlaku', 'DESC')
                ->first();

            $avgRating = $ratingModel->getAverageRating($idAtlet);

            return $this->respond([
                'success' => true,
                'data' => [
                    'atlet' => $atlet,
                    'ranking' => $ranking,
                    'rating' => $avgRating
                ]
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    /**
     * Get event matches
     */
    public function getEventMatches($idEvent)
    {
        try {
            $pertandinganModel = new \App\Models\PertandinganModel();

            $matches = $pertandinganModel->select('pertandingan.*, 
                        a1.nama_lengkap as nama_atlet_1, a2.nama_lengkap as nama_atlet_2')
                ->join('atlet atlet1', 'atlet1.id_atlet = pertandingan.id_atlet1', 'left')
                ->join('user a1', 'a1.id_user = atlet1.id_user', 'left')
                ->join('atlet atlet2', 'atlet2.id_atlet = pertandingan.id_atlet2', 'left')
                ->join('user a2', 'a2.id_user = atlet2.id_user', 'left')
                ->where('pertandingan.id_event', $idEvent)
                ->where('DATE(pertandingan.jadwal)', date('Y-m-d'))
                ->orderBy('pertandingan.jadwal', 'ASC')
                ->findAll();

            return $this->respond([
                'success' => true,
                'data' => $matches
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    /**
     * Get notifications
     */
    public function getNotifications()
    {
        try {
            if (!session()->get('logged_in')) {
                return $this->failUnauthorized('Tidak terautentikasi');
            }

            $notificationModel = new \App\Models\NotificationModel();
            $notifications = $notificationModel->getUnreadNotifications(
                session()->get('user_id'),
                10
            );

            return $this->respond([
                'success' => true,
                'data' => $notifications
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    /**
     * Search athletes
     */
    public function searchAtletes()
    {
        try {
            $query = $this->request->getVar('q');

            if (!$query || strlen($query) < 2) {
                return $this->respond([
                    'success' => true,
                    'data' => []
                ]);
            }

            $atletModel = new \App\Models\AtletModel();
            $results = $atletModel->select('atlet.id_atlet, user.nama_lengkap, klub.nama as nama_klub')
                ->join('user', 'user.id_user = atlet.id_user', 'left')
                ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
                ->like('user.nama_lengkap', $query)
                ->limit(10)
                ->findAll();

            return $this->respond([
                'success' => true,
                'data' => $results
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    /**
     * Search events
     */
    public function searchEvents()
    {
        try {
            $query = $this->request->getVar('q');

            if (!$query || strlen($query) < 2) {
                return $this->respond([
                    'success' => true,
                    'data' => []
                ]);
            }

            $eventModel = new \App\Models\EventModel();
            $results = $eventModel->like('nama_event', $query)
                ->where('status', 'aktif')
                ->limit(10)
                ->findAll();

            return $this->respond([
                'success' => true,
                'data' => $results
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    /**
     * Get ranking by category
     */
    public function getRankingByCategory($kategori)
    {
        try {
            $rankingModel = new \App\Models\RankingModel();

            $rankings = $rankingModel->select('ranking.*, user.nama_lengkap, klub.nama as nama_klub')
                ->join('atlet', 'atlet.id_atlet = ranking.id_atlet', 'left')
                ->join('user', 'user.id_user = atlet.id_user', 'left')
                ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
                ->where('ranking.kategori', $kategori)
                ->orderBy('ranking.poin', 'DESC')
                ->limit(20)
                ->findAll();

            return $this->respond([
                'success' => true,
                'data' => $rankings
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    /**
     * Get top rated athletes
     */
    public function getTopRatedAthletes()
    {
        try {
            $limit = $this->request->getVar('limit') ?? 10;

            $ratingModel = new \App\Models\RatingAtletModel();
            $topAthletes = $ratingModel->getTopRatedAthletes($limit);

            return $this->respond([
                'success' => true,
                'data' => $topAthletes
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    /**
     * Get event standings
     */
    public function getEventStandings($idEvent)
    {
        try {
            $db = \Config\Database::connect();
            $standings = $db->query("
                SELECT a.id_atlet, u.nama_lengkap, k.nama as nama_klub,
                       COUNT(CASE WHEN h.id_pemenang_atlet = a.id_atlet THEN 1 END) as menang,
                       COUNT(CASE WHEN h.id_pemenang_atlet != a.id_atlet AND h.id_event = ? THEN 1 END) as kalah
                FROM atlet a
                JOIN user u ON u.id_user = a.id_user
                LEFT JOIN klub k ON k.id_klub = a.id_klub
                LEFT JOIN hasil h ON (h.id_atlet_1 = a.id_atlet OR h.id_atlet_2 = a.id_atlet) AND h.id_event = ?
                WHERE a.status = 'aktif'
                GROUP BY a.id_atlet, u.nama_lengkap, k.nama
                ORDER BY menang DESC, kalah ASC
            ", [$idEvent, $idEvent])->getResultArray();

            return $this->respond([
                'success' => true,
                'data' => $standings
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }
}
