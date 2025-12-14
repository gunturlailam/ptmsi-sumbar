<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - PTMSI Sumbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/ptmsi-style.css') ?>">
    <style>
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

        .berita-card {
            background: #fff;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.12);
            transition: all 0.4s ease;
            border: 2px solid #E8F2FF;
            height: 100%;
        }

        .berita-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(30, 144, 255, 0.25);
            border-color: #1E90FF;
        }

        .berita-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .berita-card:hover .berita-image {
            transform: scale(1.1);
        }

        .berita-content {
            padding: 25px;
        }

        .berita-kategori {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .kategori-kejuaraan {
            background: linear-gradient(135deg, #1E90FF, #003366);
            color: #fff;
        }

        .kategori-atlet {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: #fff;
        }

        .kategori-pengumuman {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: #fff;
        }

        .kategori-artikel {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: #fff;
        }

        .berita-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #003366;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .berita-title a {
            color: #003366;
            text-decoration: none;
            transition: color 0.3s;
        }

        .berita-title a:hover {
            color: #1E90FF;
        }

        .berita-ringkasan {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .berita-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 0.9rem;
            color: #999;
            padding-top: 15px;
            border-top: 2px solid #E8F2FF;
        }

        .berita-meta i {
            color: #1E90FF;
        }

        /* Featured Article Styles */
        .featured-article-card {
            background: #fff;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(30, 144, 255, 0.15);
            border: 2px solid #E8F2FF;
            transition: all 0.4s ease;
        }

        .featured-article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(30, 144, 255, 0.25);
            border-color: #1E90FF;
        }

        .featured-image-wrapper {
            position: relative;
            height: 350px;
            overflow: hidden;
        }

        .featured-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .featured-article-card:hover .featured-image {
            transform: scale(1.05);
        }

        .featured-overlay {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .featured-kategori {
            background: linear-gradient(135deg, #1E90FF, #003366);
            color: #fff;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .featured-content {
            padding: 30px;
        }

        .featured-title {
            font-size: 1.8rem;
            font-weight: 900;
            color: #003366;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .featured-title a {
            color: #003366;
            text-decoration: none;
            transition: color 0.3s;
        }

        .featured-title a:hover {
            color: #1E90FF;
        }

        .featured-excerpt {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .featured-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            font-size: 1rem;
            color: #999;
            padding-top: 20px;
            border-top: 2px solid #E8F2FF;
        }

        .featured-meta i {
            color: #1E90FF;
        }

        /* Section Subtitle */
        .section-subtitle {
            font-size: 1.5rem;
            font-weight: 700;
            color: #003366;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #1E90FF;
        }

        /* Small News Cards */
        .news-card-small {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(30, 144, 255, 0.1);
            border: 2px solid #E8F2FF;
            transition: all 0.4s ease;
            height: 100%;
        }

        .news-card-small:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(30, 144, 255, 0.2);
            border-color: #1E90FF;
        }

        .news-image-small {
            height: 150px;
            overflow: hidden;
        }

        .news-image-small img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .news-card-small:hover .news-image-small img {
            transform: scale(1.1);
        }

        .news-content-small {
            padding: 20px;
        }

        .news-kategori-small {
            display: inline-block;
            background: linear-gradient(135deg, #1E90FF, #003366);
            color: #fff;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .news-title-small {
            font-size: 1.1rem;
            font-weight: 700;
            color: #003366;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .news-title-small a {
            color: #003366;
            text-decoration: none;
            transition: color 0.3s;
        }

        .news-title-small a:hover {
            color: #1E90FF;
        }

        .news-meta-small {
            font-size: 0.85rem;
            color: #999;
        }

        .news-meta-small i {
            color: #1E90FF;
        }

        /* Sidebar Styles */
        .news-sidebar {
            position: sticky;
            top: 100px;
        }

        .sidebar-section {
            background: #fff;
            border-radius: 25px;
            padding: 25px;
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.12);
            border: 2px solid #E8F2FF;
        }

        .sidebar-title {
            font-size: 1.3rem;
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

        /* Popular News List */
        .sidebar-news-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #E8F2FF;
        }

        .sidebar-news-item:last-child {
            border-bottom: none;
        }

        .sidebar-news-number {
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, #1E90FF, #003366);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .sidebar-news-title {
            font-size: 1rem;
            font-weight: 600;
            color: #003366;
            margin-bottom: 5px;
            line-height: 1.4;
        }

        .sidebar-news-title a {
            color: #003366;
            text-decoration: none;
            transition: color 0.3s;
        }

        .sidebar-news-title a:hover {
            color: #1E90FF;
        }

        .sidebar-news-meta {
            font-size: 0.8rem;
            color: #999;
        }

        .sidebar-news-meta i {
            color: #1E90FF;
        }

        /* Category List */
        .category-item {
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

        .category-item:hover {
            background: linear-gradient(135deg, #1E90FF, #003366);
            color: #fff;
            transform: translateX(5px);
            border-color: #1E90FF;
        }

        .category-item i {
            color: #1E90FF;
            transition: color 0.3s;
        }

        .category-item:hover i {
            color: #fff;
        }

        .category-count {
            margin-left: auto;
            background: #E8F2FF;
            color: #1E90FF;
            padding: 4px 8px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .category-item:hover .category-count {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        /* Recent News List */
        .recent-news-item {
            display: flex;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #E8F2FF;
        }

        .recent-news-item:last-child {
            border-bottom: none;
        }

        .recent-news-image {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .recent-news-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .recent-news-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #003366;
            margin-bottom: 5px;
            line-height: 1.3;
        }

        .recent-news-title a {
            color: #003366;
            text-decoration: none;
            transition: color 0.3s;
        }

        .recent-news-title a:hover {
            color: #1E90FF;
        }

        .recent-news-meta {
            font-size: 0.8rem;
            color: #999;
        }

        .recent-news-meta i {
            color: #1E90FF;
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
                    <i class="bi bi-newspaper"></i> Berita PTMSI Sumbar
                </h1>
                <p class="hero-subtitle">Informasi terkini seputar tenis meja Sumatera Barat</p>
            </div>
        </div>
    </div>

    <div class="container">

        <!-- Main Content Layout -->
        <div class="row g-4">
            <!-- Featured Article Section (Left) -->
            <div class="col-lg-8">
                <?php
                // Get the latest news from all categories for featured article
                $allBerita = [];
                if (!empty($beritaKejuaraan)) $allBerita = array_merge($allBerita, $beritaKejuaraan);
                if (!empty($beritaAtlet)) $allBerita = array_merge($allBerita, $beritaAtlet);
                if (!empty($pengumuman)) $allBerita = array_merge($allBerita, $pengumuman);
                if (!empty($artikel)) $allBerita = array_merge($allBerita, $artikel);

                // Sort by date and get the latest
                usort($allBerita, function ($a, $b) {
                    return strtotime($b['tanggal_publikasi']) - strtotime($a['tanggal_publikasi']);
                });

                $featuredBerita = !empty($allBerita) ? $allBerita[0] : null;
                ?>

                <?php if ($featuredBerita): ?>
                    <!-- Featured Article -->
                    <div class="featured-article-card">
                        <div class="featured-image-wrapper">
                            <img src="<?= !empty($featuredBerita['foto']) ? base_url($featuredBerita['foto']) : base_url('assets/img/berita1.jpg') ?>" alt="<?= esc($featuredBerita['judul']) ?>" class="featured-image">
                            <div class="featured-overlay">
                                <span class="featured-kategori">
                                    <?= esc(ucfirst($featuredBerita['kategori'] ?? 'Berita Utama')) ?>
                                </span>
                            </div>
                        </div>
                        <div class="featured-content">
                            <h2 class="featured-title">
                                <a href="#" class="berita-link" data-bs-toggle="modal" data-bs-target="#beritaModal"
                                    data-judul="<?= esc($featuredBerita['judul']) ?>"
                                    data-konten="<?= esc($featuredBerita['konten']) ?>"
                                    data-tanggal="<?= date('d M Y', strtotime($featuredBerita['tanggal_publikasi'])) ?>"
                                    data-penulis="<?= esc($featuredBerita['nama_penulis'] ?? 'Admin') ?>"
                                    data-kategori="<?= esc($featuredBerita['kategori'] ?? 'Berita Utama') ?>">
                                    <?= esc($featuredBerita['judul']) ?>
                                </a>
                            </h2>
                            <p class="featured-excerpt">
                                <?= esc(substr(strip_tags($featuredBerita['konten']), 0, 200)) ?>...
                            </p>
                            <div class="featured-meta">
                                <span><i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($featuredBerita['tanggal_publikasi'])) ?></span>
                                <span><i class="bi bi-person"></i> <?= esc($featuredBerita['nama_penulis'] ?? 'Admin') ?></span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Other News Grid -->
                <div class="other-news-section mt-4">
                    <h3 class="section-subtitle">Berita Lainnya</h3>
                    <div class="row g-3">
                        <?php
                        $otherBerita = array_slice($allBerita, 1, 6); // Skip featured article, get next 6
                        foreach ($otherBerita as $b):
                        ?>
                            <div class="col-md-6">
                                <div class="news-card-small">
                                    <div class="news-image-small">
                                        <img src="<?= !empty($b['foto']) ? base_url($b['foto']) : base_url('assets/img/berita2.jpg') ?>" alt="<?= esc($b['judul']) ?>">
                                    </div>
                                    <div class="news-content-small">
                                        <span class="news-kategori-small">
                                            <?= esc(ucfirst($b['kategori'] ?? 'Berita')) ?>
                                        </span>
                                        <h5 class="news-title-small">
                                            <a href="#" class="berita-link" data-bs-toggle="modal" data-bs-target="#beritaModal"
                                                data-judul="<?= esc($b['judul']) ?>"
                                                data-konten="<?= esc($b['konten']) ?>"
                                                data-tanggal="<?= date('d M Y', strtotime($b['tanggal_publikasi'])) ?>"
                                                data-penulis="<?= esc($b['nama_penulis'] ?? 'Admin') ?>"
                                                data-kategori="<?= esc($b['kategori'] ?? 'Berita') ?>">
                                                <?= esc($b['judul']) ?>
                                            </a>
                                        </h5>
                                        <div class="news-meta-small">
                                            <span><i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($b['tanggal_publikasi'])) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- News Sidebar (Right) -->
            <div class="col-lg-4">
                <div class="news-sidebar">
                    <!-- Berita Terpopuler -->
                    <div class="sidebar-section">
                        <h4 class="sidebar-title">
                            <i class="bi bi-fire"></i> Berita Terpopuler
                        </h4>
                        <div class="sidebar-news-list">
                            <?php
                            $popularBerita = array_slice($allBerita, 0, 5);
                            foreach ($popularBerita as $index => $b):
                            ?>
                                <div class="sidebar-news-item">
                                    <div class="sidebar-news-number"><?= $index + 1 ?></div>
                                    <div class="sidebar-news-content">
                                        <h6 class="sidebar-news-title">
                                            <a href="#" class="berita-link" data-bs-toggle="modal" data-bs-target="#beritaModal"
                                                data-judul="<?= esc($b['judul']) ?>"
                                                data-konten="<?= esc($b['konten']) ?>"
                                                data-tanggal="<?= date('d M Y', strtotime($b['tanggal_publikasi'])) ?>"
                                                data-penulis="<?= esc($b['nama_penulis'] ?? 'Admin') ?>"
                                                data-kategori="<?= esc($b['kategori'] ?? 'Berita') ?>">
                                                <?= esc($b['judul']) ?>
                                            </a>
                                        </h6>
                                        <div class="sidebar-news-meta">
                                            <span><i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($b['tanggal_publikasi'])) ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Kategori Berita -->
                    <div class="sidebar-section mt-4">
                        <h4 class="sidebar-title">
                            <i class="bi bi-tags"></i> Kategori Berita
                        </h4>
                        <div class="category-list">
                            <a href="<?= base_url('berita/kategori/kejuaraan') ?>" class="category-item">
                                <i class="bi bi-trophy-fill"></i>
                                <span>Kejuaraan</span>
                                <span class="category-count"><?= count($beritaKejuaraan ?? []) ?></span>
                            </a>
                            <a href="<?= base_url('berita/kategori/atlet') ?>" class="category-item">
                                <i class="bi bi-star-fill"></i>
                                <span>Atlet Berprestasi</span>
                                <span class="category-count"><?= count($beritaAtlet ?? []) ?></span>
                            </a>
                            <a href="<?= base_url('berita/kategori/pengumuman') ?>" class="category-item">
                                <i class="bi bi-megaphone-fill"></i>
                                <span>Pengumuman</span>
                                <span class="category-count"><?= count($pengumuman ?? []) ?></span>
                            </a>
                            <a href="<?= base_url('berita/kategori/artikel') ?>" class="category-item">
                                <i class="bi bi-book-fill"></i>
                                <span>Artikel Pembinaan</span>
                                <span class="category-count"><?= count($artikel ?? []) ?></span>
                            </a>
                        </div>
                    </div>

                    <!-- Berita Terbaru -->
                    <div class="sidebar-section mt-4">
                        <h4 class="sidebar-title">
                            <i class="bi bi-clock"></i> Berita Terbaru
                        </h4>
                        <div class="recent-news-list">
                            <?php
                            $recentBerita = array_slice($allBerita, 0, 4);
                            foreach ($recentBerita as $b):
                            ?>
                                <div class="recent-news-item">
                                    <div class="recent-news-image">
                                        <img src="<?= !empty($b['foto']) ? base_url($b['foto']) : base_url('assets/img/berita3.jpg') ?>" alt="<?= esc($b['judul']) ?>">
                                    </div>
                                    <div class="recent-news-content">
                                        <h6 class="recent-news-title">
                                            <a href="#" class="berita-link" data-bs-toggle="modal" data-bs-target="#beritaModal"
                                                data-judul="<?= esc($b['judul']) ?>"
                                                data-konten="<?= esc($b['konten']) ?>"
                                                data-tanggal="<?= date('d M Y', strtotime($b['tanggal_publikasi'])) ?>"
                                                data-penulis="<?= esc($b['nama_penulis'] ?? 'Admin') ?>"
                                                data-kategori="<?= esc($b['kategori'] ?? 'Berita') ?>">
                                                <?= esc(substr($b['judul'], 0, 60)) ?>...
                                            </a>
                                        </h6>
                                        <div class="recent-news-meta">
                                            <span><i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($b['tanggal_publikasi'])) ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Berita -->
    <div class="modal fade" id="beritaModal" tabindex="-1" aria-labelledby="beritaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="border-radius: 25px; border: 2px solid #1E90FF;">
                <div class="modal-header" style="background: linear-gradient(135deg, #1E90FF 0%, #003366 100%); color: #fff; border-radius: 23px 23px 0 0;">
                    <h5 class="modal-title fw-bold" id="beritaModalLabel">
                        <i class="bi bi-newspaper"></i> Detail Berita
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px;">
                    <div class="mb-3">
                        <span class="badge" id="modalKategori" style="padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;"></span>
                    </div>
                    <h3 class="fw-bold text-primary mb-3" id="modalJudul"></h3>
                    <div class="d-flex gap-3 mb-4 text-muted">
                        <span><i class="bi bi-calendar text-primary"></i> <span id="modalTanggal"></span></span>
                        <span><i class="bi bi-person text-primary"></i> <span id="modalPenulis"></span></span>
                    </div>
                    <div class="border-top pt-3">
                        <div id="modalKonten" style="line-height: 1.8; color: #555;"></div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 2px solid #E8F2FF;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 20px; padding: 10px 25px;">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('layouts/footer') ?>

    <script>
        // Smooth scroll untuk navigasi
        document.querySelectorAll('a[href^="#"]:not([data-bs-toggle])').forEach(anchor => {
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

        // Handle modal berita
        document.querySelectorAll('.berita-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                const judul = this.getAttribute('data-judul');
                const konten = this.getAttribute('data-konten');
                const tanggal = this.getAttribute('data-tanggal');
                const penulis = this.getAttribute('data-penulis');
                const kategori = this.getAttribute('data-kategori');

                document.getElementById('modalJudul').textContent = judul;
                document.getElementById('modalKonten').innerHTML = konten;
                document.getElementById('modalTanggal').textContent = tanggal;
                document.getElementById('modalPenulis').textContent = penulis;

                const badgeKategori = document.getElementById('modalKategori');
                badgeKategori.textContent = kategori;

                // Set badge color based on kategori
                if (kategori === 'kejuaraan' || kategori === 'Kejuaraan') {
                    badgeKategori.style.background = 'linear-gradient(135deg, #1E90FF, #003366)';
                    badgeKategori.style.color = '#fff';
                } else if (kategori === 'atlet' || kategori === 'Atlet Berprestasi') {
                    badgeKategori.style.background = 'linear-gradient(135deg, #FFD700, #FFA500)';
                    badgeKategori.style.color = '#fff';
                } else if (kategori === 'pengumuman' || kategori === 'Pengumuman') {
                    badgeKategori.style.background = 'linear-gradient(135deg, #dc3545, #c82333)';
                    badgeKategori.style.color = '#fff';
                } else if (kategori === 'artikel' || kategori === 'Artikel Pembinaan') {
                    badgeKategori.style.background = 'linear-gradient(135deg, #28a745, #20c997)';
                    badgeKategori.style.color = '#fff';
                } else {
                    badgeKategori.style.background = 'linear-gradient(135deg, #6c757d, #495057)';
                    badgeKategori.style.color = '#fff';
                }
            });
        });
    </script>
</body>

</html>