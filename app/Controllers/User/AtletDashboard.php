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

        if (!$atlet) {
            return redirect()->to('user/atlet/lengkapi-profil')
                ->with('warning', 'Data atlet tidak ditemukan. Silakan lengkapi profil Anda.');
        }

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

    public function updateProfil()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'atlet') {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $atlet = $this->atletModel->where('id_user', $userId)->first();

        if (!$atlet) {
            return redirect()->back()->with('error', 'Data atlet tidak ditemukan.');
        }

        // Validasi input
        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'tanggal_lahir' => 'required|valid_date[Y-m-d]',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'no_hp' => 'required|min_length[10]|max_length[15]',
            'alamat' => 'required|min_length[5]',
            'kategori_usia' => 'permit_empty|in_list[U-12,U-15,U-18,Senior]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update atlet data
        $this->atletModel->update($atlet['id_atlet'], [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'no_hp' => $this->request->getPost('no_hp'),
            'alamat' => $this->request->getPost('alamat'),
            'kategori_usia' => $this->request->getPost('kategori_usia')
        ]);

        // Update user nama_lengkap only (email tidak bisa diubah)
        $this->userModel->update($userId, [
            'nama_lengkap' => $this->request->getPost('nama_lengkap')
        ]);

        return redirect()->to('user/atlet/profil')->with('success', 'Profil berhasil diperbarui.');
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

        if (!$atlet) {
            return redirect()->to('user/atlet/dashboard')
                ->with('error', 'Data atlet tidak ditemukan.');
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

        if (!$atlet) {
            return redirect()->to('user/atlet/dashboard')
                ->with('error', 'Data atlet tidak ditemukan.');
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

        // Return empty riwayat for now
        // Match history will be populated when match tracking system is implemented
        $riwayat = [];

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
            ->orderBy('tanggal_berlaku', 'DESC')
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
        $db = \Config\Database::connect();

        // Get ranking data
        $rankingModel = new \App\Models\RankingModel();
        $ranking = $rankingModel->where('id_atlet', $idAtlet)
            ->orderBy('tanggal_berlaku', 'DESC')
            ->first();

        // Get tournament participation
        $pendaftaranModel = new \App\Models\PendaftaranEventModel();
        $totalTurnamen = $pendaftaranModel->where('id_atlet', $idAtlet)->countAllResults();

        // Get match statistics (if bracket table exists)
        $totalPertandingan = 0;
        $menang = 0;
        $kalah = 0;
        $winRate = 0;

        try {
            $bracketResult = $db->query("
                SELECT 
                    COUNT(*) as total,
                    SUM(CASE WHEN pemenang = 1 THEN 1 ELSE 0 END) as menang,
                    SUM(CASE WHEN pemenang = 2 THEN 1 ELSE 0 END) as kalah
                FROM bracket_turnamen
                WHERE (id_atlet_1 = ? OR id_atlet_2 = ?)
                AND pemenang IS NOT NULL
            ", [$idAtlet, $idAtlet])->getRow();

            if ($bracketResult) {
                $totalPertandingan = $bracketResult->total ?? 0;
                $menang = $bracketResult->menang ?? 0;
                $kalah = $bracketResult->kalah ?? 0;
                $winRate = $totalPertandingan > 0 ? round(($menang / $totalPertandingan) * 100, 2) : 0;
            }
        } catch (\Exception $e) {
            // Table might not exist, use default values
        }

        return [
            'ranking' => $ranking['posisi'] ?? '-',
            'poin' => $ranking['poin'] ?? 0,
            'total_turnamen' => $totalTurnamen,
            'total_pertandingan' => $totalPertandingan,
            'menang' => $menang,
            'kalah' => $kalah,
            'win_rate' => $winRate
        ];
    }
}
