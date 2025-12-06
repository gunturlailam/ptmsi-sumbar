<?php $title = isset($title) ? $title : 'Berita - PTMSI Sumbar'; ?>
<?= $this->include('layouts/header') ?>

<style>
    body {
        background: #E8F2FF;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    }

    .berita-section {
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

    .s ubmenu-item {
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

    .berita-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    .berita-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(30, 144, 255, 0.1);
        transition: all 0.3s;
        border: 2px solid transparent;
    }

    .berita-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 32px rgba(30, 144, 255, 0.2);
        border-color: #1E90FF;
    }

    .berita-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: linear-gradient(135deg, #E8F2FF 0%, #1E90FF 100%);
    }

    .berita-content {
        padding: 20px;
    }

    .berita-kategori {
        display: inline-block;
        background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
        color: #fff;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .berita-title {
        color: #003366;
        font-weight: bold;
        font-size: 1.2rem;
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
        margin-bottom: 16px;
    }

    .berita-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        font-size: 0.9rem;
        color: #999;
        padding-top: 16px;
        border-top: 1px solid #E8F2FF;
    }

    .berita-meta i {
        color: #1E90FF;
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

        .berita-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<
    section class="berita-section">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-newspaper"></i> Berita PTMSI Sumbar</h1>
            <p>Informasi terkini seputar tenis meja Sumatera Barat</p>
        </div>
    </div>

    <div class="container">
        <!-- Sub Menu Navigation -->
        <div class="submenu-nav">
            <h4><i class="bi bi-list-ul"></i> Kategori Berita</h4>
            <div class="submenu-grid">
                <a href="#berita-kejuaraan" class="submenu-item">
                    <i class="bi bi-trophy-fill"></i>
                    <span>Berita Kejuaraan</span>
                </a>
                <a href="#berita-atlet" class="submenu-item">
                    <i class="bi bi-star-fill"></i>
                    <span>Berita Atlet Berprestasi</span>
                </a>
                <a href="#pengumuman" class="submenu-item">
                    <i class="bi bi-megaphone-fill"></i>
                    <span>Pengumuman Penting</span>
                </a>
                <a href="#artikel-pembinaan" class="submenu-item">
                    <i class="bi bi-book-fill"></i>
                    <span>Artikel Pembinaan</span>
                </a>
            </div>
        </div>

        <!-- Berita Kejuaraan -->
        <div id="berita-kejuaraan" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-trophy-fill"></i> Berita Kejuaraan</h3>
                <a href="<?= base_url('berita/kategori/kejuaraan') ?>" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>

            <?php if (!empty($beritaKejuaraan)): ?>
                <div class="berita-grid">
                    <?php foreach (array_slice($beritaKejuaraan, 0, 6) as $b): ?>
                        <div class="berita-card">
                            <img src="<?= base_url('assets/img/berita1.jpg') ?>"
                                alt="<?= esc($b['judul']) ?>"
                                class="berita-image">
                            <div class="berita-content">
                                <span class="berita-kategori">Kejuaraan</span>
                                <h4 class="berita-title">
                                    <a href="<?= base_url('berita/' . $b['slug']) ?>">
                                        <?= esc($b['judul']) ?>
                                    </a>
                                </h4>
                                <p class="berita-ringkasan">
                                    <?= esc(substr(strip_tags($b['konten']), 0, 120)) ?>...
                                </p>
                                <div class="berita-meta">
                                    <span><i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($b['tanggal_publikasi'])) ?></span>
                                    <span><i class="bi bi-person"></i> <?= esc($b['nama_penulis'] ?? 'Admin') ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-newspaper"></i>
                    <h5>Belum ada berita kejuaraan</h5>
                    <p>Berita kejuaraan akan ditampilkan di sini</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Berita Atlet Berprestasi -->
        <div id="berita-atlet" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-star-fill"></i> Berita Atlet Berprestasi</h3>
                <a href="<?= base_url('berita/kategori/atlet_berprestasi') ?>" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>

            <?php if (!empty($beritaAtlet)): ?>
                <div class="berita-grid">
                    <?php foreach (array_slice($beritaAtlet, 0, 6) as $b): ?>
                        <div class="berita-card">
                            <img src="<?= base_url('assets/img/berita2.jpg') ?>"
                                alt="<?= esc($b['judul']) ?>"
                                class="berita-image">
                            <div class="berita-content">
                                <span class="berita-kategori" style="background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);">
                                    Atlet Berprestasi
                                </span>
                                <h4 class="berita-title">
                                    <a href="<?= base_url('berita/' . $b['slug']) ?>">
                                        <?= esc($b['judul']) ?>
                                    </a>
                                </h4>
                                <p class="berita-ringkasan">
                                    <?= esc(substr(strip_tags($b['konten']), 0, 120)) ?>...
                                </p>
                                <div class="berita-meta">
                                    <span><i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($b['tanggal_publikasi'])) ?></span>
                                    <span><i class="bi bi-person"></i> <?= esc($b['nama_penulis'] ?? 'Admin') ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-star"></i>
                    <h5>Belum ada berita atlet berprestasi</h5>
                    <p>Berita atlet berprestasi akan ditampilkan di sini</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pengumuman Penting -->
        <div id="pengumuman" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-megaphone-fill"></i> Pengumuman Penting</h3>
                <a href="<?= base_url('berita/kategori/pengumuman') ?>" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>

            <?php if (!empty($pengumuman)): ?>
                <div class="berita-grid">
                    <?php foreach (array_slice($pengumuman, 0, 6) as $b): ?>
                        <div class="berita-card">
                            <img src="<?= base_url('assets/img/berita3.jpg') ?>"
                                alt="<?= esc($b['judul']) ?>"
                                class="berita-image">
                            <div class="berita-content">
                                <span class="berita-kategori" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
                                    Pengumuman
                                </span>
                                <h4 class="berita-title">
                                    <a href="<?= base_url('berita/' . $b['slug']) ?>">
                                        <?= esc($b['judul']) ?>
                                    </a>
                                </h4>
                                <p class="berita-ringkasan">
                                    <?= esc(substr(strip_tags($b['konten']), 0, 120)) ?>...
                                </p>
                                <div class="berita-meta">
                                    <span><i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($b['tanggal_publikasi'])) ?></span>
                                    <span><i class="bi bi-person"></i> <?= esc($b['nama_penulis'] ?? 'Admin') ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-megaphone"></i>
                    <h5>Belum ada pengumuman</h5>
                    <p>Pengumuman penting akan ditampilkan di sini</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Artikel Pembinaan Tenis Meja -->
        <div id="artikel-pembinaan" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-book-fill"></i> Artikel Pembinaan Tenis Meja</h3>
                <a href="<?= base_url('berita/kategori/artikel_pembinaan') ?>" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>

            <?php if (!empty($artikel)): ?>
                <div class="berita-grid">
                    <?php foreach (array_slice($artikel, 0, 6) as $b): ?>
                        <div class="berita-card">
                            <img src="<?= base_url('assets/img/pembinaan.jpg') ?>"
                                alt="<?= esc($b['judul']) ?>"
                                class="berita-image">
                            <div class="berita-content">
                                <span class="berita-kategori" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                                    Artikel Pembinaan
                                </span>
                                <h4 class="berita-title">
                                    <a href="<?= base_url('berita/' . $b['slug']) ?>">
                                        <?= esc($b['judul']) ?>
                                    </a>
                                </h4>
                                <p class="berita-ringkasan">
                                    <?= esc(substr(strip_tags($b['konten']), 0, 120)) ?>...
                                </p>
                                <div class="berita-meta">
                                    <span><i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($b['tanggal_publikasi'])) ?></span>
                                    <span><i class="bi bi-person"></i> <?= esc($b['nama_penulis'] ?? 'Admin') ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-book"></i>
                    <h5>Belum ada artikel pembinaan</h5>
                    <p>Artikel pembinaan tenis meja akan ditampilkan di sini</p>
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
        });
    </script>

    <?= $this->include('layouts/footer') ?>
