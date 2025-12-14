<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atlet & Pelatih - PTMSI Sumbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/ptmsi-style.css') ?>">
    <style>
        .profile-card {
            background: #fff;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.12);
            transition: all 0.4s cubic-bezier(.4, 2, .3, 1);
            border: 2px solid #E8F2FF;
            position: relative;
            min-height: 370px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .profile-card:hover {
            transform: translateY(-12px) scale(1.03);
            box-shadow: 0 20px 60px rgba(30, 144, 255, 0.30);
            border-color: #1E90FF;
        }

        /* Grid Modern Responsive */
        .grid-modern-4 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
            gap: 2rem;
        }

        .grid-modern-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 120px;
            background: linear-gradient(135deg, #1E90FF 0%, #00BFFF 100%);
            z-index: 0;
        }

        .profile-card-body {
            position: relative;
            z-index: 1;
            padding: 25px;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #fff;
            margin: 40px auto 20px;
            display: block;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .profile-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: #003366;
            margin-bottom: 5px;
            text-align: center;
        }

        .profile-role {
            color: #1E90FF;
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .profile-info-list {
            background: linear-gradient(135deg, #F8F9FA 0%, #E8F2FF 100%);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .profile-info {
            font-size: 0.9rem;
            color: #333;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .profile-info:last-child {
            margin-bottom: 0;
        }

        .profile-info i {
            color: #1E90FF;
            margin-right: 10px;
            width: 20px;
            font-size: 1.1rem;
        }

        .profile-info strong {
            color: #003366;
            margin-right: 5px;
        }

        .badge-modern {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin: 4px;
        }

        .badge-ranking {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: #fff;
        }

        .badge-kategori {
            background: linear-gradient(135deg, #1E90FF, #003366);
            color: #fff;
        }

        .badge-sertifikasi {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: #fff;
        }

        .filter-section {
            background: #fff;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);
        }

        .filter-section select,
        .filter-section input {
            border: 2px solid #E8F2FF;
            border-radius: 15px;
            padding: 12px 18px;
            transition: all 0.3s;
        }

        .filter-section select:focus,
        .filter-section input:focus {
            border-color: #1E90FF;
            box-shadow: 0 0 0 4px rgba(30, 144, 255, 0.1);
            outline: none;
        }

        .prosedur-card {
            background: linear-gradient(135deg, #E8F2FF 0%, #fff 100%);
            border-radius: 20px;
            padding: 30px;
            border-left: 5px solid #1E90FF;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .prosedur-card:hover {
            transform: translateX(10px);
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.15);
        }

        .prosedur-number {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1E90FF, #003366);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 900;
            margin-right: 20px;
            flex-shrink: 0;
        }

        .download-card {
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

        .download-card:hover {
            background: linear-gradient(135deg, #1E90FF, #003366);
            color: #fff;
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(30, 144, 255, 0.3);
        }

        .download-card:hover * {
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

        /* Sidebar Styles */
        .atlet-sidebar {
            position: sticky;
            top: 100px;
        }

        .sidebar-section {
            background: #fff;
            border-radius: 25px;
            padding: 25px;
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.12);
            border: 2px solid #E8F2FF;
            margin-bottom: 20px;
        }

        .sidebar-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #003366;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #E8F2FF;
        }

        .sidebar-title i {
            color: #1E90FF;
            margin-right: 8px;
        }

        /* Navigation List */
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            border-radius: 15px;
            text-decoration: none;
            color: #666;
            transition: all 0.3s ease;
            margin-bottom: 8px;
            border: 2px solid transparent;
        }

        .nav-item:hover,
        .nav-item.active {
            background: linear-gradient(135deg, #1E90FF, #003366);
            color: #fff;
            transform: translateX(5px);
            border-color: #1E90FF;
        }

        .nav-item i {
            color: #1E90FF;
            transition: color 0.3s;
        }

        .nav-item:hover i,
        .nav-item.active i {
            color: #fff;
        }

        .nav-count {
            margin-left: auto;
            background: #E8F2FF;
            color: #1E90FF;
            padding: 4px 8px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .nav-item:hover .nav-count,
        .nav-item.active .nav-count {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        /* Filter List */
        .filter-group {
            margin-bottom: 15px;
        }

        .filter-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: #003366;
            margin-bottom: 8px;
        }

        .filter-select {
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #E8F2FF;
            border-radius: 12px;
            background: #fff;
            color: #333;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .filter-select:focus {
            border-color: #1E90FF;
            box-shadow: 0 0 0 4px rgba(30, 144, 255, 0.1);
            outline: none;
        }

        /* Statistics */
        .stat-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #E8F2FF;
        }

        .stat-item:last-child {
            border-bottom: none;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #1E90FF, #00BFFF);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.5rem;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 900;
            color: #003366;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
        }

        /* Quick Actions */
        .quick-action-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            background: linear-gradient(135deg, #E8F2FF, #fff);
            border: 2px solid #E8F2FF;
            border-radius: 15px;
            text-decoration: none;
            color: #003366;
            transition: all 0.3s ease;
            margin-bottom: 10px;
        }

        .quick-action-btn:hover {
            background: linear-gradient(135deg, #1E90FF, #003366);
            color: #fff;
            transform: translateX(5px);
            border-color: #1E90FF;
        }

        .quick-action-btn i {
            color: #1E90FF;
            transition: color 0.3s;
        }

        .quick-action-btn:hover i {
            color: #fff;
        }

        /* Main Content Styles */
        .atlet-main {
            background: #fff;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.12);
            border: 2px solid #E8F2FF;
        }

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .section-main-title {
            font-size: 1.8rem;
            font-weight: 900;
            color: #003366;
            margin-bottom: 8px;
        }

        .section-main-title i {
            color: #1E90FF;
            margin-right: 10px;
        }

        .section-subtitle {
            color: #666;
            margin-bottom: 0;
        }

        .search-input {
            padding: 12px 20px;
            border: 2px solid #E8F2FF;
            border-radius: 20px;
            width: 300px;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .search-input:focus {
            border-color: #1E90FF;
            box-shadow: 0 0 0 4px rgba(30, 144, 255, 0.1);
            outline: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .atlet-main {
                padding: 20px;
            }

            .sidebar-section {
                padding: 20px;
            }

            .search-input {
                width: 100%;
            }
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
                    <i class="bi bi-people-fill"></i> Atlet & Pelatih PTMSI Sumbar
                </h1>
                <p class="hero-subtitle">Data lengkap atlet, pelatih, dan sertifikasi PTMSI Sumatera Barat</p>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    <div class="container py-4">
        <div class="row g-4">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="atlet-sidebar">
                    <!-- Navigation Menu -->
                    <div class="sidebar-section">
                        <h4 class="sidebar-title">
                            <i class="bi bi-list-ul"></i> Menu Navigasi
                        </h4>
                        <div class="nav-list">
                            <a href="#data-atlet" class="nav-item active">
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Data Atlet</span>
                                <span class="nav-count"><?= count($atlet ?? []) ?></span>
                            </a>
                            <a href="#data-pelatih" class="nav-item">
                                <i class="bi bi-mortarboard-fill"></i>
                                <span>Data Pelatih</span>
                                <span class="nav-count"><?= count($pelatih ?? []) ?></span>
                            </a>
                            <a href="#prosedur-pendaftaran" class="nav-item">
                                <i class="bi bi-clipboard-check-fill"></i>
                                <span>Prosedur Pendaftaran</span>
                            </a>
                            <a href="#download-formulir" class="nav-item">
                                <i class="bi bi-download"></i>
                                <span>Download Formulir</span>
                            </a>
                        </div>
                    </div>

                    <!-- Filter Section -->
                    <div class="sidebar-section mt-4">
                        <h4 class="sidebar-title">
                            <i class="bi bi-funnel-fill"></i> Filter Data
                        </h4>
                        <div class="filter-list">
                            <div class="filter-group">
                                <label class="filter-label">Kategori Usia</label>
                                <select id="filterKategori" class="filter-select">
                                    <option value="">Semua Kategori</option>
                                    <option value="U-12">U-12</option>
                                    <option value="U-15">U-15</option>
                                    <option value="U-18">U-18</option>
                                    <option value="Senior">Senior</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Kab/Kota</label>
                                <select id="filterKabKota" class="filter-select">
                                    <option value="">Semua Kab/Kota</option>
                                    <option value="Padang">Padang</option>
                                    <option value="Bukittinggi">Bukittinggi</option>
                                    <option value="Payakumbuh">Payakumbuh</option>
                                    <option value="Solok">Solok</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label class="filter-label">Jenis Kelamin</label>
                                <select id="filterGender" class="filter-select">
                                    <option value="">Semua</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="sidebar-section mt-4">
                        <h4 class="sidebar-title">
                            <i class="bi bi-bar-chart-fill"></i> Statistik
                        </h4>
                        <div class="stats-list">
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number"><?= count($atlet ?? []) ?></div>
                                    <div class="stat-label">Total Atlet</div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bi bi-mortarboard-fill"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number"><?= count($pelatih ?? []) ?></div>
                                    <div class="stat-label">Total Pelatih</div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bi bi-building"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number"><?= count(array_unique(array_column($atlet ?? [], 'nama_klub'))) ?></div>
                                    <div class="stat-label">Klub Terdaftar</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="sidebar-section mt-4">
                        <h4 class="sidebar-title">
                            <i class="bi bi-lightning-fill"></i> Aksi Cepat
                        </h4>
                        <div class="quick-actions">
                            <a href="<?= base_url('layanan-online') ?>" class="quick-action-btn">
                                <i class="bi bi-person-plus-fill"></i>
                                <span>Daftar Atlet</span>
                            </a>
                            <a href="#download-formulir" class="quick-action-btn">
                                <i class="bi bi-download"></i>
                                <span>Download Formulir</span>
                            </a>
                            <a href="<?= base_url('hubungi-kami') ?>" class="quick-action-btn">
                                <i class="bi bi-telephone-fill"></i>
                                <span>Hubungi Kami</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="atlet-main">

                    <!-- Data Atlet Section -->
                    <div id="data-atlet" class="content-section active">
                        <div class="section-header">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h2 class="section-main-title">
                                        <i class="bi bi-person-badge-fill"></i> Data Atlet PTMSI Sumbar
                                    </h2>
                                    <p class="section-subtitle">Daftar lengkap atlet tenis meja terdaftar di PTMSI Sumbar</p>
                                </div>
                                <div class="section-actions">
                                    <input type="text" id="searchAtlet" class="search-input" placeholder="🔍 Cari nama atlet...">
                                </div>
                            </div>
                        </div>

                        <!-- Atlet Grid -->
                        <?php if (!empty($atlet)): ?>
                            <div class="grid-modern-4">
                                <?php foreach ($atlet as $a): ?>
                                    <div class="profile-card h-100">
                                        <div class="profile-card-body">
                                            <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="<?= esc($a['nama_lengkap'] ?? 'Atlet') ?>" class="profile-avatar">
                                            <h5 class="profile-name"><?= esc($a['nama_lengkap'] ?? 'N/A') ?></h5>
                                            <p class="profile-role">
                                                <i class="bi bi-building"></i> <?= esc($a['nama_klub'] ?? 'Belum ada klub') ?>
                                            </p>

                                            <div class="profile-info-list">
                                                <div class="profile-info">
                                                    <i class="bi bi-geo-alt-fill"></i>
                                                    <span><strong>Kab/Kota:</strong> <?= esc($a['kab_kota'] ?? '-') ?></span>
                                                </div>
                                                <div class="profile-info">
                                                    <i class="bi bi-<?= ($a['jenis_kelamin'] ?? '') == 'Laki-laki' ? 'gender-male' : 'gender-female' ?>"></i>
                                                    <span><strong>Gender:</strong> <?= esc($a['jenis_kelamin'] ?? '-') ?></span>
                                                </div>
                                                <div class="profile-info">
                                                    <i class="bi bi-card-text"></i>
                                                    <span><strong>Lisensi:</strong> <?= esc($a['nomor_lisensi'] ?? '-') ?></span>
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <span class="badge-modern badge-kategori">
                                                    <i class="bi bi-tag-fill"></i> <?= esc($a['kategori_usia'] ?? '-') ?>
                                                </span>
                                                <?php if (!empty($a['ranking_provinsi'])): ?>
                                                    <span class="badge-modern badge-ranking">
                                                        <i class="bi bi-trophy-fill"></i> Rank #<?= $a['ranking_provinsi'] ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="bi bi-person-x" style="font-size: 4rem; color: #1E90FF; opacity: 0.5;"></i>
                                <h5 class="mt-3 fw-bold">Belum ada data atlet</h5>
                                <p class="text-muted">Data atlet akan ditampilkan di sini setelah pendaftaran</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Data Pelatih Section -->
                    <div id="data-pelatih" class="content-section">
                        <div class="section-header">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h2 class="section-main-title">
                                        <i class="bi bi-mortarboard-fill"></i> Data Pelatih & Sertifikasi
                                    </h2>
                                    <p class="section-subtitle">Daftar pelatih bersertifikat PTMSI Sumbar</p>
                                </div>
                                <div class="section-actions">
                                    <input type="text" id="searchPelatih" class="search-input" placeholder="🔍 Cari nama pelatih...">
                                </div>
                            </div>
                        </div>



                        <!-- Pelatih Grid -->
                        <?php if (!empty($pelatih)): ?>
                            <div class="grid-modern-4">
                                <?php foreach ($pelatih as $p): ?>
                                    <div class="profile-card h-100">
                                        <div class="profile-card-body">
                                            <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="<?= esc($p['nama_lengkap'] ?? 'Pelatih') ?>" class="profile-avatar">
                                            <h5 class="profile-name"><?= esc($p['nama_lengkap'] ?? 'N/A') ?></h5>
                                            <p class="profile-role">
                                                <i class="bi bi-mortarboard-fill"></i> Pelatih Tenis Meja
                                            </p>

                                            <div class="profile-info-list">
                                                <div class="profile-info">
                                                    <i class="bi bi-building"></i>
                                                    <span><strong>Klub:</strong> <?= esc($p['nama_klub'] ?? 'Belum ada klub') ?></span>
                                                </div>
                                                <div class="profile-info">
                                                    <i class="bi bi-card-text"></i>
                                                    <span><strong>Lisensi:</strong> <?= esc($p['nomor_lisensi'] ?? '-') ?></span>
                                                </div>
                                                <?php if (!empty($p['tanggal_sertifikasi'])): ?>
                                                    <div class="profile-info">
                                                        <i class="bi bi-calendar-check"></i>
                                                        <span><strong>Sertifikasi:</strong> <?= date('d M Y', strtotime($p['tanggal_sertifikasi'])) ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="text-center">
                                                <span class="badge-modern badge-sertifikasi">
                                                    <i class="bi bi-award-fill"></i> <?= esc($p['tingkat_sertifikasi'] ?? '-') ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="bi bi-person-x" style="font-size: 4rem; color: #1E90FF; opacity: 0.5;"></i>
                                <h5 class="mt-3 fw-bold">Belum ada data pelatih</h5>
                                <p class="text-muted">Data pelatih akan ditampilkan di sini setelah pendaftaran</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Prosedur Pendaftaran Section -->
                    <div id="prosedur-pendaftaran" class="content-section">
                        <div class="section-header">
                            <h2 class="section-main-title">
                                <i class="bi bi-clipboard-check-fill"></i> Prosedur Pendaftaran Atlet
                            </h2>
                            <p class="section-subtitle">Panduan lengkap untuk mendaftarkan atlet baru</p>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <h5 class="text-primary mb-4">
                                    <i class="bi bi-check-circle-fill"></i> Persyaratan Umum
                                </h5>
                                <div class="prosedur-card">
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Warga Negara Indonesia</li>
                                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Fotokopi KTP/KK</li>
                                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Pas foto 3x4 (2 lembar)</li>
                                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Surat rekomendasi dari klub</li>
                                        <li class="mb-0"><i class="bi bi-check-circle-fill text-success me-2"></i> Surat pernyataan orang tua (untuk U-18)</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5 class="text-primary mb-4">
                                    <i class="bi bi-list-ol"></i> Langkah Pendaftaran
                                </h5>
                                <div class="prosedur-card d-flex align-items-start mb-3">
                                    <div class="prosedur-number">1</div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Download Formulir</h6>
                                        <p class="mb-0 text-muted">Download formulir pendaftaran di bawah</p>
                                    </div>
                                </div>
                                <div class="prosedur-card d-flex align-items-start mb-3">
                                    <div class="prosedur-number">2</div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Isi Formulir</h6>
                                        <p class="mb-0 text-muted">Isi formulir dengan lengkap dan benar</p>
                                    </div>
                                </div>
                                <div class="prosedur-card d-flex align-items-start mb-3">
                                    <div class="prosedur-number">3</div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Lampirkan Dokumen</h6>
                                        <p class="mb-0 text-muted">Lampirkan semua dokumen persyaratan</p>
                                    </div>
                                </div>
                                <div class="prosedur-card d-flex align-items-start mb-3">
                                    <div class="prosedur-number">4</div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Submit Formulir</h6>
                                        <p class="mb-0 text-muted">Submit ke sekretariat PTMSI Sumbar</p>
                                    </div>
                                </div>
                                <div class="prosedur-card d-flex align-items-start">
                                    <div class="prosedur-number">5</div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Tunggu Verifikasi</h6>
                                        <p class="mb-0 text-muted">Maksimal 7 hari kerja</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="alert alert-info d-flex align-items-center" role="alert" style="border-radius: 20px; border-left: 5px solid #0dcaf0;">
                                    <i class="bi bi-info-circle-fill me-3" style="font-size: 2rem;"></i>
                                    <div>
                                        <strong>Informasi Penting:</strong> Pendaftaran dapat dilakukan secara online melalui website atau langsung ke sekretariat PTMSI Sumbar. Untuk informasi lebih lanjut hubungi: <strong>0812-3456-7890</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Download Formulir Section -->
                    <div id="download-formulir" class="content-section">
                        <div class="section-header">
                            <h2 class="section-main-title">
                                <i class="bi bi-download"></i> Download Formulir
                            </h2>
                            <p class="section-subtitle">Unduh formulir pendaftaran dan dokumen terkait</p>
                        </div>

                        <div class="grid-modern-2">
                            <a href="<?= base_url('assets/formulir/formulir-pendaftaran-atlet.pdf') ?>" class="download-card" target="_blank">
                                <div>
                                    <i class="bi bi-file-pdf-fill text-danger" style="font-size: 2rem;"></i>
                                    <h6 class="fw-bold mt-2 mb-1">Formulir Pendaftaran Atlet</h6>
                                    <small class="text-muted">PDF Document</small>
                                </div>
                                <i class="bi bi-download" style="font-size: 1.5rem;"></i>
                            </a>

                            <a href="<?= base_url('assets/formulir/formulir-pendaftaran-klub.pdf') ?>" class="download-card" target="_blank">
                                <div>
                                    <i class="bi bi-file-pdf-fill text-danger" style="font-size: 2rem;"></i>
                                    <h6 class="fw-bold mt-2 mb-1">Formulir Pendaftaran Klub</h6>
                                    <small class="text-muted">PDF Document</small>
                                </div>
                                <i class="bi bi-download" style="font-size: 1.5rem;"></i>
                            </a>

                            <a href="<?= base_url('assets/formulir/formulir-perpindahan-klub.pdf') ?>" class="download-card" target="_blank">
                                <div>
                                    <i class="bi bi-file-pdf-fill text-danger" style="font-size: 2rem;"></i>
                                    <h6 class="fw-bold mt-2 mb-1">Formulir Perpindahan Klub</h6>
                                    <small class="text-muted">PDF Document</small>
                                </div>
                                <i class="bi bi-download" style="font-size: 1.5rem;"></i>
                            </a>

                            <a href="<?= base_url('assets/formulir/formulir-pembaruan-data.pdf') ?>" class="download-card" target="_blank">
                                <div>
                                    <i class="bi bi-file-pdf-fill text-danger" style="font-size: 2rem;"></i>
                                    <h6 class="fw-bold mt-2 mb-1">Formulir Pembaruan Data</h6>
                                    <small class="text-muted">PDF Document</small>
                                </div>
                                <i class="bi bi-download" style="font-size: 1.5rem;"></i>
                            </a>
                        </div>

                        <div class="text-center mt-4">
                            <a href="<?= base_url('layanan-online') ?>" class="btn-modern-primary">
                                <i class="bi bi-person-plus-fill"></i> Daftar Atlet Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('layouts/footer') ?>

    <script>
        // Navigation handling
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all nav items and sections
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                document.querySelectorAll('.content-section').forEach(section => section.classList.remove('active'));

                // Add active class to clicked nav item
                this.classList.add('active');

                // Show corresponding section
                const targetId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    targetSection.classList.add('active');
                }
            });
        });

        // Filter functionality for atlet
        document.getElementById('filterKategori')?.addEventListener('change', function() {
            filterAtlet();
        });

        document.getElementById('filterKabKota')?.addEventListener('change', function() {
            filterAtlet();
        });

        document.getElementById('filterGender')?.addEventListener('change', function() {
            filterAtlet();
        });

        document.getElementById('searchAtlet')?.addEventListener('input', function() {
            filterAtlet();
        });

        function filterAtlet() {
            const kategori = document.getElementById('filterKategori')?.value.toLowerCase() || '';
            const kabKota = document.getElementById('filterKabKota')?.value.toLowerCase() || '';
            const gender = document.getElementById('filterGender')?.value.toLowerCase() || '';
            const search = document.getElementById('searchAtlet')?.value.toLowerCase() || '';

            document.querySelectorAll('#data-atlet .profile-card').forEach(card => {
                const cardKategori = card.querySelector('.badge-kategori')?.textContent.toLowerCase() || '';
                const cardKabKota = card.querySelector('.profile-info span')?.textContent.toLowerCase() || '';
                const cardGender = card.querySelectorAll('.profile-info span')[1]?.textContent.toLowerCase() || '';
                const cardName = card.querySelector('.profile-name')?.textContent.toLowerCase() || '';

                const matchKategori = !kategori || cardKategori.includes(kategori);
                const matchKabKota = !kabKota || cardKabKota.includes(kabKota);
                const matchGender = !gender || cardGender.includes(gender);
                const matchSearch = !search || cardName.includes(search);

                if (matchKategori && matchKabKota && matchGender && matchSearch) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Filter functionality for pelatih
        document.getElementById('searchPelatih')?.addEventListener('input', function() {
            const search = this.value.toLowerCase();

            document.querySelectorAll('#data-pelatih .profile-card').forEach(card => {
                const name = card.querySelector('.profile-name')?.textContent.toLowerCase() || '';
                const sertifikasi = card.querySelector('.badge-sertifikasi')?.textContent.toLowerCase() || '';

                if (name.includes(search) || sertifikasi.includes(search)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Initialize - show first section
        document.addEventListener('DOMContentLoaded', function() {
            const firstSection = document.querySelector('.content-section');
            if (firstSection) {
                firstSection.classList.add('active');
            }
        });
    </script>
</body>

</html>