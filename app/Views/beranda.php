<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>PTMSI Sumbar - Beranda</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #E8F2FF 0%, #F0F8FF 100%);
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            overflow-x: hidden;
        }

        .hero-section {
            background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%), url('<?= base_url('assets/img/hero.jpg') ?>') center/cover no-repeat;
            background-blend-mode: overlay;
            position: relative;
            color: #fff;
            padding: 100px 0 80px 0;
            text-align: center;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(30, 144, 255, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 70% 50%, rgba(0, 191, 255, 0.3) 0%, transparent 50%);
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

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 51, 102, 0.3);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
            animation: fadeInUp 1s ease-out;
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

        .hero-content h1 {
            font-size: 3rem;
            font-weight: 900;
            letter-spacing: 1px;
            margin-bottom: 20px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            line-height: 1.2;
        }

        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 35px;
            font-weight: 400;
            opacity: 0.95;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .hero-content .btn {
            font-size: 1.1rem;
            border-radius: 50px;
            padding: 14px 40px;
            margin: 0 10px 10px 0;
            font-weight: 700;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-primary-ptmsi {
            background: linear-gradient(135deg, #1E90FF 0%, #00BFFF 100%);
            color: #fff;
            border: none;
        }

        .btn-primary-ptmsi::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #00BFFF 0%, #1E90FF 100%);
            transition: left 0.3s ease;
        }

        .btn-primary-ptmsi:hover::before {
            left: 0;
        }

        .btn-primary-ptmsi:hover {
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(30, 144, 255, 0.4);
        }

        .btn-primary-ptmsi span {
            position: relative;
            z-index: 1;
        }

        .btn-outline-ptmsi {
            border: 3px solid #fff;
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .btn-outline-ptmsi:hover {
            background: #fff;
            color: #003366;
            border-color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 255, 255, 0.3);
        }

        /* Banner Kegiatan */
        .banner-kegiatan {
            background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%);
            border-radius: 30px;
            padding: 0;
            margin: 40px auto;
            max-width: 1200px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(30, 144, 255, 0.3);
            position: relative;
            transform: translateY(0);
            transition: transform 0.3s ease;
        }

        .banner-kegiatan:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(30, 144, 255, 0.4);
        }

        .banner-slider {
            position: relative;
            height: 450px;
        }

        .banner-item {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            transform: scale(1.05);
        }

        .banner-item.active {
            opacity: 1;
            transform: scale(1);
        }

        .banner-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.85);
        }

        .banner-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 51, 102, 0.95) 0%, rgba(0, 51, 102, 0.3) 50%, transparent 100%);
            display: flex;
            align-items: flex-end;
            padding: 50px;
        }

        .banner-content {
            color: #fff;
            max-width: 700px;
            animation: slideInLeft 0.8s ease-out;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .banner-content h3 {
            font-size: 2.2rem;
            font-weight: 900;
            margin-bottom: 15px;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            line-height: 1.3;
        }

        .banner-content p {
            font-size: 1.2rem;
            opacity: 0.95;
            margin-bottom: 0;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .banner-indicators {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 10;
        }

        .banner-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid rgba(255, 255, 255, 0.6);
        }

        .banner-dot:hover {
            background: rgba(255, 255, 255, 0.7);
            transform: scale(1.2);
        }

        .banner-dot.active {
            background: #fff;
            width: 40px;
            border-radius: 7px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.8);
        }

        /* Pengumuman Cepat */
        .pengumuman-section {
            background: #fff;
            border-radius: 30px;
            box-shadow: 0 10px 40px rgba(30, 144, 255, 0.15);
            padding: 40px;
            margin: 40px auto;
            max-width: 1200px;
            position: relative;
            overflow: hidden;
        }

        .pengumuman-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(30, 144, 255, 0.05) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .pengumuman-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid transparent;
            background: linear-gradient(90deg, #E8F2FF 0%, transparent 100%);
            border-image: linear-gradient(90deg, #1E90FF 0%, transparent 100%) 1;
            position: relative;
            z-index: 1;
        }

        .pengumuman-header h3 {
            color: #003366;
            font-weight: 900;
            font-size: 1.8rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .pengumuman-header h3 i {
            animation: bounce 2s ease-in-out infinite;
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

        .pengumuman-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
            position: relative;
            z-index: 1;
        }

        .pengumuman-item {
            display: flex;
            align-items: start;
            padding: 24px;
            background: linear-gradient(135deg, #F8F9FA 0%, #fff 100%);
            border-radius: 20px;
            border-left: 5px solid #1E90FF;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .pengumuman-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(30, 144, 255, 0.1) 0%, transparent 100%);
            transition: left 0.4s ease;
        }

        .pengumuman-item:hover::before {
            left: 0;
        }

        .pengumuman-item:hover {
            background: linear-gradient(135deg, #E8F2FF 0%, #F0F8FF 100%);
            transform: translateX(10px) scale(1.02);
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.2);
            border-left-width: 8px;
        }

        .pengumuman-icon {
            background: linear-gradient(135deg, #1E90FF 0%, #00BFFF 100%);
            color: #fff;
            width: 60px;
            height: 60px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-right: 20px;
            flex-shrink: 0;
            box-shadow: 0 5px 20px rgba(30, 144, 255, 0.3);
            transition: transform 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .pengumuman-item:hover .pengumuman-icon {
            transform: rotate(10deg) scale(1.1);
        }

        .pengumuman-content {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .pengumuman-content h5 {
            color: #003366;
            font-weight: 800;
            margin-bottom: 8px;
            font-size: 1.2rem;
            line-height: 1.4;
        }

        .pengumuman-content p {
            color: #666;
            font-size: 1rem;
            margin-bottom: 8px;
            line-height: 1.6;
        }

        .pengumuman-date {
            color: #1E90FF;
            font-size: 0.9rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* Agenda Pertandingan */
        .agenda-section {
            background: linear-gradient(135deg, #E8F2FF 0%, #F0F8FF 50%, #E8F2FF 100%);
            padding: 60px 0 40px 0;
            position: relative;
        }

        .agenda-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, #1E90FF 50%, transparent 100%);
        }

        .agenda-title {
            color: #003366;
            font-weight: 900;
            font-size: 2.2rem;
            margin-bottom: 40px;
            text-align: center;
            letter-spacing: 0.5px;
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .agenda-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, #1E90FF 0%, #00BFFF 100%);
            border-radius: 2px;
        }

        .agenda-card {
            background: #fff;
            border-radius: 25px;
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.15);
            padding: 30px;
            margin-bottom: 24px;
            border-left: 6px solid #1E90FF;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .agenda-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(30, 144, 255, 0.05) 0%, transparent 70%);
        }

        .agenda-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 50px rgba(30, 144, 255, 0.25);
            border-left-width: 10px;
        }

        .agenda-date {
            background: linear-gradient(135deg, #1E90FF 0%, #00BFFF 100%);
            color: #fff;
            padding: 16px 24px;
            border-radius: 18px;
            text-align: center;
            display: inline-block;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(30, 144, 255, 0.3);
            transition: transform 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .agenda-card:hover .agenda-date {
            transform: scale(1.05) rotate(-2deg);
        }

        .agenda-date .day {
            font-size: 2.2rem;
            font-weight: 900;
            line-height: 1;
            display: block;
        }

        .agenda-date .month {
            font-size: 1rem;
            opacity: 0.95;
            font-weight: 600;
            margin-top: 4px;
            display: block;
        }

        .agenda-info {
            position: relative;
            z-index: 1;
        }

        .agenda-info h5 {
            color: #003366;
            font-weight: 900;
            margin-bottom: 16px;
            font-size: 1.4rem;
            line-height: 1.3;
        }

        .agenda-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            color: #555;
            font-size: 1rem;
            transition: transform 0.2s ease;
        }

        .agenda-card:hover .agenda-info-item {
            transform: translateX(5px);
        }

        .agenda-info-item i {
            color: #1E90FF;
            margin-right: 12px;
            width: 24px;
            font-size: 1.1rem;
        }

        /* Link Cepat */
        .link-cepat-section {
            background: #fff;
            border-radius: 30px;
            box-shadow: 0 10px 40px rgba(30, 144, 255, 0.15);
            padding: 50px 40px;
            margin: 40px auto;
            max-width: 1200px;
            position: relative;
            overflow: hidden;
        }

        .link-cepat-section::before {
            content: '';
            position: absolute;
            top: -100px;
            left: -100px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(30, 144, 255, 0.08) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(50px, 50px);
            }
        }

        .link-cepat-title {
            color: #003366;
            font-weight: 900;
            font-size: 2.2rem;
            margin-bottom: 40px;
            text-align: center;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 1;
        }

        .link-cepat-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, #1E90FF 0%, #00BFFF 100%);
            border-radius: 2px;
        }

        .link-cepat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            position: relative;
            z-index: 1;
        }

        .link-cepat-item {
            background: linear-gradient(135deg, #F8F9FA 0%, #fff 100%);
            border-radius: 25px;
            padding: 35px 25px;
            text-align: center;
            text-decoration: none;
            color: #003366;
            border: 3px solid transparent;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .link-cepat-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #1E90FF 0%, #00BFFF 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 0;
        }

        .link-cepat-item:hover::before {
            opacity: 1;
        }

        .link-cepat-item:hover {
            color: #fff;
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 15px 50px rgba(30, 144, 255, 0.4);
            border-color: #00BFFF;
        }

        .link-cepat-item i {
            font-size: 3rem;
            margin-bottom: 16px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 1;
        }

        .link-cepat-item:hover i {
            transform: scale(1.3) rotate(10deg);
        }

        .link-cepat-item span {
            font-weight: 700;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
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
                <span><i class="bi bi-person-plus"></i> Pendaftaran Atlet</span>
            </a>
            <a href="<?= base_url('event') ?>" class="btn btn-outline-ptmsi">
                <span><i class="bi bi-calendar-event"></i> Lihat Event Kejuaraan</span>
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