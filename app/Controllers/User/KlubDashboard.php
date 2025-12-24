<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\KlubModel;
use App\Models\AtletModel;
use App\Models\PelatihModel;
use App\Models\PendaftaranAtletModel;
use App\Models\PendaftaranPelatihModel;

class KlubDashboard extends BaseController
{
    protected $userModel;
    protected $klubModel;
    protected $atletModel;
    protected $pelatihModel;
    protected $pendaftaranAtletModel;
    protected $pendaftaranPelatihModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->klubModel = new KlubModel();
        $this->atletModel = new AtletModel();
        $this->pelatihModel = new PelatihModel();
        $this->pendaftaranAtletModel = new PendaftaranAtletModel();
        $this->pendaftaranPelatihModel = new PendaftaranPelatihModel();
    }

    public function index()
    {
        // Pastikan user sudah login dan role klub
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login')->with('error', 'Akses ditolak. Silakan login sebagai klub.');
        }

        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);
        $klub = $this->klubModel->where('id_user', $userId)->first();

        if (!$klub) {
            return redirect()->to('auth/login')->with('error', 'Data klub tidak ditemukan.');
        }

        // Cek status klub
        $statusAktif = $klub['status'] === 'aktif';

        // Jika belum aktif, hanya bisa upload dokumen
        if (!$statusAktif) {
            return $this->dashboardBelumAktif($user, $klub);
        }

        // Statistik klub
        $statistik = $this->getStatistikKlub($klub['id_klub']);

        $data = [
            'title' => 'Dashboard Klub',
            'user' => $user,
            'klub' => $klub,
            'statistik' => $statistik,
            'status_aktif' => $statusAktif
        ];

        return view('user/klub/dashboard', $data);
    }

    public function dataKlub()
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->select('klub.*, organisasi.nama_organisasi')
            ->join('organisasi', 'organisasi.id_organisasi = klub.id_organisasi', 'left')
            ->where('klub.id_user', $userId)
            ->first();

        $data = [
            'title' => 'Data Klub',
            'klub' => $klub
        ];

        return view('user/klub/data_klub', $data);
    }

    public function kelolaAtlet()
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        if ($klub['status'] !== 'aktif') {
            return redirect()->to('user/klub/dashboard')
                ->with('error', 'Klub harus aktif untuk mengelola atlet.');
        }

        // Ambil daftar atlet aktif
        $atletAktif = $this->atletModel->select('atlet.*, user.nama_lengkap, user.email')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->where('atlet.id_klub', $klub['id_klub'])
            ->where('atlet.status', 'aktif')
            ->findAll();

        // Ambil pendaftaran atlet yang menunggu verifikasi klub
        $pendaftaranPending = $this->pendaftaranAtletModel->where('id_klub', $klub['id_klub'])
            ->where('status', 'menunggu_verifikasi_klub')
            ->orderBy('tanggal_daftar', 'ASC')
            ->findAll();



        $data = [
            'title' => 'Kelola Atlet',
            'klub' => $klub,
            'atlet_aktif' => $atletAktif,
            'pendaftaran_pending' => $pendaftaranPending
        ];

        return view('user/klub/kelola_atlet', $data);
    }

    public function kelolaPelatih()
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        if ($klub['status'] !== 'aktif') {
            return redirect()->to('user/klub/dashboard')
                ->with('error', 'Klub harus aktif untuk mengelola pelatih.');
        }

        // Ambil daftar pelatih dengan jenis dari pendaftaran
        $pelatihAktif = $this->pelatihModel->select('pelatih.*, user.nama_lengkap, user.email, COALESCE(pp.jenis_pelatih, "Pelatih") as jenis_pelatih')
            ->join('user', 'user.id_user = pelatih.id_user', 'left')
            ->join('pendaftaran_pelatih pp', 'pp.id_pelatih = pelatih.id_pelatih', 'left')
            ->where('pelatih.id_klub', $klub['id_klub'])
            ->findAll();

        // Ambil pendaftaran pelatih
        $pendaftaranPelatih = $this->pendaftaranPelatihModel->where('id_klub', $klub['id_klub'])
            ->orderBy('tanggal_daftar', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Kelola Pelatih & Wasit',
            'klub' => $klub,
            'pelatih_aktif' => $pelatihAktif,
            'pendaftaran_pelatih' => $pendaftaranPelatih
        ];

        return view('user/klub/kelola_pelatih', $data);
    }

    public function pendaftaranTurnamen()
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        if ($klub['status'] !== 'aktif') {
            return redirect()->to('user/klub/dashboard')
                ->with('error', 'Klub harus aktif untuk mendaftar turnamen.');
        }

        // Ambil turnamen yang tersedia
        $eventModel = new \App\Models\EventModel();
        $turnamenTersedia = $eventModel->where('status', 'aktif')
            ->where('tanggal_mulai >', date('Y-m-d'))
            ->orderBy('tanggal_mulai', 'ASC')
            ->findAll();

        // Hitung jumlah peserta untuk setiap turnamen
        $pendaftaranEventModel = new \App\Models\PendaftaranEventModel();
        foreach ($turnamenTersedia as &$turnamen) {
            $jumlahPeserta = $pendaftaranEventModel
                ->where('id_event', $turnamen['id_event'])
                ->where('status_verifikasi', 'diverifikasi')
                ->countAllResults();

            $turnamen['jumlah_peserta'] = $jumlahPeserta;
            $turnamen['sisa_kuota'] = ($turnamen['kuota_peserta'] ?? 0) - $jumlahPeserta;
        }

        // Ambil riwayat pendaftaran turnamen klub
        $pendaftaranEventModel = new \App\Models\PendaftaranEventModel();
        $riwayatPendaftaran = $pendaftaranEventModel->select('pendaftaran_event.*, event.nama_event, user.nama_lengkap as nama_atlet')
            ->join('event', 'event.id_event = pendaftaran_event.id_event', 'left')
            ->join('atlet', 'atlet.id_atlet = pendaftaran_event.id_atlet', 'left')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->where('atlet.id_klub', $klub['id_klub'])
            ->orderBy('pendaftaran_event.tanggal_daftar', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Pendaftaran Turnamen',
            'klub' => $klub,
            'turnamen_tersedia' => $turnamenTersedia,
            'riwayat_pendaftaran' => $riwayatPendaftaran
        ];

        return view('user/klub/pendaftaran_turnamen', $data);
    }

    public function kelolaAnggota()
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        // Ambil semua anggota klub (atlet + pelatih)
        $anggotaAtlet = $this->atletModel->select('atlet.*, user.nama_lengkap, user.email, "Atlet" as jenis')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->where('atlet.id_klub', $klub['id_klub'])
            ->findAll();

        $anggotaPelatih = $this->pelatihModel->select('pelatih.*, user.nama_lengkap, user.email, user.nohp, pelatih.tingkat_sertifikasi as jenis')
            ->join('user', 'user.id_user = pelatih.id_user', 'left')
            ->where('pelatih.id_klub', $klub['id_klub'])
            ->findAll();

        $data = [
            'title' => 'Kelola Anggota Klub',
            'klub' => $klub,
            'anggota_atlet' => $anggotaAtlet,
            'anggota_pelatih' => $anggotaPelatih
        ];

        return view('user/klub/kelola_anggota', $data);
    }

    public function approveAtlet()
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        $pendaftaranId = $this->request->getPost('pendaftaran_id');
        $catatan = $this->request->getPost('catatan');

        $pendaftaran = $this->pendaftaranAtletModel->where('id_pendaftaran_atlet', $pendaftaranId)
            ->where('id_klub', $klub['id_klub'])
            ->where('status', 'menunggu_verifikasi_klub')
            ->first();

        if (!$pendaftaran) {
            return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        try {
            $db = \Config\Database::connect();
            $db->transStart();

            // Generate password default
            $defaultPassword = 'atlet' . date('Y');

            // Buat user account
            $userData = [
                'nama_lengkap' => $pendaftaran['nama_lengkap'],
                'email' => $pendaftaran['email'],
                'password_hash' => password_hash($defaultPassword, PASSWORD_DEFAULT),
                'peran' => 'atlet',
                'dibuat_pada' => date('Y-m-d H:i:s')
            ];

            $userIdBaru = $this->userModel->insert($userData);

            // Handle foto - move from pendaftaran folder to atlet folder
            $fotoPath = null;
            if ($pendaftaran['foto_path']) {
                $oldPath = FCPATH . 'uploads/pendaftaran_atlet/' . $pendaftaran['foto_path'];
                if (file_exists($oldPath)) {
                    $fileName = 'atlet_' . $userIdBaru . '_' . time() . '.' . pathinfo($pendaftaran['foto_path'], PATHINFO_EXTENSION);
                    $newPath = FCPATH . 'uploads/foto_atlet/' . $fileName;

                    if (copy($oldPath, $newPath)) {
                        $fotoPath = 'uploads/foto_atlet/' . $fileName;
                        unlink($oldPath); // Remove old file
                    }
                }
            }

            // Buat data atlet
            $atletData = [
                'id_user' => $userIdBaru,
                'id_klub' => $klub['id_klub'],
                'tanggal_lahir' => $pendaftaran['tanggal_lahir'],
                'tempat_lahir' => $pendaftaran['tempat_lahir'],
                'jenis_kelamin' => $pendaftaran['jenis_kelamin'],
                'kategori_usia' => $pendaftaran['kategori_usia'],
                'no_hp' => $pendaftaran['no_hp'],
                'alamat' => $pendaftaran['alamat'],
                'foto' => $fotoPath,
                'status' => 'aktif',
                'tanggal_bergabung' => date('Y-m-d')
            ];

            $this->atletModel->insert($atletData);

            // Update status pendaftaran
            $updateData = [
                'status' => 'disetujui_klub',
                'catatan_klub' => $catatan,
                'tanggal_verifikasi_klub' => date('Y-m-d H:i:s'),
                'diverifikasi_klub_oleh' => $userId
            ];

            $this->pendaftaranAtletModel->update($pendaftaranId, $updateData);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal memproses persetujuan.');
            }

            return redirect()->back()->with('success', "Pendaftaran atlet disetujui! Atlet berhasil ditambahkan ke klub. Password default: {$defaultPassword}");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memproses verifikasi: ' . $e->getMessage());
        }
    }

    public function rejectAtlet()
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        $pendaftaranId = $this->request->getPost('pendaftaran_id');
        $catatan = $this->request->getPost('catatan');

        $pendaftaran = $this->pendaftaranAtletModel->where('id_pendaftaran_atlet', $pendaftaranId)
            ->where('id_klub', $klub['id_klub'])
            ->where('status', 'menunggu_verifikasi_klub')
            ->first();

        if (!$pendaftaran) {
            return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $updateData = [
            'status' => 'ditolak_klub',
            'catatan_klub' => $catatan,
            'tanggal_verifikasi_klub' => date('Y-m-d H:i:s'),
            'diverifikasi_klub_oleh' => $userId
        ];

        if ($this->pendaftaranAtletModel->update($pendaftaranId, $updateData)) {
            return redirect()->back()->with('success', 'Pendaftaran atlet ditolak.');
        } else {
            return redirect()->back()->with('error', 'Gagal memproses verifikasi.');
        }
    }



    public function detailPendaftaranPelatih($pendaftaranId)
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        $pendaftaran = $this->pendaftaranPelatihModel->where('id_pendaftaran_pelatih', $pendaftaranId)
            ->where('id_klub', $klub['id_klub'])
            ->first();

        if (!$pendaftaran) {
            return $this->response->setJSON(['success' => false, 'message' => 'Pendaftaran tidak ditemukan']);
        }

        // Format status text
        $statusText = 'Menunggu Verifikasi';
        if ($pendaftaran['status'] === 'diterima') {
            $statusText = 'Diterima';
        } elseif ($pendaftaran['status'] === 'ditolak') {
            $statusText = 'Ditolak';
        }

        // Format data untuk response
        $pendaftaranData = [
            'id_pendaftaran_pelatih' => $pendaftaran['id_pendaftaran_pelatih'],
            'nama_lengkap' => $pendaftaran['nama_lengkap'],
            'email' => $pendaftaran['email'],
            'no_hp' => $pendaftaran['no_hp'],
            'alamat' => $pendaftaran['alamat'],
            'jenis_pelatih' => $pendaftaran['jenis_pelatih'],
            'tanggal_daftar' => date('d/m/Y', strtotime($pendaftaran['tanggal_daftar'])),
            'status' => $pendaftaran['status'],
            'status_text' => $statusText,
            'foto' => $pendaftaran['foto'] ? base_url('uploads/pelatih/foto/' . $pendaftaran['foto']) : null,
            'sertifikat' => $pendaftaran['sertifikat'] ? base_url('uploads/pelatih/sertifikat/' . $pendaftaran['sertifikat']) : null
        ];

        return $this->response->setJSON(['success' => true, 'pendaftaran' => $pendaftaranData]);
    }

    public function detailPelatih($pelatihId)
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        $pelatih = $this->pelatihModel->select('pelatih.*, user.nama_lengkap, user.email, COALESCE(pp.jenis_pelatih, "Pelatih") as jenis_pelatih')
            ->join('user', 'user.id_user = pelatih.id_user', 'left')
            ->join('pendaftaran_pelatih pp', 'pp.id_pelatih = pelatih.id_pelatih', 'left')
            ->where('pelatih.id_pelatih', $pelatihId)
            ->where('pelatih.id_klub', $klub['id_klub'])
            ->first();

        if (!$pelatih) {
            return $this->response->setJSON(['success' => false, 'message' => 'Pelatih tidak ditemukan']);
        }

        // Format data untuk response
        $pelatihData = [
            'id_pelatih' => $pelatih['id_pelatih'],
            'nama_lengkap' => $pelatih['nama_lengkap'],
            'email' => $pelatih['email'],
            'jenis_pelatih' => $pelatih['jenis_pelatih'],
            'no_hp' => $pelatih['nohp'] ?? '',
            'alamat' => '-',
            'foto' => null,
            'sertifikat' => null
        ];

        return $this->response->setJSON(['success' => true, 'pelatih' => $pelatihData]);
    }

    public function detailPendaftaranTurnamen($pendaftaranId)
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        $pendaftaranEventModel = new \App\Models\PendaftaranEventModel();
        $eventModel = new \App\Models\EventModel();

        $pendaftaran = $pendaftaranEventModel->select('pendaftaran_event.*, event.nama_event, user.nama_lengkap as nama_atlet')
            ->join('event', 'event.id_event = pendaftaran_event.id_event', 'left')
            ->join('atlet', 'atlet.id_atlet = pendaftaran_event.id_atlet', 'left')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->where('pendaftaran_event.id_pendaftaran', $pendaftaranId)
            ->where('atlet.id_klub', $klub['id_klub'])
            ->first();

        if (!$pendaftaran) {
            return $this->response->setJSON(['success' => false, 'message' => 'Pendaftaran tidak ditemukan']);
        }

        // Format status text dan class
        $statusClass = 'secondary';
        $statusText = 'Pending';

        switch ($pendaftaran['status_verifikasi']) {
            case 'diverifikasi':
                $statusClass = 'success';
                $statusText = 'Diverifikasi';
                break;
            case 'ditolak':
                $statusClass = 'danger';
                $statusText = 'Ditolak';
                break;
            case 'pending':
                $statusClass = 'warning';
                $statusText = 'Menunggu Verifikasi';
                break;
        }

        $paymentClass = 'secondary';
        $paymentText = 'Belum Bayar';

        if ($pendaftaran['biaya_pendaftaran'] > 0) {
            switch ($pendaftaran['status_pembayaran']) {
                case 'lunas':
                    $paymentClass = 'success';
                    $paymentText = 'Lunas';
                    break;
                case 'menunggu_konfirmasi':
                    $paymentClass = 'warning';
                    $paymentText = 'Menunggu Konfirmasi';
                    break;
                case 'ditolak':
                    $paymentClass = 'danger';
                    $paymentText = 'Ditolak';
                    break;
            }
        } else {
            $paymentClass = 'info';
            $paymentText = 'Gratis';
        }

        // Format data untuk response
        $pendaftaranData = [
            'id_pendaftaran' => $pendaftaran['id_pendaftaran'],
            'nama_event' => $pendaftaran['nama_event'],
            'nama_atlet' => $pendaftaran['nama_atlet'],
            'kategori' => $pendaftaran['kategori'],
            'tanggal_daftar' => date('d/m/Y H:i', strtotime($pendaftaran['tanggal_daftar'])),
            'status_verifikasi' => $pendaftaran['status_verifikasi'],
            'status_text' => $statusText,
            'status_class' => $statusClass,
            'status_pembayaran' => $pendaftaran['status_pembayaran'],
            'payment_text' => $paymentText,
            'payment_class' => $paymentClass,
            'nomor_peserta' => $pendaftaran['nomor_peserta'],
            'catatan_verifikasi' => $pendaftaran['catatan_verifikasi']
        ];

        return $this->response->setJSON(['success' => true, 'pendaftaran' => $pendaftaranData]);
    }

    private function dashboardBelumAktif($user, $klub)
    {
        $data = [
            'title' => 'Dashboard Klub - Belum Aktif',
            'user' => $user,
            'klub' => $klub,
            'status_aktif' => false
        ];

        return view('user/klub/dashboard_belum_aktif', $data);
    }

    private function getStatistikKlub($idKlub)
    {
        $db = \Config\Database::connect();

        $totalAtlet = $this->atletModel->where('id_klub', $idKlub)
            ->where('status', 'aktif')
            ->countAllResults();

        $totalPelatih = $this->pelatihModel->where('id_klub', $idKlub)
            ->countAllResults();

        $pendaftaranPending = $this->pendaftaranAtletModel->where('id_klub', $idKlub)
            ->where('status', 'menunggu_verifikasi_klub')
            ->countAllResults();

        $eventModel = new \App\Models\EventModel();
        $eventAktif = $eventModel->where('status', 'aktif')
            ->where('tanggal_mulai >', date('Y-m-d'))
            ->countAllResults();

        // Get top atlet dari klub
        $topAtlet = $this->atletModel->select('atlet.*, ranking.poin, ranking.posisi')
            ->join('ranking', 'ranking.id_atlet = atlet.id_atlet', 'left')
            ->where('atlet.id_klub', $idKlub)
            ->where('atlet.status', 'aktif')
            ->orderBy('ranking.poin', 'DESC')
            ->limit(5)
            ->findAll();

        // Get tournament participation
        $pendaftaranTurnamenModel = new \App\Models\PendaftaranEventModel();
        $turnamenDiikuti = $pendaftaranTurnamenModel->where('id_klub', $idKlub)->countAllResults();

        // Get total medals (if hasil table exists)
        $totalMedali = 0;
        try {
            $medalResult = $db->query("
                SELECT COUNT(*) as total FROM hasil 
                WHERE id_klub = ? AND posisi IN (1, 2, 3)
            ", [$idKlub])->getRow();
            $totalMedali = $medalResult->total ?? 0;
        } catch (\Exception $e) {
            // Table might not exist
        }

        return [
            'total_atlet' => $totalAtlet,
            'total_pelatih' => $totalPelatih,
            'pendaftaran_pending' => $pendaftaranPending,
            'event_tersedia' => $eventAktif,
            'turnamen_diikuti' => $turnamenDiikuti,
            'total_medali' => $totalMedali,
            'top_atlet' => $topAtlet
        ];
    }

    /**
     * Tambah atlet baru - Creates pending registration for verification
     */
    public function tambahAtlet()
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        if (!$klub || $klub['status'] !== 'aktif') {
            return redirect()->back()->with('error', 'Klub harus aktif untuk menambah atlet.');
        }

        // Validasi input
        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[pendaftaran_atlet.email]|is_unique[user.email]',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'no_hp' => 'permit_empty|min_length[10]|max_length[15]',
            'foto' => 'permit_empty|uploaded[foto]|max_size[foto,2048]|ext_in[foto,jpg,jpeg,png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            // Upload foto jika ada
            $fotoPath = null;
            $foto = $this->request->getFile('foto');
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                $fileName = 'pendaftaran_atlet_' . time() . '.' . $foto->getExtension();
                $uploadPath = FCPATH . 'uploads/pendaftaran_atlet/';

                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                if ($foto->move($uploadPath, $fileName)) {
                    $fotoPath = $fileName;
                }
            }

            // Hitung kategori usia otomatis jika tidak dipilih
            $kategoriUsia = $this->request->getPost('kategori_usia');
            if (empty($kategoriUsia)) {
                $tanggalLahir = $this->request->getPost('tanggal_lahir');
                $umur = date_diff(date_create($tanggalLahir), date_create('today'))->y;

                if ($umur < 12) $kategoriUsia = 'U-12';
                elseif ($umur < 15) $kategoriUsia = 'U-15';
                elseif ($umur < 18) $kategoriUsia = 'U-18';
                else $kategoriUsia = 'Senior';
            }

            // Generate NIK dummy (since it's required but not provided in form)
            $nikDummy = '3201' . date('dmy') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT) . '01'; // Generate a dummy NIK

            // Check if NIK already exists and generate new one if needed
            while ($this->pendaftaranAtletModel->where('nik', $nikDummy)->first()) {
                $nikDummy = '3201' . date('dmy') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT) . '01';
            }

            // Buat pendaftaran atlet (pending verification)
            $pendaftaranData = [
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'nik' => $nikDummy, // Required field
                'tempat_lahir' => 'Tidak diisi', // Default value
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'alamat' => $this->request->getPost('alamat') ?: 'Tidak diisi',
                'no_hp' => $this->request->getPost('no_hp') ?: '',
                'email' => $this->request->getPost('email'),
                'kategori_usia' => $kategoriUsia,
                'id_klub' => $klub['id_klub'],
                'foto_path' => $fotoPath,
                'ktp_path' => null, // Optional
                'tanggal_daftar' => date('Y-m-d H:i:s'),
                'didaftarkan_oleh' => $userId,
                'status' => 'menunggu_verifikasi_klub'
            ];

            $insertResult = $this->pendaftaranAtletModel->insert($pendaftaranData);

            if (!$insertResult) {
                $errors = $this->pendaftaranAtletModel->errors();
                log_message('error', 'Failed to insert pendaftaran atlet: ' . json_encode($errors));
                throw new \Exception('Gagal menyimpan pendaftaran: ' . implode(', ', $errors));
            }

            return redirect()->to('user/klub/kelola-atlet')
                ->with('success', 'Pendaftaran atlet berhasil dibuat! Silakan verifikasi data atlet di bagian "Pendaftaran Menunggu Verifikasi".');
        } catch (\Exception $e) {
            log_message('error', 'Error in tambahAtlet: ' . $e->getMessage());
            log_message('error', 'Data yang akan diinsert: ' . json_encode($pendaftaranData ?? []));
            return redirect()->back()->withInput()->with('error', 'Gagal menambah atlet: ' . $e->getMessage());
        }
    }



    /**
     * Get data atlet untuk edit
     */
    public function getAtletData($idAtlet)
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        $atlet = $this->atletModel->select('atlet.*, user.nama_lengkap, user.email')
            ->join('user', 'user.id_user = atlet.id_user')
            ->where('atlet.id_atlet', $idAtlet)
            ->where('atlet.id_klub', $klub['id_klub'])
            ->first();

        if (!$atlet) {
            return $this->response->setJSON(['success' => false, 'message' => 'Atlet tidak ditemukan']);
        }

        return $this->response->setJSON(['success' => true, 'atlet' => $atlet]);
    }

    /**
     * Update data atlet
     */
    public function updateAtlet($idAtlet)
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        $atlet = $this->atletModel->where('id_atlet', $idAtlet)
            ->where('id_klub', $klub['id_klub'])
            ->first();

        if (!$atlet) {
            return redirect()->back()->with('error', 'Atlet tidak ditemukan.');
        }

        // Validasi input
        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'email' => "required|valid_email|is_unique[user.email,id_user,{$atlet['id_user']}]",
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'no_hp' => 'permit_empty|min_length[10]|max_length[15]',
            'foto' => 'permit_empty|uploaded[foto]|max_size[foto,2048]|ext_in[foto,jpg,jpeg,png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $db = \Config\Database::connect();
            $db->transStart();

            // Update user data
            $userData = [
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'email' => $this->request->getPost('email'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->userModel->update($atlet['id_user'], $userData);

            // Upload foto baru jika ada
            $fotoPath = $atlet['foto']; // Keep existing photo
            $foto = $this->request->getFile('foto');
            if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                // Hapus foto lama jika ada
                if ($atlet['foto'] && file_exists(FCPATH . $atlet['foto'])) {
                    unlink(FCPATH . $atlet['foto']);
                }

                $fileName = 'atlet_' . $atlet['id_user'] . '_' . time() . '.' . $foto->getExtension();
                $uploadPath = FCPATH . 'uploads/foto_atlet/';

                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                if ($foto->move($uploadPath, $fileName)) {
                    $fotoPath = 'uploads/foto_atlet/' . $fileName;
                }
            }

            // Hitung kategori usia otomatis jika tidak dipilih
            $kategoriUsia = $this->request->getPost('kategori_usia');
            if (empty($kategoriUsia)) {
                $tanggalLahir = $this->request->getPost('tanggal_lahir');
                $umur = date_diff(date_create($tanggalLahir), date_create('today'))->y;

                if ($umur < 12) $kategoriUsia = 'U-12';
                elseif ($umur < 15) $kategoriUsia = 'U-15';
                elseif ($umur < 18) $kategoriUsia = 'U-18';
                else $kategoriUsia = 'Senior';
            }

            // Update data atlet
            $atletData = [
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'kategori_usia' => $kategoriUsia,
                'no_hp' => $this->request->getPost('no_hp'),
                'alamat' => $this->request->getPost('alamat'),
                'foto' => $fotoPath
            ];

            $this->atletModel->update($idAtlet, $atletData);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal mengupdate data atlet.');
            }

            return redirect()->to('user/klub/kelola-atlet')
                ->with('success', 'Data atlet berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate atlet: ' . $e->getMessage());
        }
    }

    /**
     * Nonaktifkan atlet
     */
    public function nonaktifkanAtlet($idAtlet)
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        $atlet = $this->atletModel->where('id_atlet', $idAtlet)
            ->where('id_klub', $klub['id_klub'])
            ->first();

        if (!$atlet) {
            return redirect()->back()->with('error', 'Atlet tidak ditemukan.');
        }

        try {
            $updateData = [
                'status' => 'nonaktif',
                'alasan_nonaktif' => $this->request->getPost('alasan_nonaktif'),
                'tanggal_nonaktif' => date('Y-m-d')
            ];

            $this->atletModel->update($idAtlet, $updateData);

            // Update status user juga
            $this->userModel->update($atlet['id_user'], ['status' => 'nonaktif']);

            return redirect()->to('user/klub/kelola-atlet')
                ->with('success', 'Atlet berhasil dinonaktifkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menonaktifkan atlet: ' . $e->getMessage());
        }
    }

    /**
     * Get detail atlet untuk modal
     */
    public function detailAtlet($idAtlet)
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        $atlet = $this->atletModel->select('atlet.*, user.nama_lengkap, user.email')
            ->join('user', 'user.id_user = atlet.id_user')
            ->where('atlet.id_atlet', $idAtlet)
            ->where('atlet.id_klub', $klub['id_klub'])
            ->first();

        if (!$atlet) {
            return $this->response->setJSON(['success' => false, 'message' => 'Atlet tidak ditemukan']);
        }

        // Ambil ranking jika ada
        $rankingModel = new \App\Models\RankingModel();
        $ranking = $rankingModel->where('id_atlet', $idAtlet)
            ->orderBy('tanggal_berlaku', 'DESC')
            ->first();

        $atlet['ranking_provinsi'] = $ranking['posisi'] ?? null;

        return $this->response->setJSON(['success' => true, 'atlet' => $atlet]);
    }

    /**
     * Laporan Kegiatan Klub
     */
    public function laporanKegiatan()
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        $laporanModel = new \App\Models\LaporanModel();
        $laporan = $laporanModel->where('id_klub', $klub['id_klub'])
            ->orderBy('tanggal_laporan', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Laporan Kegiatan Klub',
            'klub' => $klub,
            'laporan' => $laporan
        ];

        return view('user/klub/laporan_kegiatan_enhanced', $data);
    }

    /**
     * Dashboard Statistik Detail Klub
     */
    public function statistikDetail()
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        $db = \Config\Database::connect();

        // Statistik lengkap
        $totalAtlet = $this->atletModel->where('id_klub', $klub['id_klub'])
            ->where('status', 'aktif')
            ->countAllResults();

        $totalPelatih = $this->pelatihModel->where('id_klub', $klub['id_klub'])
            ->countAllResults();

        // Atlet per kategori usia
        $atletPerKategori = $db->query("
            SELECT kategori_usia, COUNT(*) as total
            FROM atlet
            WHERE id_klub = ? AND status = 'aktif'
            GROUP BY kategori_usia
        ", [$klub['id_klub']])->getResultArray();

        // Atlet per gender
        $atletPerGender = $db->query("
            SELECT jenis_kelamin, COUNT(*) as total
            FROM atlet
            WHERE id_klub = ? AND status = 'aktif'
            GROUP BY jenis_kelamin
        ", [$klub['id_klub']])->getResultArray();

        // Top 10 atlet
        $topAtlet = $this->atletModel->select('atlet.*, user.nama_lengkap, ranking.poin, ranking.posisi')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->join('ranking', 'ranking.id_atlet = atlet.id_atlet', 'left')
            ->where('atlet.id_klub', $klub['id_klub'])
            ->where('atlet.status', 'aktif')
            ->orderBy('ranking.poin', 'DESC')
            ->limit(10)
            ->findAll();

        // Turnamen yang diikuti
        $pendaftaranEventModel = new \App\Models\PendaftaranEventModel();
        $turnamenDiikuti = $pendaftaranEventModel->select('event.nama_event, COUNT(DISTINCT pendaftaran_event.id_atlet) as jumlah_atlet')
            ->join('event', 'event.id_event = pendaftaran_event.id_event', 'left')
            ->join('atlet', 'atlet.id_atlet = pendaftaran_event.id_atlet', 'left')
            ->where('atlet.id_klub', $klub['id_klub'])
            ->groupBy('event.nama_event')
            ->orderBy('jumlah_atlet', 'DESC')
            ->limit(10)
            ->findAll();

        // Medali yang diraih
        $medalResult = $db->query("
            SELECT 
                CASE WHEN posisi = 1 THEN 'Emas'
                     WHEN posisi = 2 THEN 'Perak'
                     WHEN posisi = 3 THEN 'Perunggu'
                END as jenis_medali,
                COUNT(*) as total
            FROM hasil h
            JOIN atlet a ON a.id_atlet = h.id_pemenang_atlet
            WHERE a.id_klub = ? AND h.posisi IN (1, 2, 3)
            GROUP BY posisi
        ", [$klub['id_klub']])->getResultArray();

        $data = [
            'title' => 'Statistik Detail Klub',
            'klub' => $klub,
            'total_atlet' => $totalAtlet,
            'total_pelatih' => $totalPelatih,
            'atlet_per_kategori' => $atletPerKategori,
            'atlet_per_gender' => $atletPerGender,
            'top_atlet' => $topAtlet,
            'turnamen_diikuti' => $turnamenDiikuti,
            'medali' => $medalResult
        ];

        return view('user/klub/statistik_detail', $data);
    }

    /**
     * Export Data Atlet ke CSV
     */
    public function exportAtletCSV()
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        $atlet = $this->atletModel->select('atlet.*, user.nama_lengkap, user.email, ranking.poin, ranking.posisi')
            ->join('user', 'user.id_user = atlet.id_user', 'left')
            ->join('ranking', 'ranking.id_atlet = atlet.id_atlet', 'left')
            ->where('atlet.id_klub', $klub['id_klub'])
            ->findAll();

        // Create CSV
        $filename = 'data_atlet_' . $klub['id_klub'] . '_' . date('Y-m-d_H-i-s') . '.csv';
        $filepath = FCPATH . 'uploads/export/' . $filename;

        // Create directory if not exists
        if (!is_dir(FCPATH . 'uploads/export/')) {
            mkdir(FCPATH . 'uploads/export/', 0755, true);
        }

        $file = fopen($filepath, 'w');

        // Header
        fputcsv($file, ['No', 'Nama Lengkap', 'Email', 'Kategori Usia', 'Jenis Kelamin', 'No HP', 'Alamat', 'Ranking', 'Poin', 'Status']);

        // Data
        $no = 1;
        foreach ($atlet as $row) {
            fputcsv($file, [
                $no++,
                $row['nama_lengkap'],
                $row['email'],
                $row['kategori_usia'],
                $row['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan',
                $row['no_hp'],
                $row['alamat'],
                $row['posisi'] ?? '-',
                $row['poin'] ?? 0,
                $row['status']
            ]);
        }

        fclose($file);

        return $this->response->download($filepath, null);
    }

    /**
     * Export Data Pelatih ke CSV
     */
    public function exportPelatihCSV()
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        $pelatih = $this->pelatihModel->select('pelatih.*, user.nama_lengkap, user.email, COALESCE(pp.jenis_pelatih, "Pelatih") as jenis_pelatih')
            ->join('user', 'user.id_user = pelatih.id_user', 'left')
            ->join('pendaftaran_pelatih pp', 'pp.id_pelatih = pelatih.id_pelatih', 'left')
            ->where('pelatih.id_klub', $klub['id_klub'])
            ->findAll();

        // Create CSV
        $filename = 'data_pelatih_' . $klub['id_klub'] . '_' . date('Y-m-d_H-i-s') . '.csv';
        $filepath = FCPATH . 'uploads/export/' . $filename;

        // Create directory if not exists
        if (!is_dir(FCPATH . 'uploads/export/')) {
            mkdir(FCPATH . 'uploads/export/', 0755, true);
        }

        $file = fopen($filepath, 'w');

        // Header
        fputcsv($file, ['No', 'Nama Lengkap', 'Email', 'Jenis Pelatih', 'No HP', 'Spesialisasi', 'Pengalaman (Tahun)']);

        // Data
        $no = 1;
        foreach ($pelatih as $row) {
            $pengalaman = $row['dibuat_pada'] ? (date('Y') - date('Y', strtotime($row['dibuat_pada']))) : 0;
            fputcsv($file, [
                $no++,
                $row['nama_lengkap'],
                $row['email'],
                $row['jenis_pelatih'],
                $row['nohp'] ?? '-',
                $row['spesialisasi'] ?? '-',
                $pengalaman
            ]);
        }

        fclose($file);

        return $this->response->download($filepath, null);
    }

    /**
     * Export Laporan Kegiatan ke PDF
     */
    public function exportLaporanPDF()
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        $laporanModel = new \App\Models\LaporanModel();
        $laporan = $laporanModel->where('id_klub', $klub['id_klub'])
            ->orderBy('tanggal_laporan', 'DESC')
            ->findAll();

        // Simple HTML to PDF (using basic HTML)
        $html = '<h1>Laporan Kegiatan Klub ' . esc($klub['nama']) . '</h1>';
        $html .= '<p>Tanggal Cetak: ' . date('d/m/Y H:i:s') . '</p>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0" width="100%">';
        $html .= '<tr><th>No</th><th>Tanggal</th><th>Kegiatan</th><th>Deskripsi</th></tr>';

        $no = 1;
        foreach ($laporan as $row) {
            $html .= '<tr>';
            $html .= '<td>' . $no++ . '</td>';
            $html .= '<td>' . date('d/m/Y', strtotime($row['tanggal_laporan'])) . '</td>';
            $html .= '<td>' . esc($row['judul_kegiatan']) . '</td>';
            $html .= '<td>' . esc(substr($row['deskripsi'], 0, 100)) . '...</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        // Return as downloadable file
        $filename = 'laporan_kegiatan_' . $klub['id_klub'] . '_' . date('Y-m-d_H-i-s') . '.html';
        return $this->response->download('data:text/html;base64,' . base64_encode($html), $filename);
    }
}
