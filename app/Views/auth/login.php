<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PTMSI Sumbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%);
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: pulse 8s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.5;
            }

            50% {
                opacity: 0.8;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 370px;
            animation: fadeInUp 0.8s ease-out;
        }

        .login-card {
            background: #fff;
            border-radius: 18px;
            padding: 28px 22px 22px 22px;
            box-shadow: 0 4px 24px rgba(30, 144, 255, 0.10);
            border: 1px solid #e8f2ff;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 18px;
        }

        .logo-container img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid #1E90FF;
            background: #fff;
            padding: 4px;
            box-shadow: 0 2px 8px rgba(30, 144, 255, 0.10);
            margin-bottom: 10px;
        }

        .logo-container h2 {
            color: #003366;
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 4px;
            letter-spacing: 1px;
        }

        .logo-container p {
            color: #888;
            font-size: 0.98rem;
            margin: 0;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            color: #003366;
            font-weight: 600;
            margin-bottom: 7px;
            display: block;
            font-size: 0.97rem;
        }

        .form-control-modern {
            width: 100%;
            padding: 12px 16px 12px 40px;
            border: 1.5px solid #E8F2FF;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #F8F9FA;
        }

        .form-control-modern:focus {
            outline: none;
            border-color: #1E90FF;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(30, 144, 255, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #1E90FF;
            font-size: 1.1rem;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #bbb;
            cursor: pointer;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #1E90FF;
        }

        .form-check {
            margin-bottom: 25px;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            border: 2px solid #1E90FF;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #1E90FF;
            border-color: #1E90FF;
        }

        .form-check-label {
            color: #666;
            margin-left: 8px;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #1E90FF 0%, #00BFFF 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(30, 144, 255, 0.10);
        }

        .btn-login:hover {
            background: linear-gradient(90deg, #00BFFF 0%, #1E90FF 100%);
            box-shadow: 0 4px 16px rgba(30, 144, 255, 0.13);
        }

        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #E8F2FF;
        }

        .divider span {
            background: #fff;
            padding: 0 15px;
            color: #666;
            font-size: 0.9rem;
            position: relative;
            z-index: 1;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 0.95rem;
        }

        .register-link a {
            color: #1E90FF;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #003366;
            text-decoration: underline;
        }

        .forgot-password {
            text-align: right;
            margin-top: -15px;
            margin-bottom: 25px;
        }

        .forgot-password a {
            color: #1E90FF;
            font-size: 0.9rem;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #003366;
            text-decoration: underline;
        }

        .alert-modern {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: none;
            font-size: 0.95rem;
        }

        .alert-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: #fff;
        }

        .alert-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: #fff;
        }

        .back-home {
            text-align: left;
            margin-bottom: 18px;
            margin-left: 2px;
        }

        .back-home a {
            color: #1E90FF;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            background: #f4faff;
            border-radius: 18px;
            border: 1px solid #e8f2ff;
            transition: all 0.2s ease;
        }

        .back-home a:hover {
            background: #e8f2ff;
            color: #003366;
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 40px 30px;
                border-radius: 25px;
            }

            .logo-container h2 {
                font-size: 1.6rem;
            }

            .logo-container img {
                width: 80px;
                height: 80px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="back-home" style="text-align: left; margin-bottom: 20px; margin-left: 5px;">
            <a href="<?= base_url('/') ?>">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
        <div class="login-card">
            <div class="logo-container">
                <img src="<?= base_url('assets/img/gambar-ptmsi.png') ?>" alt="PTMSI Sumbar">
                <h2>PTMSI Sumbar</h2>
                <p>Masuk ke Akun Anda</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert-modern alert-danger">
                    <i class="bi bi-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert-modern alert-success">
                    <i class="bi bi-check-circle"></i> <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('auth/login') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="username">Username atau Email</label>
                    <div style="position: relative;">
                        <i class="bi bi-person-fill input-icon"></i>
                        <input type="text"
                            id="username"
                            name="username"
                            class="form-control-modern"
                            placeholder="Masukkan username atau email"
                            value="<?= old('username') ?>"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div style="position: relative;">
                        <i class="bi bi-lock-fill input-icon"></i>
                        <input type="password"
                            id="password"
                            name="password"
                            class="form-control-modern"
                            placeholder="Masukkan password"
                            required>
                        <i class="bi bi-eye-fill password-toggle" onclick="togglePassword()"></i>
                    </div>
                </div>

                <div class="forgot-password">
                    <a href="<?= base_url('auth/forgot-password') ?>">Lupa Password?</a>
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                        Ingat Saya
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    <span><i class="bi bi-box-arrow-in-right"></i> Masuk</span>
                </button>
            </form>
        </div>

        <!-- back-home dipindahkan ke atas -->
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye-fill');
                toggleIcon.classList.add('bi-eye-slash-fill');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash-fill');
                toggleIcon.classList.add('bi-eye-fill');
            }
        }
    </script>
</body>

</html>