<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kejuaraan & Event - PTMSI Sumbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/ptmsi-style.css') ?>">
    <style>
        .event-card {
            background: #fff;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.12);
            transition: all 0.4s ease;
            border: 2px solid #E8F2FF;
            position: relative;
        }

        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(30, 144, 255, 0.25);
            border-color: #1E90FF;
        }

        .event-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(90deg, #1E90FF 0%, #00BFFF 100%);
        }

        .event-date-badge {
            background: linear-gradient(135deg, #1E90FF, #003366);
            color: #fff;
            padding: 25px 20px;
            text-align: center;
            min-width: 110px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .event-date-badge::after {
            content: '';
            position: absolute;
            right: -10px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-left: 10px solid #003366;
        }

        .event-date-day {
            font-size: 2.8rem;
            font-weight: 900;
            line-height: 1;
            margin-bottom: 5px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .event-date-month {
            font-size: 1rem;
            font-weight: 600;
            opacity: 0.95;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .event-content {
            padding: 25px 30px;
            flex: 1;
        }

        .event-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #003366;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .event-info-grid {
            display: grid;
            gap: 10px;
            margin-bottom: 15px;
        }

        .event-info {
            font-size: 0.95rem;
            color: #555;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #F8F9FA 0%, #E8F2FF 100%);
            padding: 10px 15px;
            border-radius: 10px;
        }

        .event-info i {
            color: #1E90FF;
            margin-right: 10px;
            font-size: 1.1rem;
            width: 20px;
        }

        .event-info strong {
            color: #003366;
            margin-right: 5px;
        }

        .badge-tingkat {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 10px;
        }

        .badge-provinsi {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: #fff;
        }



        .badge-open {
            background: linear-gradient(135deg, #ffc107, #ff9800);
            color: #fff;
        }

        .filter-tabs {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 30px;
            justify-content: center;
        }

        .filter-tab {
            padding: 12px 28px;
            border-radius: 25px;
            border: 2px solid #1E90FF;
            background: #fff;
            color: #1E90FF;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-tab:hover,
        .filter-tab.active {
            background: linear-gradient(135deg, #1E90FF, #003366);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 144, 255, 0.3);
        }

        .form-modern {
            background: linear-gradient(135deg, #E8F2FF 0%, #fff 100%);
            border-radius: 25px;
            padding: 30px;
            border: 2px solid #1E90FF;
        }

        .form-modern .form-label {
            color: #003366;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-modern .form-control,
        .form-modern .form-select {
            border: 2px solid #E8F2FF;
            border-radius: 15px;
            padding: 12px 18px;
            transition: all 0.3s;
        }

        .form-modern .form-control:focus,
        .form-modern .form-select:focus {
            border-color: #1E90FF;
            box-shadow: 0 0 0 4px rgba(30, 144, 255, 0.1);
            outline: none;
        }

        .hasil-card {
            background: linear-gradient(135deg, #fff 0%, #F8F9FA 100%);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.12);
            margin-bottom: 25px;
            border: 2px solid #E8F2FF;
            position: relative;
            overflow: hidden;
        }

        .hasil-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(180deg, #1E90FF 0%, #00BFFF 100%);
        }

        .hasil-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(30, 144, 255, 0.2);
            border-color: #1E90FF;
        }

        .juara-badge {
            padding: 15px 20px;
            border-radius: 15px;
            font-size: 0.95rem;
            font-weight: 700;
            display: block;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .juara-badge:hover {
            transform: scale(1.05);
        }

        .juara-badge i {
            font-size: 1.2rem;
            margin-right: 5px;
        }

        .juara-1 {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: #fff;
            border: 3px solid #FFD700;
        }

        .juara-2 {
            background: linear-gradient(135deg, #C0C0C0, #A8A8A8);
            color: #fff;
            border: 3px solid #C0C0C0;
        }

        .juara-3 {
            background: linear-gradient(135deg, #CD7F32, #A0522D);
            color: #fff;
            border: 3px solid #CD7F32;
        }

        .dokumen-card {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            border: 2px solid #E8F2FF;
            transition: all 0.3s;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .dokumen-card:hover {
            background: linear-gradient(135deg, #1E90FF, #003366);
            color: #fff;
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(30, 144, 255, 0.3);
        }

        .dokumen-card:hover * {
            color: #fff !important;
        }

        .nav-menu-card {
            background: linear-gradient(135deg, #fff 0%, #E8F2FF 100%);
            border-radius: 20px;
            padding: 30px 20px;
            text-align: center;
            text-decoration: none;
            display: block;
            border: 2px solid #E8F2FF;
            transition: all 0.4s ease;
            height: 100%;
        }

        .nav-menu-card:hover {
            background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(30, 144, 255, 0.3);
            border-color: #1E90FF;
        }

        .nav-menu-card .nav-icon-wrapper {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1E90FF, #00BFFF);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            transition: all 0.4s ease;
        }

        .nav-menu-card:hover .nav-icon-wrapper {
            background: #fff;
            transform: scale(1.1) rotate(5deg);
        }

        .nav-menu-card .nav-icon-wrapper i {
            font-size: 2rem;
            color: #fff;
            transition: all 0.4s ease;
        }

        .nav-menu-card:hover .nav-icon-wrapper i {
            color: #1E90FF;
        }

        .nav-menu-card h6 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #003366;
            margin-bottom: 8px;
            transition: all 0.4s ease;
        }

        .nav-menu-card:hover h6 {
            color: #fff;
        }

        .nav-menu-card p {
            font-size: 0.85rem;
            color: #666;
            margin: 0;
            transition: all 0.4s ease;
        }

        .nav-menu-card:hover p {
            color: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>

<body>
    <?= $this->include('layouts/navbar') ?>

    <!-- Hero Section -->
    <div class="hero-modern">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">
                    <i class="bi bi-trophy-fill"></i> Kejuaraan & Event PTMSI Sumbar
                </h1>
                <p class="hero-subtitle">Informasi lengkap kejuaraan, turnamen, dan event tenis meja</p>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Sub Menu Navigation -->
        <div class="row g-3 mb-5">
            <div class="col-md-3 col-6">
                <a href="#kalender-kejuaraan" class="nav-menu-card">
                    <div class="nav-icon-wrapper">
                        <i class="bi bi-calendar-event-fill"></i>
                    </div>
                    <h6>Kalender</h6>
                    <p>Jadwal kejuaraan</p>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="#pendaftaran-turnamen" class="nav-menu-card">
                    <div class="nav-icon-wrapper">
                        <i class="bi bi-clipboard-check-fill"></i>
                    </div>
                    <h6>Pendaftaran</h6>
                    <p>Daftar turnamen</p>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="#juklak-juknis" class="nav-menu-card">
                    <div class="nav-icon-wrapper">
                        <i class="bi bi-file-earmark-text-fill"></i>
                    </div>
                    <h6>Juklak & Juknis</h6>
                    <p>Peraturan kejuaraan</p>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="#hasil-pertandingan" class="nav-menu-card">
                    <div class="nav-icon-wrapper">
                        <i class="bi bi-trophy-fill"></i>
                    </div>
                    <h6>Hasil</h6>
                    <p>Pemenang & skor</p>
                </a>
            </div>
        </div>

        <!-- Kalender Kejuaraan -->
        <div id="kalender-kejuaraan" class="card-modern mt-5">
            <h2 class="section-title-modern">
                <i class="bi bi-calendar-event-fill"></i> Kalender Kejuaraan
            </h2>

            <div class="filter-tabs">
                <button class="filter-tab active" data-filter="all">
                    <i class="bi bi-grid-fill"></i> Semua
                </button>
                <button class="filter-tab" data-filter="provinsi">
                    <i class="bi bi-geo-alt-fill"></i> Provinsi
                </button>
                <button class="filter-tab" data-filter="open">
                    <i class="bi bi-trophy-fill"></i> Open Tournament
                </button>
            </div>

            <?php if (!empty($events)): ?>
                <div class="grid-modern">
                    <?php foreach ($events as $event): ?>
                        <div class="event-card" data-tingkat="<?= strtolower($event['tingkat']) ?>">
                            <div class="d-flex">
                                <div class="event-date-badge">
                                    <div class="event-date-day"><?= date('d', strtotime($event['tanggal_mulai'])) ?></div>
                                    <div class="event-date-month"><?= date('M Y', strtotime($event['tanggal_mulai'])) ?></div>
                                </div>
                                <div class="event-content">
                                    <h5 class="event-title"><?= esc($event['judul']) ?></h5>
                                    <div class="event-info-grid">
                                        <div class="event-info">
                                            <i class="bi bi-geo-alt-fill"></i>
                                            <span><strong>Lokasi:</strong> <?= esc($event['lokasi'] ?? 'Lokasi TBA') ?></span>
                                        </div>
                                        <div class="event-info">
                                            <i class="bi bi-calendar-range"></i>
                                            <span><strong>Tanggal:</strong> <?= date('d M', strtotime($event['tanggal_mulai'])) ?> - <?= date('d M Y', strtotime($event['tanggal_selesai'])) ?></span>
                                        </div>
                                        <div class="event-info">
                                            <i class="bi bi-building"></i>
                                            <span><strong>Penyelenggara:</strong> <?= esc($event['nama_klub_penyelenggara'] ?? 'PTMSI Sumbar') ?></span>
                                        </div>
                                    </div>
                                    <div class="text-center mt-2">
                                        <span class="badge-tingkat badge-<?= strtolower($event['tingkat']) ?>">
                                            <i class="bi bi-trophy-fill"></i> <?= esc($event['tingkat']) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-calendar-x" style="font-size: 4rem; color: #1E90FF; opacity: 0.5;"></i>
                    <h5 class="mt-3 fw-bold">Belum ada kejuaraan terjadwal</h5>
                    <p class="text-muted">Kalender kejuaraan akan ditampilkan di sini</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pendaftaran Turnamen Online -->
        <div id="pendaftaran-turnamen" class="card-modern mt-5">
            <h2 class="section-title-modern">
                <i class="bi bi-clipboard-check-fill"></i> Pendaftaran Turnamen Online
            </h2>

            <div class="row g-4">
                <div class="col-lg-8 mx-auto">
                    <div class="text-center">
                        <div class="mb-4">
                            <i class="bi bi-trophy-fill" style="font-size: 4rem; color: #1E90FF;"></i>
                        </div>
                        <h4 class="mb-3 fw-bold text-primary">Sistem Pendaftaran Terintegrasi</h4>
                        <p class="mb-4 text-muted fs-5">
                            Pendaftaran turnamen kini menggunakan sistem terintegrasi yang lebih mudah dan aman.
                            Silakan gunakan sistem pendaftaran resmi untuk mendaftar turnamen.
                        </p>

                        <div class="d-grid gap-3 d-md-flex justify-content-md-center">
                            <a href="<?= base_url('tournament') ?>" class="btn btn-lg px-5 py-3"
                                style="background: linear-gradient(135deg, #1E90FF, #003366); color: white; border: none; border-radius: 25px; font-weight: 700;">
                                <i class="bi bi-trophy-fill me-2"></i>Lihat Turnamen Tersedia
                            </a>
                            <a href="<?= base_url('user/login') ?>" class="btn btn-outline-primary btn-lg px-5 py-3"
                                style="border-radius: 25px; font-weight: 600;">
                                <i class="bi bi-person-fill me-2"></i>Login untuk Mendaftar
                            </a>
                        </div>

                        <div class="mt-5">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded-4">
                                        <i class="bi bi-shield-check text-success mb-2" style="font-size: 2rem;"></i>
                                        <h6 class="fw-bold">Aman & Terpercaya</h6>
                                        <small class="text-muted">Data pendaftaran tersimpan dengan aman</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded-4">
                                        <i class="bi bi-lightning-charge text-warning mb-2" style="font-size: 2rem;"></i>
                                        <h6 class="fw-bold">Proses Cepat</h6>
                                        <small class="text-muted">Pendaftaran dan verifikasi otomatis</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded-4">
                                        <i class="bi bi-graph-up text-info mb-2" style="font-size: 2rem;"></i>
                                        <h6 class="fw-bold">Tracking Status</h6>
                                        <small class="text-muted">Pantau status pendaftaran real-time</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Juklak & Juknis Kejuaraan -->
        <div id="juklak-juknis" class="card-modern mt-5">
            <h2 class="section-title-modern">
                <i class="bi bi-file-earmark-text-fill"></i> Juklak & Juknis Kejuaraan
            </h2>

            <div class="alert alert-info d-flex align-items-center mb-4" role="alert" style="border-radius: 20px; border-left: 5px solid #0dcaf0;">
                <i class="bi bi-info-circle-fill me-3" style="font-size: 2rem;"></i>
                <div>
                    <strong>Petunjuk Pelaksanaan (Juklak) dan Petunjuk Teknis (Juknis)</strong> berisi aturan, tata cara, dan ketentuan pelaksanaan kejuaraan. Pastikan membaca dokumen ini sebelum mendaftar.
                </div>
            </div>

            <h5 class="mb-4 text-primary">
                <i class="bi bi-file-earmark-arrow-down-fill"></i> Dokumen Tersedia
            </h5>

            <div class="grid-modern-2">
                <a href="<?= base_url('assets/dokumen/juklak-kejuaraan-provinsi.pdf') ?>" class="dokumen-card" target="_blank">
                    <div>
                        <i class="bi bi-file-pdf-fill text-danger" style="font-size: 2rem;"></i>
                        <h6 class="fw-bold mt-2 mb-1">Juklak Kejuaraan Provinsi</h6>
                        <small class="text-muted">Petunjuk Pelaksanaan Kejuaraan Tingkat Provinsi</small>
                    </div>
                    <i class="bi bi-download" style="font-size: 1.5rem;"></i>
                </a>

                <a href="<?= base_url('assets/dokumen/juknis-kejuaraan-provinsi.pdf') ?>" class="dokumen-card" target="_blank">
                    <div>
                        <i class="bi bi-file-pdf-fill text-danger" style="font-size: 2rem;"></i>
                        <h6 class="fw-bold mt-2 mb-1">Juknis Kejuaraan Provinsi</h6>
                        <small class="text-muted">Petunjuk Teknis Kejuaraan Tingkat Provinsi</small>
                    </div>
                    <i class="bi bi-download" style="font-size: 1.5rem;"></i>
                </a>

                <a href="<?= base_url('assets/dokumen/peraturan-pertandingan.pdf') ?>" class="dokumen-card" target="_blank">
                    <div>
                        <i class="bi bi-file-pdf-fill text-danger" style="font-size: 2rem;"></i>
                        <h6 class="fw-bold mt-2 mb-1">Peraturan Pertandingan</h6>
                        <small class="text-muted">Aturan dan Tata Cara Pertandingan</small>
                    </div>
                    <i class="bi bi-download" style="font-size: 1.5rem;"></i>
                </a>

                <a href="<?= base_url('assets/dokumen/kode-etik-atlet.pdf') ?>" class="dokumen-card" target="_blank">
                    <div>
                        <i class="bi bi-file-pdf-fill text-danger" style="font-size: 2rem;"></i>
                        <h6 class="fw-bold mt-2 mb-1">Kode Etik Atlet</h6>
                        <small class="text-muted">Pedoman Etika dan Perilaku Atlet</small>
                    </div>
                    <i class="bi bi-download" style="font-size: 1.5rem;"></i>
                </a>

                <a href="<?= base_url('assets/dokumen/panduan-pendaftaran.pdf') ?>" class="dokumen-card" target="_blank">
                    <div>
                        <i class="bi bi-file-pdf-fill text-danger" style="font-size: 2rem;"></i>
                        <h6 class="fw-bold mt-2 mb-1">Panduan Pendaftaran</h6>
                        <small class="text-muted">Cara Mendaftar Turnamen Online</small>
                    </div>
                    <i class="bi bi-download" style="font-size: 1.5rem;"></i>
                </a>

                <a href="<?= base_url('assets/dokumen/syarat-ketentuan.pdf') ?>" class="dokumen-card" target="_blank">
                    <div>
                        <i class="bi bi-file-pdf-fill text-danger" style="font-size: 2rem;"></i>
                        <h6 class="fw-bold mt-2 mb-1">Syarat & Ketentuan</h6>
                        <small class="text-muted">Persyaratan Umum Peserta Turnamen</small>
                    </div>
                    <i class="bi bi-download" style="font-size: 1.5rem;"></i>
                </a>
            </div>
        </div>

        <!-- Hasil Pertandingan -->
        <div id="hasil-pertandingan" class="card-modern mt-5">
            <h2 class="section-title-modern">
                <i class="bi bi-trophy-fill"></i> Hasil Pertandingan
            </h2>

            <h5 class="mb-4 text-primary">
                <i class="bi bi-award-fill"></i> Skor & Juara Terbaru
            </h5>

            <?php if (!empty($hasilPertandingan)): ?>
                <?php foreach ($hasilPertandingan as $hasil): ?>
                    <div class="hasil-card">
                        <div class="mb-4">
                            <h4 class="fw-bold text-primary mb-2">
                                <i class="bi bi-trophy-fill"></i> <?= esc($hasil['nama_event']) ?>
                            </h4>
                            <div class="d-flex gap-3 flex-wrap">
                                <span class="badge" style="background: linear-gradient(135deg, #1E90FF, #00BFFF); padding: 8px 16px; font-size: 0.9rem;">
                                    <i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($hasil['tanggal'])) ?>
                                </span>
                                <span class="badge" style="background: linear-gradient(135deg, #28a745, #20c997); padding: 8px 16px; font-size: 0.9rem;">
                                    <i class="bi bi-tag"></i> <?= esc($hasil['kategori']) ?>
                                </span>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="juara-badge juara-1">
                                    <i class="bi bi-trophy-fill"></i> JUARA 1
                                    <div style="font-size: 1.1rem; margin-top: 8px;"><?= esc($hasil['juara_1']) ?></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="juara-badge juara-2">
                                    <i class="bi bi-trophy-fill"></i> JUARA 2
                                    <div style="font-size: 1.1rem; margin-top: 8px;"><?= esc($hasil['juara_2']) ?></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="juara-badge juara-3">
                                    <i class="bi bi-trophy-fill"></i> JUARA 3
                                    <div style="font-size: 1.1rem; margin-top: 8px;"><?= esc($hasil['juara_3']) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-trophy" style="font-size: 4rem; color: #1E90FF; opacity: 0.5;"></i>
                    <h5 class="mt-3 fw-bold">Belum ada hasil pertandingan</h5>
                    <p class="text-muted">Hasil pertandingan akan ditampilkan di sini setelah event selesai</p>
                </div>
            <?php endif; ?>

            <div class="mt-5">
                <h5 class="mb-4 text-primary">
                    <i class="bi bi-diagram-3-fill"></i> Bracket Pertandingan
                </h5>
                <p class="text-muted mb-4">Lihat bracket lengkap untuk setiap kategori pertandingan</p>

                <?php if (!empty($events)): ?>
                    <div class="grid-modern-2">
                        <?php foreach (array_slice($events, 0, 4) as $event): ?>
                            <?php if ($event['status'] == 'berlangsung' || $event['status'] == 'selesai'): ?>
                                <div class="item-card-modern">
                                    <h6 class="fw-bold text-primary mb-2">
                                        <i class="bi bi-trophy"></i> <?= esc($event['judul']) ?>
                                    </h6>
                                    <p class="text-muted mb-3">
                                        <i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($event['tanggal_mulai'])) ?>
                                    </p>
                                    <a href="<?= base_url('event/bracket/' . $event['id_event']) ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> Lihat Bracket
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info" role="alert" style="border-radius: 15px;">
                        <i class="bi bi-info-circle me-2"></i>
                        Bracket pertandingan akan tersedia saat event berlangsung
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?= $this->include('layouts/footer') ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter tabs functionality
            const filterTabs = document.querySelectorAll('.filter-tab');
            const eventCards = document.querySelectorAll('.event-card');

            filterTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    filterTabs.forEach(t => t.classList.remove('active'));
                    // Add active class to clicked tab
                    this.classList.add('active');

                    const filter = this.getAttribute('data-filter');

                    eventCards.forEach(card => {
                        if (filter === 'all') {
                            card.style.display = 'block';
                        } else {
                            const tingkat = card.getAttribute('data-tingkat');
                            card.style.display = tingkat === filter ? 'block' : 'none';
                        }
                    });
                });
            });

            // Smooth scroll untuk navigasi
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>