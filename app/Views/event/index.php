<?php $title = isset($title) ? $title : 'Kejuaraan & Event - PTMSI Sumbar'; ?>
<?= $this->include('layouts/header') ?>

<style>
    body {
        background: #E8F2FF;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    }

    .event-section {
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

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    .calendar-card {
        background: linear-gradient(135deg, #E8F2FF 0%, #fff 100%);
        border-radius: 16px;
        padding: 20px;
        border-left: 5px solid #1E90FF;
        transition: all 0.3s;
    }

    .calendar-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(30, 144, 255, 0.2);
    }

    .calendar-date {
        background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
        color: #fff;
        padding: 10px 16px;
        border-radius: 10px;
        text-align: center;
        display: inline-block;
        margin-bottom: 12px;
        font-weight: bold;
    }

    .calendar-title {
        color: #003366;
        font-weight: bold;
        font-size: 1.1rem;
        margin-bottom: 8px;
    }

    .calendar-info {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 4px;
    }

    .cale ndar-info i {
        color: #1E90FF;
        margin-right: 6px;
    }

    .badge-tingkat {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-top: 8px;
    }

    .badge-provinsi {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: #fff;
    }

    .badge-nasional {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: #fff;
    }

    .badge-open {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        color: #fff;
    }

    .filter-tabs {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .filter-tab {
        padding: 10px 20px;
        border-radius: 20px;
        border: 2px solid #1E90FF;
        background: #fff;
        color: #1E90FF;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .filter-tab:hover,
    .filter-tab.active {
        background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
        color: #fff;
    }

    .pendaftaran-form {
        background: linear-gradient(135deg, #E8F2FF 0%, #fff 100%);
        border-radius: 16px;
        padding: 24px;
        border: 2px solid #1E90FF;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        color: #003366;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        border: 2px solid #E8F2FF;
        border-radius: 8px;
        padding: 10px 16px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #1E90FF;
        outline: none;
        box-shadow: 0 0 0 3px rgba(30, 144, 255, 0.1);
    }

    .btn-submit {
        background: linear-gradient(90deg, #1E90FF 60%, #003366 100%);
        color: #fff;
        border: none;
        padding: 12px 32px;
        border-radius: 30px;
        font-weight: 600;
        transition: transform 0.2s;
    }

    .btn-submit:hover {
        transform: scale(1.05);
        color: #fff;
    }

    .dokumen-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
    }

    .dok umen-item {
        background: #fff;
        border-radius: 12px;
        padding: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1px solid #E8F2FF;
        transition: all 0.3s;
    }

    .dokumen-item:hover {
        background: #1E90FF;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(30, 144, 255, 0.2);
    }

    .dokumen-item span {
        font-weight: 600;
        font-size: 0.95rem;
    }

    .dokumen-item i {
        font-size: 1.3rem;
    }

    .hasil-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
    }

    .hasil-table thead {
        background: linear-gradient(135deg, #003366 0%, #1E90FF 100%);
        color: #fff;
    }

    .hasil-table thead th {
        padding: 16px 12px;
        text-align: left;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .hasil-table thead th:first-child {
        border-radius: 12px 0 0 0;
    }

    .hasil-table thead th:last-child {
        border-radius: 0 12px 0 0;
    }

    .hasil-table tbody tr {
        background: #fff;
        transition: all 0.3s;
        border-bottom: 1px solid #f0f0f0;
    }

    .hasil-table tbody tr:hover {
        background: #F8F9FA;
        transform: scale(1.01);
    }

    .hasil-table tbody td {
        padding: 14px 12px;
        vertical-align: middle;
        color: #333;
    }

    .badge-juara {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .juara-1 {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: #fff;
    }

    .juara-2 {
        background: linear-gradient(135deg, #C0C0C0 0%, #808080 100%);
        color: #fff;
    }

    .juara-3 {
        background: linear-gradient(135deg, #CD7F32 0%, #8B4513 100%);
        color: #fff;
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

        .calendar-grid {
            grid-template-columns: 1fr;
        }

        .dokumen-list {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="event-section">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-trophy-fill"></i> Kejuaraan & Event PTMSI Sumbar</h1>
            <p>Informasi lengkap kejuaraan, turnamen, dan event tenis meja</p>
        </div>
    </div>

    <div class="container">
        <!-- Sub Menu Navigation -->
        <div class="submenu-nav">
            <h4><i class="bi bi-list-ul"></i> Menu Navigasi</h4>
            <div class="submenu-grid">
                <a href="#kalender-kejuaraan" class="submenu-item">
                    <i class="bi bi-calendar-event-fill"></i>
                    <span>Kalender Kejuaraan</span>
                </a>
                <a href="#pendaftaran-turnamen" class="submenu-item">
                    <i class="bi bi-clipboard-check-fill"></i>
                    <span>Pendaftaran Turnamen</span>
                </a>
                <a href="#juklak-juknis" class="submenu-item">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span>Juklak & Juknis</span>
                </a>
                <a href="#hasil-pertandingan" class="submenu-item">
                    <i class="bi bi-trophy-fill"></i>
                    <span>Hasil Pertandingan</span>
                </a>
            </div>
        </div>

        <!-- Kalender Kejuaraan -->
        <div id="kalender-kejuaraan" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-calendar-event-fill"></i> Kalender Kejuaraan</h3>
            </div>

            <div class="filter-tabs">
                <button class="filter-tab active" data-filter="all">Semua</button>
                <button class="filter-tab" data-filter="provinsi">Provinsi</button>
                <button class="filter-tab" data-filter="nasional">Nasional</button>
                <button class="filter-tab" data-filter="open">Open Tournament</button>
            </div>

            <div class="calendar-grid">
                <?php if (!empty($events)): ?>
                    <?php foreach ($events as $event): ?>
                        <div class="calendar-card" data-tingkat="<?= strtolower($event['tingkat']) ?>">
                            <div class="calendar-date">
                                <?= date('d M Y', strtotime($event['tanggal_mulai'])) ?>
                            </div>
                            <div class="calendar-title"><?= esc($event['judul']) ?></div>
                            <div class="calendar-info">
                                <i class="bi bi-geo-alt-fill"></i>
                                <?= esc($event['lokasi'] ?? 'Lokasi TBA') ?>
                            </div>
                            <div class="calendar-info">
                                <i class="bi bi-calendar-range"></i>
                                <?= date('d M', strtotime($event['tanggal_mulai'])) ?> -
                                <?= date('d M Y', strtotime($event['tanggal_selesai'])) ?>
                            </div>
                            <div class="calendar-info">
                                <i class="bi bi-building"></i>
                                <?= esc($event['nama_klub_penyelenggara'] ?? 'PTMSI Sumbar') ?>
                            </div>
                            <span class="badge-tingkat badge-<?= strtolower($event['tingkat']) ?>">
                                <?= esc($event['tingkat']) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="bi bi-calendar-x"></i>
                            <h5>Belum ada kejuaraan terjadwal</h5>
                            <p>Kalender kejuaraan akan ditampilkan di sini</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Pendaftaran Turnamen Online -->
        <div id="pendaftaran-turnamen" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-clipboard-check-fill"></i> Pendaftaran Turnamen Online</h3>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="pendaftaran-form">
                        <h5 class="mb-4" style="color: #003366;">
                            <i class="bi bi-person-plus-fill"></i> Form Pendaftaran
                        </h5>
                        <form action="<?= base_url('event/daftar') ?>" method="POST">
                            <div class="form-group">
                                <label>Pilih Event/Turnamen</label>
                                <select name="id_event" class="form-control" required>
                                    <option value="">-- Pilih Event --</option>
                                    <?php if (!empty($events)): ?>
                                        <?php foreach ($events as $event): ?>
                                            <?php if ($event['status'] == 'aktif' || $event['status'] == 'mendatang'): ?>
                                                <option value="<?= $event['id_event'] ?>">
                                                    <?= esc($event['judul']) ?> - <?= esc($event['tingkat']) ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                            </div>

                            <div class="form-group">
                                <label>Klub</label>
                                <input type="text" name="klub" class="form-control" placeholder="Nama klub" required>
                            </div>

                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="U-12">U-12</option>
                                    <option value="U-15">U-15</option>
                                    <option value="U-18">U-18</option>
                                    <option value="Senior">Senior</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                            </div>

                            <div class="form-group">
                                <label>No. Telepon</label>
                                <input type="tel" name="telepon" class="form-control" placeholder="08xxxxxxxxxx" required>
                            </div>

                            <button type="submit" class="btn btn-submit w-100">
                                <i class="bi bi-send-fill"></i> Daftar Sekarang
                            </button>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="text-primary mb-3">
                                <i class="bi bi-info-circle-fill"></i> Informasi Pendaftaran
                            </h5>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    <strong>Pendaftaran Online:</strong> Isi formulir dengan lengkap dan benar
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    <strong>Verifikasi:</strong> Tim akan memverifikasi data dalam 1x24 jam
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    <strong>Konfirmasi:</strong> Konfirmasi akan dikirim via email/WhatsApp
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    <strong>Pembayaran:</strong> Ikuti instruksi pembayaran yang diberikan
                                </li>
                            </ul>

                            <div class="alert alert-warning mt-4" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong>Perhatian:</strong> Pastikan data yang diisi sudah benar. Pendaftaran yang sudah dikonfirmasi tidak dapat dibatalkan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Juklak & Juknis Kejuaraan -->
        <div id="juklak-juknis" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-file-earmark-text-fill"></i> Juklak & Juknis Kejuaraan</h3>
            </div>

            <div class="row g-4">
                <div class="col-md-12">
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="bi bi-info-circle-fill me-3" style="font-size: 1.5rem;"></i>
                        <div>
                            <strong>Petunjuk Pelaksanaan (Juklak) dan Petunjuk Teknis (Juknis)</strong> berisi aturan, tata cara, dan ketentuan pelaksanaan kejuaraan. Pastikan membaca dokumen ini sebelum mendaftar.
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <h5 class="mb-3" style="color: #003366;">
                        <i class="bi bi-file-earmark-arrow-down-fill"></i> Dokumen Tersedia
                    </h5>
                    <div class="dokumen-list">
                        <a href="<?= base_url('assets/dokumen/juklak-kejuaraan-provinsi.pdf') ?>" class="dokumen-item" target="_blank">
                            <span><i class="bi bi-file-pdf-fill text-danger me-2"></i> Juklak Kejuaraan Provinsi</span>
                            <i class="bi bi-download"></i>
                        </a>
                        <a href="<?= base_url('assets/dokumen/juknis-kejuaraan-provinsi.pdf') ?>" class="dokumen-item" target="_blank">
                            <span><i class="bi bi-file-pdf-fill text-danger me-2"></i> Juknis Kejuaraan Provinsi</span>
                            <i class="bi bi-download"></i>
                        </a>
                        <a href="<?= base_url('assets/dokumen/juklak-kejuaraan-nasional.pdf') ?>" class="dokumen-item" target="_blank">
                            <span><i class="bi bi-file-pdf-fill text-danger me-2"></i> Juklak Kejuaraan Nasional</span>
                            <i class="bi bi-download"></i>
                        </a>
                        <a href="<?= base_url('assets/dokumen/juknis-kejuaraan-nasional.pdf') ?>" class="dokumen-item" target="_blank">
                            <span><i class="bi bi-file-pdf-fill text-danger me-2"></i> Juknis Kejuaraan Nasional</span>
                            <i class="bi bi-download"></i>
                        </a>
                        <a href="<?= base_url('assets/dokumen/peraturan-pertandingan.pdf') ?>" class="dokumen-item" target="_blank">
                            <span><i class="bi bi-file-pdf-fill text-danger me-2"></i> Peraturan Pertandingan</span>
                            <i class="bi bi-download"></i>
                        </a>
                        <a href="<?= base_url('assets/dokumen/kode-etik-atlet.pdf') ?>" class="dokumen-item" target="_blank">
                            <span><i class="bi bi-file-pdf-fill text-danger me-2"></i> Kode Etik Atlet</span>
                            <i class="bi bi-download"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hasil Pertandingan -->
        <div id="hasil-pertandingan" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-trophy-fill"></i> Hasil Pertandingan</h3>
            </div>

            <div class="mb-4">
                <h5 style="color: #003366;"><i class="bi bi-award-fill"></i> Skor & Juara Terbaru</h5>
            </div>

            <div class="table-responsive">
                <?php if (!empty($hasilPertandingan)): ?>
                    <table class="hasil-table">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Kategori</th>
                                <th>Juara 1</th>
                                <th>Juara 2</th>
                                <th>Juara 3</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($hasilPertandingan as $hasil): ?>
                                <tr>
                                    <td><strong><?= esc($hasil['nama_event']) ?></strong></td>
                                    <td><?= esc($hasil['kategori']) ?></td>
                                    <td>
                                        <span class="badge-juara juara-1">
                                            <i class="bi bi-trophy-fill"></i> <?= esc($hasil['juara_1']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-juara juara-2">
                                            <i class="bi bi-trophy-fill"></i> <?= esc($hasil['juara_2']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-juara juara-3">
                                            <i class="bi bi-trophy-fill"></i> <?= esc($hasil['juara_3']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('d M Y', strtotime($hasil['tanggal'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="bi bi-trophy"></i>
                        <h5>Belum ada hasil pertandingan</h5>
                        <p>Hasil pertandingan akan ditampilkan di sini setelah event selesai</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-4">
                <h5 style="color: #003366;"><i class="bi bi-diagram-3-fill"></i> Bracket Pertandingan</h5>
                <p class="text-muted">Lihat bracket lengkap untuk setiap kategori pertandingan</p>
                <div class="row g-3">
                    <?php if (!empty($events)): ?>
                        <?php foreach (array_slice($events, 0, 4) as $event): ?>
                            <?php if ($event['status'] == 'berlangsung' || $event['status'] == 'selesai'): ?>
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h6 class="card-title text-primary">
                                                <i class="bi bi-trophy"></i> <?= esc($event['judul']) ?>
                                            </h6>
                                            <p class="card-text text-muted mb-3">
                                                <i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($event['tanggal_mulai'])) ?>
                                            </p>
                                            <a href="<?= base_url('event/bracket/' . $event['id_event']) ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i> Lihat Bracket
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-info" role="alert">
                                <i class="bi bi-info-circle me-2"></i>
                                Bracket pertandingan akan tersedia saat event berlangsung
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter tabs functionality
        const filterTabs = document.querySelectorAll('.filter-tab');
        const calendarCards = document.querySelectorAll('.calendar-card');

        filterTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                filterTabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');

                calendarCards.forEach(card => {
                    if (filter === 'all') {
                        card.style.display = 'block';
                    } else {
                        const tingkat = card.getAttribute('data-tingkat');
                        card.style.display = tingkat === filter ? 'block' : 'none';
                    }
                });
            });
        });

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