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
        <div class="container">
            <div class="quick-nav-grid">
                <a href="<?= base_url('/') ?>" class="quick-nav-card">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Beranda</span>
                </a>
                <a href="<?= base_url('profil') ?>" class="quick-nav-card">
                    <i class="bi bi-info-circle-fill"></i>
                    <span>Profil</span>
                </a>
                <a href="<?= base_url('atlet-pelatih') ?>" class="quick-nav-card">
                    <i class="bi bi-people-fill"></i>
                    <span>Atlet & Pelatih</span>
                </a>
                <a href="<?= base_url('event') ?>" class="quick-nav-card">
                    <i class="bi bi-trophy-fill"></i>
                    <span>Kejuaraan & Event</span>
                </a>
                <a href="<?= base_url('pembinaan') ?>" class="quick-nav-card">
                    <i class="bi bi-mortarboard-fill"></i>
                    <span>Program Pembinaan</span>
                </a>
                <a href="<?= base_url('klub-pengurus') ?>" class="quick-nav-card">
                    <i class="bi bi-building"></i>
                    <span>Klub & Pengurus</span>
                </a>
                <a href="<?= base_url('berita') ?>" class="quick-nav-card">
                    <i class="bi bi-newspaper"></i>
                    <span>Berita</span>
                </a>
                <a href="<?= base_url('galeri') ?>" class="quick-nav-card">
                    <i class="bi bi-images"></i>
                    <span>Galeri</span>
                </a>
                <a href="<?= base_url('dokumen') ?>" class="quick-nav-card">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Dokumen & Regulasi</span>
                </a>
                <a href="<?= base_url('ranking') ?>" class="quick-nav-card">
                    <i class="bi bi-bar-chart-fill"></i>
                    <span>Ranking & Statistik</span>
                </a>
                <a href="<?= base_url('layanan-online') ?>" class="quick-nav-card">
                    <i class="bi bi-globe"></i>
                    <span>Layanan Online</span>
                </a>
                <a href="<?= base_url('kontak') ?>" class="quick-nav-card">
                    <i class="bi bi-envelope-fill"></i>
                    <span>Hubungi Kami</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Tentang PTMSI -->
    <section class="about-section">
        <div class="about-text">
            <h2>Tentang PTMSI Sumatera Barat</h2>
            <p><b>Visi:</b> Menjadi pusat pembinaan dan prestasi tenis meja terbaik di Indonesia.<br>
                <b>Misi:</b> Meningkatkan kualitas atlet, pelatih, dan klub melalui kompetisi dan pembinaan
                berkelanjutan.<br>
                <span style="display:block;margin-top:12px;">PTMSI Sumbar berdiri sejak 1980 dan telah melahirkan banyak
                    atlet nasional. Kami aktif mengadakan pelatihan, turnamen, dan pembinaan usia dini.</span>
            </p>
            <a href="<?= base_url('profil') ?>" class="btn btn-primary-ptmsi about-btn">Selengkapnya → Profil PTMSI</a>
        </div>
        <div class="about-img">
            <img src="<?= base_url('assets/img/pembinaan.jpg') ?>" alt="Pembinaan Atlet PTMSI">
        </div>
    </section>

    <!-- Event & Kejuaraan Terdekat -->
    <section class="event-section">
        <div class="container">
            <div class="event-title">
                <i class="bi bi-calendar-event"></i> Event & Kejuaraan Terdekat
            </div>
            <div class="event-grid">
                <?php if (!empty($events)): ?>
                <?php foreach (array_slice($events, 0, 6) as $event): ?>
                <div class="event-card">
                    <img src="<?= base_url('assets/img/event1.jpg') ?>" alt="<?= esc($event['judul']) ?>">
                    <div class="event-info">
                        <div class="event-title"><?= esc($event['judul']) ?></div>
                        <div class="event-meta">
                            <i class="bi bi-geo-alt"></i> <?= esc($event['lokasi'] ?? 'Lokasi TBA') ?> •
                            <i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($event['tanggal_mulai'])) ?>
                        </div>
                        <span class="badge bg-primary"><?= esc($event['tingkat']) ?></span>
                        <span
                            class="badge bg-<?= ($event['status'] == 'aktif' || $event['status'] == 'berlangsung') ? 'success' : 'secondary' ?>">
                            <?= esc(ucfirst($event['status'] ?? 'mendatang')) ?>
                        </span>
                        <a href="<?= base_url('event/detail/' . $event['id_event']) ?>"
                            class="btn btn-outline-primary btn-sm mt-2">Detail Event</a>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <div class="col-12 text-center text-muted py-5">
                    <i class="bi bi-calendar-x" style="font-size: 3rem;"></i>
                    <p class="mt-3">Belum ada event yang tersedia</p>
                </div>
                <?php endif; ?>
            </div>
            <div class="text-center mt-4">
                <a href="<?= base_url('event') ?>" class="btn btn-primary-ptmsi">Lihat Semua Event</a>
            </div>
        </div>
    </section>

    <!-- Ranking Nasional -->
    <section class="ranking-section">
        <div class="container">
            <div class="ranking-title">
                <i class="bi bi-trophy"></i> Ranking Nasional Atlet Tenis Meja
            </div>
            <div class="table-responsive">
                <table class="ranking-table table align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Atlet</th>
                            <th>Klub</th>
                            <th>Kategori</th>
                            <th>Posisi</th>
                            <th>Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ranking)): ?>
                        <?php $no = 1;
                            foreach (array_slice($ranking, 0, 10) as $r): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <img src="<?= base_url('assets/img/orang.jpg') ?>"
                                    alt="<?= esc($r['nama_lengkap'] ?? 'Atlet') ?>">
                                <?= esc($r['nama_lengkap'] ?? 'N/A') ?>
                            </td>
                            <td><?= esc($r['nama_klub'] ?? '-') ?></td>
                            <td><?= esc($r['kategori_usia'] ?? '-') ?></td>
                            <td><?= $r['posisi'] ?></td>
                            <td><strong><?= number_format($r['poin']) ?></strong></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-info-circle"></i> Data ranking belum tersedia
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-4">
                <a href="<?= base_url('ranking') ?>" class="btn btn-primary-ptmsi">Lihat Semua Ranking</a>
            </div>
        </div>
    </section>

    <!-- Galeri Publikasi -->
    <section class="gallery-section">
        <div class="container">
            <div class="gallery-title">
                <i class="bi bi-images"></i> Galeri Kegiatan & Dokumentasi
            </div>
            <div class="gallery-grid">
                <?php if (!empty($galeri)): ?>
                <?php foreach (array_slice($galeri, 0, 8) as $g): ?>
                <div class="gallery-item">
                    <?php if ($g['jenis_media'] == 'gambar'): ?>
                    <img src="<?= base_url($g['url']) ?>" alt="<?= esc($g['judul']) ?>">
                    <?php else: ?>
                    <img src="<?= base_url('assets/img/video-placeholder.jpg') ?>" alt="<?= esc($g['judul']) ?>">
                    <?php endif; ?>
                    <div class="gallery-overlay"></div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <?php for ($i = 1; $i <= 4; $i++): ?>
                <div class="gallery-item">
                    <img src="<?= base_url('assets/img/galeri' . $i . '.jpg') ?>" alt="Galeri <?= $i ?>">
                    <div class="gallery-overlay"></div>
                </div>
                <?php endfor; ?>
                <?php endif; ?>
            </div>
            <div class="text-center mt-4">
                <a href="<?= base_url('galeri') ?>" class="btn btn-primary-ptmsi">Lihat Semua Galeri</a>
            </div>
        </div>
    </section>

    <!-- Berita Terbaru -->
    <section class="news-section">
        <div class="container">
            <div class="news-title">
                <i class="bi bi-newspaper"></i> Berita Terbaru PTMSI
            </div>
            <div class="news-grid">
                <?php if (!empty($berita)): ?>
                <?php foreach ($berita as $b): ?>
                <div class="news-card">
                    <img src="<?= base_url('assets/img/berita1.jpg') ?>" alt="<?= esc($b['judul']) ?>">
                    <div class="news-info">
                        <div class="news-title"><?= esc($b['judul']) ?></div>
                        <div class="news-date">
                            <i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($b['tanggal_publikasi'])) ?>
                            <i class="bi bi-person ms-2"></i> <?= esc($b['nama_penulis'] ?? 'Admin') ?>
                        </div>
                        <div class="news-summary">
                            <?= esc(substr(strip_tags($b['konten']), 0, 100)) ?>...
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <?php for ($i = 1; $i <= 3; $i++): ?>
                <div class="news-card">
                    <img src="<?= base_url('assets/img/berita' . $i . '.jpg') ?>" alt="Berita <?= $i ?>">
                    <div class="news-info">
                        <div class="news-title">Berita Contoh <?= $i ?></div>
                        <div class="news-date"><i class="bi bi-calendar"></i> <?= date('d M Y') ?></div>
                        <div class="news-summary">Contoh berita dari PTMSI Sumbar.</div>
                    </div>
                </div>
                <?php endfor; ?>
                <?php endif; ?>
            </div>
            <div class="text-center">
                <a href="<?= base_url('berita') ?>" class="btn btn-primary-ptmsi mt-3">Lihat Semua Berita</a>
            </div>
        </div>
    </section>

    <!-- Program Pembinaan -->
    <section class="pembinaan-section"
        style="background: #fff; border-radius: 22px; box-shadow: 0 4px 24px rgba(30, 144, 255, 0.09); padding: 48px 32px; margin: 48px auto 32px auto; max-width: 1100px;">
        <div class="container">
            <h2 class="text-center mb-4" style="color: #003366; font-weight: bold;">
                <i class="bi bi-mortarboard-fill"></i> Program Pembinaan
            </h2>
            <div class="row g-4">
                <?php if (!empty($sertifikasi)): ?>
                <?php foreach (array_slice($sertifikasi, 0, 6) as $s): ?>
                <div class="col-md-4">
                    <div class="card h-100"
                        style="border-radius: 16px; box-shadow: 0 2px 12px rgba(30, 144, 255, 0.08);">
                        <div class="card-body">
                            <h5 class="card-title" style="color: #003366;">
                                <i class="bi bi-award"></i> <?= esc($s['jenis_sertifikasi']) ?>
                            </h5>
                            <p class="card-text">
                                <strong>Pelatih:</strong> <?= esc($s['nama_lengkap'] ?? 'N/A') ?><br>
                                <strong>Tanggal:</strong> <?= date('d M Y', strtotime($s['tanggal_dikeluarkan'])) ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <div class="col-12 text-center text-muted py-4">
                    <i class="bi bi-info-circle" style="font-size: 2rem;"></i>
                    <p class="mt-3">Data program pembinaan akan segera ditambahkan</p>
                </div>
                <?php endif; ?>
            </div>
            <div class="text-center mt-4">
                <a href="<?= base_url('pembinaan') ?>" class="btn btn-primary-ptmsi">Lihat Semua Program</a>
            </div>
        </div>
    </section>

    <!-- Klub & Pengurus -->
    <section class="klub-section" style="background: #F0F6FF; padding: 48px 0 32px 0;">
        <div class="container">
            <h2 class="text-center mb-4" style="color: #003366; font-weight: bold;">
                <i class="bi bi-building"></i> Klub & Pengurus
            </h2>
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card" style="border-radius: 18px; box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);">
                        <div class="card-header"
                            style="background: linear-gradient(90deg, #1E90FF 60%, #003366 100%); color: #fff; border-radius: 18px 18px 0 0;">
                            <h5 class="mb-0"><i class="bi bi-building"></i> Daftar Klub</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($klub)): ?>
                            <div class="list-group list-group-flush">
                                <?php foreach (array_slice($klub, 0, 5) as $k): ?>
                                <div class="list-group-item border-0 px-0">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    <strong><?= esc($k['nama']) ?></strong>
                                    <?php if (!empty($k['nama_organisasi'])): ?>
                                    <br><small class="text-muted"><?= esc($k['nama_organisasi']) ?></small>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php else: ?>
                            <p class="text-muted">Data klub akan segera ditambahkan</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card" style="border-radius: 18px; box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);">
                        <div class="card-header"
                            style="background: linear-gradient(90deg, #1E90FF 60%, #003366 100%); color: #fff; border-radius: 18px 18px 0 0;">
                            <h5 class="mb-0"><i class="bi bi-people-fill"></i> Pengurus & Ofisial</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($ofisial)): ?>
                            <div class="list-group list-group-flush">
                                <?php foreach (array_slice($ofisial, 0, 5) as $o): ?>
                                <div class="list-group-item border-0 px-0">
                                    <i class="bi bi-person-badge text-primary me-2"></i>
                                    <strong><?= esc($o['nama_lengkap'] ?? 'N/A') ?></strong>
                                    <?php if (!empty($o['nomor_lisensi'])): ?>
                                    <br><small class="text-muted">Lisensi: <?= esc($o['nomor_lisensi']) ?></small>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php else: ?>
                            <p class="text-muted">Data pengurus akan segera ditambahkan</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="<?= base_url('klub-pengurus') ?>" class="btn btn-primary-ptmsi">Lihat Semua Klub & Pengurus</a>
            </div>
        </div>
    </section>

    <!-- Dokumen & Regulasi -->
    <section class="dokumen-section"
        style="background: #fff; border-radius: 22px; box-shadow: 0 4px 24px rgba(30, 144, 255, 0.09); padding: 48px 32px; margin: 48px auto 32px auto; max-width: 1100px;">
        <div class="container">
            <h2 class="text-center mb-4" style="color: #003366; font-weight: bold;">
                <i class="bi bi-file-earmark-text"></i> Dokumen & Regulasi
            </h2>
            <div class="row g-3">
                <?php if (!empty($dokumen)): ?>
                <?php foreach ($dokumen as $d): ?>
                <div class="col-md-6">
                    <div class="card" style="border-radius: 12px; box-shadow: 0 2px 12px rgba(30, 144, 255, 0.08);">
                        <div class="card-body d-flex align-items-center">
                            <i class="bi bi-file-pdf-fill text-danger" style="font-size: 2rem; margin-right: 16px;"></i>
                            <div class="flex-grow-1">
                                <h6 class="card-title mb-1" style="color: #003366;"><?= esc($d['judul']) ?></h6>
                                <small class="text-muted">
                                    <i class="bi bi-tag"></i> <?= esc($d['kategori']) ?> •
                                    <i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($d['diunggah_pada'])) ?>
                                </small>
                            </div>
                            <a href="<?= base_url($d['file_url']) ?>" class="btn btn-sm btn-outline-primary"
                                target="_blank">
                                <i class="bi bi-download"></i> Unduh
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <div class="col-12 text-center text-muted py-4">
                    <i class="bi bi-file-earmark" style="font-size: 2rem;"></i>
                    <p class="mt-3">Dokumen akan segera ditambahkan</p>
                </div>
                <?php endif; ?>
            </div>
            <div class="text-center mt-4">
                <a href="<?= base_url('dokumen') ?>" class="btn btn-primary-ptmsi">Lihat Semua Dokumen</a>
            </div>
        </div>
    </section>

    <!-- Layanan Online -->
    <section class="layanan-section" style="background: #E8F2FF; padding: 48px 0 32px 0;">
        <div class="container">
            <h2 class="text-center mb-4" style="color: #003366; font-weight: bold;">
                <i class="bi bi-globe"></i> Layanan Online
            </h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card text-center h-100"
                        style="border-radius: 18px; box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1); border: none;">
                        <div class="card-body">
                            <i class="bi bi-person-plus-fill"
                                style="font-size: 3rem; color: #1E90FF; margin-bottom: 16px;"></i>
                            <h5 class="card-title" style="color: #003366;">Pendaftaran Atlet</h5>
                            <p class="card-text text-muted">Daftarkan diri Anda sebagai atlet PTMSI Sumbar</p>
                            <a href="<?= base_url('pendaftaran-atlet') ?>" class="btn btn-primary-ptmsi">Daftar
                                Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center h-100"
                        style="border-radius: 18px; box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1); border: none;">
                        <div class="card-body">
                            <i class="bi bi-calendar-check-fill"
                                style="font-size: 3rem; color: #1E90FF; margin-bottom: 16px;"></i>
                            <h5 class="card-title" style="color: #003366;">Pendaftaran Event</h5>
                            <p class="card-text text-muted">Daftarkan diri atau klub Anda untuk mengikuti event</p>
                            <a href="<?= base_url('event') ?>" class="btn btn-primary-ptmsi">Lihat Event</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center h-100"
                        style="border-radius: 18px; box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1); border: none;">
                        <div class="card-body">
                            <i class="bi bi-download" style="font-size: 3rem; color: #1E90FF; margin-bottom: 16px;"></i>
                            <h5 class="card-title" style="color: #003366;">Unduh Dokumen</h5>
                            <p class="card-text text-muted">Akses dan unduh dokumen serta regulasi terkini</p>
                            <a href="<?= base_url('dokumen') ?>" class="btn btn-primary-ptmsi">Lihat Dokumen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hubungi Kami -->
    <section class="kontak-section"
        style="background: linear-gradient(135deg, #003366 0%, #1E90FF 100%); color: #fff; padding: 48px 0; border-radius: 22px; margin: 48px auto; max-width: 1100px;">
        <div class="container">
            <h2 class="text-center mb-4" style="font-weight: bold;">
                <i class="bi bi-envelope-fill"></i> Hubungi Kami
            </h2>
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <i class="bi bi-geo-alt-fill" style="font-size: 2.5rem; margin-bottom: 16px;"></i>
                    <h5>Alamat</h5>
                    <p>Jl. Contoh No. 123<br>Padang, Sumatera Barat</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="bi bi-telephone-fill" style="font-size: 2.5rem; margin-bottom: 16px;"></i>
                    <h5>Telepon</h5>
                    <p>0812-3456-7890<br>0751-123456</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="bi bi-envelope-fill" style="font-size: 2.5rem; margin-bottom: 16px;"></i>
                    <h5>Email</h5>
                    <p>info@ptmsisumbar.or.id<br>sekretariat@ptmsisumbar.or.id</p>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="<?= base_url('kontak') ?>" class="btn btn-light btn-lg">
                    <i class="bi bi-chat-dots"></i> Kirim Pesan
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?= $this->include('layouts/footer') ?>
</body>

</html>