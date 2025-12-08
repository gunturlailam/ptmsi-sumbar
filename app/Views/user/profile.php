<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - PTMSI Sumbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/ptmsi-style.css') ?>">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 30%, rgba(30, 144, 255, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(0, 191, 255, 0.05) 0%, transparent 50%);
            animation: pulse 8s ease-in-out infinite;
            z-index: -1;
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

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        .profile-hero {
            background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%);
            color: white;
            padding: 80px 0 120px;
            border-radius: 0 0 50px 50px;
            margin-bottom: 0;
            position: relative;
            overflow: hidden;
        }

        .profile-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 40%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 60%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: pulse 8s ease-in-out infinite;
        }

        .profile-hero .container {
            position: relative;
            z-index: 2;
        }

        .hero-content {
            animation: fadeInUp 0.8s ease-out;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 20px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .profile-main-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 50px;
            padding: 50px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(20px);
            margin-top: -100px;
            position: relative;
            z-index: 3;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .profile-avatar-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1E90FF 0%, #00BFFF 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: white;
            margin: 0 auto 25px;
            border: 6px solid white;
            box-shadow: 0 15px 40px rgba(30, 144, 255, 0.4);
            animation: bounce 2s ease-in-out infinite;
            position: relative;
        }

        .profile-avatar::after {
            content: '';
            position: absolute;
            top: -6px;
            left: -6px;
            right: -6px;
            bottom: -6px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1E90FF, #00BFFF, #1E90FF);
            z-index: -1;
            animation: pulse 3s ease-in-out infinite;
        }

        .profile-name {
            font-size: 2.2rem;
            font-weight: 900;
            color: #003366;
            margin-bottom: 15px;
        }

        .role-badge {
            background: linear-gradient(135deg, #1E90FF 0%, #00BFFF 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 700;
            display: inline-block;
            box-shadow: 0 8px 25px rgba(30, 144, 255, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .join-date {
            color: #666;
            font-size: 0.95rem;
            margin-top: 15px;
        }

        .info-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin: 40px 0;
        }

        .info-card {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 30px;
            padding: 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            border: 2px solid rgba(30, 144, 255, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #1E90FF 0%, #00BFFF 100%);
        }

        .info-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 60px rgba(30, 144, 255, 0.15);
            border-color: rgba(30, 144, 255, 0.3);
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1E90FF 0%, #00BFFF 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            box-shadow: 0 8px 20px rgba(30, 144, 255, 0.3);
        }

        .info-content h6 {
            margin: 0 0 5px 0;
            color: #003366;
            font-weight: 700;
            font-size: 1rem;
        }

        .info-content p {
            margin: 0;
            color: #666;
            font-size: 1rem;
            font-weight: 500;
        }

        .form-section {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            border: 2px solid rgba(30, 144, 255, 0.1);
            margin: 40px 0;
            position: relative;
            overflow: hidden;
        }

        .form-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #1E90FF 0%, #00BFFF 100%);
        }

        .section-title {
            color: #003366;
            font-weight: 900;
            font-size: 1.8rem;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .section-title i {
            color: #1E90FF;
            font-size: 2rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            color: #003366;
            font-weight: 700;
            margin-bottom: 12px;
            display: block;
            font-size: 1rem;
        }

        .form-control-modern {
            width: 100%;
            padding: 18px 25px;
            border: 2px solid #E8F2FF;
            border-radius: 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #F8F9FA;
            font-weight: 500;
        }

        .form-control-modern:focus {
            outline: none;
            border-color: #1E90FF;
            background: #fff;
            box-shadow: 0 0 0 6px rgba(30, 144, 255, 0.1);
            transform: translateY(-2px);
        }

        .form-control-modern[readonly] {
            background: linear-gradient(135deg, #e9ecef 0%, #f8f9fa 100%);
            color: #6c757d;
            cursor: not-allowed;
        }

        .btn-modern {
            padding: 18px 35px;
            border: none;
            border-radius: 15px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        .btn-update {
            background: linear-gradient(135deg, #1E90FF 0%, #00BFFF 100%);
            color: white;
            box-shadow: 0 10px 30px rgba(30, 144, 255, 0.4);
        }

        .btn-update:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(30, 144, 255, 0.5);
            color: white;
        }

        .btn-back {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
            box-shadow: 0 10px 30px rgba(108, 117, 125, 0.3);
        }

        .btn-back:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(108, 117, 125, 0.4);
            color: white;
        }

        .btn-contact {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
        }

        .btn-contact:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(40, 167, 69, 0.4);
            color: white;
        }

        .alert-modern {
            padding: 20px 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: #fff;
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
        }

        .alert-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: #fff;
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
        }

        .password-section {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            border: 2px solid rgba(255, 193, 7, 0.3);
        }

        .password-section::before {
            background: linear-gradient(90deg, #ffc107 0%, #fd7e14 100%);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .profile-main-card {
                padding: 30px;
                margin-top: -80px;
                border-radius: 30px;
            }

            .profile-avatar {
                width: 120px;
                height: 120px;
                font-size: 3rem;
            }

            .profile-name {
                font-size: 1.8rem;
            }

            .info-cards-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .form-section {
                padding: 25px;
                border-radius: 25px;
            }

            .btn-modern {
                width: 100%;
                justify-content: center;
                margin-bottom: 15px;
            }
        }
    </style>
</head>

<body>
    <?= $this->include('layouts/navbar') ?>

    <!-- Profile Hero Section -->
    <div class="profile-hero">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">
                    <i class="bi bi-person-circle"></i> Profil Saya
                </h1>
                <p class="hero-subtitle">Kelola informasi profil dan data pribadi Anda</p>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Main Profile Card -->
        <div class="profile-main-card">
            <!-- Profile Avatar Section -->
            <div class="profile-avatar-section">
                <div class="profile-avatar">
                    <i class="bi bi-person"></i>
                </div>
                <h2 class="profile-name"><?= esc($user['nama_lengkap']) ?></h2>
                <span class="role-badge"><?= ucfirst(session()->get('role')) ?></span>
                <p class="join-date">
                    <i class="bi bi-calendar-check"></i> Bergabung sejak <?= date('d M Y', strtotime($user['dibuat_pada'])) ?>
                </p>
            </div>

            <!-- Account Information Cards -->
            <div class="info-cards-grid">
                <div class="info-card">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="info-content">
                            <h6>Nama Lengkap</h6>
                            <p><?= esc($user['nama_lengkap']) ?></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-at"></i>
                        </div>
                        <div class="info-content">
                            <h6>Username</h6>
                            <p><?= esc($user['username']) ?></p>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h6>Email</h6>
                            <p><?= esc($user['email']) ?></p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-phone"></i>
                        </div>
                        <div class="info-content">
                            <h6>Nomor HP</h6>
                            <p><?= esc($user['nohp'] ?? 'Belum diisi') ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Form -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="bi bi-pencil-square"></i> Edit Profil
            </h3>

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

            <form action="<?= base_url('user/profile/update') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_lengkap" class="form-label">
                                <i class="bi bi-person"></i> Nama Lengkap
                            </label>
                            <input type="text"
                                id="nama_lengkap"
                                name="nama_lengkap"
                                class="form-control-modern"
                                value="<?= esc($user['nama_lengkap']) ?>"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope"></i> Email
                            </label>
                            <input type="email"
                                id="email"
                                name="email"
                                class="form-control-modern"
                                value="<?= esc($user['email']) ?>"
                                required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nohp" class="form-label">
                                <i class="bi bi-phone"></i> Nomor HP
                            </label>
                            <input type="tel"
                                id="nohp"
                                name="nohp"
                                class="form-control-modern"
                                value="<?= esc($user['nohp'] ?? '') ?>"
                                placeholder="Masukkan nomor HP">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username" class="form-label">
                                <i class="bi bi-at"></i> Username
                            </label>
                            <input type="text"
                                id="username"
                                name="username"
                                class="form-control-modern"
                                value="<?= esc($user['username']) ?>"
                                readonly>
                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i> Username tidak dapat diubah
                            </small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="peran" class="form-label">
                                <i class="bi bi-person-badge"></i> Peran
                            </label>
                            <input type="text"
                                id="peran"
                                name="peran"
                                class="form-control-modern"
                                value="<?= ucfirst(esc($user['peran'])) ?>"
                                readonly>
                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i> Peran tidak dapat diubah
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-calendar-check"></i> Tanggal Bergabung
                            </label>
                            <input type="text"
                                class="form-control-modern"
                                value="<?= date('d M Y H:i', strtotime($user['dibuat_pada'])) ?>"
                                readonly>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-3 mt-4">
                    <button type="submit" class="btn-modern btn-update">
                        <i class="bi bi-check-circle"></i> Simpan Perubahan
                    </button>
                    <a href="<?= base_url('user/dashboard') ?>" class="btn-modern btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </form>
        </div>

        <!-- Change Password Section -->
        <div class="form-section password-section">
            <h3 class="section-title">
                <i class="bi bi-shield-lock"></i> Ubah Password
            </h3>
            <p class="text-muted mb-4">
                <i class="bi bi-info-circle"></i>
                Untuk keamanan akun, silakan hubungi administrator untuk mengubah password Anda.
            </p>
            <a href="<?= base_url('hubungi-kami') ?>" class="btn-modern btn-contact">
                <i class="bi bi-envelope"></i> Hubungi Administrator
            </a>
        </div>
    </div>

    <?= $this->include('layouts/footer') ?>
</body>

</html>

</html>