<?php $title = isset($title) ? $title : 'Galeri - PTMSI Sumbar'; ?>
<?= $this->include('layouts/header') ?>

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

    .galeri-section {
        background: transparent;
        min-height: 100vh;
        padding: 0;
    }

    .page-header {
        background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%);
        color: #fff;
        padding: 60px 0;
        margin-bottom: 50px;
        border-radius: 0 0 50px 50px;
        box-shadow: 0 15px 50px rgba(30, 144, 255, 0.25);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
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

    .page-header h1 {
        font-weight: 900;
        font-size: 2.8rem;
        margin-bottom: 15px;
        text-align: center;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 1;
        animation: fadeInUp 0.8s ease-out;
    }

    .page-header p {
        text-align: center;
        font-size: 1.2rem;
        opacity: 0.95;
        position: relative;
        z-index: 1;
        animation: fadeInUp 1s ease-out;
    }

    .submenu-nav {
        background: #fff;
        border-radius: 30px;
        box-shadow: 0 10px 40px rgba(30, 144, 255, 0.15);
        padding: 30px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
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

    .submenu-nav h4 {
        color: #003366;
        font-weight: 900;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
        position: relative;
        z-index: 1;
    }

    .submenu-nav h4 i {
        animation: bounce 2s ease-in-out infinite;
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

    .galeri-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    .galeri-item {
        position: relative;
        overflow: hidden;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);
        cursor: pointer;
        transition: all 0.3s;
        background: #fff;
    }

    .galeri-item:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 32px rgba(30, 144, 255, 0.2);
    }

    .galeri -image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .galeri-item:hover .galeri-image {
        transform: scale(1.1);
    }

    .galeri-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 51, 102, 0.9) 0%, transparent 60%);
        display: flex;
        align-items: flex-end;
        padding: 20px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .galeri-item:hover .galeri-overlay {
        opacity: 1;
    }

    .galeri-info {
        color: #fff;
        width: 100%;
    }

    .galeri-title {
        font-weight: bold;
        font-size: 1.1rem;
        margin-bottom: 6px;
    }

    .galeri-meta {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .galeri-meta i {
        margin-right: 6px;
    }

    .video-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(220, 53, 69, 0.9);
        color: #fff;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .play-icon {
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
        font-size: 1.5rem;
        transition: all 0.3s;
    }

    .galeri-item:hover .play-icon {
        background: rgba(30, 144, 255, 1);
        transform: translate(-50%, -50%) scale(1.1);
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

        .galeri-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 12px;
        }
    }
