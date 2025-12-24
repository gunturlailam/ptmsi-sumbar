<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;
use App\Models\EventModel;
use App\Models\PertandinganModel;
use App\Models\HasilModel;
use App\Models\AtletModel;
use App\Models\RankingModel;

class LiveScoring extends BaseController
{
    protected $eventModel;
    protected $pertandinganModel;
    protected $hasilModel;
    protected $atletModel;
    protected $rankingModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
        $this->pertandinganModel = new PertandinganModel();
        $this->hasilModel = new HasilModel();
        $this->atletModel = new AtletModel();
        $this->rankingModel = new RankingModel();
    }

    /**
     * Live Scoring Dashboard
     */
    public function index()
    {
        // Get active events
        $events = $this->eventModel->where('status', 'aktif')
            ->orderBy('tanggal_mulai', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Live Scoring',
            'events' => $events
        ];

        return view('public/live_scoring/index', $data);
    }

    /**
     * View live scoring for specific event
     */
    public function event($idEvent)
    {
        $event = $this->eventModel->find($idEvent);

        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get today's matches
        $matches = $this->pertandinganModel->select('pertandingan.*, 
                    a1.nama_lengkap as nama_atlet_1, a2.nama_lengkap as nama_atlet_2,
                    k1.nama as nama_klub_1, k2.nama as nama_klub_2')
            ->join('atlet atlet1', 'atlet1.id_atlet = pertandingan.id_atlet_1', 'left')
            ->join('user a1', 'a1.id_user = atlet1.id_user', 'left')
            ->join('klub k1', 'k1.id_klub = atlet1.id_klub', 'left')
            ->join('atlet atlet2', 'atlet2.id_atlet = pertandingan.id_atlet_2', 'left')
            ->join('user a2', 'a2.id_user = atlet2.id_user', 'left')
            ->join('klub k2', 'k2.id_klub = atlet2.id_klub', 'left')
            ->where('pertandingan.id_event', $idEvent)
            ->where('DATE(pertandingan.tanggal_pertandingan)', date('Y-m-d'))
            ->orderBy('pertandingan.jam_pertandingan', 'ASC')
            ->findAll();

        // Get results
        $results = $this->hasilModel->where('id_event', $idEvent)
            ->orderBy('tanggal_hasil', 'DESC')
            ->limit(10)
            ->findAll();

        $data = [
            'title' => 'Live Scoring - ' . esc($event['nama_event']),
            'event' => $event,
            'matches' => $matches,
            'results' => $results
        ];

        return view('public/live_scoring/event', $data);
    }

    /**
     * Get live match data (AJAX)
     */
    public function getMatchData($idEvent)
    {
        $matches = $this->pertandinganModel->select('pertandingan.*, 
                    a1.nama_lengkap as nama_atlet_1, a2.nama_lengkap as nama_atlet_2')
            ->join('atlet atlet1', 'atlet1.id_atlet = pertandingan.id_atlet_1', 'left')
            ->join('user a1', 'a1.id_user = atlet1.id_user', 'left')
            ->join('atlet atlet2', 'atlet2.id_atlet = pertandingan.id_atlet_2', 'left')
            ->join('user a2', 'a2.id_user = atlet2.id_user', 'left')
            ->where('pertandingan.id_event', $idEvent)
            ->where('DATE(pertandingan.tanggal_pertandingan)', date('Y-m-d'))
            ->findAll();

        return $this->response->setJSON([
            'success' => true,
            'matches' => $matches
        ]);
    }

    /**
     * View bracket for event
     */
    public function bracket($idEvent)
    {
        $event = $this->eventModel->find($idEvent);

        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get bracket data
        $db = \Config\Database::connect();
        $bracket = $db->query("
            SELECT * FROM bracket_turnamen
            WHERE id_event = ?
            ORDER BY round ASC, match_number ASC
        ", [$idEvent])->getResultArray();

        $data = [
            'title' => 'Bracket - ' . esc($event['nama_event']),
            'event' => $event,
            'bracket' => $bracket
        ];

        return view('public/live_scoring/bracket', $data);
    }

    /**
     * View standings/ranking for event
     */
    public function standings($idEvent)
    {
        $event = $this->eventModel->find($idEvent);

        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get standings
        $db = \Config\Database::connect();
        $standings = $db->query("
            SELECT a.id_atlet, u.nama_lengkap, k.nama as nama_klub,
                   COUNT(CASE WHEN h.id_pemenang_atlet = a.id_atlet THEN 1 END) as menang,
                   COUNT(CASE WHEN h.id_pemenang_atlet != a.id_atlet AND h.id_event = ? THEN 1 END) as kalah,
                   SUM(CASE WHEN h.id_pemenang_atlet = a.id_atlet THEN 1 ELSE 0 END) * 10 + 
                   SUM(CASE WHEN h.id_pemenang_atlet != a.id_atlet AND h.id_event = ? THEN 1 ELSE 0 END) * 3 as poin
            FROM atlet a
            JOIN user u ON u.id_user = a.id_user
            LEFT JOIN klub k ON k.id_klub = a.id_klub
            LEFT JOIN hasil h ON (h.id_atlet_1 = a.id_atlet OR h.id_atlet_2 = a.id_atlet) AND h.id_event = ?
            WHERE a.status = 'aktif'
            GROUP BY a.id_atlet, u.nama_lengkap, k.nama
            ORDER BY poin DESC, menang DESC
        ", [$idEvent, $idEvent, $idEvent])->getResultArray();

        $data = [
            'title' => 'Standings - ' . esc($event['nama_event']),
            'event' => $event,
            'standings' => $standings
        ];

        return view('public/live_scoring/standings', $data);
    }

    /**
     * View athlete profile with ratings
     */
    public function atletProfile($idAtlet)
    {
        $atlet = $this->atletModel->select('atlet.*, user.nama_lengkap, user.email, klub.nama as nama_klub')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->find($idAtlet);

        if (!$atlet) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get ratings
        $ratingModel = new \App\Models\RatingAtletModel();
        $ratings = $ratingModel->getAtletRatings($idAtlet, 10);
        $avgRating = $ratingModel->getAverageRating($idAtlet);
        $ratingByCategory = $ratingModel->getRatingByCategory($idAtlet);

        // Get ranking
        $ranking = $this->rankingModel->where('id_atlet', $idAtlet)
            ->orderBy('tanggal_berlaku', 'DESC')
            ->first();

        $data = [
            'title' => 'Profil Atlet - ' . esc($atlet['nama_lengkap']),
            'atlet' => $atlet,
            'ratings' => $ratings,
            'avg_rating' => $avgRating,
            'rating_by_category' => $ratingByCategory,
            'ranking' => $ranking
        ];

        return view('public/live_scoring/atlet_profile', $data);
    }

    /**
     * Rate athlete (POST)
     */
    public function rateAtlet()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $idAtlet = $this->request->getPost('id_atlet');
        $rating = $this->request->getPost('rating');
        $kategori = $this->request->getPost('kategori');
        $komentar = $this->request->getPost('komentar');

        // Validate
        if (!$idAtlet || !$rating || !$kategori) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak lengkap']);
        }

        if ($rating < 1 || $rating > 5) {
            return $this->response->setJSON(['success' => false, 'message' => 'Rating harus antara 1-5']);
        }

        $ratingModel = new \App\Models\RatingAtletModel();

        // Check if already rated
        $existing = $ratingModel->hasUserRated($idAtlet, session()->get('user_id'), $kategori);

        if ($existing) {
            // Update existing rating
            $ratingModel->updateRating($existing['id_rating'], $rating, $komentar);
            $message = 'Rating berhasil diperbarui';
        } else {
            // Add new rating
            $ratingModel->addRating(
                $idAtlet,
                session()->get('user_id') ?? null,
                $rating,
                $kategori,
                $komentar
            );
            $message = 'Rating berhasil ditambahkan';
        }

        return $this->response->setJSON(['success' => true, 'message' => $message]);
    }

    /**
     * Get top rated athletes
     */
    public function topRated()
    {
        $ratingModel = new \App\Models\RatingAtletModel();
        $topAthletes = $ratingModel->getTopRatedAthletes(20);

        $data = [
            'title' => 'Atlet Terbaik',
            'top_athletes' => $topAthletes
        ];

        return view('public/live_scoring/top_rated', $data);
    }
}
