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

    public function login()
    {
        // If already logged in, redirect to dashboard
        if (session()->get('logged_in')) {
            return redirect()->to('/');
        }

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
        $user = $this->userModel
            ->where('username', $username)
            ->orWhere('email', $username)
            ->first();

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username atau email tidak ditemukan');
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password salah');
        }

        // Check if user is active
        if ($user['status'] !== 'aktif') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Akun Anda belum aktif atau telah dinonaktifkan');
        }

        // Set session data
        $sessionData = [
            'user_id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'nama_lengkap' => $user['nama_lengkap'],
            'role' => $user['role'],
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

        // Update last login
        $this->userModel->update($user['id'], [
            'last_login' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/')
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
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'user', // Default role
            'status' => 'aktif', // Auto activate, or set to 'pending' for manual activation
            'created_at' => date('Y-m-d H:i:s')
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
