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
            'statistik' => $statistik,
            // Top 10 Atlet Ranking
            'top_atlet' => $this->getTopAtlet(10),
            // Atlet per Klub
            'atlet_per_klub' => $this->getAtletPerKlub(5),
            // Statistik Pendaftaran Bulan Ini
            'statistik_bulan_ini' => $this->getStatistikBulanIni(),
            // Turnamen Mendatang
            'turnamen_mendatang' => $this->getTurnamenMendatang(5),
        ];

        // Get latest data
        $data['beritaTerbaru'] = $this->beritaModel
            ->orderBy('tanggal_publikasi', 'DESC')
            ->limit(5)
            ->findAll();

        $data['eventMendatang'] = $this->eventModel
            ->where('status', 'aktif')
            ->orderBy('id_event', 'DESC')
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

    /**
     * Get top atlet berdasarkan ranking
     */
    private function getTopAtlet($limit = 10)
    {
        $rankingModel = new \App\Models\RankingModel();
        return $rankingModel->select('ranking.*, atlet.nama_lengkap, klub.nama as nama_klub')
            ->join('atlet', 'atlet.id_atlet = ranking.id_atlet', 'left')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->orderBy('ranking.poin', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Get atlet per klub (top N)
     */
    private function getAtletPerKlub($limit = 5)
    {
        $db = \Config\Database::connect();
        return $db->query(
            "
            SELECT k.id_klub, k.nama, COUNT(a.id_atlet) as total_atlet
            FROM klub k
            LEFT JOIN atlet a ON a.id_klub = k.id_klub AND a.status = 'aktif'
            GROUP BY k.id_klub, k.nama
            ORDER BY total_atlet DESC
            LIMIT " . (int)$limit
        )->getResultArray();
    }

    /**
     * Get statistik pendaftaran bulan ini
     */
    private function getStatistikBulanIni()
    {
        $db = \Config\Database::connect();
        $bulan = date('m');
        $tahun = date('Y');

        $pendaftaranAtletModel = new \App\Models\PendaftaranAtletModel();
        $pendaftaranPelatihModel = new \App\Models\PendaftaranPelatihModel();

        return [
            'atlet_bulan_ini' => $pendaftaranAtletModel
                ->where("MONTH(dibuat_pada)", $bulan)
                ->where("YEAR(dibuat_pada)", $tahun)
                ->countAllResults(),
            'pelatih_bulan_ini' => $pendaftaranPelatihModel
                ->where("MONTH(dibuat_pada)", $bulan)
                ->where("YEAR(dibuat_pada)", $tahun)
                ->countAllResults(),
            'klub_bulan_ini' => $this->klubModel
                ->where("MONTH(dibuat_pada)", $bulan)
                ->where("YEAR(dibuat_pada)", $tahun)
                ->countAllResults(),
        ];
    }

    /**
     * Get turnamen mendatang
     */
    private function getTurnamenMendatang($limit = 5)
    {
        $turnamenModel = new \App\Models\TurnamenModel();
        return $turnamenModel
            ->orderBy('id_turnamen', 'DESC')
            ->limit($limit)
            ->findAll();
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
}
