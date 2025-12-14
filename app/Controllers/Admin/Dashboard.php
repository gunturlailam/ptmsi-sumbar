<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AtletModel;
use App\Models\PelatihModel;
use App\Models\KlubModel;
use App\Models\EventModel;
use App\Models\BeritaModel;

class Dashboard extends BaseController
{
    protected $atletModel;
    protected $pelatihModel;
    protected $klubModel;
    protected $eventModel;
    protected $beritaModel;

    public function __construct()
    {
        // Check if user is logged in and is admin
        if (!session()->get('logged_in')) {
            redirect()->to('auth/login')->send();
            exit;
        }

        if (session()->get('role') !== 'admin') {
            redirect()->to('/')->with('error', 'Akses ditolak. Anda tidak memiliki hak akses admin.')->send();
            exit;
        }

        $this->atletModel = new AtletModel();
        $this->pelatihModel = new PelatihModel();
        $this->klubModel = new KlubModel();
        $this->eventModel = new EventModel();
        $this->beritaModel = new BeritaModel();
    }

    public function index()
    {
        // Statistik lengkap untuk Admin Provinsi
        $statistik = $this->getStatistikProvinsi();

        $data = [
            'title' => 'Dashboard Admin Provinsi PTMSI Sumbar',
            'statistik' => $statistik
        ];

        // Get latest data
        $data['beritaTerbaru'] = $this->beritaModel
            ->orderBy('tanggal_publikasi', 'DESC')
            ->limit(5)
            ->findAll();

        $data['eventMendatang'] = $this->eventModel
            ->where('tanggal_mulai >=', date('Y-m-d'))
            ->orderBy('tanggal_mulai', 'ASC')
            ->limit(5)
            ->findAll();

        // Pendaftaran yang menunggu verifikasi
        $pendaftaranAtletModel = new \App\Models\PendaftaranAtletModel();
        $pendaftaranPelatihModel = new \App\Models\PendaftaranPelatihModel();

        $data['pendaftaranAtletPending'] = $pendaftaranAtletModel
            ->where('status', 'menunggu_verifikasi_admin')
            ->limit(5)
            ->findAll();

        $data['pendaftaranPelatihPending'] = $pendaftaranPelatihModel
            ->where('status', 'menunggu_verifikasi_admin')
            ->limit(5)
            ->findAll();

        return view('admin/dashboard', $data);
    }

    public function kelolaRanking()
    {
        $rankingModel = new \App\Models\RankingModel();

        // Ambil ranking terbaru
        $rankingTerbaru = $rankingModel->select('ranking.*, atlet.nama_lengkap, klub.nama as nama_klub')
            ->join('atlet', 'atlet.id_atlet = ranking.id_atlet', 'left')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->where('ranking.tahun', date('Y'))
            ->where('ranking.bulan', date('n'))
            ->orderBy('ranking.peringkat', 'ASC')
            ->findAll();

        $data = [
            'title' => 'Kelola Ranking Atlet',
            'ranking_terbaru' => $rankingTerbaru
        ];

        return view('admin/kelola_ranking', $data);
    }

    public function updateRankingOtomatis()
    {
        // Logic untuk update ranking otomatis berdasarkan hasil pertandingan
        $bracketModel = new \App\Models\BracketTurnamenModel();
        $rankingModel = new \App\Models\RankingModel();

        // Ambil hasil pertandingan bulan ini
        $hasilBulanIni = $bracketModel->select('bracket_turnamen.*, event.kategori, event.tingkat')
            ->join('event', 'event.id_event = bracket_turnamen.id_event', 'left')
            ->where('MONTH(bracket_turnamen.tanggal_pertandingan)', date('n'))
            ->where('YEAR(bracket_turnamen.tanggal_pertandingan)', date('Y'))
            ->where('bracket_turnamen.pemenang IS NOT NULL')
            ->findAll();

        // Hitung poin untuk setiap atlet
        $poinAtlet = [];
        foreach ($hasilBulanIni as $hasil) {
            $pemenang = $hasil['pemenang'] == 1 ? $hasil['id_atlet_1'] : $hasil['id_atlet_2'];
            $kalah = $hasil['pemenang'] == 1 ? $hasil['id_atlet_2'] : $hasil['id_atlet_1'];

            // Poin berdasarkan tingkat event
            $poinMenang = $this->hitungPoin($hasil['tingkat'] ?? 'kabupaten', true);
            $poinKalah = $this->hitungPoin($hasil['tingkat'] ?? 'kabupaten', false);

            if (!isset($poinAtlet[$pemenang])) $poinAtlet[$pemenang] = 0;
            if (!isset($poinAtlet[$kalah])) $poinAtlet[$kalah] = 0;

            $poinAtlet[$pemenang] += $poinMenang;
            $poinAtlet[$kalah] += $poinKalah;
        }

        // Update ranking
        arsort($poinAtlet);
        $peringkat = 1;
        foreach ($poinAtlet as $idAtlet => $totalPoin) {
            $rankingModel->upsertRanking([
                'id_atlet' => $idAtlet,
                'tahun' => date('Y'),
                'bulan' => date('n'),
                'peringkat' => $peringkat,
                'total_poin' => $totalPoin,
                'diperbarui_pada' => date('Y-m-d H:i:s')
            ]);
            $peringkat++;
        }

        return redirect()->back()->with('success', 'Ranking berhasil diperbarui otomatis.');
    }



    private function getStatistikProvinsi()
    {
        $pendaftaranAtletModel = new \App\Models\PendaftaranAtletModel();
        $pendaftaranPelatihModel = new \App\Models\PendaftaranPelatihModel();

        return [
            'total_klub' => $this->klubModel->countAllResults(),
            'klub_aktif' => $this->klubModel->where('status', 'aktif')->countAllResults(),
            'klub_pending' => $this->klubModel->where('status', 'pending')->countAllResults(),
            'total_atlet' => $this->atletModel->where('status', 'aktif')->countAllResults(),
            'total_pelatih' => $this->pelatihModel->countAllResults(), // Pelatih table doesn't have status column
            'event_aktif' => $this->eventModel->where('status', 'aktif')->countAllResults(),
            'pendaftaran_atlet_pending' => $pendaftaranAtletModel->where('status', 'menunggu_verifikasi_admin')->countAllResults(),
            'pendaftaran_pelatih_pending' => $pendaftaranPelatihModel->where('status', 'menunggu_verifikasi_admin')->countAllResults(),
            'total_berita' => $this->beritaModel->countAllResults()
        ];
    }

    private function hitungPoin($tingkatEvent, $menang)
    {
        $poinBase = [
            'nasional' => 100,
            'provinsi' => 50,
            'kabupaten' => 25,
            'kota' => 25
        ];

        $poin = $poinBase[$tingkatEvent] ?? 10;
        return $menang ? $poin : ($poin * 0.3); // Kalah dapat 30% poin
    }

    private function generateUUID()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}
