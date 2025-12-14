<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\AtletModel;
use App\Models\PendaftaranEventModel;

class AtletDashboard extends BaseController
{
    protected $userModel;
    protected $atletModel;
    protected $pendaftaranEventModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->atletModel = new AtletModel();
        $this->pendaftaranEventModel = new PendaftaranEventModel();
    }

    public function index()
    {
        // Pastikan user sudah login dan role atlet
        if (!session()->get('logged_in') || session()->get('role') !== 'atlet') {
            return redirect()->to('auth/login')->with('error', 'Akses ditolak. Silakan login sebagai atlet.');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        // Cari data atlet
        $atlet = $this->atletModel->where('id_user', $userId)->first();

        // Cek kelengkapan profil
        $profilLengkap = $this->cekKelengkapanProfil($atlet);

        // Jika profil belum lengkap, redirect ke halaman lengkapi profil
        if (!$profilLengkap) {
            return redirect()->to('user/atlet/lengkapi-profil')
                ->with('warning', 'Silakan lengkapi profil Anda terlebih dahulu sebelum mengakses fitur lainnya.');
        }

        // Statistik atlet
        $statistik = $this->getStatistikAtlet($atlet['id_atlet']);

        $data = [
            'title' => 'Dashboard Atlet',
            'user' => $user,
            'atlet' => $atlet,
            'statistik' => $statistik,
            'profil_lengkap' => $profilLengkap
        ];

        return view('user/atlet/dashboard', $data);
    }

    public function profil()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'atlet') {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);
        $atlet = $this->atletModel->where('id_user', $userId)->first();

        $data = [
            'title' => 'Profil Atlet',
            'user' => $user,
            'atlet' => $atlet
        ];

        return view('user/atlet/profil', $data);
    }

    public function kartuAtlet()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'atlet') {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $atlet = $this->atletModel->select('atlet.*, klub.nama as nama_klub, user.nama_lengkap')
            ->join('klub', 'klub.id_klub = atlet.id_klub', 'left')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->where('atlet.id_user', $userId)
            ->first();

        if (!$atlet || $atlet['status'] !== 'aktif') {
            return redirect()->to('user/atlet/dashboard')
                ->with('error', 'Kartu atlet hanya tersedia untuk atlet yang sudah diverifikasi.');
        }

        $data = [
            'title' => 'Kartu Atlet',
            'atlet' => $atlet
        ];

        return view('user/atlet/kartu', $data);
    }

    public function daftarTurnamen()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'atlet') {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $atlet = $this->atletModel->where('id_user', $userId)->first();

        if (!$atlet || $atlet['status'] !== 'aktif') {
            return redirect()->to('user/atlet/dashboard')
                ->with('error', 'Anda harus diverifikasi terlebih dahulu sebelum dapat mendaftar turnamen.');
        }

        // Ambil turnamen yang tersedia
        $eventModel = new \App\Models\EventModel();
        $turnamenTersedia = $eventModel->where('status', 'aktif')
            ->where('tanggal_mulai >', date('Y-m-d'))
            ->orderBy('tanggal_mulai', 'ASC')
            ->findAll();

        // Ambil riwayat pendaftaran
        $riwayatPendaftaran = $this->pendaftaranEventModel->select('pendaftaran_event.*, event.nama_event, event.tanggal_mulai')
            ->join('event', 'event.id_event = pendaftaran_event.id_event', 'left')
            ->where('pendaftaran_event.id_atlet', $atlet['id_atlet'])
            ->orderBy('pendaftaran_event.tanggal_daftar', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Daftar Turnamen',
            'atlet' => $atlet,
            'turnamen_tersedia' => $turnamenTersedia,
            'riwayat_pendaftaran' => $riwayatPendaftaran
        ];

        return view('user/atlet/daftar_turnamen', $data);
    }

    public function riwayatPertandingan()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'atlet') {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $atlet = $this->atletModel->where('id_user', $userId)->first();

        // Ambil riwayat pertandingan dari bracket turnamen
        $bracketModel = new \App\Models\BracketTurnamenModel();
        $riwayat = $bracketModel->select('bracket_turnamen.*, event.nama_event, event.tanggal_mulai')
            ->join('event', 'event.id_event = bracket_turnamen.id_event', 'left')
            ->where('bracket_turnamen.id_atlet_1', $atlet['id_atlet'])
            ->orWhere('bracket_turnamen.id_atlet_2', $atlet['id_atlet'])
            ->orderBy('event.tanggal_mulai', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Riwayat Pertandingan',
            'atlet' => $atlet,
            'riwayat' => $riwayat
        ];

        return view('user/atlet/riwayat_pertandingan', $data);
    }

    public function rankingPribadi()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'atlet') {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $atlet = $this->atletModel->where('id_user', $userId)->first();

        // Ambil data ranking dari tabel ranking
        $rankingModel = new \App\Models\RankingModel();
        $ranking = $rankingModel->where('id_atlet', $atlet['id_atlet'])
            ->orderBy('tahun', 'DESC')
            ->orderBy('bulan', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Ranking Pribadi',
            'atlet' => $atlet,
            'ranking' => $ranking
        ];

        return view('user/atlet/ranking_pribadi', $data);
    }

    public function lengkapiProfil()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'atlet') {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);
        $atlet = $this->atletModel->where('id_user', $userId)->first();

        $data = [
            'title' => 'Lengkapi Profil Atlet',
            'user' => $user,
            'atlet' => $atlet
        ];

        return view('user/atlet/lengkapi_profil', $data);
    }

    private function cekKelengkapanProfil($atlet)
    {
        if (!$atlet) return false;

        // Cek field wajib yang harus diisi
        $fieldWajib = [
            'nama_lengkap',
            'tanggal_lahir',
            'jenis_kelamin',
            'alamat',
            'no_hp',
            'kategori_usia'
        ];

        foreach ($fieldWajib as $field) {
            if (empty($atlet[$field])) {
                return false;
            }
        }

        return true;
    }

    private function getStatistikAtlet($idAtlet)
    {
        // Hitung statistik atlet
        $totalTurnamen = $this->pendaftaranEventModel->where('id_atlet', $idAtlet)
            ->where('status', 'diterima')
            ->countAllResults();

        $bracketModel = new \App\Models\BracketTurnamenModel();
        $totalPertandingan = $bracketModel->groupStart()
            ->where('id_atlet_1', $idAtlet)
            ->orWhere('id_atlet_2', $idAtlet)
            ->groupEnd()
            ->countAllResults();

        $menang = $bracketModel->groupStart()
            ->where('id_atlet_1', $idAtlet)
            ->where('pemenang', 1)
            ->orWhere('id_atlet_2', $idAtlet)
            ->where('pemenang', 2)
            ->groupEnd()
            ->countAllResults();

        return [
            'total_turnamen' => $totalTurnamen,
            'total_pertandingan' => $totalPertandingan,
            'menang' => $menang,
            'kalah' => $totalPertandingan - $menang,
            'win_rate' => $totalPertandingan > 0 ? round(($menang / $totalPertandingan) * 100, 1) : 0
        ];
    }
}
