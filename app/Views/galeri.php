<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - PTMSI Sumbar</title>
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

        .galeri-item {
            position: relative;
            overflow: hidden;
            border-radius: 25px;
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.12);
            cursor: pointer;
            transition: all 0.4s ease;
            background: #fff;
            border: 2px solid #E8F2FF;
        }

        .galeri-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(30, 144, 255, 0.25);
            border-color: #1E90FF;
        }

        .galeri-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .galeri-item:hover .galeri-image {
            transform: scale(1.1);
        }

        .galeri-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 51, 102, 0.95) 0%, transparent 60%);
            display: flex;
            align-items: flex-end;
            padding: 25px;
            opacity: 0;
            transition: opacity 0.4s;
        }

        .galeri-item:hover .galeri-overlay {
            opacity: 1;
        }

        .galeri-info {
            color: #fff;
            width: 100%;
        }

        .galeri-title {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 8px;
        }

        .galeri-meta {
            font-size: 0.9rem;
            opacity: 0.95;
        }

        .galeri-meta i {
            margin-right: 6px;
        }

        .video-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: #fff;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
        }

        .play-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(135deg, #1E90FF, #00BFFF);
            color: #fff;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            transition: all 0.4s;
            box-shadow: 0 8px 25px rgba(30, 144, 255, 0.4);
        }

        .galeri-item:hover .play-icon {
            transform: translate(-50%, -50%) scale(1.15);
            box-shadow: 0 12px 35px rgba(30, 144, 255, 0.6);
        }

        /* Sidebar Styles */
        .gallery-sidebar {
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

        .category-item:hover,
        .category-item.active {
            background: linear-gradient(135deg, #1E90FF, #003366);
            color: #fff;
            transform: translateX(5px);
            border-color: #1E90FF;
        }

        .category-item i {
            color: #1E90FF;
            transition: color 0.3s;
        }

        .category-item:hover i,
        .category-item.active i {
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

        .category-item:hover .category-count,
        .category-item.active .category-count {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        /* Year Filter */
        .year-item {
            display: block;
            padding: 10px 15px;
            border-radius: 12px;
            text-decoration: none;
            color: #666;
            transition: all 0.3s ease;
            margin-bottom: 6px;
            border: 2px solid transparent;
        }

        .year-item:hover,
        .year-item.active {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: #fff;
            transform: translateX(3px);
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

        /* Main Gallery Styles */
        .gallery-main {
            background: #fff;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.12);
            border: 2px solid #E8F2FF;
        }

        .gallery-main-title {
            font-size: 1.8rem;
            font-weight: 900;
            color: #003366;
            margin-bottom: 8px;
        }

        .gallery-main-title i {
            color: #1E90FF;
            margin-right: 10px;
        }

        .gallery-subtitle {
            color: #666;
            margin-bottom: 0;
        }

        .gallery-view-toggle {
            display: flex;
            gap: 5px;
        }

        .gallery-view-toggle .btn {
            border-radius: 12px;
            padding: 8px 12px;
            border: 2px solid #E8F2FF;
        }

        .gallery-view-toggle .btn.active {
            background: linear-gradient(135deg, #1E90FF, #003366);
            border-color: #1E90FF;
            color: #fff;
        }

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        .gallery-item {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(30, 144, 255, 0.1);
            border: 2px solid #E8F2FF;
            transition: all 0.4s ease;
            cursor: pointer;
        }

        .gallery-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(30, 144, 255, 0.2);
            border-color: #1E90FF;
        }

        .gallery-image-wrapper {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .gallery-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .gallery-item:hover .gallery-image {
            transform: scale(1.1);
        }

        .video-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(30, 144, 255, 0.9);
            color: #fff;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            transition: all 0.4s;
        }

        .gallery-item:hover .video-overlay {
            transform: translate(-50%, -50%) scale(1.2);
            background: rgba(30, 144, 255, 1);
        }

        .gallery-info {
            padding: 20px;
        }

        .gallery-category {
            display: inline-block;
            background: linear-gradient(135deg, #1E90FF, #003366);
            color: #fff;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .gallery-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #003366;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .gallery-meta {
            display: flex;
            flex-direction: column;
            gap: 5px;
            font-size: 0.85rem;
            color: #999;
        }

        .gallery-meta i {
            color: #1E90FF;
            margin-right: 5px;
        }

        .empty-gallery {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 15px;
            }

            .gallery-main {
                padding: 20px;
            }

            .sidebar-section {
                padding: 20px;
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
                    <i class="bi bi-images"></i> Galeri PTMSI Sumbar
                </h1>
                <p class="hero-subtitle">Dokumentasi kegiatan dan prestasi tenis meja Sumatera Barat</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row g-4">
            <!-- Sidebar Categories -->
            <div class="col-lg-3">
                <div class="gallery-sidebar">
                    <div class="sidebar-section">
                        <h4 class="sidebar-title">
                            <i class="bi bi-grid-3x3-gap-fill"></i> Kategori Galeri
                        </h4>
                        <div class="category-list">
                            <a href="<?= base_url('galeri') ?>" class="category-item <?= !isset($_GET['kategori']) ? 'active' : '' ?>">
                                <i class="bi bi-grid-fill"></i>
                                <span>Semua Foto</span>
                                <span class="category-count"><?= ($totalFoto ?? 0) + ($totalVideo ?? 0) + count($galeri ?? []) ?></span>
                            </a>
                            <a href="<?= base_url('galeri?kategori=kegiatan') ?>" class="category-item <?= (isset($_GET['kategori']) && $_GET['kategori'] == 'kegiatan') ? 'active' : '' ?>">
                                <i class="bi bi-camera-fill"></i>
                                <span>Kegiatan Pelatihan</span>
                                <span class="category-count"><?= count($fotoKegiatan ?? []) ?></span>
                            </a>
                            <a href="<?= base_url('galeri?kategori=turnamen') ?>" class="category-item <?= (isset($_GET['kategori']) && $_GET['kategori'] == 'turnamen') ? 'active' : '' ?>">
                                <i class="bi bi-trophy-fill"></i>
                                <span>Turnamen</span>
                                <span class="category-count"><?= count($videoHighlight ?? []) ?></span>
                            </a>
                            <a href="<?= base_url('galeri?kategori=resmi') ?>" class="category-item <?= (isset($_GET['kategori']) && $_GET['kategori'] == 'resmi') ? 'active' : '' ?>">
                                <i class="bi bi-file-earmark-image-fill"></i>
                                <span>Dokumentasi Resmi</span>
                                <span class="category-count"><?= count($galeri ?? []) ?></span>
                            </a>
                            <a href="<?= base_url('galeri?kategori=video') ?>" class="category-item <?= (isset($_GET['kategori']) && $_GET['kategori'] == 'video') ? 'active' : '' ?>">
                                <i class="bi bi-play-circle-fill"></i>
                                <span>Video</span>
                                <span class="category-count"><?= $totalVideo ?? 0 ?></span>
                            </a>
                        </div>
                    </div>

                    <!-- Filter by Year -->
                    <div class="sidebar-section mt-4">
                        <h4 class="sidebar-title">
                            <i class="bi bi-calendar-range"></i> Filter Tahun
                        </h4>
                        <div class="year-filter">
                            <a href="<?= base_url('galeri') ?>" class="year-item <?= !isset($_GET['tahun']) ? 'active' : '' ?>">
                                Semua Tahun
                            </a>
                            <a href="<?= base_url('galeri?tahun=2025') ?>" class="year-item <?= (isset($_GET['tahun']) && $_GET['tahun'] == '2025') ? 'active' : '' ?>">
                                2025
                            </a>
                            <a href="<?= base_url('galeri?tahun=2024') ?>" class="year-item <?= (isset($_GET['tahun']) && $_GET['tahun'] == '2024') ? 'active' : '' ?>">
                                2024
                            </a>
                            <a href="<?= base_url('galeri?tahun=2023') ?>" class="year-item <?= (isset($_GET['tahun']) && $_GET['tahun'] == '2023') ? 'active' : '' ?>">
                                2023
                            </a>
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
                                    <i class="bi bi-images"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number"><?= $totalFoto ?? 0 ?></div>
                                    <div class="stat-label">Total Foto</div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bi bi-play-circle"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number"><?= $totalVideo ?? 0 ?></div>
                                    <div class="stat-label">Total Video</div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bi bi-calendar-event"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number"><?= count($galeri ?? []) ?></div>
                                    <div class="stat-label">Event Terdokumentasi</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Gallery Content -->
            <div class="col-lg-9">
                <div class="gallery-main">
                    <!-- Gallery Header -->
                    <div class="gallery-header">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h2 class="gallery-main-title">
                                    <?php
                                    $kategori = $_GET['kategori'] ?? 'semua';
                                    switch ($kategori) {
                                        case 'kegiatan':
                                            echo '<i class="bi bi-camera-fill"></i> Kegiatan Pelatihan';
                                            break;
                                        case 'turnamen':
                                            echo '<i class="bi bi-trophy-fill"></i> Turnamen';
                                            break;
                                        case 'resmi':
                                            echo '<i class="bi bi-file-earmark-image-fill"></i> Dokumentasi Resmi';
                                            break;
                                        case 'video':
                                            echo '<i class="bi bi-play-circle-fill"></i> Video';
                                            break;
                                        default:
                                            echo '<i class="bi bi-images"></i> Semua Galeri';
                                            break;
                                    }
                                    ?>
                                </h2>
                                <p class="gallery-subtitle">Dokumentasi kegiatan dan prestasi PTMSI Sumbar</p>
                            </div>
                            <div class="gallery-view-toggle">
                                <button class="btn btn-outline-primary active" id="gridView">
                                    <i class="bi bi-grid-3x3-gap"></i>
                                </button>
                                <button class="btn btn-outline-primary" id="listView">
                                    <i class="bi bi-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Grid -->
                    <div class="gallery-grid" id="galleryContainer">
                        <?php
                        // Combine all gallery items based on category filter
                        $allGallery = [];

                        if (!isset($_GET['kategori']) || $_GET['kategori'] == 'kegiatan') {
                            if (!empty($fotoKegiatan)) {
                                foreach ($fotoKegiatan as $item) {
                                    $item['type'] = 'foto';
                                    $item['category'] = 'Kegiatan Pelatihan';
                                    $allGallery[] = $item;
                                }
                            }
                        }

                        if (!isset($_GET['kategori']) || $_GET['kategori'] == 'turnamen') {
                            if (!empty($videoHighlight)) {
                                foreach ($videoHighlight as $item) {
                                    $item['type'] = 'video';
                                    $item['category'] = 'Turnamen';
                                    $allGallery[] = $item;
                                }
                            }
                        }

                        if (!isset($_GET['kategori']) || $_GET['kategori'] == 'resmi') {
                            if (!empty($galeri)) {
                                foreach ($galeri as $item) {
                                    $item['type'] = $item['jenis_media'] ?? 'foto';
                                    $item['category'] = 'Dokumentasi Resmi';
                                    $allGallery[] = $item;
                                }
                            }
                        }

                        // Sort by date
                        usort($allGallery, function ($a, $b) {
                            return strtotime($b['diunggah_pada'] ?? $b['tanggal_publikasi'] ?? date('Y-m-d')) - strtotime($a['diunggah_pada'] ?? $a['tanggal_publikasi'] ?? date('Y-m-d'));
                        });
                        ?>

                        <?php if (!empty($allGallery)): ?>
                            <?php foreach ($allGallery as $item): ?>
                                <div class="gallery-item" data-category="<?= esc($item['category']) ?>" data-type="<?= esc($item['type']) ?>">
                                    <div class="gallery-image-wrapper">
                                        <?php if ($item['type'] == 'video'): ?>
                                            <?php if (strpos($item['url'], 'youtube.com') !== false || strpos($item['url'], 'youtu.be') !== false): ?>
                                                <?php
                                                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $item['url'], $matches);
                                                $videoId = $matches[1] ?? '';
                                                ?>
                                                <img src="https://img.youtube.com/vi/<?= $videoId ?>/maxresdefault.jpg" alt="<?= esc($item['judul']) ?>" class="gallery-image"
                                                    onerror="this.src='https://img.youtube.com/vi/<?= $videoId ?>/hqdefault.jpg'">
                                            <?php else: ?>
                                                <img src="<?= base_url('assets/img/video-placeholder.jpg') ?>" alt="<?= esc($item['judul']) ?>" class="gallery-image">
                                            <?php endif; ?>
                                            <div class="video-overlay">
                                                <i class="bi bi-play-circle-fill"></i>
                                            </div>
                                        <?php else: ?>
                                            <img src="<?= base_url($item['url']) ?>" alt="<?= esc($item['judul']) ?>" class="gallery-image"
                                                onerror="this.src='<?= base_url('assets/img/galeri1.jpg') ?>'">
                                        <?php endif; ?>
                                    </div>
                                    <div class="gallery-info">
                                        <div class="gallery-category"><?= esc($item['category']) ?></div>
                                        <h5 class="gallery-title"><?= esc($item['judul']) ?></h5>
                                        <div class="gallery-meta">
                                            <span><i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($item['diunggah_pada'] ?? $item['tanggal_publikasi'] ?? date('Y-m-d'))) ?></span>
                                            <?php if (!empty($item['nama_event'])): ?>
                                                <span><i class="bi bi-trophy"></i> <?= esc($item['nama_event']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="empty-gallery">
                                <i class="bi bi-images" style="font-size: 4rem; color: #1E90FF; opacity: 0.5;"></i>
                                <h5 class="mt-3 fw-bold">Belum ada galeri</h5>
                                <p class="text-muted">Galeri foto dan video akan ditampilkan di sini</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('layouts/footer') ?>

    <script>
        // Gallery view toggle
        document.getElementById('gridView')?.addEventListener('click', function() {
            document.getElementById('listView').classList.remove('active');
            this.classList.add('active');
            document.getElementById('galleryContainer').className = 'gallery-grid';
        });

        document.getElementById('listView')?.addEventListener('click', function() {
            document.getElementById('gridView').classList.remove('active');
            this.classList.add('active');
            document.getElementById('galleryContainer').className = 'gallery-list';
        });

        // Gallery item click handler
        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', function() {
                const img = this.querySelector('.gallery-image');
                const videoOverlay = this.querySelector('.video-overlay');

                if (videoOverlay) {
                    // Handle video items - could open in modal or redirect to video
                    const title = this.querySelector('.gallery-title').textContent;
                    alert('Video: ' + title + '\n(Video player functionality can be implemented here)');
                } else if (img) {
                    // Open image in new tab
                    window.open(img.src, '_blank');
                }
            });
        });

        // Image lazy loading
        const images = document.querySelectorAll('.gallery-image');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.src; // Trigger load
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));

        // Search functionality (if needed)
        function filterGallery(searchTerm) {
            const items = document.querySelectorAll('.gallery-item');
            items.forEach(item => {
                const title = item.querySelector('.gallery-title').textContent.toLowerCase();
                const category = item.querySelector('.gallery-category').textContent.toLowerCase();

                if (title.includes(searchTerm.toLowerCase()) || category.includes(searchTerm.toLowerCase())) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>