<?php $title = isset($title) ? $title : 'Dokumen & Regulasi - PTMSI Sumbar'; ?>
<?= $this->include('layouts/header') ?>

<style>
    body {
        background: #E8F2FF;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    }

    .dokumen-section {
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
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
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

    .dokumen-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .dokumen-item {
        background: #F8F9FA;
        border-radius: 12px;
        padding: 20px;
        border-left: 4px solid #1E90FF;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .dokumen-item:hover {
        background: #E8F2FF;
        transform: translateX(4px);
        box-shadow: 0 2px 12px rgba(30, 144, 255, 0.1);
    }

    .dokumen-icon {
        background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
        color: #fff;
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .dokumen-content {
        flex: 1;
    }

    .dokumen-title {
        color: #003366;
        font-weight: bold;
        font-size: 1.1rem;
        margin-bottom: 6px;
    }

    .dokumen-meta {
        font-size: 0.9rem;
        color: #666;
    }

    .dokumen-meta i {
        color: #1E90FF;
        margin-right: 6px;
    }

    .btn-download {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
        white-space: nowrap;
    }

    .btn-download:hover {
        color: #fff;
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
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
                <a href="#ad-art" class="submenu-item">
                    <i class="bi bi-book-fill"></i>
                    <span>AD/ART PTMSI</span>
                </a>
                <a href="#peraturan" class="submenu-item">
                    <i class="bi bi-shield-fill-check"></i>
                    <span>Peraturan Pertandingan</span>
                </a>
                <a href="#panduan" class="submenu-item">
                    <i class="bi bi-journal-text"></i>
                    <span>Panduan Klub</span>
                </a>
                <a href="#sop" class="submenu-item">
                    <i class="bi bi-clipboard-check-fill"></i>
                    <span>SOP Kejuaraan</span>
                </a>
                <a href="#formulir" class="submenu-item">
                    <i class="bi bi-file-earmark-arrow-down-fill"></i>
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