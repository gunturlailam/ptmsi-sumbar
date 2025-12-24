<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AtletModel;
use App\Models\PertandinganModel;
use App\Models\EventModel;

class GenerateMatches extends BaseController
{
    protected $atletModel;
    protected $pertandinganModel;
    protected $eventModel;

    public function __construct()
    {
        $this->atletModel = new AtletModel();
        $this->pertandinganModel = new PertandinganModel();
        $this->eventModel = new EventModel();
    }

    /**
     * Tampilkan halaman generate matches
     */
    public function index()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('auth/login')->with('error', 'Akses ditolak.');
        }

        // Ambil semua atlet aktif
        $allAtlet = $this->atletModel->select('atlet.*, user.nama_lengkap, klub.nama as nama_klub')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->where('atlet.status', 'aktif')
            ->findAll();

        // Ambil event aktif
        $events = $this->eventModel->where('status', 'aktif')->findAll();

        $data = [
            'title' => 'Generate Pertandingan Hari Ini',
            'all_atlet' => $allAtlet,
            'events' => $events
        ];

        return view('admin/generate_matches', $data);
    }

    /**
     * Generate random matches untuk semua atlet hari ini
     */
    public function generateRandom()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Akses ditolak.']);
        }

        try {
            $db = \Config\Database::connect();
            $db->transStart();

            // Ambil semua atlet aktif
            $allAtlet = $this->atletModel->where('status', 'aktif')->findAll();

            if (count($allAtlet) < 2) {
                throw new \Exception('Minimal 2 atlet diperlukan untuk membuat pertandingan.');
            }

            // Shuffle atlet secara acak
            shuffle($allAtlet);

            // Ambil event ID dari request atau gunakan event pertama
            $eventId = $this->request->getPost('event_id');
            if (!$eventId) {
                $event = $this->eventModel->where('status', 'aktif')->first();
                if (!$event) {
                    throw new \Exception('Tidak ada event aktif.');
                }
                $eventId = $event['id_event'];
            }

            // Buat pertandingan dengan pasangan acak
            $matchCount = 0;
            $jadwalBase = date('Y-m-d 08:00:00'); // Mulai jam 8 pagi

            for ($i = 0; $i < count($allAtlet) - 1; $i += 2) {
                $atlet1 = $allAtlet[$i];
                $atlet2 = $allAtlet[$i + 1];

                // Hitung jadwal (setiap pertandingan 30 menit)
                $jadwal = date('Y-m-d H:i:s', strtotime($jadwalBase . ' +' . ($matchCount * 30) . ' minutes'));

                $matchData = [
                    'id_event' => $eventId,
                    'babak' => 'Penyisihan',
                    'id_atlet1' => $atlet1['id_atlet'],
                    'id_atlet2' => $atlet2['id_atlet'],
                    'jadwal' => $jadwal,
                    'venue' => 'Lapangan ' . (($matchCount % 4) + 1)
                ];

                $this->pertandinganModel->insert($matchData);
                $matchCount++;
            }

            // Jika jumlah atlet ganjil, buat bye (atlet istirahat)
            if (count($allAtlet) % 2 === 1) {
                $lastAtlet = $allAtlet[count($allAtlet) - 1];
                $jadwal = date('Y-m-d H:i:s', strtotime($jadwalBase . ' +' . ($matchCount * 30) . ' minutes'));

                $matchData = [
                    'id_event' => $eventId,
                    'babak' => 'Bye',
                    'id_atlet1' => $lastAtlet['id_atlet'],
                    'id_atlet2' => $lastAtlet['id_atlet'], // Sama dengan atlet1 untuk bye
                    'jadwal' => $jadwal,
                    'venue' => 'Bye'
                ];

                $this->pertandinganModel->insert($matchData);
                $matchCount++;
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal menyimpan pertandingan.');
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Berhasil membuat ' . $matchCount . ' pertandingan untuk ' . count($allAtlet) . ' atlet.',
                'match_count' => $matchCount,
                'athlete_count' => count($allAtlet)
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Hapus semua pertandingan hari ini
     */
    public function clearMatches()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Akses ditolak.']);
        }

        try {
            $db = \Config\Database::connect();
            $db->transStart();

            // Hapus pertandingan yang dibuat hari ini
            $today = date('Y-m-d');
            $deleted = $db->table('pertandingan')
                ->where('DATE(jadwal)', $today)
                ->delete();

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal menghapus pertandingan.');
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Berhasil menghapus ' . $deleted . ' pertandingan.'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Lihat pertandingan hari ini
     */
    public function viewToday()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('auth/login')->with('error', 'Akses ditolak.');
        }

        $today = date('Y-m-d');

        $matches = $this->pertandinganModel->select('pertandingan.*, 
                                                     atlet1.id_atlet as id_atlet1_check,
                                                     user1.nama_lengkap as nama_atlet1,
                                                     atlet2.id_atlet as id_atlet2_check,
                                                     user2.nama_lengkap as nama_atlet2,
                                                     event.nama_event')
            ->join('atlet as atlet1', 'atlet1.id_atlet = pertandingan.id_atlet1', 'left')
            ->join('user as user1', 'user1.id_user = atlet1.id_user', 'left')
            ->join('atlet as atlet2', 'atlet2.id_atlet = pertandingan.id_atlet2', 'left')
            ->join('user as user2', 'user2.id_user = atlet2.id_user', 'left')
            ->join('event', 'event.id_event = pertandingan.id_event', 'left')
            ->where('DATE(pertandingan.jadwal)', $today)
            ->orderBy('pertandingan.jadwal', 'ASC')
            ->findAll();

        $data = [
            'title' => 'Pertandingan Hari Ini',
            'matches' => $matches,
            'today' => $today
        ];

        return view('admin/matches_today', $data);
    }
}
