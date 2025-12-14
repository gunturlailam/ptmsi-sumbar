<?php $title = isset($title) ? $title : 'Dokumen & Regulasi - PTMSI Sumbar'; ?>
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

    .dokumen-section {
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
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }

    .nav-menu-card {
        background: #fff;
        border-radius: 25px;
        padding: 20px;
        text-decoration: none;
        color: #003366;
        border: 2px solid #E8F2FF;
        transition: all 0.4s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .nav-menu-card:hover {
        background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%);
        color: #fff;
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(30, 144, 255, 0.4);
        border-color: transparent;
    }

    .nav-icon-circle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
    }

    .nav-menu-card:hover .nav-icon-circle {
        background: #fff;
        transform: rotate(360deg);
    }

    .nav-icon-circle i {
        font-size: 2rem;
        color: #fff;
        transition: all 0.4s ease;
    }

    .nav-menu-card:hover .nav-icon-circle i {
        color: #1E90FF;
    }

    .nav-menu-card span {
        font-weight: 700;
        font-size: 1rem;
    }

    .section-card {
        background: #fff;
        border-radius: 25px;
        box-shadow: 0 8px 30px rgba(30, 144, 255, 0.12);
        padding: 35px;
        margin-bottom: 35px;
        border: 2px solid #E8F2FF;
        transition: all 0.3s ease;
    }

    .section-card:hover {
        box-shadow: 0 12px 40px rgba(30, 144, 255, 0.18);
        transform: translateY(-2px);
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        padding-bottom: 20px;
        border-bottom: 4px solid transparent;
        background: linear-gradient(to right, #E8F2FF 0%, transparent 100%);
        border-radius: 15px;
        padding: 20px;
    }

    .section-header h3 {
        color: #003366;
        font-weight: 900;
        font-size: 1.9rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .section-header h3 i {
        color: #1E90FF;
        font-size: 2rem;
    }

    .dokumen-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .dokumen-item {
        background: linear-gradient(135deg, #fff 0%, #F8F9FA 100%);
        border-radius: 25px;
        padding: 25px;
        border: 2px solid #E8F2FF;
        transition: all 0.4s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        position: relative;
        overflow: hidden;
    }

    .dokumen-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 5px;
        background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%);
        transition: all 0.4s ease;
    }

    .dokumen-item:hover {
        background: linear-gradient(135deg, #E8F2FF 0%, #fff 100%);
        transform: translateX(8px);
        box-shadow: 0 8px 30px rgba(30, 144, 255, 0.2);
        border-color: #1E90FF;
    }

    .dokumen-item:hover::before {
        width: 8px;
    }

    .dokumen-icon {
        background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%);
        color: #fff;
        width: 65px;
        height: 65px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        flex-shrink: 0;
        box-shadow: 0 4px 15px rgba(30, 144, 255, 0.3);
        transition: all 0.4s ease;
    }

    .dokumen-item:hover .dokumen-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .dokumen-content {
        flex: 1;
    }

    .dokumen-title {
        color: #003366;
        font-weight: 900;
        font-size: 1.15rem;
        margin-bottom: 8px;
        transition: all 0.3s ease;
    }

    .dokumen-item:hover .dokumen-title {
        color: #1E90FF;
    }

    .dokumen-meta {
        font-size: 0.95rem;
        color: #666;
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .dokumen-meta i {
        color: #1E90FF;
        margin-right: 5px;
    }

    .btn-download {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: #fff;
        border: none;
        padding: 12px 24px;
        border-radius: 20px;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.4s ease;
        white-space: nowrap;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
    }

    .btn-download:hover {
        color: #fff;
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
    }

    .btn-download i {
        font-size: 1.1rem;
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

        .dokumen-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-download {
            width: 100%;
            justify-content: center;
        }
    }
</style>
<se
    ction class="dokumen-section">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-file-earmark-text"></i> Dokumen & Regulasi</h1>
            <p>Dokumen resmi, peraturan, dan formulir PTMSI Sumatera Barat</p>
        </div>
    </div>

    <div class="container">
        <!-- Sub Menu Navigation -->
        <div class="submenu-nav">
            <h4><i class="bi bi-list-ul"></i> Kategori Dokumen</h4>
            <div class="submenu-grid">
                <a href="#ad-art" class="nav-menu-card">
                    <div class="nav-icon-circle">
                        <i class="bi bi-book-fill"></i>
                    </div>
                    <span>AD/ART PTMSI</span>
                </a>
                <a href="#peraturan" class="nav-menu-card">
                    <div class="nav-icon-circle">
                        <i class="bi bi-shield-fill-check"></i>
                    </div>
                    <span>Peraturan Pertandingan</span>
                </a>
                <a href="#panduan" class="nav-menu-card">
                    <div class="nav-icon-circle">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <span>Panduan Klub</span>
                </a>
                <a href="#sop" class="nav-menu-card">
                    <div class="nav-icon-circle">
                        <i class="bi bi-clipboard-check-fill"></i>
                    </div>
                    <span>SOP Kejuaraan</span>
                </a>
                <a href="#formulir" class="nav-menu-card">
                    <div class="nav-icon-circle">
                        <i class="bi bi-file-earmark-arrow-down-fill"></i>
                    </div>
                    <span>Formulir Download</span>
                </a>
            </div>
        </div>

        <!-- AD/ART PTMSI -->
        <div id="ad-art" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-book-fill"></i> AD/ART PTMSI</h3>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="bi bi-info-circle-fill me-3" style="font-size: 1.5rem;"></i>
                        <div>
                            Anggaran Dasar (AD) dan Anggaran Rumah Tangga (ART) PTMSI yang mengatur struktur organisasi, tujuan, dan tata kelola organisasi.
                        </div>
                    </div>
                </div>
            </div>

            <?php if (!empty($adArt)): ?>
                <div class="dokumen-list">
                    <?php foreach ($adArt as $d): ?>
                        <div class="dokumen-item">
                            <div class="dokumen-icon">
                                <i class="bi bi-file-pdf-fill"></i>
                            </div>
                            <div class="dokumen-content">
                                <div class="dokumen-title"><?= esc($d['judul']) ?></div>
                                <div class="dokumen-meta">
                                    <i class="bi bi-calendar"></i>
                                    <?= date('d M Y', strtotime($d['diunggah_pada'])) ?>
                                    <span class="ms-3">
                                        <i class="bi bi-person"></i>
                                        <?= esc($d['nama_pengunggah'] ?? 'Admin') ?>
                                    </span>
                                </div>
                            </div>
                            <a href="<?= base_url('dokumen/download/' . $d['id_dokumen']) ?>"
                                class="btn-download" target="_blank">
                                <i class="bi bi-download"></i> Download
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-file-earmark"></i>
                    <h5>Belum ada dokumen AD/ART</h5>
                    <p>Dokumen AD/ART akan ditampilkan di sini</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Peraturan Pertandingan ITTF/PTMSI -->
        <div id="peraturan" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-shield-fill-check"></i> Peraturan Pertandingan ITTF/PTMSI</h3>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-3" style="font-size: 1.5rem;"></i>
                        <div>
                            Peraturan resmi pertandingan tenis meja dari ITTF (International Table Tennis Federation) dan PTMSI yang wajib dipatuhi dalam setiap pertandingan.
                        </div>
                    </div>
                </div>
            </div>

            <?php if (!empty($peraturan)): ?>
                <div class="dokumen-list">
                    <?php foreach ($peraturan as $d): ?>
                        <div class="dokumen-item">
                            <div class="dokumen-icon">
                                <i class="bi bi-file-pdf-fill"></i>
                            </div>
                            <div class="dokumen-content">
                                <div class="dokumen-title"><?= esc($d['judul']) ?></div>
                                <div class="dokumen-meta">
                                    <i class="bi bi-calendar"></i>
                                    <?= date('d M Y', strtotime($d['diunggah_pada'])) ?>
                                    <span class="ms-3">
                                        <i class="bi bi-person"></i>
                                        <?= esc($d['nama_pengunggah'] ?? 'Admin') ?>
                                    </span>
                                </div>
                            </div>
                            <a href="<?= base_url('dokumen/download/' . $d['id_dokumen']) ?>"
                                class="btn-download" target="_blank">
                                <i class="bi bi-download"></i> Download
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-shield"></i>
                    <h5>Belum ada peraturan pertandingan</h5>
                    <p>Peraturan pertandingan akan ditampilkan di sini</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Panduan Klub -->
        <div id="panduan" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-journal-text"></i> Panduan Klub</h3>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <p style="color: #555; font-size: 1rem; line-height: 1.8;">
                        Panduan lengkap untuk pengelolaan klub tenis meja, termasuk administrasi, pembinaan atlet, dan penyelenggaraan kegiatan.
                    </p>
                </div>
            </div>

            <?php if (!empty($panduan)): ?>
                <div class="dokumen-list">
                    <?php foreach ($panduan as $d): ?>
                        <div class="dokumen-item">
                            <div class="dokumen-icon">
                                <i class="bi bi-file-pdf-fill"></i>
                            </div>
                            <div class="dokumen-content">
                                <div class="dokumen-title"><?= esc($d['judul']) ?></div>
                                <div class="dokumen-meta">
                                    <i class="bi bi-calendar"></i>
                                    <?= date('d M Y', strtotime($d['diunggah_pada'])) ?>
                                    <span class="ms-3">
                                        <i class="bi bi-person"></i>
                                        <?= esc($d['nama_pengunggah'] ?? 'Admin') ?>
                                    </span>
                                </div>
                            </div>
                            <a href="<?= base_url('dokumen/download/' . $d['id_dokumen']) ?>"
                                class="btn-download" target="_blank">
                                <i class="bi bi-download"></i> Download
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-journal"></i>
                    <h5>Belum ada panduan klub</h5>
                    <p>Panduan klub akan ditampilkan di sini</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- SOP Kejuaraan -->
        <div id="sop" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-clipboard-check-fill"></i> SOP Kejuaraan</h3>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <p style="color: #555; font-size: 1rem; line-height: 1.8;">
                        Standard Operating Procedure (SOP) untuk penyelenggaraan kejuaraan tenis meja yang mencakup persiapan, pelaksanaan, dan evaluasi event.
                    </p>
                </div>
            </div>

            <?php if (!empty($sop)): ?>
                <div class="dokumen-list">
                    <?php foreach ($sop as $d): ?>
                        <div class="dokumen-item">
                            <div class="dokumen-icon">
                                <i class="bi bi-file-pdf-fill"></i>
                            </div>
                            <div class="dokumen-content">
                                <div class="dokumen-title"><?= esc($d['judul']) ?></div>
                                <div class="dokumen-meta">
                                    <i class="bi bi-calendar"></i>
                                    <?= date('d M Y', strtotime($d['diunggah_pada'])) ?>
                                    <span class="ms-3">
                                        <i class="bi bi-person"></i>
                                        <?= esc($d['nama_pengunggah'] ?? 'Admin') ?>
                                    </span>
                                </div>
                            </div>
                            <a href="<?= base_url('dokumen/download/' . $d['id_dokumen']) ?>"
                                class="btn-download" target="_blank">
                                <i class="bi bi-download"></i> Download
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-clipboard"></i>
                    <h5>Belum ada SOP kejuaraan</h5>
                    <p>SOP kejuaraan akan ditampilkan di sini</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Formulir Download -->
        <div id="formulir" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-file-earmark-arrow-down-fill"></i> Formulir Download</h3>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill me-3" style="font-size: 1.5rem;"></i>
                        <div>
                            Berbagai formulir yang dapat diunduh untuk keperluan pendaftaran atlet, klub, event, dan administrasi lainnya.
                        </div>
                    </div>
                </div>
            </div>

            <?php if (!empty($formulir)): ?>
                <div class="dokumen-list">
                    <?php foreach ($formulir as $d): ?>
                        <div class="dokumen-item">
                            <div class="dokumen-icon">
                                <i class="bi bi-file-earmark-fill"></i>
                            </div>
                            <div class="dokumen-content">
                                <div class="dokumen-title"><?= esc($d['judul']) ?></div>
                                <div class="dokumen-meta">
                                    <i class="bi bi-calendar"></i>
                                    <?= date('d M Y', strtotime($d['diunggah_pada'])) ?>
                                    <span class="ms-3">
                                        <i class="bi bi-person"></i>
                                        <?= esc($d['nama_pengunggah'] ?? 'Admin') ?>
                                    </span>
                                </div>
                            </div>
                            <a href="<?= base_url('dokumen/download/' . $d['id_dokumen']) ?>"
                                class="btn-download" target="_blank">
                                <i class="bi bi-download"></i> Download
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-file-earmark-arrow-down"></i>
                    <h5>Belum ada formulir</h5>
                    <p>Formulir download akan ditampilkan di sini</p>
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