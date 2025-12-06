<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>PTMSI Sumbar - Beranda</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: #E8F2FF;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }

        .hero-section {
            background: linear-gradient(120deg, #003366 60%, #1E90FF 100%), url('<?= base_url('assets/img/hero.jpg') ?>') center/cover no-repeat;
            position: relative;
            color: #fff;
            padding: 90px 0 70px 0;
            text-align: center;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(30, 144, 255, 0.45);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 700px;
            margin: 0 auto;
        }

        .hero-content h1 {
            font-size: 2.7rem;
            font-weight: 800;
            letter-spacing: 2px;
            margin-bottom: 18px;
        }

        .hero-content p {
            font-size: 1.18rem;
            margin-bottom: 32px;
            font-weight: 500;
        }

        .hero-content .btn {
            font-size: 1.1rem;
            border-radius: 30px;
            padding: 12px 32px;
            margin: 0 8px 8px 0;
            font-weight: 600;
            box-shadow: 0 4px 16px rgba(30, 144, 255, 0.13);
            transition: 0.2s;
        }

        .btn-primary-ptmsi {
            background: linear-gradient(90deg, #1E90FF 60%, #003366 100%);
            color: #fff;
            border: none;
        }

        .btn-primary-ptmsi:hover {
            background: linear-gradient(90deg, #003366 60%, #1E90FF 100%);
            color: #fff;
            transform: scale(1.04);
        }

        .btn-outline-ptmsi {
            border: 2px solid #fff;
            color: #fff;
            background: transparent;
        }

        .btn-outline-ptmsi:hover {
            background: #1E90FF;
            color: #fff;
            border-color: #1E90FF;
        }

        /* Banner Kegiatan */
        .banner-kegiatan {
            background: linear-gradient(135deg, #003366 0%, #1E90FF 100%);
            border-radius: 20px;
            padding: 0;
            margin: 32px auto;
            max-width: 1100px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(30, 144, 255, 0.2);
            position: relative;
        }

        .banner-slider {
            position: relative;
            height: 400px;
        }

        .banner-item {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.6s;
        }

        .banner-item.active {
            opacity: 1;
        }

        .banner-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 51, 102, 0.8) 0%, transparent 100%);
            display: flex;
            align-items: flex-end;
            padding: 40px;
        }

        .banner-content {
            color: #fff;
            max-width: 600px;
        }

        .banner-content h3 {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 12px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .banner-content p {
            font-size: 1.1rem;
            opacity: 0.95;
            margin-bottom: 0;
        }

        .banner-indicators {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 10;
        }

        .banner-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s;
        }

        .banner-dot.active {
            background: #fff;
            width: 32px;
            border-radius: 6px;
        }

        /* Pengumuman Cepat */
        .pengumuman-section {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 24px rgba(30, 144, 255, 0.1);
            padding: 32px;
            margin: 32px auto;
            max-width: 1100px;
        }

        .pengumuman-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 3px solid #E8F2FF;
        }

        .pengumuman-header h3 {
            color: #003366;
            font-weight: bold;
            font-size: 1.5rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pengumuman-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .pengumuman-item {
            display: flex;
            align-items: start;
            padding: 16px;
            background: #F8F9FA;
            border-radius: 12px;
            border-left: 4px solid #1E90FF;
            transition: all 0.3s;
            cursor: pointer;
        }

        .pengumuman-item:hover {
            background: #E8F2FF;
            transform: translateX(4px);
            box-shadow: 0 2px 12px rgba(30, 144, 255, 0.1);
        }

        .pengumuman-icon {
            background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
            color: #fff;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 16px;
            flex-shrink: 0;
        }

        .pengumuman-content {
            flex: 1;
        }

        .pengumuman-content h5 {
            color: #003366;
            font-weight: bold;
            margin-bottom: 6px;
            font-size: 1.1rem;
        }

        .pengumuman-content p {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 4px;
        }

        .pengumuman-date {
            color: #1E90FF;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Agenda Pertandingan */
        .agenda-section {
            background: #E8F2FF;
            padding: 48px 0 32px 0;
        }

        .agenda-title {
            color: #003366;
            font-weight: bold;
            font-size: 1.8rem;
            margin-bottom: 32px;
            text-align: center;
            letter-spacing: 1px;
        }

        .agenda-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);
            padding: 24px;
            margin-bottom: 20px;
            border-left: 5px solid #1E90FF;
            transition: all 0.3s;
        }

        .agenda-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 32px rgba(30, 144, 255, 0.2);
        }

        .agenda-date {
            background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
            color: #fff;
            padding: 12px 20px;
            border-radius: 12px;
            text-align: center;
            display: inline-block;
            margin-bottom: 16px;
        }

        .agenda-date .day {
            font-size: 1.8rem;
            font-weight: bold;
            line-height: 1;
        }

        .agenda-date .month {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .agenda-info h5 {
            color: #003366;
            font-weight: bold;
            margin-bottom: 12px;
            font-size: 1.2rem;
        }

        .agenda-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            color: #555;
            font-size: 0.95rem;
        }

        .agenda-info-item i {
            color: #1E90FF;
            margin-right: 10px;
            width: 20px;
        }

        /* Link Cepat */
        .link-cepat-section {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 24px rgba(30, 144, 255, 0.1);
            padding: 40px 32px;
            margin: 32px auto;
            max-width: 1100px;
        }

        .link-cepat-title {
            color: #003366;
            font-weight: bold;
            font-size: 1.8rem;
            margin-bottom: 32px;
            text-align: center;
            letter-spacing: 1px;
        }

        .link-cepat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .link-cepat-item {
            background: linear-gradient(135deg, #E8F2FF 0%, #fff 100%);
            border-radius: 16px;
            padding: 24px 20px;
            text-align: center;
            text-decoration: none;
            color: #003366;
            border: 2px solid transparent;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .link-cepat-item:hover {
            background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
            color: #fff;
            transform: translateY(-6px);
            box-shadow: 0 8px 32px rgba(30, 144, 255, 0.3);
            border-color: #1E90FF;
        }

        .link-cepat-item i {
            font-size: 2.5rem;
            margin-bottom: 12px;
            transition: transform 0.3s;
        }

        .link-cepat-item:hover i {
            transform: scale(1.2);
        }

        .link-cepat-item span {
            font-weight: 600;
            font-size: 1rem;
        }

        /* Footer */
        .footer-ptmsi {
            background: #02162B;
            color: #FAFAFA;
            padding: 40px 0 0 0;
            margin-top: 48px;
            border-top: 4px solid #003366;
        }

        .footer-ptmsi .footer-logo {
            width: 60px;
            border-radius: 50%;
            border: 2px solid #fff;
            background: #fff;
            box-shadow: 0 2px 12px #222;
        }

        .footer-ptmsi .footer-title {
            color: #1E90FF;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .footer-ptmsi a {
            color: #E8F2FF;
            text-decoration: none;
            margin: 0 8px;
        }

        .footer-ptmsi a:hover {
            color: #FFD232;
        }

        .footer-ptmsi .footer-social a {
            color: #fff;
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .footer-ptmsi .footer-social a:hover {
            color: #1E90FF;
        }

        .footer-ptmsi hr {
            border-color: #1E90FF;
            margin: 32px 0 12px 0;
        }

        .footer-ptmsi .copyright {
            color: #ccc;
            font-size: 0.97rem;
        }

        @media (max-width: 767px) {
            .hero-content h1 {
                font-size: 1.5rem;
            }

            .banner-slider {
                height: 300px;
            }

            .banner-content h3 {
                font-size: 1.3rem;
            }

            .link-cepat-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .pengumuman-section,
            .link-cepat-section {
                padding: 24px 16px;
            }
        }
    </style>

    <script>
        // Banner Slider
        document.addEventListener('DOMContentLoaded', function() {
            const bannerItems = document.querySelectorAll('.banner-item');
            const bannerDots = document.querySelectorAll('.banner-dot');
            let currentSlide = 0;

            function showSlide(index) {
                bannerItems.forEach((item, i) => {
                    item.classList.toggle('active', i === index);
                });
                bannerDots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === index);
                });
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % bannerItems.length;
                showSlide(currentSlide);
            }

            // Auto slide setiap 5 detik
            if (bannerItems.length > 0) {
                setInterval(nextSlide, 5000);
            }

            // Click pada dot
            bannerDots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    showSlide(currentSlide);
                });
            });
        });
    </script>
