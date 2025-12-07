<!DOCTYPE html>
<html lang="id">

</html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lupa Password - PTMSI Sumbar</title>
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

    .forgot-container {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 450px;
        animation: fadeInUp 0.8s ease-out;
    }

    .forgot-card {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 30px;
        padding: 50px 40px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
    }

    .logo-container {
        text-align: center;
        margin-bottom: 35px;
        animation: float 3s ease-in-out infinite;
    }

    .logo-container img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 4px solid #1E90FF;
        background: #fff;
        padding: 10px;
        box-shadow: 0 8px 25px rgba(30, 144, 255, 0.3);
        margin-bottom: 20px;
    }

    .logo-container h2 {
        color: #003366;
        font-weight: 900;
        font-size: 2rem;
        margin-bottom: 8px;
    }

    .logo-container p {
        color: #666;
        font-size: 1rem;
        margin: 0;
        line-height: 1.5;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group label {
        color: #003366;
        font-weight: 700;
        margin-bottom: 10px;
        display: block;
        font-size: 0.95rem;
    }

    .form-control-modern {
        width: 100%;
        padding: 15px 20px 15px 50px;
        border: 2px solid #E8F2FF;
        border-radius: 15px;
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
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #1E90FF;
        font-size: 1.2rem;
    }

    .btn-reset {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #1E90FF 0%, #00BFFF 100%);
        color: #fff;
        border: none;
        border-radius: 15px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 25px rgba(30, 144, 255, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-reset::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #00BFFF 0%, #1E90FF 100%);
        transition: left 0.3s ease;
    }

    .btn-reset:hover::before {
        left: 0;
    }

    .btn-reset:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(30, 144, 255, 0.4);
    }

    .btn-reset span {
        position: relative;
        z-index: 1;
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

    .back-link {
        text-align: center;
        margin-top: 25px;
        color: #666;
        font-size: 0.95rem;
    }

    .back-link a {
        color: #1E90FF;
        font-weight: 700;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .back-link a:hover {
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
        text-align: center;
        margin-top: 25px;
    }

    .back-home a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 25px;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .back-home a:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }

    @media (max-width: 576px) {
        .forgot-card {
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
    <div class="forgot-container">
        <div class="forgot-card">
            <div class="logo-container">
                <img src="<?= base_url('assets/img/gambar-ptmsi.png') ?>" alt="PTMSI Sumbar">
                <h2>Lupa Password?</h2>
                <p>Masukkan email Anda dan kami akan mengirimkan link untuk reset password</p>
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

            <form action="<?= base_url('auth/forgot-password') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="email">Email</label>
                    <div style="position: relative;">
                        <i class="bi bi-envelope-fill input-icon"></i>
                        <input type="email"
                            id="email"
                            name="email"
                            class="form-control-modern"
                            placeholder="Masukkan email Anda"
                            value="<?= old('email') ?>"
                            required>
                    </div>
                </div>

                <button type="submit" class="btn-reset">
                    <span><i class="bi bi-send-fill"></i> Kirim Link Reset</span>
                </button>
            </form>

            <div class="divider">
                <span>atau</span>
            </div>

            <div class="back-link">
                Ingat password Anda? <a href="<?= base_url('auth/login') ?>">Masuk Sekarang</a>
            </div>
        </div>

        <div class="back-home">
            <a href="<?= base_url('/') ?>">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</body>

</html>