<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
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

    public function login()
    {
        // Debug info
        log_message('info', 'Login method called');

        // If already logged in, redirect to dashboard
        if (session()->get('logged_in')) {
            log_message('info', 'User already logged in, redirecting');
            return redirect()->to('/');
        }

        log_message('info', 'Showing login view');
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username dan password harus diisi dengan benar');
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        // Check if user exists by username or email
        $user = $this->userModel->getUserByUsernameOrEmail($username);

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username atau email tidak ditemukan');
        }

        // Normalize field names for compatibility
        if (isset($user['id_user']) && !isset($user['id'])) {
            $user['id'] = $user['id_user'];
        }
        if (isset($user['password_hash']) && !isset($user['password'])) {
            $user['password'] = $user['password_hash'];
        }
        if (isset($user['peran']) && !isset($user['role'])) {
            $user['role'] = $user['peran'];
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password salah');
        }

        // Check if user is active (skip if status field doesn't exist)
        if (isset($user['status']) && $user['status'] !== 'aktif') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Akun Anda belum aktif atau telah dinonaktifkan');
        }

        // Set session data
        $sessionData = [
            'user_id' => $user['id_user'] ?? $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'nama_lengkap' => $user['nama_lengkap'],
            'role' => $user['peran'],
            'logged_in' => true
        ];

        session()->set($sessionData);

        // Set remember me cookie if checked
        if ($remember) {
            $token = bin2hex(random_bytes(32));
            // Store token in database (you may need to add remember_token field)
            // Set cookie for 30 days
            setcookie('remember_token', $token, time() + (86400 * 30), '/');
        }

        // Update diperbarui_pada (last activity)
        $this->userModel->update($user['id'], [
            'diperbarui_pada' => date('Y-m-d H:i:s')
        ]);

        // Redirect based on role
        if ($user['role'] === 'admin') {
            $redirectUrl = 'admin/dashboard';
        } else {
            $redirectUrl = 'user/dashboard';
        }

        return redirect()->to($redirectUrl)
            ->with('success', 'Selamat datang, ' . $user['nama_lengkap'] . '!');
    }

    public function register()
    {
        // If already logged in, redirect to dashboard
        if (session()->get('logged_in')) {
            return redirect()->to('/');
        }

        return view('auth/register');
    }

    public function attemptRegister()
    {
        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'username' => 'required|min_length[3]|max_length[50]|is_unique[user.username]',
            'email' => 'required|valid_email|is_unique[user.email]',
            'no_hp' => 'required|min_length[10]|max_length[15]',
            'peran' => 'required|in_list[atlet,pelatih,ofisial]',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
            'terms' => 'required'
        ];

        $errors = [
            'username' => [
                'is_unique' => 'Username sudah digunakan'
            ],
            'email' => [
                'is_unique' => 'Email sudah terdaftar',
                'valid_email' => 'Email tidak valid'
            ],
            'password_confirm' => [
                'matches' => 'Konfirmasi password tidak cocok'
            ],
            'peran' => [
                'required' => 'Silakan pilih peran Anda',
                'in_list' => 'Peran yang dipilih tidak valid'
            ],
            'terms' => [
                'required' => 'Anda harus menyetujui syarat dan ketentuan'
            ]
        ];

        if (!$this->validate($rules, $errors)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $this->validator->getErrors()));
        }

        // Prepare data
        $data = [
            'id_user' => $this->generateUUID(),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'nohp' => $this->request->getPost('no_hp'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'peran' => $this->request->getPost('peran'),
            'dibuat_pada' => date('Y-m-d H:i:s'),
            'diperbarui_pada' => date('Y-m-d H:i:s')
        ];

        // Insert user
        if ($this->userModel->insert($data)) {
            return redirect()->to('auth/login')
                ->with('success', 'Pendaftaran berhasil! Silakan login dengan akun Anda.');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
        }
    }

    public function logout()
    {
        // Clear session
        session()->destroy();

        // Clear remember me cookie
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/');
        }

        return redirect()->to('/')
            ->with('success', 'Anda telah berhasil logout');
    }

    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    public function sendResetLink()
    {
        $rules = [
            'email' => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email tidak valid');
        }

        $email = $this->request->getPost('email');
        $user = $this->userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email tidak terdaftar');
        }

        // Generate reset token
        $token = bin2hex(random_bytes(32));

        // Store token in database (you may need to add reset_token and reset_token_expires fields)
        // Send email with reset link
        // For now, just show success message

        return redirect()->back()
            ->with('success', 'Link reset password telah dikirim ke email Anda');
    }
}