</head>

<body>
    <?php $title = 'PTMSI Sumbar - Beranda'; ?>
    <?= $this->include('layouts/header') ?>

    <!-- Hero Section -->
    <section class="hero-section position-relative">
        <div class="hero-overlay"></div>
        <div class="hero-content position-relative">
            <img src="<?= base_url('assets/img/gambar-ptmsi.png') ?>" alt="Logo PTMSI Sumbar"
                style="width:80px; border-radius:50%; border:3px solid #fff; background:#fff; margin-bottom:18px;">
            <h1>Persatuan Tenis Meja Seluruh Indonesia (PTMSI)</h1>
            <p>Membangun Prestasi melalui Pembinaan dan Kompetisi Berkelanjutan.</p>
            <a href="<?= base_url('pendaftaran-atlet') ?>" class="btn btn-primary-ptmsi me-2">
                <i class="bi bi-person-plus"></i> Pendaftaran Atlet
            </a>
            <a href="<?= base_url('event') ?>" class="btn btn-outline-ptmsi">
                <i class="bi bi-calendar-event"></i> Lihat Event Kejuaraan
            </a>
        </div>
    </section>

    <!-- Banner Kegiatan Terbaru -->
    <section class="container">
        <div class="banner-kegiatan">
            <div class="banner-slider">
                <?php if (!empty($kegiatanTerbaru)): ?>
                    <?php foreach (array_slice($kegiatanTerbaru, 0, 3) as $index => $kegiatan): ?>
                        <div class="banner-item <?= $index === 0 ? 'active' : '' ?>">
                            <?php if ($kegiatan['jenis_media'] == 'gambar'): ?>
                                <img src="<?= base_url($kegiatan['url']) ?>" alt="<?= esc($kegiatan['judul']) ?>">
                            <?php else: ?>
                                <img src="<?= base_url('assets/img/hero.jpg') ?>" alt="<?= esc($kegiatan['judul']) ?>">
                            <?php endif; ?>
                            <div class="banner-overlay">
                                <div class="banner-content">
                                    <h3><?= esc($kegiatan['judul']) ?></h3>
                                    <?php if (!empty($kegiatan['nama_event'])): ?>
                                        <p><i class="bi bi-calendar-event"></i> <?= esc($kegiatan['nama_event']) ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="banner-item active">
                        <img src="<?= base_url('assets/img/hero.jpg') ?>" alt="Kegiatan PTMSI">
                        <div class="banner-overlay">
                            <div class="banner-content">
                                <h3>Kegiatan Terbaru PTMSI Sumbar</h3>
                                <p>Ikuti berbagai kegiatan dan event tenis meja di Sumatera Barat</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="banner-indicators">
                <?php
                $totalBanner = !empty($kegiatanTerbaru) ? min(3, count($kegiatanTerbaru)) : 1;
                for ($i = 0; $i < $totalBanner; $i++):
                ?>
                    <div class="banner-dot <?= $i === 0 ? 'active' : '' ?>" data-slide="<?= $i ?>"></div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Informasi Pengumuman Cepat -->
    <section class="container">
        <div class="pengumuman-section">
            <div class="pengumuman-header">
                <h3>
                    <i class="bi bi-megaphone-fill" style="color: #1E90FF;"></i>
                    Informasi Pengumuman Cepat
                </h3>
                <a href="<?= base_url('berita') ?>" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="pengumuman-list">
                <?php if (!empty($pengumuman)): ?>
                    <?php foreach (array_slice($pengumuman, 0, 5) as $p): ?>
                        <div class="pengumuman-item" onclick="window.location.href='<?= base_url('berita') ?>'">
                            <div class="pengumuman-icon">
                                <i class="bi bi-bell-fill"></i>
                            </div>
                            <div class="pengumuman-content">
                                <h5><?= esc($p['judul']) ?></h5>
                                <p><?= esc(substr(strip_tags($p['konten']), 0, 100)) ?>...</p>
                                <div class="pengumuman-date">
                                    <i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($p['tanggal_publikasi'])) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="pengumuman-item">
                        <div class="pengumuman-icon">
                            <i class="bi bi-info-circle-fill"></i>
                        </div>
                        <div class="pengumuman-content">
                            <h5>Pengumuman Penting</h5>
                            <p>Pengumuman terbaru akan ditampilkan di sini.</p>
                            <div class="pengumuman-date">
                                <i class="bi bi-calendar"></i> <?= date('d M Y') ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Agenda Pertandingan Terdekat -->
    <section class="agenda-section">
        <div class="container">
            <div class="agenda-title">
                <i class="bi bi-calendar-check"></i> Agenda Pertandingan Terdekat
            </div>
            <div class="row g-4">
                <?php if (!empty($pertandinganTerdekat)): ?>
                    <?php foreach ($pertandinganTerdekat as $p): ?>
                        <div class="col-md-6">
                            <div class="agenda-card">
                                <div class="agenda-date">
                                    <div class="day"><?= date('d', strtotime($p['jadwal'])) ?></div>
                                    <div class="month"><?= date('M Y', strtotime($p['jadwal'])) ?></div>
                                </div>
                                <div class="agenda-info">
                                    <h5><?= esc($p['nama_event'] ?? 'Pertandingan') ?></h5>
                                    <div class="agenda-info-item">
                                        <i class="bi bi-clock"></i>
                                        <span><?= date('H:i', strtotime($p['jadwal'])) ?> WIB</span>
                                    </div>
                                    <div class="agenda-info-item">
                                        <i class="bi bi-trophy"></i>
                                        <span>Babak: <?= esc($p['babak'] ?? 'TBD') ?></span>
                                    </div>
                                    <div class="agenda-info-item">
                                        <i class="bi bi-person"></i>
                                        <span><?= esc($p['nama_atlet1'] ?? 'Atlet 1') ?> vs <?= esc($p['nama_atlet2'] ?? 'Atlet 2') ?></span>
                                    </div>
                                    <?php if (!empty($p['venue'])): ?>
                                        <div class="agenda-info-item">
                                            <i class="bi bi-geo-alt"></i>
                                            <span><?= esc($p['venue']) ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="agenda-card text-center">
                            <i class="bi bi-calendar-x" style="font-size: 3rem; color: #ccc; margin-bottom: 16px;"></i>
                            <h5 style="color: #666;">Belum ada agenda pertandingan terdekat</h5>
                            <p class="text-muted">Jadwal pertandingan akan ditampilkan di sini</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="text-center mt-4">
                <a href="<?= base_url('event/pertandingan') ?>" class="btn btn-primary-ptmsi">Lihat Semua Agenda</a>
            </div>
        </div>
    </section>

    <!-- Link Cepat -->
    <section class="container">
        <div class="link-cepat-section">
            <div class="link-cepat-title">
                <i class="bi bi-lightning-charge-fill"></i> Link Cepat
            </div>
            <div class="link-cepat-grid">
                <a href="<?= base_url('pendaftaran-atlet') ?>" class="link-cepat-item">
                    <i class="bi bi-person-plus-fill"></i>
                    <span>Pendaftaran Atlet</span>
                </a>
                <a href="<?= base_url('event') ?>" class="link-cepat-item">
                    <i class="bi bi-calendar-event-fill"></i>
                    <span>Pendaftaran Event</span>
                </a>
                <a href="<?= base_url('dokumen') ?>" class="link-cepat-item">
                    <i class="bi bi-download"></i>
                    <span>Unduh Dokumen</span>
                </a>
                <a href="<?= base_url('ranking') ?>" class="link-cepat-item">
                    <i class="bi bi-bar-chart-fill"></i>
                    <span>Lihat Ranking</span>
                </a>
                <a href="<?= base_url('pembinaan') ?>" class="link-cepat-item">
                    <i class="bi bi-mortarboard-fill"></i>
                    <span>Program Pembinaan</span>
                </a>
                <a href="<?= base_url('kontak') ?>" class="link-cepat-item">
                    <i class="bi bi-envelope-fill"></i>
                    <span>Hubungi Kami</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?= $this->include('layouts/footer') ?>
</body>

</html>