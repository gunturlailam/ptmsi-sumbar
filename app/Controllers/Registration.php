<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KlubModel;
use App\Models\AtletModel;
use App\Models\PelatihModel;
use App\Models\OrganisasiModel;
use App\Models\PendaftaranAtletModel;
use App\Models\PendaftaranPelatihModel;

class Registration extends BaseController
{
    protected $userModel;
    protected $klubModel;
    protected $atletModel;
    protected $pelatihModel;
    protected $organisasiModel;
    protected $pendaftaranAtletModel;
    protected $pendaftaranPelatihModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->klubModel = new KlubModel();
        $this->atletModel = new AtletModel();
        $this->pelatihModel = new PelatihModel();
        $this->organisasiModel = new OrganisasiModel();
        $this->pendaftaranAtletModel = new PendaftaranAtletModel();
        $this->pendaftaranPelatihModel = new PendaftaranPelatihModel();
        helper(['form', 'url']);
    }

    /**
     * Generate UUID v4
     */
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

    // ========== KLUB REGISTRATION ==========

    /**
     * Show klub registration form
     */
    public function klubRegister()
    {
        $data = [
            'title' => 'Daftar Klub',
            'organisasi' => $this->organisasiModel->where('jenis', 'kabupaten')->findAll()
        ];

        return view('registration/klub_register', $data);
    }

    /**
     * Process klub registration
     */
    public function klubRegisterSubmit()
    {
        $rules = [
            'nama_klub' => 'required|min_length[3]|max_length[100]',
            'alamat' => 'required|min_length[10]',
            'id_organisasi' => 'required|integer',
            'penanggung_jawab' => 'required|min_length[3]',
            'telepon' => 'required|min_length[10]|max_length[15]',
            'email' => 'required|valid_email|is_unique[user.email]',
            'username' => 'required|min_length[3]|max_length[50]|is_unique[user.username]',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
            'sk_klub' => 'uploaded[sk_klub]|max_size[sk_klub,5120]|ext_in[sk_klub,pdf,jpg,jpeg,png]',
            'identitas_pengurus' => 'uploaded[identitas_pengurus]|max_size[identitas_pengurus,5120]|ext_in[identitas_pengurus,pdf,jpg,jpeg,png]'
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            log_message('error', 'Klub registration validation failed: ' . json_encode($errors));

            // Check if email already exists
            if (isset($errors['email'])) {
                $existingUser = $this->userModel->where('email', $this->request->getPost('email'))->first();
                if ($existingUser) {
                    log_message('error', 'Email already exists for user: ' . $existingUser['username']);
                }
            }

            return redirect()->back()->withInput()->with('errors', $errors);
        }

        log_message('info', 'Klub registration validation passed, proceeding with registration');

        // Debug: Log the submitted data (without password)
        $debugData = $this->request->getPost();
        unset($debugData['password'], $debugData['password_confirm']);
        log_message('info', 'Submitted form data: ' . json_encode($debugData));

        // Handle file uploads
        $skKlub = $this->request->getFile('sk_klub');
        $identitasPengurus = $this->request->getFile('identitas_pengurus');

        $skKlubPath = null;
        $identitasPath = null;

        if ($skKlub && $skKlub->isValid() && !$skKlub->hasMoved()) {
            $skKlubName = $skKlub->getRandomName();
            if ($skKlub->move(FCPATH . 'uploads/klub/sk', $skKlubName)) {
                $skKlubPath = 'uploads/klub/sk/' . $skKlubName;
                log_message('info', 'SK Klub uploaded successfully: ' . $skKlubPath);
            } else {
                log_message('error', 'Failed to upload SK Klub: ' . $skKlub->getErrorString());
            }
        }

        if ($identitasPengurus && $identitasPengurus->isValid() && !$identitasPengurus->hasMoved()) {
            $identitasName = $identitasPengurus->getRandomName();
            if ($identitasPengurus->move(FCPATH . 'uploads/klub/identitas', $identitasName)) {
                $identitasPath = 'uploads/klub/identitas/' . $identitasName;
                log_message('info', 'Identitas Pengurus uploaded successfully: ' . $identitasPath);
            } else {
                log_message('error', 'Failed to upload Identitas Pengurus: ' . $identitasPengurus->getErrorString());
            }
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Create user account for klub
            $userId = $this->generateUUID();
            $userData = [
                'id_user' => $userId,
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'nama_lengkap' => $this->request->getPost('penanggung_jawab'),
                'nohp' => $this->request->getPost('telepon'),
                'peran' => 'admin_klub',
                'dibuat_pada' => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s')
            ];

            log_message('info', 'Inserting user data: ' . json_encode($userData));

            // Insert without model validation since we already validated in controller
            $userInserted = $this->userModel->insert($userData, false);

            if (!$userInserted) {
                throw new \Exception('Failed to create user account: ' . json_encode($this->userModel->errors()));
            }

            log_message('info', 'User created successfully with ID: ' . $userId);

            // Create klub record
            $klubData = [
                'id_user' => $userId,
                'id_organisasi' => $this->request->getPost('id_organisasi'),
                'nama' => $this->request->getPost('nama_klub'),
                'alamat' => $this->request->getPost('alamat'),
                'penanggung_jawab' => $this->request->getPost('penanggung_jawab'),
                'telepon' => $this->request->getPost('telepon'),
                'tanggal_berdiri' => date('Y-m-d'),
                'status' => 'pending', // Menunggu verifikasi provinsi
                'sk_klub_path' => $skKlubPath,
                'identitas_pengurus_path' => $identitasPath
            ];

            log_message('info', 'Inserting klub data: ' . json_encode($klubData));

            // Insert without model validation since we already validated in controller
            $klubInserted = $this->klubModel->insert($klubData, false);

            if (!$klubInserted) {
                throw new \Exception('Failed to create klub record: ' . json_encode($this->klubModel->errors()));
            }

            log_message('info', 'Klub created successfully');

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            return redirect()->to('registration/success')
                ->with('success', 'Pendaftaran klub berhasil! Menunggu verifikasi dari Admin Provinsi.');
        } catch (\Exception $e) {
            $db->transRollback();

            // Clean up uploaded files
            if ($skKlubPath && file_exists(FCPATH . $skKlubPath)) {
                unlink(FCPATH . $skKlubPath);
            }
            if ($identitasPath && file_exists(FCPATH . $identitasPath)) {
                unlink(FCPATH . $identitasPath);
            }

            // Log the actual error for debugging
            log_message('error', 'Klub registration failed: ' . $e->getMessage());

            return redirect()->back()->withInput()
                ->with('error', 'Terjadi kesalahan saat mendaftar: ' . $e->getMessage());
        }
    }

    // ========== ATLET REGISTRATION (VIA KLUB) ==========

    /**
     * Show atlet registration form (only accessible by klub)
     */
    public function atletRegister()
    {
        // Check if user is logged in as klub
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login')->with('error', 'Akses ditolak. Hanya klub yang dapat mendaftarkan atlet.');
        }

        // Get klub info
        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        if (!$klub || $klub['status'] !== 'aktif') {
            return redirect()->to('user/dashboard')->with('error', 'Klub Anda belum aktif. Tidak dapat mendaftarkan atlet.');
        }

        $data = [
            'title' => 'Daftar Atlet Baru',
            'klub' => $klub
        ];

        return view('registration/atlet_register', $data);
    }

    /**
     * Process atlet registration by klub
     */
    public function atletRegisterSubmit()
    {
        // Check klub access
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login')->with('error', 'Akses ditolak.');
        }

        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'nik' => 'required|exact_length[16]|is_unique[pendaftaran_atlet.nik]',
            'tempat_lahir' => 'required|min_length[3]',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'alamat' => 'required|min_length[10]',
            'no_hp' => 'required|min_length[10]|max_length[15]',
            'email' => 'required|valid_email|is_unique[pendaftaran_atlet.email]',
            'kategori_usia' => 'required|in_list[U-12,U-15,U-18,Senior]',
            'foto_atlet' => 'uploaded[foto_atlet]|max_size[foto_atlet,2048]|ext_in[foto_atlet,jpg,jpeg,png]',
            'ktp_scan' => 'uploaded[ktp_scan]|max_size[ktp_scan,2048]|ext_in[ktp_scan,jpg,jpeg,png,pdf]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get klub info
        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        // Handle file uploads
        $fotoAtlet = $this->request->getFile('foto_atlet');
        $ktpScan = $this->request->getFile('ktp_scan');

        $fotoPath = null;
        $ktpPath = null;

        if ($fotoAtlet->isValid()) {
            $fotoName = $fotoAtlet->getRandomName();
            $fotoAtlet->move('uploads/atlet/foto', $fotoName);
            $fotoPath = 'uploads/atlet/foto/' . $fotoName;
        }

        if ($ktpScan->isValid()) {
            $ktpName = $ktpScan->getRandomName();
            $ktpScan->move('uploads/atlet/ktp', $ktpName);
            $ktpPath = 'uploads/atlet/ktp/' . $ktpName;
        }

        try {
            // Create pendaftaran atlet record
            $pendaftaranData = [
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'nik' => $this->request->getPost('nik'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'alamat' => $this->request->getPost('alamat'),
                'no_hp' => $this->request->getPost('no_hp'),
                'email' => $this->request->getPost('email'),
                'kategori_usia' => $this->request->getPost('kategori_usia'),
                'id_klub' => $klub['id_klub'],
                'foto_path' => $fotoPath,
                'ktp_path' => $ktpPath,
                'status' => 'menunggu_verifikasi_klub', // First step: klub verification
                'tanggal_daftar' => date('Y-m-d H:i:s'),
                'didaftarkan_oleh' => $userId
            ];

            $this->pendaftaranAtletModel->insert($pendaftaranData);

            return redirect()->to('user/dashboard')
                ->with('success', 'Pendaftaran atlet berhasil! Silakan verifikasi data atlet di dashboard klub.');
        } catch (\Exception $e) {
            // Clean up uploaded files
            if ($fotoPath && file_exists($fotoPath)) {
                unlink($fotoPath);
            }
            if ($ktpPath && file_exists($ktpPath)) {
                unlink($ktpPath);
            }

            return redirect()->back()->withInput()
                ->with('error', 'Terjadi kesalahan saat mendaftar atlet. Silakan coba lagi.');
        }
    }

    // ========== PELATIH/WASIT REGISTRATION (VIA KLUB) ==========

    /**
     * Show pelatih registration form
     */
    public function pelatihRegister()
    {
        // Check if user is logged in as klub
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login')->with('error', 'Akses ditolak. Hanya klub yang dapat mendaftarkan pelatih.');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        if (!$klub || $klub['status'] !== 'aktif') {
            return redirect()->to('user/dashboard')->with('error', 'Klub Anda belum aktif.');
        }

        $data = [
            'title' => 'Daftar Pelatih/Wasit Baru',
            'klub' => $klub
        ];

        return view('registration/pelatih_register', $data);
    }

    /**
     * Process pelatih registration by klub
     */
    public function pelatihRegisterSubmit()
    {
        // Check klub access
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login')->with('error', 'Akses ditolak.');
        }

        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'nik' => 'required|exact_length[16]',
            'tempat_lahir' => 'required|min_length[3]',
            'tanggal_lahir' => 'required|valid_date',
            'jenis_kelamin' => 'required|in_list[L,P]',
            'alamat' => 'required|min_length[10]',
            'no_hp' => 'required|min_length[10]|max_length[15]',
            'email' => 'required|valid_email|is_unique[pelatih.email]',
            'jenis_pelatih' => 'required|in_list[pelatih,wasit]',
            'sertifikat' => 'uploaded[sertifikat]|max_size[sertifikat,5120]|ext_in[sertifikat,pdf,jpg,jpeg,png]',
            'foto_pelatih' => 'uploaded[foto_pelatih]|max_size[foto_pelatih,2048]|ext_in[foto_pelatih,jpg,jpeg,png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get klub info
        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        // Handle file uploads
        $sertifikat = $this->request->getFile('sertifikat');
        $fotoPelatih = $this->request->getFile('foto_pelatih');

        $sertifikatPath = null;
        $fotoPath = null;

        if ($sertifikat->isValid()) {
            $sertifikatName = $sertifikat->getRandomName();
            $sertifikat->move('uploads/pelatih/sertifikat', $sertifikatName);
            $sertifikatPath = 'uploads/pelatih/sertifikat/' . $sertifikatName;
        }

        if ($fotoPelatih->isValid()) {
            $fotoName = $fotoPelatih->getRandomName();
            $fotoPelatih->move('uploads/pelatih/foto', $fotoName);
            $fotoPath = 'uploads/pelatih/foto/' . $fotoName;
        }

        try {
            // Create pelatih record
            $pelatihData = [
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'nik' => $this->request->getPost('nik'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'alamat' => $this->request->getPost('alamat'),
                'no_hp' => $this->request->getPost('no_hp'),
                'email' => $this->request->getPost('email'),
                'jenis_pelatih' => $this->request->getPost('jenis_pelatih'),
                'id_klub' => $klub['id_klub'],
                'sertifikat_path' => $sertifikatPath,
                'foto_path' => $fotoPath,
                'status' => 'menunggu_verifikasi_admin', // Direct to admin verification
                'tanggal_daftar' => date('Y-m-d H:i:s'),
                'didaftarkan_oleh' => $userId
            ];

            $this->pendaftaranPelatihModel->insert($pelatihData);

            return redirect()->to('user/dashboard')
                ->with('success', 'Pendaftaran pelatih/wasit berhasil! Menunggu verifikasi dari Admin Provinsi.');
        } catch (\Exception $e) {
            // Clean up uploaded files
            if ($sertifikatPath && file_exists($sertifikatPath)) {
                unlink($sertifikatPath);
            }
            if ($fotoPath && file_exists($fotoPath)) {
                unlink($fotoPath);
            }

            return redirect()->back()->withInput()
                ->with('error', 'Terjadi kesalahan saat mendaftar pelatih/wasit. Silakan coba lagi.');
        }
    }

    /**
     * Success page
     */
    public function success()
    {
        return view('registration/success');
    }

    // ========== KLUB VERIFICATION METHODS ==========

    /**
     * Klub verifies atlet registration
     */
    public function klubVerifyAtlet($id)
    {
        if (!session()->get('logged_in') || !in_array(session()->get('role'), ['klub', 'admin_klub'])) {
            return redirect()->to('auth/login');
        }

        $userId = session()->get('user_id');
        $klub = $this->klubModel->where('id_user', $userId)->first();

        $pendaftaran = $this->pendaftaranAtletModel->where('id_pendaftaran', $id)
            ->where('id_klub', $klub['id_klub'])
            ->where('status', 'menunggu_verifikasi_klub')
            ->first();

        if (!$pendaftaran) {
            return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $action = $this->request->getPost('action'); // 'approve' or 'reject'
        $catatan = $this->request->getPost('catatan');

        if ($action === 'approve') {
            $newStatus = 'menunggu_verifikasi_admin';
            $message = 'Pendaftaran atlet disetujui dan dikirim ke Admin untuk verifikasi.';
        } else {
            $newStatus = 'ditolak_klub';
            $message = 'Pendaftaran atlet ditolak.';
        }

        $updateData = [
            'status' => $newStatus,
            'catatan_klub' => $catatan,
            'tanggal_verifikasi_klub' => date('Y-m-d H:i:s'),
            'diverifikasi_klub_oleh' => $userId
        ];

        if ($this->pendaftaranAtletModel->update($id, $updateData)) {
            return redirect()->back()->with('success', $message);
        } else {
            return redirect()->back()->with('error', 'Gagal memproses verifikasi.');
        }
    }
}
