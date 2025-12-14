<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - PTMSI Sumbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #003366;
            --secondary-blue: #1E90FF;
            --light-blue: #00BFFF;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #E8F2FF 0%, #F0F8FF 100%);
            min-height: 100vh;
            overflow-x: hidden;
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
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--light-blue) 100%);
            color: white;
            padding: 60px 0 40px;
            margin-bottom: 50px;
            border-radius: 0 0 50px 50px;
            box-shadow: 0 15px 50px rgba(30, 144, 255, 0.25);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
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

        .hero-section h1 {
            font-size: 2.8rem;
            font-weight: 900;
            margin-bottom: 15px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.8s ease-out;
        }

        .submenu-nav {
            background: white;
            border-radius: 30px;
            padding: 35px;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(30, 144, 255, 0.15);
            position: relative;
            overflow: hidden;
            border: 2px solid #E8F2FF;
        }

        .submenu-nav::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(30, 144, 255, 0.05) 0%, transparent 70%);
        }

        .submenu-nav .nav-link {
            color: var(--primary-blue);
            font-weight: 700;
            padding: 16px 28px;
            border-radius: 25px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            margin: 8px;
            position: relative;
            z-index: 1;
            border: 2px solid transparent;
            font-size: 1.05rem;
        }

        .submenu-nav .nav-link:hover {
            background: linear-gradient(135deg, #E8F2FF 0%, #fff 100%);
            color: var(--primary-blue);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(30, 144, 255, 0.2);
            border-color: var(--secondary-blue);
        }

        .submenu-nav .nav-link.active {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--light-blue) 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(30, 144, 255, 0.4);
        }

        .submenu-nav .nav-link i {
            font-size: 1.2rem;
            margin-right: 8px;
        }

        .section-card {
            background: white;
            border-radius: 25px;
            padding: 35px;
            margin-bottom: 35px;
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.12);
            border: 2px solid #E8F2FF;
            transition: all 0.3s ease;
        }

        .section-card:hover {
            box-shadow: 0 12px 40px rgba(30, 144, 255, 0.18);
            transform: translateY(-2px);
        }

        .section-title {
            color: var(--primary-blue);
            font-size: 1.9rem;
            font-weight: 900;
            margin-bottom: 25px;
            padding: 20px;
            background: linear-gradient(to right, #E8F2FF 0%, transparent 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .section-title i {
            color: var(--secondary-blue);
            font-size: 2rem;
        }

        .form-card {
            background: linear-gradient(135deg, #E8F2FF 0%, #F8F9FA 100%);
            padding: 30px;
            border-radius: 25px;
            margin-bottom: 25px;
            border: 2px solid #E8F2FF;
            box-shadow: 0 4px 20px rgba(30, 144, 255, 0.08);
            transition: all 0.3s ease;
        }

        .form-card:hover {
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.15);
            transform: translateY(-2px);
        }

        .form-card h4 {
            font-weight: 900;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 15px;
            border: 2px solid #E8F2FF;
            padding: 12px 18px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 0.2rem rgba(30, 144, 255, 0.25);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--light-blue) 100%);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 20px;
            font-weight: 700;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(30, 144, 255, 0.3);
            font-size: 1.05rem;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(30, 144, 255, 0.4);
            color: white;
        }

        .btn-submit i {
            font-size: 1.2rem;
            margin-right: 8px;
        }

        .info-box {
            background: linear-gradient(135deg, #E8F2FF 0%, #F0F8FF 100%);
            padding: 25px;
            border-radius: 20px;
            border: 2px solid var(--secondary-blue);
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(30, 144, 255, 0.1);
        }

        .info-box i {
            font-size: 2.5rem;
            color: var(--secondary-blue);
            margin-right: 18px;
        }

        .info-box strong {
            color: var(--primary-blue);
            font-weight: 900;
            font-size: 1.1rem;
        }

        .info-box p,
        .info-box ul {
            color: var(--primary-blue);
            font-weight: 500;
        }

        .alert {
            border-radius: 20px;
            border: 2px solid;
            padding: 18px 20px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .alert-success {
            background: linear-gradient(135deg, #E8F5E9 0%, #C8E6C9 100%);
            border-color: #66BB6A;
            color: #2E7D32;
        }

        .alert-danger {
            background: linear-gradient(135deg, #FFEBEE 0%, #FFCDD2 100%);
            border-color: #EF5350;
            color: #C62828;
        }

        .alert i {
            font-size: 1.3rem;
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 1.8rem;
            }

            .submenu-nav .nav-link {
                display: block;
                margin: 5px 0;
            }

            .section-card {
                padding: 20px;
            }

            .form-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <?= $this->include('layouts/header') ?>

    <div class="hero-section">
        <div class="container">
            <h1><i class="bi bi-globe"></i> Layanan Online</h1>
            <p>Pendaftaran dan Pengajuan Online PTMSI Sumbar</p>
        </div>
    </div>

    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle"></i> <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Sub Menu Navigation -->
        <div class="submenu-nav">
            <ul class="nav nav-pills justify-content-center flex-wrap">
                <li class="nav-item">
                    <a class="nav-link active" href="#pendaftaran-atlet" data-bs-toggle="pill">
                        <i class="bi bi-person-plus"></i> Pendaftaran Atlet/Klub
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pendaftaran-turnamen" data-bs-toggle="pill">
                        <i class="bi bi-trophy"></i> Pendaftaran Turnamen
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#informasi-layanan" data-bs-toggle="pill">
                        <i class="bi bi-info-circle"></i> Informasi Layanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#kontak-bantuan" data-bs-toggle="pill">
                        <i class="bi bi-headset"></i> Bantuan
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <!-- 1. Pendaftaran Atlet/Klub Online -->
            <div class="tab-pane fade show active" id="pendaftaran-atlet">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-person-plus"></i> Pendaftaran Atlet/Klub Online
                    </h2>

                    <div class="info-box">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle"></i>
                            <div>
                                <strong>Sistem Pendaftaran Terintegrasi:</strong>
                                <p class="mb-0">PTMSI Sumbar telah memiliki sistem pendaftaran online yang terintegrasi. Silakan gunakan sistem resmi untuk pendaftaran.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-card">
                                <h4 class="text-primary mb-3"><i class="bi bi-building"></i> Pendaftaran Klub</h4>
                                <div class="info-box mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-check-circle text-success"></i>
                                        <div>
                                            <strong>Sistem Resmi Tersedia</strong>
                                            <p class="mb-0">Gunakan sistem pendaftaran klub resmi PTMSI Sumbar dengan fitur lengkap dan terintegrasi.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <a href="<?= base_url('registration/klub-register') ?>" class="btn btn-submit">
                                        <i class="bi bi-arrow-right-circle"></i> Daftar Klub Resmi
                                    </a>
                                    <a href="<?= base_url('login') ?>" class="btn btn-outline-primary">
                                        <i class="bi bi-box-arrow-in-right"></i> Login Klub
                                    </a>
                                </div>
                                <hr class="my-3">
                                <small class="text-muted">
                                    <strong>Fitur Sistem Resmi:</strong><br>
                                    • Upload dokumen SK & identitas<br>
                                    • Verifikasi otomatis admin<br>
                                    • Dashboard klub lengkap<br>
                                    • Kelola atlet & pelatih
                                </small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-card">
                                <h4 class="text-primary mb-3"><i class="bi bi-person"></i> Pendaftaran Atlet</h4>
                                <div class="info-box mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-shield-check text-warning"></i>
                                        <div>
                                            <strong>Melalui Klub Terdaftar</strong>
                                            <p class="mb-0">Pendaftaran atlet harus melalui klub yang sudah terdaftar dan terverifikasi di PTMSI Sumbar.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle"></i>
                                    <strong>Cara Mendaftar Atlet:</strong>
                                    <ol class="mb-0 mt-2">
                                        <li>Klub login ke sistem</li>
                                        <li>Pilih menu "Kelola Atlet"</li>
                                        <li>Klik "Tambah Atlet Baru"</li>
                                        <li>Isi data & upload dokumen</li>
                                        <li>Tunggu verifikasi admin</li>
                                    </ol>
                                </div>
                                <div class="d-grid">
                                    <a href="<?= base_url('login') ?>" class="btn btn-outline-primary">
                                        <i class="bi bi-box-arrow-in-right"></i> Login untuk Daftar Atlet
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Pendaftaran Turnamen -->
            <div class="tab-pane fade" id="pendaftaran-turnamen">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-trophy"></i> Pendaftaran Turnamen Online
                    </h2>

                    <div class="info-box">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar-event"></i>
                            <div>
                                <strong>Sistem Turnamen Terintegrasi:</strong>
                                <p class="mb-0">Gunakan sistem pendaftaran turnamen resmi dengan validasi otomatis dan fitur lengkap.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="form-card text-center">
                                <h4 class="text-primary mb-4"><i class="bi bi-trophy"></i> Sistem Turnamen Resmi</h4>

                                <div class="info-box mb-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="bi bi-check-circle-fill text-success me-3"></i>
                                        <div>
                                            <strong>Fitur Sistem Turnamen:</strong>
                                            <ul class="list-unstyled mb-0 mt-2 text-start">
                                                <li>✅ Validasi otomatis (usia, gender, kuota)</li>
                                                <li>✅ Upload bukti pembayaran</li>
                                                <li>✅ Tracking status real-time</li>
                                                <li>✅ Notifikasi verifikasi</li>
                                                <li>✅ Riwayat pendaftaran</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-3">
                                    <a href="<?= base_url('tournament') ?>" class="btn btn-submit btn-lg">
                                        <i class="bi bi-eye"></i> Lihat Turnamen Tersedia
                                    </a>
                                    <a href="<?= base_url('login') ?>" class="btn btn-outline-primary">
                                        <i class="bi bi-box-arrow-in-right"></i> Login untuk Mendaftar
                                    </a>
                                </div>

                                <hr class="my-4">

                                <div class="alert alert-info text-start">
                                    <i class="bi bi-info-circle"></i>
                                    <strong>Cara Mendaftar Turnamen:</strong>
                                    <ol class="mb-0 mt-2">
                                        <li><strong>Atlet:</strong> Login → Lihat Turnamen → Pilih & Daftar</li>
                                        <li><strong>Klub:</strong> Login → Dashboard → Pendaftaran Turnamen</li>
                                        <li>Sistem akan validasi otomatis kelayakan</li>
                                        <li>Upload bukti bayar (jika ada biaya)</li>
                                        <li>Tunggu verifikasi admin</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Informasi Layanan -->
            <div class="tab-pane fade" id="informasi-layanan">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-info-circle"></i> Informasi Layanan PTMSI Sumbar
                    </h2>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-card">
                                <h4 class="text-primary mb-3"><i class="bi bi-building"></i> Layanan Klub</h4>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Pendaftaran klub baru</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Verifikasi dokumen klub</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Pengelolaan anggota</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Dashboard klub terintegrasi</li>
                                </ul>
                                <a href="<?= base_url('registration/klub-register') ?>" class="btn btn-outline-primary">
                                    <i class="bi bi-arrow-right"></i> Daftar Klub
                                </a>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-card">
                                <h4 class="text-primary mb-3"><i class="bi bi-person"></i> Layanan Atlet</h4>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Pendaftaran melalui klub</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Kartu anggota digital</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Tracking ranking</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Riwayat pertandingan</li>
                                </ul>
                                <a href="<?= base_url('login') ?>" class="btn btn-outline-primary">
                                    <i class="bi bi-arrow-right"></i> Login Atlet
                                </a>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-card">
                                <h4 class="text-primary mb-3"><i class="bi bi-trophy"></i> Layanan Turnamen</h4>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Pendaftaran online</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Validasi otomatis</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Upload bukti bayar</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Tracking status</li>
                                </ul>
                                <a href="<?= base_url('tournament') ?>" class="btn btn-outline-primary">
                                    <i class="bi bi-arrow-right"></i> Lihat Turnamen
                                </a>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-card">
                                <h4 class="text-primary mb-3"><i class="bi bi-award"></i> Layanan Pelatih</h4>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Pendaftaran melalui klub</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Sertifikasi pelatih</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Manajemen atlet</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Laporan kegiatan</li>
                                </ul>
                                <a href="<?= base_url('login') ?>" class="btn btn-outline-primary">
                                    <i class="bi bi-arrow-right"></i> Login Pelatih
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Kontak & Bantuan -->
            <div class="tab-pane fade" id="kontak-bantuan">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-headset"></i> Bantuan & Kontak
                    </h2>

                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="form-card text-center">
                                <h4 class="text-primary mb-4"><i class="bi bi-question-circle"></i> Butuh Bantuan?</h4>

                                <div class="info-box mb-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="bi bi-telephone-fill text-primary me-3"></i>
                                        <div>
                                            <strong>Kontak PTMSI Sumatera Barat:</strong>
                                            <p class="mb-0 mt-2">
                                                <strong>Telepon:</strong> (0751) 123-4567<br>
                                                <strong>Email:</strong> info@ptmsi-sumbar.org<br>
                                                <strong>WhatsApp:</strong> +62 812-3456-7890
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info text-start">
                                    <i class="bi bi-clock"></i>
                                    <strong>Jam Layanan:</strong><br>
                                    Senin - Jumat: 08:00 - 16:00 WIB<br>
                                    Sabtu: 08:00 - 12:00 WIB<br>
                                    Minggu & Hari Libur: Tutup
                                </div>

                                <div class="d-grid gap-2">
                                    <a href="<?= base_url('hubungi-kami') ?>" class="btn btn-submit">
                                        <i class="bi bi-envelope"></i> Kirim Pesan
                                    </a>
                                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success">
                                        <i class="bi bi-whatsapp"></i> Chat WhatsApp
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('layouts/footer') ?>

</body>

</html>