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

        /* Quick Navigation */
        .quick-nav {
            background: #E8F2FF;
            padding: 36px 0 24px 0;
        }

        .quick-nav-grid {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .quick-nav-card {
            background: #fff;
            border-radius: 50px;
            box-shadow: 0 2px 16px rgba(30, 144, 255, 0.08);
            padding: 24px 28px;
            min-width: 180px;
            max-width: 220px;
            text-align: center;
            transition: box-shadow 0.2s, transform 0.2s;
            border: none;
            margin-bottom: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .quick-nav-card:hover {
            box-shadow: 0 8px 32px rgba(30, 144, 255, 0.15);
            transform: translateY(-4px) scale(1.04);
        }

        .quick-nav-card i {
            font-size: 2.2rem;
            color: #1E90FF;
            margin-bottom: 10px;
        }

        .quick-nav-card span {
            font-weight: 600;
            color: #003366;
            font-size: 1.08rem;
        }

        /* Tentang PTMSI */
        .about-section {
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 4px 24px rgba(30, 144, 255, 0.09);
            padding: 48px 32px;
            margin: 48px auto 32px auto;
            max-width: 1100px;
            display: flex;
            gap: 36px;
            align-items: center;
            flex-wrap: wrap;
        }

        .about-text {
            flex: 1 1 340px;
            min-width: 260px;
        }

        .about-text h2 {
            color: #003366;
            font-weight: bold;
            margin-bottom: 18px;
        }

        .about-text p {
            color: #222;
            font-size: 1.08rem;
        }

        .about-img {
            flex: 1 1 260px;
            min-width: 220px;
            max-width: 340px;
            text-align: center;
        }

        .about-img img {
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(30, 144, 255, 0.13);
            width: 100%;
            max-width: 320px;
        }

        .about-btn {
            margin-top: 18px;
        }

        /* Event Section */
        .event-section {
            background: #F0F6FF;
            padding: 48px 0 32px 0;
        }

        .event-title {
            color: #003366;
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 32px;
            text-align: center;
        }

        .event-grid {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .event-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(30, 144, 255, 0.09);
            padding: 0 0 18px 0;
            min-width: 240px;
            max-width: 300px;
            text-align: left;
            border: none;
            transition: box-shadow 0.2s, transform 0.2s;
            display: flex;
            flex-direction: column;
        }

        .event-card:hover {
            box-shadow: 0 8px 32px rgba(30, 144, 255, 0.13);
            transform: translateY(-4px) scale(1.03);
        }

        .event-card img {
            border-radius: 18px 18px 0 0;
            width: 100%;
            height: 140px;
            object-fit: cover;
        }

        .event-card .event-info {
            padding: 16px 18px 0 18px;
        }

        .event-card .event-title {
            font-weight: bold;
            color: #1E90FF;
            font-size: 1.08rem;
            margin-bottom: 6px;
        }

        .event-card .event-meta {
            font-size: 0.97rem;
            color: #003366;
            margin-bottom: 4px;
        }

        .event-card .badge {
            font-size: 0.85rem;
            margin-right: 6px;
        }

        .event-card .btn {
            margin-top: 10px;
            font-size: 0.97rem;
            border-radius: 20px;
            padding: 6px 18px;
        }

        /* Ranking Section */
        .ranking-section {
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 4px 24px rgba(30, 144, 255, 0.09);
            padding: 36px 32px;
            margin: 48px auto 32px auto;
            max-width: 1100px;
        }

        .ranking-title {
            color: #003366;
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 32px;
            text-align: center;
        }

        .ranking-table {
            width: 100%;
        }

        .ranking-table th,
        .ranking-table td {
            padding: 10px 8px;
            text-align: left;
        }

        .ranking-table th {
            background: #E8F2FF;
            color: #003366;
            font-weight: 700;
        }

        .ranking-table tr {
            border-bottom: 1px solid #f0f0f0;
        }

        .ranking-table td {
            vertical-align: middle;
        }

        .ranking-table img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
            border: 2px solid #1E90FF;
        }

        /* Gallery */
        .gallery-section {
            background: #E8F2FF;
            padding: 48px 0 32px 0;
        }

        .gallery-title {
            color: #003366;
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 32px;
            text-align: center;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(30, 144, 255, 0.09);
            cursor: pointer;
        }

        .gallery-item img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .gallery-item:hover img {
            transform: scale(1.08);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: rgba(30, 144, 255, 0.18);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        /* News Section */
        .news-section {
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 4px 24px rgba(30, 144, 255, 0.09);
            padding: 36px 32px;
            margin: 48px auto 32px auto;
            max-width: 1100px;
        }

        .news-title {
            color: #003366;
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 32px;
            text-align: center;
        }

        .news-grid {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .news-card {
            background: #E8F2FF;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(30, 144, 255, 0.07);
            padding: 0 0 16px 0;
            min-width: 220px;
            max-width: 300px;
            text-align: left;
            border: none;
            transition: box-shadow 0.2s, transform 0.2s;
            display: flex;
            flex-direction: column;
        }

        .news-card:hover {
            box-shadow: 0 8px 32px rgba(30, 144, 255, 0.13);
            transform: translateY(-4px) scale(1.03);
        }

        .news-card img {
            border-radius: 16px 16px 0 0;
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .news-card .news-info {
            padding: 14px 16px 0 16px;
        }

        .news-card .news-title {
            font-weight: bold;
            color: #003366;
            font-size: 1.05rem;
            margin-bottom: 6px;
        }

        .news-card .news-date {
            font-size: 0.93rem;
            color: #1E90FF;
            margin-bottom: 4px;
        }

        .news-card .news-summary {
            font-size: 0.97rem;
            color: #222;
        }

        .news-section .btn {
            margin-top: 18px;
            border-radius: 20px;
            padding: 8px 22px;
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

        @media (max-width: 991px) {

            .about-section,
            .ranking-section,
            .news-section {
                padding: 24px 8px;
            }

            .gallery-section {
                padding: 24px 0 16px 0;
            }
        }

        @media (max-width: 767px) {
            .hero-content h1 {
                font-size: 1.3rem;
            }

            .about-section,
            .ranking-section,
            .news-section {
                padding: 12px 2px;
            }

            .about-section {
                flex-direction: column;
                gap: 18px;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .quick-nav-grid,
            .event-grid,
            .news-grid {
                flex-direction: column;
                gap: 14px;
            }
        }
    </style>
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
            <a href="<?= base_url('pendaftaran-atlet') ?>" class="btn btn-primary-ptmsi me-2"><i
                    class="bi bi-person-plus"></i> Pendaftaran Atlet</a>
            <a href="<?= base_url('event') ?>" class="btn btn-outline-ptmsi"><i class="bi bi-calendar-event"></i> Lihat
                Event Kejuaraan</a>
        </div>
    </section>

    <!-- Quick Navigation -->
    <section class="quick-nav">
        <div class="quick-nav-grid">
            <a href="<?= base_url('atlet-pelatih') ?>" class="quick-nav-card">
                <i class="bi bi-person-badge"></i>
                <span>Data Atlet & Pelatih</span>
            </a>
            <a href="<?= base_url('event') ?>" class="quick-nav-card">
                <i class="bi bi-trophy-fill"></i>
                <span>Kejuaraan Nasional</span>
            </a>
            <a href="<?= base_url('ranking') ?>" class="quick-nav-card">
                <i class="bi bi-bar-chart-fill"></i>
                <span>Ranking & Statistik</span>
            </a>
            <a href="<?= base_url('pembinaan') ?>" class="quick-nav-card">
                <i class="bi bi-mortarboard-fill"></i>
                <span>Program Pembinaan</span>
            </a>
            <a href="<?= base_url('pendaftaran-atlet') ?>" class="quick-nav-card">
                <i class="bi bi-pencil-square"></i>
                <span>Pendaftaran Online PTMSI</span>
            </a>
        </div>
    </section>

    <!-- Tentang PTMSI -->
    <section class="about-section">
        <div class="about-text">
            <h2>Tentang PTMSI Sumatera Barat</h2>
            <p><b>Visi:</b> Menjadi pusat pembinaan dan prestasi tenis meja terbaik di Indonesia.<br>
                <b>Misi:</b> Meningkatkan kualitas atlet, pelatih, dan klub melalui kompetisi dan pembinaan berkelanjutan.<br>
                <span style="display:block;margin-top:12px;">PTMSI Sumbar berdiri sejak 1980 dan telah melahirkan banyak atlet nasional. Kami aktif mengadakan pelatihan, turnamen, dan pembinaan usia dini.</span>
            </p>
            <a href="<?= base_url('profil') ?>" class="btn btn-primary-ptmsi about-btn">Selengkapnya → Profil PTMSI</a>
        </div>
        <div class="about-img">
            <img src="<?= base_url('assets/img/pembinaan.jpg') ?>" alt="Pembinaan Atlet PTMSI">
        </div>
    </section>

    <!-- Event & Kejuaraan Terdekat -->
    <section class="event-section">
        <div class="event-title">Event & Kejuaraan Terdekat</div>
        <div class="event-grid">
            <div class="event-card">
                <img src="<?= base_url('assets/img/event1.jpg') ?>" alt="Event 1">
                <div class="event-info">
                    <div class="event-title">Sumbar Open 2025</div>
                    <div class="event-meta"><i class="bi bi-geo-alt"></i> Padang • <i class="bi bi-calendar"></i> 20-22
                        Jan 2025
                    </div>
                    <span class="badge bg-primary">Nasional</span>
                    <span class="badge bg-success">Pendaftaran Dibuka</span>
                    <a href="#" class="btn btn-outline-primary btn-sm mt-2">Detail Event</a>
                </div>
            </div>
            <div class="event-card">
                <img src="<?= base_url('assets/img/event2.jpg') ?>" alt="Event 2">
                <div class="event-info">
                    <div class="event-title">Liga PTMSI Junior</div>
                    <div class="event-meta"><i class="bi bi-geo-alt"></i> Bukittinggi • <i class="bi bi-calendar"></i>
                        10-12 Feb 2025
                    </div>
                    <span class="badge bg-info text-dark">Daerah</span>
                    <span class="badge bg-secondary">Pendaftaran Tertutup</span>
                    <a href="#" class="btn btn-outline-primary btn-sm mt-2">Detail Event</a>
                </div>
            </div>
            <div class="event-card">
                <img src="<?= base_url('assets/img/event3.jpg') ?>" alt="Event 3">
                <div class="event-info">
                    <div class="event-title">Sumbar Table Tennis Cup</div>
                    <div class="event-meta"><i class="bi bi-geo-alt"></i> Solok • <i class="bi bi-calendar"></i> 5-7 Mar
                        2025
                    </div>
                    <span class="badge bg-warning text-dark">Internasional</span>
                    <span class="badge bg-success">Pendaftaran Dibuka</span>
                    <a href="#" class="btn btn-outline-primary btn-sm mt-2">Detail Event</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Ranking Nasional -->
    <section class="ranking-section">
        <div class="ranking-title">Ranking Nasional Atlet Tenis Meja</div>
        <div class="table-responsive">
            <table class="ranking-table table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Atlet</th>
                        <th>Klub</th>
                        <th>Ranking</th>
                        <th>Poin</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><img src="<?= base_url('assets/img/orang.jpg') ?>"> Andi Pratama</td>
                        <td>Padang Smash</td>
                        <td>1</td>
                        <td>980</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><img src="<?= base_url('assets/img/orang.jpg') ?>"> Fajar Ramadhan</td>
                        <td>Minang Table Club</td>
                        <td>2</td>
                        <td>920</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><img src="<?= base_url('assets/img/orang.jpg') ?>"> Putri Amelia</td>
                        <td>Sumbar Junior</td>
                        <td>3</td>
                        <td>900</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Galeri Publikasi -->
    <section class="gallery-section">
        <div class="gallery-title">Galeri Kegiatan & Dokumentasi</div>
        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="<?= base_url('assets/img/galeri1.jpg') ?>" alt="Galeri 1">
                <div class="gallery-overlay"></div>
            </div>
            <div class="gallery-item">
                <img src="<?= base_url('assets/img/galeri2.jpg') ?>" alt="Galeri 2">
                <div class="gallery-overlay"></div>
            </div>
            <div class="gallery-item">
                <img src="<?= base_url('assets/img/galeri3.jpg') ?>" alt="Galeri 3">
                <div class="gallery-overlay"></div>
            </div>
            <div class="gallery-item">
                <img src="<?= base_url('assets/img/galeri4.jpg') ?>" alt="Galeri 4">
                <div class="gallery-overlay"></div>
            </div>
        </div>
    </section>

    <!-- Berita Terbaru -->
    <section class="news-section">
        <div class="news-title">Berita Terbaru PTMSI</div>
        <div class="news-grid">
            <div class="news-card">
                <img src="<?= base_url('assets/img/berita1.jpg') ?>" alt="Berita 1">
                <div class="news-info">
                    <div class="news-title">PTMSI Sumbar Gelar Turnamen Daerah 2025</div>
                    <div class="news-date"><i class="bi bi-calendar"></i> 5 Desember 2025</div>
                    <div class="news-summary">Turnamen daerah sukses digelar dengan partisipasi 30 klub se-Sumbar.
                    </div>
                </div>
            </div>
            <div class="news-card">
                <img src="<?= base_url('assets/img/berita2.jpg') ?>" alt="Berita 2">
                <div class="news-info">
                    <div class="news-title">Atlet Sumbar Raih Medali Emas Nasional</div>
                    <div class="news-date"><i class="bi bi-calendar"></i> 2 Desember 2025</div>
                    <div class="news-summary">Prestasi membanggakan dari atlet muda PTMSI di kejuaraan nasional.
                    </div>
                </div>
            </div>
            <div class="news-card">
                <img src="<?= base_url('assets/img/berita3.jpg') ?>" alt="Berita 3">
                <div class="news-info">
                    <div class="news-title">Pelatih PTMSI Ikuti Sertifikasi Internasional</div>
                    <div class="news-date"><i class="bi bi-calendar"></i> 28 November 2025</div>
                    <div class="news-summary">Pelatih Sumbar tingkatkan kompetensi di pelatihan internasional.
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="<?= base_url('berita') ?>" class="btn btn-primary-ptmsi mt-3">Lihat Semua Berita</a>
        </div>
    </section>

    <!-- Footer -->
    <?= $this->include('layouts/footer') ?>
</body>

</html>