</style>
<sec
    tion class="galeri-section">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-images"></i> Galeri PTMSI Sumbar</h1>
            <p>Dokumentasi kegiatan dan prestasi tenis meja Sumatera Barat</p>
        </div>
    </div>

    <div class="container">
        <!-- Sub Menu Navigation -->
        <div class="submenu-nav">
            <h4><i class="bi bi-list-ul"></i> Kategori Galeri</h4>
            <div class="submenu-grid">
                <a href="#foto-kegiatan" class="submenu-item">
                    <i class="bi bi-camera-fill"></i>
                    <span>Foto Kegiatan</span>
                </a>
                <a href="#video-highlight" class="submenu-item">
                    <i class="bi bi-play-circle-fill"></i>
                    <span>Video Highlight Turnamen</span>
                </a>
                <a href="#dokumentasi-resmi" class="submenu-item">
                    <i class="bi bi-file-earmark-image-fill"></i>
                    <span>Dokumentasi Resmi PTMSI</span>
                </a>
            </div>
        </div>

        <!-- Foto Kegiatan -->
        <div id="foto-kegiatan" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-camera-fill"></i> Foto Kegiatan</h3>
                <div>
                    <span class="badge bg-primary">
                        <i class="bi bi-images"></i> <?= $totalFoto ?> Foto
                    </span>
                </div>
            </div>

            <?php if (!empty($fotoKegiatan)): ?>
                <div class="galeri-grid">
                    <?php foreach (array_slice($fotoKegiatan, 0, 12) as $g): ?>
                        <div class="galeri-item">
                            <img src="<?= base_url($g['url']) ?>"
                                alt="<?= esc($g['judul']) ?>"
                                class="galeri-image"
                                onerror="this.src='<?= base_url('assets/img/galeri1.jpg') ?>'">
                            <div class="galeri-overlay">
                                <div class="galeri-info">
                                    <div class="galeri-title"><?= esc($g['judul']) ?></div>
                                    <div class="galeri-meta">
                                        <i class="bi bi-calendar"></i>
                                        <?= date('d M Y', strtotime($g['diunggah_pada'])) ?>
                                        <?php if (!empty($g['nama_event'])): ?>
                                            <br><i class="bi bi-trophy"></i> <?= esc($g['nama_event']) ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if (count($fotoKegiatan) > 12): ?>
                    <div class="text-center mt-4">
                        <a href="<?= base_url('galeri/foto') ?>" class="btn btn-primary">
                            <i class="bi bi-images"></i> Lihat Semua Foto
                        </a>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-camera"></i>
                    <h5>Belum ada foto kegiatan</h5>
                    <p>Foto kegiatan akan ditampilkan di sini</p>
                </div>
            <?php endif; ?>
        </div>
        <!-
            - Video Highlight Turnamen -->
            <div id="video-highlight" class="section-card">
                <div class="section-header">
                    <h3><i class="bi bi-play-circle-fill"></i> Video Highlight Turnamen</h3>
                    <div>
                        <span class="badge bg-danger">
                            <i class="bi bi-play-circle"></i> <?= $totalVideo ?> Video
                        </span>
                    </div>
                </div>

                <?php if (!empty($videoHighlight)): ?>
                    <div class="galeri-grid">
                        <?php foreach (array_slice($videoHighlight, 0, 12) as $g): ?>
                            <div class="galeri-item">
                                <?php if (strpos($g['url'], 'youtube.com') !== false || strpos($g['url'], 'youtu.be') !== false): ?>
                                    <?php
                                    // Extract YouTube video ID
                                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $g['url'], $matches);
                                    $videoId = $matches[1] ?? '';
                                    ?>
                                    <img src="https://img.youtube.com/vi/<?= $videoId ?>/maxresdefault.jpg"
                                        alt="<?= esc($g['judul']) ?>"
                                        class="galeri-image"
                                        onerror="this.src='https://img.youtube.com/vi/<?= $videoId ?>/hqdefault.jpg'">
                                <?php else: ?>
                                    <img src="<?= base_url('assets/img/video-placeholder.jpg') ?>"
                                        alt="<?= esc($g['judul']) ?>"
                                        class="galeri-image">
                                <?php endif; ?>

                                <span class="video-badge">
                                    <i class="bi bi-play-fill"></i> Video
                                </span>
                                <div class="play-icon">
                                    <i class="bi bi-play-fill"></i>
                                </div>
                                <div class="galeri-overlay">
                                    <div class="galeri-info">
                                        <div class="galeri-title"><?= esc($g['judul']) ?></div>
                                        <div class="galeri-meta">
                                            <i class="bi bi-calendar"></i>
                                            <?= date('d M Y', strtotime($g['diunggah_pada'])) ?>
                                            <?php if (!empty($g['nama_event'])): ?>
                                                <br><i class="bi bi-trophy"></i> <?= esc($g['nama_event']) ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (count($videoHighlight) > 12): ?>
                        <div class="text-center mt-4">
                            <a href="<?= base_url('galeri/video') ?>" class="btn btn-danger">
                                <i class="bi bi-play-circle"></i> Lihat Semua Video
                            </a>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="bi bi-play-circle"></i>
                        <h5>Belum ada video highlight</h5>
                        <p>Video highlight turnamen akan ditampilkan di sini</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Dokumentasi Resmi PTMSI -->
            <div id="dokumentasi-resmi" class="section-card">
                <div class="section-header">
                    <h3><i class="bi bi-file-earmark-image-fill"></i> Dokumentasi Resmi PTMSI</h3>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <i class="bi bi-info-circle-fill me-3" style="font-size: 1.5rem;"></i>
                            <div>
                                Dokumentasi resmi kegiatan PTMSI Sumatera Barat termasuk foto-foto acara resmi, rapat pengurus, dan kegiatan pembinaan.
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (!empty($galeri)): ?>
                    <div class="galeri-grid">
                        <?php foreach (array_slice($galeri, 0, 12) as $g): ?>
                            <div class="galeri-item">
                                <?php if ($g['jenis_media'] == 'gambar'): ?>
                                    <img src="<?= base_url($g['url']) ?>"
                                        alt="<?= esc($g['judul']) ?>"
                                        class="galeri-image"
                                        onerror="this.src='<?= base_url('assets/img/galeri1.jpg') ?>'">
                                <?php else: ?>
                                    <?php
                                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $g['url'], $matches);
                                    $videoId = $matches[1] ?? '';
                                    ?>
                                    <img src="https://img.youtube.com/vi/<?= $videoId ?>/maxresdefault.jpg"
                                        alt="<?= esc($g['judul']) ?>"
                                        class="galeri-image"
                                        onerror="this.src='https://img.youtube.com/vi/<?= $videoId ?>/hqdefault.jpg'">
                                    <span class="video-badge">
                                        <i class="bi bi-play-fill"></i> Video
                                    </span>
                                    <div class="play-icon">
                                        <i class="bi bi-play-fill"></i>
                                    </div>
                                <?php endif; ?>

                                <div class="galeri-overlay">
                                    <div class="galeri-info">
                                        <div class="galeri-title"><?= esc($g['judul']) ?></div>
                                        <div class="galeri-meta">
                                            <i class="bi bi-calendar"></i>
                                            <?= date('d M Y', strtotime($g['diunggah_pada'])) ?>
                                            <?php if (!empty($g['nama_event'])): ?>
                                                <br><i class="bi bi-trophy"></i> <?= esc($g['nama_event']) ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="bi bi-file-earmark-image"></i>
                        <h5>Belum ada dokumentasi resmi</h5>
                        <p>Dokumentasi resmi PTMSI akan ditampilkan di sini</p>
                    </div>
                <?php endif; ?>
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

            // Click handler untuk galeri item
            document.querySelectorAll('.galeri-item').forEach(item => {
                item.addEventListener('click', function() {
                    const img = this.querySelector('img');
                    const videoUrl = this.closest('.galeri-item').dataset.videoUrl;

                    if (videoUrl) {
                        // Open video in new tab
                        window.open(videoUrl, '_blank');
                    } else if (img) {
                        // Open image in lightbox or new tab
                        window.open(img.src, '_blank');
                    }
                });
            });
        });
    </script>

    <?= $this->include('layouts/footer') ?>