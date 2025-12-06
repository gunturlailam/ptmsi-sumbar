<?php $title = isset($title) ? $title : 'Program Pembinaan - PTMSI Sumbar'; ?>
<?= $this->include('layouts/header') ?>

<style>
    body {
        background: #E8F2FF;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    }

    .pembinaan-section {
        background: #E8F2FF;
        min-height: 100vh;
        padding: 48px 0 32px 0;
    }

    .page-header {
        background: linear-gradient(135deg, #003366 0%, #1E90FF 100%);
        color: #fff;
        padding: 48px 0;
        margin-bottom: 40px;
        border-radius: 0 0 30px 30px;
        box-shadow: 0 4px 20px rgba(30, 144, 255, 0.2);
    }

    .page-header h1 {
        font-weight: bold;
        font-size: 2.5rem;
        margin-bottom: 12px;
        text-align: center;
    }

    .page-header p {
        text-align: center;
        font-size: 1.1rem;
        opacity: 0.95;
    }

    .submenu-nav {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);
        padding: 24px;
        margin-bottom: 32px;
    }

    .submenu-nav h4 {
        color: #003366;
        font-weight: bold;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .submenu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
    }

    .submenu-item {
        background: linear-gradient(135deg, #E8F2FF 0%, #fff 100%);
        border-radius: 12px;
        padding: 16px 20px;
        text-decoration: none;
        color: #003366;
        border: 2px solid transparent;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .submenu-item:hover {
        background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(30, 144, 255, 0.3);
        border-color: #1E90FF;
    }

    .submenu-item i {
        font-size: 1.5rem;
    }

    .submenu-item span {
        font-weight: 600;
    }

    .section-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 4px 24px rgba(30, 144, 255, 0.1);
        padding: 32px;
        margin-bottom: 32px;
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 3px solid #E8F2FF;
    }

    .section-header h3 {
        color: #003366;
        font-weight: bold;
        font-size: 1.8rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .program-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    .program-card {
        background: linear-gradient(135deg, #E8F2FF 0%, #fff 100%);
        border-radius: 16px;
        padding: 24px;
        border-left: 5px solid #1E90FF;
        transition: all 0.3s;
    }

    .program-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(30, 144, 255, 0.2);
    }

    .program-icon {
        background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
        color: #fff;
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 16px;
    }

    .program-title {
        color: #003366;
        font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 12px;
    }

    .program-info {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 8px;
    }

    .program-info i {
        color: #1E90FF;
        margin-right: 8px;
    }

    .program-desc {
        color: #555;
        font-size: 0.9rem;
        line-height: 1.6;
        margin-top: 12px;
    }

    .kegiatan-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .kegiatan-item {
        background: #F8F9FA;
        border-radius: 12px;
        padding: 20px;
        border-left: 4px solid #1E90FF;
        transition: all 0.3s;
    }

    .kegiatan-item:hover {
        background: #E8F2FF;
        transform: translateX(4px);
        box-shadow: 0 2px 12px rgba(30, 144, 255, 0.1);
    }

    .kegiatan-header {
        display: flex;
        align-items: start;
        gap: 16px;
        margin-bottom: 12px;
    }

    .kegiatan-icon {
        background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
        color: #fff;
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .kegiatan-content {
        flex: 1;
    }

    .kegiatan-title {
        color: #003366;
        font-weight: bold;
        font-size: 1.1rem;
        margin-bottom: 8px;
    }

    .kegiatan-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 8px;
    }

    .kegiatan-meta span {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .kegiatan-meta i {
        color: #1E90FF;
    }

    .badge-status {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .status-berlangsung {
        background: #d4edda;
        color: #155724;
    }

    .status-selesai {
        background: #f8d7da;
        color: #721c24;
    }

    .status-terjadwal {
        background: #fff3cd;
        color: #856404;
    }

    .t alent-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    .talent-card {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        text-align: center;
        border: 2px solid #E8F2FF;
        transition: all 0.3s;
    }

    .talent-card:hover {
        border-color: #1E90FF;
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(30, 144, 255, 0.15);
    }

    .talent-card img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #1E90FF;
        margin-bottom: 12px;
    }

    .talent-name {
        color: #003366;
        font-weight: bold;
        font-size: 1.1rem;
        margin-bottom: 6px;
    }

    .talent-info {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 4px;
    }

    .talent-badge {
        display: inline-block;
        background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
        color: #fff;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-top: 8px;
    }

    .coaching-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
    }

    .coaching-table thead {
        background: linear-gradient(135deg, #003366 0%, #1E90FF 100%);
        color: #fff;
    }

    .coaching-table thead th {
        padding: 16px 12px;
        text-align: left;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .coaching-table thead th:first-child {
        border-radius: 12px 0 0 0;
    }

    .coaching-table thead th:last-child {
        border-radius: 0 12px 0 0;
    }

    .coaching-table tbody tr {
        background: #fff;
        transition: all 0.3s;
        border-bottom: 1px solid #f0f0f0;
    }

    .coaching-table tbody tr:hover {
        background: #F8F9FA;
        transform: scale(1.01);
    }

    .coaching-table tbody td {
        padding: 14px 12px;
        vertical-align: middle;
        color: #333;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .empty-state i {
        font-size: 4rem;
        color: #ccc;
        margin-bottom: 20px;
    }

    @media (max-width: 991px) {
        .page-header h1 {
            font-size: 2rem;
        }

        .submenu-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .page-header h1 {
            font-size: 1.5rem;
        }

        .section-card {
            padding: 20px 16px;
        }

        .program-grid,
        .talent-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<sec
    tion class="pembinaan-section">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-mortarboard-fill"></i> Program Pembinaan PTMSI Sumbar</h1>
            <p>Membangun atlet berprestasi melalui pembinaan berkelanjutan</p>
        </div>
    </div>

    <div class="container">
        <!-- Sub Menu Navigation -->
        <div class="submenu-nav">
            <h4><i class="bi bi-list-ul"></i> Menu Navigasi</h4>
            <div class="submenu-grid">
                <a href="#puslatda" class="submenu-item">
                    <i class="bi bi-building-fill"></i>
                    <span>Pemusatan Latihan Daerah</span>
                </a>
                <a href="#pembinaan-usia-dini" class="submenu-item">
                    <i class="bi bi-people-fill"></i>
                    <span>Pembinaan Usia Dini</span>
                </a>
                <a href="#talent-scouting" class="submenu-item">
                    <i class="bi bi-star-fill"></i>
                    <span>Talent Scouting</span>
                </a>
                <a href="#coaching-clinic" class="submenu-item">
                    <i class="bi bi-award-fill"></i>
                    <span>Coaching Clinic & Pelatihan</span>
                </a>
            </div>
        </div>

        <!-- Pemusatan Latihan Daerah (Puslatda) -->
        <div id="puslatda" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-building-fill"></i> Pemusatan Latihan Daerah (Puslatda)</h3>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="bi bi-info-circle-fill me-3" style="font-size: 1.5rem;"></i>
                        <div>
                            <strong>Puslatda</strong> adalah program pemusatan latihan untuk atlet-atlet terpilih yang bertujuan meningkatkan kemampuan teknis dan mental bertanding dalam persiapan menghadapi kejuaraan tingkat provinsi dan nasional.
                        </div>
                    </div>
                </div>
            </div>

            <div class="program-grid">
                <div class="program-card">
                    <div class="program-icon">
                        <i class="bi bi-calendar-range"></i>
                    </div>
                    <div class="program-title">Puslatda Reguler</div>
                    <div class="program-info">
                        <i class="bi bi-clock"></i> Senin - Jumat, 16:00 - 19:00 WIB
                    </div>
                    <div class="program-info">
                        <i class="bi bi-geo-alt"></i> GOR Haji Agus Salim, Padang
                    </div>
                    <div class="program-info">
                        <i class="bi bi-people"></i> 25 Atlet Terpilih
                    </div>
                    <div class="program-desc">
                        Program latihan rutin untuk atlet binaan PTMSI Sumbar dengan fokus peningkatan teknik dasar dan strategi permainan.
                    </div>
                </div>

                <div class="program-card">
                    <div class="program-icon">
                        <i class="bi bi-trophy"></i>
                    </div>
                    <div class="program-title">Puslatda Pra-Kejuaraan</div>
                    <div class="program-info">
                        <i class="bi bi-clock"></i> Intensif 2 Minggu Sebelum Event
                    </div>
                    <div class="program-info">
                        <i class="bi bi-geo-alt"></i> Lokasi Disesuaikan
                    </div>
                    <div class="program-info">
                        <i class="bi bi-people"></i> 15-20 Atlet
                    </div>
                    <div class="program-desc">
                        Pemusatan latihan intensif sebagai persiapan menghadapi kejuaraan provinsi dan nasional dengan program khusus.
                    </div>
                </div>

                <div class="program-card">
                    <div class="program-icon">
                        <i class="bi bi-star"></i>
                    </div>
                    <div class="program-title">Puslatda Atlet Muda</div>
                    <div class="program-info">
                        <i class="bi bi-clock"></i> Sabtu - Minggu, 08:00 - 12:00 WIB
                    </div>
                    <div class="program-info">
                        <i class="bi bi-geo-alt"></i> GOR Haji Agus Salim, Padang
                    </div>
                    <div class="program-info">
                        <i class="bi bi-people"></i> 30 Atlet U-12 & U-15
                    </div>
                    <div class="program-desc">
                        Program pembinaan khusus untuk atlet muda kategori U-12 dan U-15 dengan fokus pengembangan bakat dan karakter.
                    </div>
                </div>
            </div>
        </div>

        <!-- Program Pembinaan Usia Dini -->
        <div id="pembinaan-usia-dini" class="section-card">
            <div class="section-header"></div>
            <h3><i class="bi bi-people-fill"></i> Program Pembinaan Usia Dini</h3>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <p style="color: #555; font-size: 1rem; line-height: 1.8;">
                    Program pembinaan usia dini bertujuan mengenalkan olahraga tenis meja sejak dini dan mengembangkan minat serta bakat anak-anak usia 6-12 tahun melalui metode pembelajaran yang menyenangkan.
                </p>
            </div>
        </div>

        <div class="kegiatan-list">
            <div class="kegiatan-item">
                <div class="kegiatan-header">
                    <div class="kegiatan-icon">
                        <i class="bi bi-controller"></i>
                    </div>
                    <div class="kegiatan-content">
                        <div class="kegiatan-title">Program Mini Tenis Meja</div>
                        <div class="kegiatan-meta">
                            <span><i class="bi bi-calendar"></i> Setiap Sabtu</span>
                            <span><i class="bi bi-clock"></i> 09:00 - 11:00 WIB</span>
                            <span><i class="bi bi-people"></i> Usia 6-9 tahun</span>
                        </div>
                        <p style="color: #666; margin-top: 8px; margin-bottom: 8px;">
                            Pengenalan dasar tenis meja dengan peralatan mini dan metode bermain sambil belajar untuk anak usia dini.
                        </p>
                        <span class="badge-status status-berlangsung">Berlangsung</span>
                    </div>
                </div>
            </div>

            <div class="kegiatan-item">
                <div class="kegiatan-header">
                    <div class="kegiatan-icon">
                        <i class="bi bi-trophy"></i>
                    </div>
                    <div class="kegiatan-content">
                        <div class="kegiatan-title">Kelas Teknik Dasar U-12</div>
                        <div class="kegiatan-meta">
                            <span><i class="bi bi-calendar"></i> Senin & Rabu</span>
                            <span><i class="bi bi-clock"></i> 15:00 - 17:00 WIB</span>
                            <span><i class="bi bi-people"></i> Usia 10-12 tahun</span>
                        </div>
                        <p style="color: #666; margin-top: 8px; margin-bottom: 8px;">
                            Pembelajaran teknik dasar seperti forehand, backhand, servis, dan footwork untuk kategori U-12.
                        </p>
                        <span class="badge-status status-berlangsung">Berlangsung</span>
                    </div>
                </div>
            </div>

            <div class="kegiatan-item">
                <div class="kegiatan-header">
                    <div class="kegiatan-icon">
                        <i class="bi bi-heart"></i>
                    </div>
                    <div class="kegiatan-content">
                        <div class="kegiatan-title">Program Sekolah Tenis Meja</div>
                        <div class="kegiatan-meta">
                            <span><i class="bi bi-calendar"></i> Selasa & Kamis</span>
                            <span><i class="bi bi-clock"></i> 14:00 - 16:00 WIB</span>
                            <span><i class="bi bi-people"></i> SD/MI</span>
                        </div>
                        <p style="color: #666; margin-top: 8px; margin-bottom: 8px;">
                            Kerjasama dengan sekolah-sekolah untuk memperkenalkan tenis meja sebagai ekstrakurikuler dan mencari bibit atlet.
                        </p>
                        <span class="badge-status status-berlangsung">Berlangsung</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Talent Scouting -->
    <div id="talent-scouting" class="section-card">
        <div class="section-header">
            <h3><i class="bi bi-star-fill"></i> Talent Scouting</h3>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-3" style="font-size: 1.5rem;"></i>
                    <div>
                        Program pencarian dan pengembangan bakat atlet muda berbakat melalui seleksi, tes kemampuan, dan pembinaan berkelanjutan.
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-search" style="font-size: 3rem; color: #1E90FF; margin-bottom: 16px;"></i>
                        <h5 class="text-primary">Seleksi Terbuka</h5>
                        <p class="text-muted">Seleksi terbuka untuk atlet muda berbakat dari seluruh Sumbar</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-clipboard-check" style="font-size: 3rem; color: #1E90FF; margin-bottom: 16px;"></i>
                        <h5 class="text-primary">Tes Kemampuan</h5>
                        <p class="text-muted">Tes fisik, teknik, dan mental untuk menilai potensi atlet</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-graph-up-arrow" style="font-size: 3rem; color: #1E90FF; margin-bottom: 16px;"></i>
                        <h5 class="text-primary">Pembinaan Lanjutan</h5>
                        <p class="text-muted">Program pembinaan khusus untuk atlet terpilih</p>
                    </div>
                </div>
            </div>
        </div>

        <h5 class="mb-3" style="color: #003366;">
            <i class="bi bi-award"></i> Atlet Hasil Talent Scouting
        </h5>

        <?php if (!empty($atletTalent)): ?>
            <div class="talent-grid">
                <?php foreach ($atletTalent as $atlet): ?>
                    <div class="talent-card">
                        <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="<?= esc($atlet['nama']) ?>">
                        <div class="talent-name"><?= esc($atlet['nama']) ?></div>
                        <div class="talent-info">
                            <i class="bi bi-calendar"></i> <?= esc($atlet['usia']) ?> tahun
                        </div>
                        <div class="talent-info">
                            <i class="bi bi-building"></i> <?= esc($atlet['klub']) ?>
                        </div>
                        <div class="talent-info">
                            <i class="bi bi-geo-alt"></i> <?= esc($atlet['asal']) ?>
                        </div>
                        <span class="talent-badge"><?= esc($atlet['kategori']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-star"></i>
                <h5>Data atlet talent scouting akan ditampilkan di sini</h5>
            </div>
        <?php endif; ?>
    </div>

    <!-- Coaching Clinic & Pelatihan Wasit -->
    <div id="coaching-clinic" class="section-card">
        <div class="section-header">
            <h3><i class="bi bi-award-fill"></i> Coaching Clinic & Pelatihan Wasit</h3>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #1E90FF;">
                    <div class="card-body">
                        <h5 class="text-primary mb-3">
                            <i class="bi bi-mortarboard-fill"></i> Coaching Clinic
                        </h5>
                        <p class="text-muted">
                            Program pelatihan dan peningkatan kompetensi pelatih tenis meja melalui workshop, seminar, dan praktik langsung dengan pelatih bersertifikat nasional dan internasional.
                        </p>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Pelatihan Teknik Modern</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Strategi Coaching</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Sport Psychology</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Sertifikasi Pelatih</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100" style="border-left: 4px solid #28a745;">
                    <div class="card-body">
                        <h5 class="text-success mb-3">
                            <i class="bi bi-flag-fill"></i> Pelatihan Wasit
                        </h5>
                        <p class="text-muted">
                            Program pelatihan dan sertifikasi wasit tenis meja untuk memenuhi kebutuhan wasit berkualitas dalam setiap kejuaraan dan turnamen.
                        </p>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Peraturan Pertandingan</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Teknik Perwasitan</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Praktik Lapangan</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Sertifikasi Wasit</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <h5 class="mb-3" style="color: #003366;">
            <i class="bi bi-calendar-event"></i> Jadwal Kegiatan Coaching & Pelatihan
        </h5>

        <div class="table-responsive">
            <?php if (!empty($kegiatanPelatihan)): ?>
                <table class="coaching-table">
                    <thead>
                        <tr>
                            <th>Kegiatan</th>
                            <th>Jenis</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Peserta</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kegiatanPelatihan as $kegiatan): ?>
                            <tr>
                                <td><strong><?= esc($kegiatan['nama']) ?></strong></td>
                                <td>
                                    <?php if ($kegiatan['jenis'] == 'coaching'): ?>
                                        <span class="badge-status" style="background: #1E90FF; color: #fff;">
                                            <i class="bi bi-mortarboard"></i> Coaching Clinic
                                        </span>
                                    <?php else: ?>
                                        <span class="badge-status" style="background: #28a745; color: #fff;">
                                            <i class="bi bi-flag"></i> Pelatihan Wasit
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <i class="bi bi-calendar"></i>
                                    <?= date('d M Y', strtotime($kegiatan['tanggal'])) ?>
                                </td>
                                <td>
                                    <i class="bi bi-geo-alt"></i>
                                    <?= esc($kegiatan['lokasi']) ?>
                                </td>
                                <td>
                                    <i class="bi bi-people"></i>
                                    <?= esc($kegiatan['jumlah_peserta']) ?> orang
                                </td>
                                <td>
                                    <span class="badge-status status-<?= strtolower($kegiatan['status']) ?>">
                                        <?= esc(ucfirst($kegiatan['status'])) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-calendar-x"></i>
                    <h5>Belum ada jadwal kegiatan</h5>
                    <p>Jadwal coaching clinic dan pelatihan wasit akan ditampilkan di sini</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-4">
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-3" style="font-size: 1.5rem;"></i>
                <div>
                    <strong>Informasi Pendaftaran:</strong> Untuk mendaftar coaching clinic atau pelatihan wasit, silakan hubungi sekretariat PTMSI Sumbar di <strong>0812-3456-7890</strong> atau email ke <strong>pembinaan@ptmsisumbar.or.id</strong>
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll untuk navigasi
            document.querySelectorAll('.submenu-item').forEach(item => {
                item.addEventListener('click', function(e) {
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

    <?= $this->include('layouts/footer') ?>