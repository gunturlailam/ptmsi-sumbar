<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PelatihModel;
use App\Models\AtletModel;
use App\Models\SertifikasiModel;

class PelatihDashboard extends BaseController
{
    protected $userModel;
    protected $pelatihModel;
    protected $atletModel;
    protected $sertifikasiModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->pelatihModel = new PelatihModel();
        $this->atletModel = new AtletModel();
        $this->sertifikasiModel = new \App\Models\SertifikasiModel();
    }

    public function index()
    {
        // Pastikan user sudah login dan role pelatih
        if (!session()->get('logged_in') || session()->get('role') !== 'pelatih') {
            return redirect()->to('auth/login')->with('error', 'Akses ditolak. Silakan login sebagai pelatih.');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        // Cari data pelatih
        $pelatih = $this->pelatihModel->select('pelatih.*, klub.nama as nama_klub')
            ->join('klub', 'klub.id_klub = pelatih.id_klub', 'left')
            ->where('pelatih.id_user', $userId)
            ->first();

        if (!$pelatih) {
            return redirect()->to('auth/login')
                ->with('error', 'Data pelatih tidak ditemukan.');
        }

        // Statistik pelatih
        $statistik = $this->getStatistikPelatih($pelatih['id_pelatih']);

        $data = [
            'title' => 'Dashboard Pelatih',
            'user' => $user,
            'pelatih' => $pelatih,
            'statistik' => $statistik
        ];

        return view('user/pelatih/dashboard', $data);
    }

    public function profil()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'pelatih') {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);
        $pelatih = $this->pelatihModel->select('pelatih.*, klub.nama as nama_klub')
            ->join('klub', 'klub.id_klub = pelatih.id_klub', 'left')
            ->where('pelatih.id_user', $userId)
            ->first();

        $data = [
            'title' => 'Profil Pelatih',
            'user' => $user,
            'pelatih' => $pelatih
        ];

        return view('user/pelatih/profil', $data);
    }

    public function sertifikasi()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'pelatih') {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $pelatih = $this->pelatihModel->where('id_user', $userId)->first();

        if (!$pelatih) {
            return redirect()->to('auth/login')
                ->with('error', 'Data pelatih tidak ditemukan.');
        }

        // Ambil sertifikasi aktif
        $sertifikasi_aktif = $this->sertifikasiModel->where('id_pelatih', $pelatih['id_pelatih'])
            ->where('tanggal_kadaluarsa >=', date('Y-m-d'))
            ->orWhere('tanggal_kadaluarsa', null)
            ->findAll();

        // Ambil riwayat sertifikasi
        $sertifikasi_riwayat = $this->sertifikasiModel->where('id_pelatih', $pelatih['id_pelatih'])
            ->orderBy('tanggal_dikeluarkan', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Sertifikasi Pelatih',
            'pelatih' => $pelatih,
            'sertifikasi_aktif' => $sertifikasi_aktif,
            'sertifikasi_riwayat' => $sertifikasi_riwayat
        ];

        return view('user/pelatih/sertifikasi', $data);
    }

    public function atletBinaan()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'pelatih') {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $pelatih = $this->pelatihModel->where('id_user', $userId)->first();

        if (!$pelatih) {
            return redirect()->to('auth/login')
                ->with('error', 'Data pelatih tidak ditemukan.');
        }

        $pelatihAtletModel = new \App\Models\PelatihAtletModel();

        // Ambil atlet binaan aktif
        $atlet_aktif = $pelatihAtletModel->getAtletBinaanAktif($pelatih['id_pelatih']);

        // Ambil riwayat atlet binaan
        $riwayat_atlet = $pelatihAtletModel->getRiwayatAtletBinaan($pelatih['id_pelatih']);

        $data = [
            'title' => 'Atlet Binaan',
            'pelatih' => $pelatih,
            'atlet_aktif' => $atlet_aktif,
            'riwayat_atlet' => $riwayat_atlet
        ];

        return view('user/pelatih/atlet_binaan', $data);
    }

    private function getStatistikPelatih($idPelatih)
    {
        $db = \Config\Database::connect();
        $pelatih = $this->pelatihModel->find($idPelatih);
        $pelatihAtletModel = new \App\Models\PelatihAtletModel();

        // Hitung total atlet binaan aktif
        $total_atlet = $pelatihAtletModel->getTotalAtletAktif($idPelatih);

        // Hitung total sertifikasi
        $total_sertifikasi = $this->sertifikasiModel->where('id_pelatih', $idPelatih)
            ->countAllResults();

        // Hitung atlet juara (medali)
        $atlet_juara = 0;
        try {
            $medalResult = $db->query("
                SELECT COUNT(DISTINCT h.id_pemenang_atlet) as total
                FROM hasil h
                JOIN pelatih_atlet pa ON pa.id_atlet = h.id_pemenang_atlet
                WHERE pa.id_pelatih = ?
            ", [$idPelatih])->getRow();
            $atlet_juara = $medalResult->total ?? 0;
        } catch (\Exception $e) {
            // Table might not exist
        }

        // Hitung tahun pengalaman
        $tahun_pengalaman = 0;
        if (!empty($pelatih['dibuat_pada'])) {
            $tahun_pengalaman = date('Y') - date('Y', strtotime($pelatih['dibuat_pada']));
        }

        // Get top atlet binaan
        $top_atlet = $pelatihAtletModel->select('pa.*, 
                                                 atlet.id_atlet,
                                                 user.nama_lengkap,
                                                 ranking.poin, ranking.posisi')
            ->join('atlet', 'atlet.id_atlet = pa.id_atlet', 'left')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->join('ranking', 'ranking.id_atlet = atlet.id_atlet', 'left')
            ->where('pa.id_pelatih', $idPelatih)
            ->where('pa.status', 'aktif')
            ->orderBy('ranking.poin', 'DESC')
            ->limit(5)
            ->findAll();

        return [
            'total_atlet' => $total_atlet,
            'total_sertifikasi' => $total_sertifikasi,
            'atlet_juara' => $atlet_juara,
            'tahun_pengalaman' => $tahun_pengalaman,
            'top_atlet' => $top_atlet
        ];
    }
}
