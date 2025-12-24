<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EventModel;
use App\Models\PendaftaranEventModel;
use App\Models\AtletModel;
use App\Models\KlubModel;

class TournamentRegistration extends BaseController
{
    protected $eventModel;
    protected $pendaftaranEventModel;
    protected $atletModel;
    protected $klubModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
        $this->pendaftaranEventModel = new PendaftaranEventModel();
        $this->atletModel = new AtletModel();
        $this->klubModel = new KlubModel();
    }

    /**
     * Tampilkan daftar turnamen yang tersedia
     */
    public function index()
    {
        // Ambil turnamen yang masih buka pendaftaran
        $turnamenTersedia = $this->eventModel
            ->where('status', 'aktif')
            ->where('batas_pendaftaran >=', date('Y-m-d'))
            ->orderBy('tanggal_mulai', 'ASC')
            ->findAll();

        // Hitung jumlah peserta yang sudah mendaftar untuk setiap turnamen
        foreach ($turnamenTersedia as &$turnamen) {
            $jumlahPeserta = $this->pendaftaranEventModel
                ->where('id_event', $turnamen['id_event'])
                ->where('status_verifikasi', 'diverifikasi')
                ->countAllResults();

            $turnamen['jumlah_peserta'] = $jumlahPeserta;
            $turnamen['sisa_kuota'] = ($turnamen['kuota_peserta'] ?? 0) - $jumlahPeserta;
        }

        $data = [
            'title' => 'Pendaftaran Turnamen',
            'turnamen_tersedia' => $turnamenTersedia
        ];

        return view('tournament/index', $data);
    }

    /**
     * Detail turnamen dan form pendaftaran
     */
    public function detail($idEvent)
    {
        $turnamen = $this->eventModel->find($idEvent);

        if (!$turnamen) {
            return redirect()->back()->with('error', 'Turnamen tidak ditemukan.');
        }

        // Cek apakah masih bisa mendaftar
        $masihBisaDaftar = $this->cekBisaDaftar($turnamen);

        // Hitung jumlah peserta
        $jumlahPeserta = $this->pendaftaranEventModel
            ->where('id_event', $idEvent)
            ->where('status_verifikasi', 'diverifikasi')
            ->countAllResults();

        $turnamen['jumlah_peserta'] = $jumlahPeserta;
        $turnamen['sisa_kuota'] = ($turnamen['kuota_peserta'] ?? 0) - $jumlahPeserta;

        // Jika user login, cek apakah sudah mendaftar
        $sudahMendaftar = false;
        $pendaftaranUser = null;

        if (session()->get('logged_in')) {
            $userId = session()->get('user_id');
            $role = session()->get('role');

            if ($role === 'atlet') {
                $atlet = $this->atletModel->where('id_user', $userId)->first();
                if ($atlet) {
                    $pendaftaranUser = $this->pendaftaranEventModel
                        ->where('id_event', $idEvent)
                        ->where('id_atlet', $atlet['id_atlet'])
                        ->first();
                }
            } elseif (in_array($role, ['klub', 'admin_klub'])) {
                $klub = $this->klubModel->where('id_user', $userId)->first();
                if ($klub) {
                    $pendaftaranUser = $this->pendaftaranEventModel
                        ->where('id_event', $idEvent)
                        ->where('id_klub', $klub['id_klub'])
                        ->first();
                }
            }

            $sudahMendaftar = !empty($pendaftaranUser);
        }

        $data = [
            'title' => 'Detail Turnamen - ' . $turnamen['nama_event'],
            'turnamen' => $turnamen,
            'masih_bisa_daftar' => $masihBisaDaftar,
            'sudah_mendaftar' => $sudahMendaftar,
            'pendaftaran_user' => $pendaftaranUser
        ];

        return view('tournament/detail', $data);
    }

    /**
     * Tampilkan form pendaftaran turnamen
     */
    public function daftar($idEvent)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $role = session()->get('role');

        // Hanya klub yang bisa mendaftar turnamen
        if ($role === 'atlet') {
            return redirect()->back()->with('error', 'Hanya klub yang dapat mendaftar turnamen. Silakan hubungi klub Anda untuk mendaftar.');
        }

        if (!in_array($role, ['klub', 'admin_klub'])) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mendaftar turnamen.');
        }

        $turnamen = $this->eventModel->find($idEvent);
        if (!$turnamen) {
            return redirect()->back()->with('error', 'Turnamen tidak ditemukan.');
        }

        // Validasi apakah masih bisa mendaftar
        $validasi = $this->validasiPendaftaran($turnamen);
        if (!$validasi['valid']) {
            return redirect()->back()->with('error', $validasi['pesan']);
        }

        $userId = session()->get('user_id');

        // Ambil daftar atlet klub
        $atletKlub = [];
        $klub = $this->klubModel->where('id_user', $userId)->first();
        if ($klub) {
            $atletKlub = $this->atletModel->select('atlet.*, user.nama_lengkap')
                ->join('user', 'user.id_user = atlet.id_user')
                ->where('atlet.id_klub', $klub['id_klub'])
                ->where('atlet.status', 'aktif')
                ->findAll();
        }

        $data = [
            'title' => 'Form Pendaftaran Turnamen',
            'turnamen' => $turnamen,
            'atlet_klub' => $atletKlub
        ];

        return view('tournament/form_pendaftaran', $data);
    }

    /**
     * Proses pendaftaran turnamen dengan data lengkap
     */
    public function prosesPendaftaran($idEvent)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $role = session()->get('role');

        // Hanya klub yang bisa mendaftar
        if (!in_array($role, ['klub', 'admin_klub'])) {
            return redirect()->back()->with('error', 'Hanya klub yang dapat mendaftar turnamen.');
        }

        $turnamen = $this->eventModel->find($idEvent);
        if (!$turnamen) {
            return redirect()->back()->with('error', 'Turnamen tidak ditemukan.');
        }

        // Validasi apakah masih bisa mendaftar
        $validasi = $this->validasiPendaftaran($turnamen);
        if (!$validasi['valid']) {
            return redirect()->back()->with('error', $validasi['pesan']);
        }

        // Validasi input
        $rules = [
            'nomor_telepon' => 'required|min_length[10]|max_length[15]',
            'email_kontak' => 'required|valid_email',
            'setuju_syarat' => 'required',
            'data_benar' => 'required',
            'atlet_terpilih' => 'required'
        ];

        // Jika ada biaya, validasi bukti pembayaran
        if ($turnamen['biaya_pendaftaran'] > 0) {
            $rules['bukti_pembayaran'] = 'uploaded[bukti_pembayaran]|max_size[bukti_pembayaran,2048]|ext_in[bukti_pembayaran,jpg,jpeg,png,pdf]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = session()->get('user_id');

        try {
            $db = \Config\Database::connect();
            $db->transStart();

            // Upload bukti pembayaran jika ada
            $buktiBayar = null;
            if ($turnamen['biaya_pendaftaran'] > 0) {
                $buktiBayar = $this->uploadBuktiBayar($idEvent);
            }

            // Data pendaftaran
            $dataPendaftaran = [
                'id_event' => $idEvent,
                'nomor_telepon' => $this->request->getPost('nomor_telepon'),
                'email_kontak' => $this->request->getPost('email_kontak'),
                'catatan' => $this->request->getPost('catatan'),
                'bukti_pembayaran' => $buktiBayar,
                'keterangan_pembayaran' => $this->request->getPost('keterangan_pembayaran'),
                'status_verifikasi' => 'pending',
                'tanggal_daftar' => date('Y-m-d H:i:s')
            ];

            $atletTerpilih = $this->request->getPost('atlet_terpilih');
            if (empty($atletTerpilih)) {
                throw new \Exception('Pilih minimal satu atlet untuk didaftarkan.');
            }
            $result = $this->daftarKlubLengkap($dataPendaftaran, $userId, $atletTerpilih);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal menyimpan data pendaftaran.');
            }

            return redirect()->to('tournament/detail/' . $idEvent)
                ->with('success', 'Pendaftaran berhasil dikirim! Menunggu verifikasi dari panitia.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal mendaftar: ' . $e->getMessage());
        }
    }

    /**
     * Upload bukti pembayaran
     */
    public function uploadBuktiPembayaran($idPendaftaran)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('auth/login');
        }

        $pendaftaran = $this->pendaftaranEventModel->find($idPendaftaran);
        if (!$pendaftaran) {
            return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        // Validasi ownership
        if (!$this->validateOwnership($pendaftaran)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke pendaftaran ini.');
        }

        if ($this->request->getMethod() === 'POST') {
            return $this->prosesUploadBukti($idPendaftaran);
        }

        $turnamen = $this->eventModel->find($pendaftaran['id_event']);

        $data = [
            'title' => 'Upload Bukti Pembayaran',
            'pendaftaran' => $pendaftaran,
            'turnamen' => $turnamen
        ];

        return view('tournament/upload_bukti', $data);
    }

    /**
     * Cek apakah turnamen masih bisa didaftari
     */
    private function cekBisaDaftar($turnamen)
    {
        // Cek status turnamen
        if ($turnamen['status'] !== 'aktif') {
            return false;
        }

        // Cek batas pendaftaran
        if (strtotime($turnamen['batas_pendaftaran']) < time()) {
            return false;
        }

        // Cek kuota
        $jumlahPeserta = $this->pendaftaranEventModel
            ->where('id_event', $turnamen['id_event'])
            ->where('status_verifikasi', 'diverifikasi')
            ->countAllResults();

        if ($turnamen['kuota_peserta'] && $jumlahPeserta >= $turnamen['kuota_peserta']) {
            return false;
        }

        return true;
    }

    /**
     * Validasi lengkap untuk pendaftaran
     */
    private function validasiPendaftaran($turnamen)
    {
        $userId = session()->get('user_id');
        $role = session()->get('role');

        // 1. Cek apakah masih bisa daftar
        if (!$this->cekBisaDaftar($turnamen)) {
            return ['valid' => false, 'pesan' => 'Pendaftaran sudah ditutup atau kuota penuh.'];
        }

        // 2. Validasi berdasarkan role
        if ($role === 'atlet') {
            return $this->validasiAtlet($turnamen, $userId);
        } elseif (in_array($role, ['klub', 'admin_klub'])) {
            return $this->validasiKlub($turnamen, $userId);
        }

        return ['valid' => false, 'pesan' => 'Role tidak diizinkan untuk mendaftar.'];
    }

    /**
     * Validasi khusus untuk atlet - TIDAK DIIZINKAN
     */
    private function validasiAtlet($turnamen, $userId)
    {
        return ['valid' => false, 'pesan' => 'Hanya klub yang dapat mendaftar turnamen. Silakan hubungi klub Anda.'];
    }

    /**
     * Validasi khusus untuk klub
     */
    private function validasiKlub($turnamen, $userId)
    {
        $klub = $this->klubModel->where('id_user', $userId)->first();

        if (!$klub) {
            return ['valid' => false, 'pesan' => 'Data klub tidak ditemukan.'];
        }

        // Cek status klub aktif
        if ($klub['status'] !== 'aktif') {
            return ['valid' => false, 'pesan' => 'Status klub belum aktif. Silakan hubungi admin.'];
        }

        // Cek apakah sudah mendaftar
        $sudahDaftar = $this->pendaftaranEventModel
            ->where('id_event', $turnamen['id_event'])
            ->where('id_klub', $klub['id_klub'])
            ->first();

        if ($sudahDaftar) {
            return ['valid' => false, 'pesan' => 'Klub sudah mendaftar di turnamen ini.'];
        }

        return ['valid' => true, 'pesan' => 'Validasi berhasil.'];
    }

    /**
     * Proses pendaftaran atlet
     */
    private function daftarAtlet($idEvent, $userId)
    {
        $atlet = $this->atletModel->where('id_user', $userId)->first();

        $data = [
            'id_event' => $idEvent,
            'tipe_pendaftar' => 'atlet',
            'id_atlet' => $atlet['id_atlet'],
            'id_klub' => $atlet['id_klub'],
            'tanggal_daftar' => date('Y-m-d H:i:s'),
            'status_verifikasi' => 'pending',
            'nama_atlet1' => $atlet['nama_lengkap'] ?? '',
            'nohp_pendaftar' => $atlet['no_hp'] ?? '',
            'kategori' => $atlet['kategori_usia'] ?? ''
        ];

        return $this->pendaftaranEventModel->insert($data);
    }

    /**
     * Proses pendaftaran klub
     */
    private function daftarKlub($idEvent, $userId)
    {
        $klub = $this->klubModel->where('id_user', $userId)->first();

        $data = [
            'id_event' => $idEvent,
            'tipe_pendaftar' => 'klub',
            'id_klub' => $klub['id_klub'],
            'tanggal_daftar' => date('Y-m-d H:i:s'),
            'status_verifikasi' => 'pending',
            'nohp_pendaftar' => $klub['telepon'] ?? ''
        ];

        return $this->pendaftaranEventModel->insert($data);
    }

    /**
     * Proses upload bukti pembayaran
     */
    private function prosesUploadBukti($idPendaftaran)
    {
        $rules = [
            'bukti_pembayaran' => 'uploaded[bukti_pembayaran]|max_size[bukti_pembayaran,2048]|ext_in[bukti_pembayaran,jpg,jpeg,png,pdf]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('bukti_pembayaran');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            if ($file->move(FCPATH . 'uploads/bukti_pembayaran', $fileName)) {
                $updateData = [
                    'bukti_pembayaran' => 'uploads/bukti_pembayaran/' . $fileName,
                    'tanggal_pembayaran' => date('Y-m-d H:i:s'),
                    'status_pembayaran' => 'menunggu_konfirmasi'
                ];

                if ($this->pendaftaranEventModel->update($idPendaftaran, $updateData)) {
                    return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload. Menunggu konfirmasi panitia.');
                }
            }
        }

        return redirect()->back()->with('error', 'Gagal mengupload bukti pembayaran.');
    }

    /**
     * Validasi kepemilikan pendaftaran
     */
    private function validateOwnership($pendaftaran)
    {
        $userId = session()->get('user_id');
        $role = session()->get('role');

        if ($role === 'atlet') {
            $atlet = $this->atletModel->where('id_user', $userId)->first();
            return $atlet && $pendaftaran['id_atlet'] == $atlet['id_atlet'];
        } elseif (in_array($role, ['klub', 'admin_klub'])) {
            $klub = $this->klubModel->where('id_user', $userId)->first();
            return $klub && $pendaftaran['id_klub'] == $klub['id_klub'];
        }

        return false;
    }

    /**
     * Upload bukti pembayaran untuk pendaftaran baru
     */
    private function uploadBuktiBayar($idEvent)
    {
        $file = $this->request->getFile('bukti_pembayaran');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = 'bukti_' . $idEvent . '_' . time() . '.' . $file->getExtension();

            // Buat direktori jika belum ada
            $uploadPath = FCPATH . 'uploads/bukti_pembayaran/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if ($file->move($uploadPath, $fileName)) {
                return 'uploads/bukti_pembayaran/' . $fileName;
            }
        }

        throw new \Exception('Gagal mengupload bukti pembayaran.');
    }

    /**
     * Proses pendaftaran atlet dengan data lengkap
     */
    private function daftarAtletLengkap($dataPendaftaran, $userId)
    {
        $atlet = $this->atletModel->select('atlet.*, user.nama_lengkap')
            ->join('user', 'user.id_user = atlet.id_user')
            ->where('atlet.id_user', $userId)
            ->first();

        if (!$atlet) {
            throw new \Exception('Data atlet tidak ditemukan.');
        }

        $data = array_merge($dataPendaftaran, [
            'tipe_pendaftar' => 'atlet',
            'id_atlet' => $atlet['id_atlet'],
            'id_klub' => $atlet['id_klub'],
            'nama_atlet1' => $atlet['nama_lengkap'],
            'kategori' => $atlet['kategori_usia'] ?? ''
        ]);

        return $this->pendaftaranEventModel->insert($data);
    }

    /**
     * Proses pendaftaran klub dengan data lengkap dan atlet terpilih
     */
    private function daftarKlubLengkap($dataPendaftaran, $userId, $atletTerpilih)
    {
        $klub = $this->klubModel->where('id_user', $userId)->first();

        if (!$klub) {
            throw new \Exception('Data klub tidak ditemukan.');
        }

        // Validasi atlet yang dipilih
        $atletValid = $this->atletModel->select('atlet.*, user.nama_lengkap')
            ->join('user', 'user.id_user = atlet.id_user')
            ->where('atlet.id_klub', $klub['id_klub'])
            ->whereIn('atlet.id_atlet', $atletTerpilih)
            ->where('atlet.status', 'aktif')
            ->findAll();

        if (count($atletValid) !== count($atletTerpilih)) {
            throw new \Exception('Beberapa atlet yang dipilih tidak valid atau tidak aktif.');
        }

        // Buat pendaftaran untuk setiap atlet
        $results = [];
        foreach ($atletValid as $index => $atlet) {
            $data = array_merge($dataPendaftaran, [
                'tipe_pendaftar' => 'klub',
                'id_atlet' => $atlet['id_atlet'],
                'id_klub' => $klub['id_klub'],
                'nama_atlet1' => $atlet['nama_lengkap'],
                'kategori' => $atlet['kategori_usia'] ?? ''
            ]);

            // Untuk atlet kedua dan seterusnya, tidak perlu upload bukti bayar lagi
            if ($index > 0) {
                $data['bukti_pembayaran'] = null;
                $data['keterangan_pembayaran'] = 'Mengikuti pembayaran atlet pertama';
            }

            $results[] = $this->pendaftaranEventModel->insert($data);
        }

        return $results;
    }
}
