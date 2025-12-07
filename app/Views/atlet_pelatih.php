<?php $title = isset($title) ? $title : 'Atlet & Pelatih PTMSI Sumbar'; ?>
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

    .atlet-pelatih-section {
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

    /* Sub Menu Navigation */
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

    /* Section Card */
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

    .filter-group {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-group select,
    .filter-group input {
        padding: 8px 16px;
        border: 2px solid #E8F2FF;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: border-color 0.3s;
    }

    .filter-group select:focus,
    .filter-group input:focus {
        outline: none;
        border-color: #1E90FF;
    }

    /* Table Styles */
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
    }

    .data-table thead {
        background: linear-gradient(135deg, #003366 0%, #1E90FF 100%);
        color: #fff;
    }

    .data-table thead th {
        padding: 16px 12px;
        text-align: left;
        font-weight: 600;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
    }

    .data-table thead th:first-child {
        border-radius: 12px 0 0 0;
    }

    .data-table thead th:last-child {
        border-radius: 0 12px 0 0;
    }

    .data-table tbody tr {
        background: #fff;
        transition: all 0.3s;
        border-bottom: 1px solid #f0f0f0;
    }

    .data-table tbody tr:hover {
        background: #F8F9FA;
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(30, 144, 255, 0.1);
    }

    .data-table tbody td {
        padding: 14px 12px;
        vertical-align: middle;
        color: #333;
        font-size: 0.95rem;
    }

    .data-table tbody tr:last-child td:first-child {
        border-radius: 0 0 0 12px;
    }

    .data-table tbody tr:last-child td:last-child {
        border-radius: 0 0 12px 0;
    }

    .avatar-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .avatar-cell img {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #1E90FF;
        background: #fff;
    }

    .avatar-cell .name-info {
        display: flex;
        flex-direction: column;
    }

    .avatar-cell .name {
        font-weight: 600;
        color: #003366;
    }

    .avatar-cell .sub-info {
        font-size: 0.85rem;
        color: #666;
    }

    .badge-custom {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .badge-ranking {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: #fff;
    }

    .badge-kategori {
        background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
        color: #fff;
    }

    .badge-sertifikasi {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: #fff;
    }

    .badge-status-aktif {
        background: #28a745;
        color: #fff;
    }

    .badge-status-nonaktif {
        background: #6c757d;
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

    .empty-state h5 {
        color: #003366;
        margin-bottom: 8px;
    }

    /* Download Section */
    .download-section {
        background: linear-gradient(135deg, #E8F2FF 0%, #fff 100%);
        border-radius: 16px;
        padding: 24px;
        border: 2px solid #1E90FF;
    }

    .download-section h5 {
        color: #003366;
        font-weight: bold;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .download-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
    }

    .download-item {
        background: #fff;
        border-radius: 10px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1px solid #E8F2FF;
        transition: all 0.3s;
    }

    .download-item:hover {
        background: #1E90FF;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(30, 144, 255, 0.2);
    }

    .download-item span {
        font-weight: 600;
        font-size: 0.9rem;
    }

    .download-item i {
        font-size: 1.2rem;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .page-header h1 {
            font-size: 2rem;
        }

        .submenu-grid {
            grid-template-columns: 1fr;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .filter-group {
            width: 100%;
        }

        .filter-group select,
        .filter-group input {
            flex: 1;
        }
    }

    @media (max-width: 767px) {
        .page-header h1 {
            font-size: 1.5rem;
        }

        .section-card {
            padding: 20px 16px;
        }

        .data-table {
            font-size: 0.85rem;
        }

        .data-table thead th,
        .data-table tbody td {
            padding: 10px 8px;
        }

        .avatar-cell img {
            width: 36px;
            height: 36px;
        }

        .download-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="atlet-pelatih-section">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-people-fill"></i> Atlet & Pelatih PTMSI Sumbar</h1>
            <p>Data lengkap atlet, pelatih, dan sertifikasi PTMSI Sumatera Barat</p>
        </div>
    </div>

    <div class="container">
        <!-- Sub Menu Navigation -->
        <div class="submenu-nav">
            <h4><i class="bi bi-list-ul"></i> Menu Navigasi</h4>
            <div class="submenu-grid">
                <a href="#data-atlet" class="submenu-item">
                    <i class="bi bi-person-badge-fill"></i>
                    <span>Data Atlet</span>
                </a>
                <a href="#data-pelatih" class="submenu-item">
                    <i class="bi bi-mortarboard-fill"></i>
                    <span>Data Pelatih & Sertifikasi</span>
                </a>
                <a href="#prosedur-pendaftaran" class="submenu-item">
                    <i class="bi bi-clipboard-check-fill"></i>
                    <span>Prosedur Pendaftaran</span>
                </a>
                <a href="#download-formulir" class="submenu-item">
                    <i class="bi bi-download"></i>
                    <span>Download Formulir</span>
                </a>
            </div>
        </div>

        <!-- Data Atlet Section -->
        <div id="data-atlet" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-person-badge-fill"></i> Data Atlet PTMSI Sumbar</h3>
                <div class="filter-group">
                    <select id="filterKabKota" class="form-select">
                        <option value="">Semua Kab/Kota</option>
                        <option value="Padang">Padang</option>
                        <option value="Bukittinggi">Bukittinggi</option>
                        <option value="Payakumbuh">Payakumbuh</option>
                        <option value="Solok">Solok</option>
                        <option value="Padang Panjang">Padang Panjang</option>
                    </select>
                    <select id="filterKategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        <option value="U-12">U-12</option>
                        <option value="U-15">U-15</option>
                        <option value="U-18">U-18</option>
                        <option value="Senior">Senior</option>
                    </select>
                    <input type="text" id="searchAtlet" class="form-control" placeholder="Cari nama atlet...">
                </div>
            </div>

            <div class="table-responsive">
                <?php if (!empty($atlet)): ?>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Atlet</th>
                                <th>Kab/Kota</th>
                                <th>Klub</th>
                                <th>Kategori Usia</th>
                                <th>Jenis Kelamin</th>
                                <th>Ranking</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($atlet as $a): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <div class="avatar-cell">
                                            <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="<?= esc($a['nama_lengkap'] ?? 'Atlet') ?>">
                                            <div class="name-info">
                                                <span class="name"><?= esc($a['nama_lengkap'] ?? 'N/A') ?></span>
                                                <span class="sub-info"><?= esc($a['nomor_lisensi'] ?? '-') ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= esc($a['kab_kota'] ?? '-') ?></td>
                                    <td><?= esc($a['nama_klub'] ?? 'Belum ada klub') ?></td>
                                    <td>
                                        <span class="badge-custom badge-kategori">
                                            <?= esc($a['kategori_usia'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <i class="bi bi-<?= ($a['jenis_kelamin'] ?? '') == 'Laki-laki' ? 'gender-male' : 'gender-female' ?>"></i>
                                        <?= esc($a['jenis_kelamin'] ?? '-') ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($a['ranking_provinsi'])): ?>
                                            <span class="badge-custom badge-ranking">
                                                <i class="bi bi-trophy-fill"></i> #<?= $a['ranking_provinsi'] ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge-custom badge-status-<?= ($a['status'] ?? 'nonaktif') == 'aktif' ? 'aktif' : 'nonaktif' ?>">
                                            <?= esc(ucfirst($a['status'] ?? 'nonaktif')) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="bi bi-person-x"></i>
                        <h5>Belum ada data atlet</h5>
                        <p>Data atlet akan ditampilkan di sini setelah pendaftaran</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Data Pelatih & Sertifikasi Section -->
        <div id="data-pelatih" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-mortarboard-fill"></i> Data Pelatih & Sertifikasi</h3>
                <div class="filter-group">
                    <select id="filterSertifikasi" class="form-select">
                        <option value="">Semua Sertifikasi</option>
                        <option value="Lisensi A">Lisensi A</option>
                        <option value="Lisensi B">Lisensi B</option>
                        <option value="Lisensi C">Lisensi C</option>
                        <option value="Lisensi D">Lisensi D</option>
                    </select>
                    <input type="text" id="searchPelatih" class="form-control" placeholder="Cari nama pelatih...">
                </div>
            </div>

            <div class="table-responsive">
                <?php if (!empty($pelatih)): ?>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelatih</th>
                                <th>Klub</th>
                                <th>Tingkat Sertifikasi</th>
                                <th>Nomor Lisensi</th>
                                <th>Tanggal Sertifikasi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($pelatih as $p): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <div class="avatar-cell">
                                            <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="<?= esc($p['nama_lengkap'] ?? 'Pelatih') ?>">
                                            <div class="name-info">
                                                <span class="name"><?= esc($p['nama_lengkap'] ?? 'N/A') ?></span>
                                                <span class="sub-info">Pelatih</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= esc($p['nama_klub'] ?? 'Belum ada klub') ?></td>
                                    <td>
                                        <span class="badge-custom badge-sertifikasi">
                                            <i class="bi bi-award-fill"></i> <?= esc($p['tingkat_sertifikasi'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td><?= esc($p['nomor_lisensi'] ?? '-') ?></td>
                                    <td>
                                        <?php if (!empty($p['tanggal_sertifikasi'])): ?>
                                            <i class="bi bi-calendar-check"></i> <?= date('d M Y', strtotime($p['tanggal_sertifikasi'])) ?>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge-custom badge-status-aktif">
                                            Aktif
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="bi bi-person-x"></i>
                        <h5>Belum ada data pelatih</h5>
                        <p>Data pelatih akan ditampilkan di sini setelah pendaftaran</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Tabel Sertifikasi -->
        <div class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-award-fill"></i> Daftar Sertifikasi Pelatih</h3>
            </div>

            <div class="table-responsive">
                <?php if (!empty($sertifikasi)): ?>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelatih</th>
                                <th>Jenis Sertifikasi</th>
                                <th>Nomor Sertifikat</th>
                                <th>Lembaga Penerbit</th>
                                <th>Tanggal Dikeluarkan</th>
                                <th>Masa Berlaku</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($sertifikasi as $s): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <div class="avatar-cell">
                                            <img src="<?= base_url('assets/img/orang.jpg') ?>" alt="<?= esc($s['nama_lengkap'] ?? 'Pelatih') ?>">
                                            <div class="name-info">
                                                <span class="name"><?= esc($s['nama_lengkap'] ?? 'N/A') ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-custom badge-sertifikasi">
                                            <?= esc($s['jenis_sertifikasi'] ?? '-') ?>
                                        </span>
                                    </td>
                                    <td><?= esc($s['nomor_sertifikat'] ?? '-') ?></td>
                                    <td><?= esc($s['lembaga_penerbit'] ?? '-') ?></td>
                                    <td>
                                        <?php if (!empty($s['tanggal_dikeluarkan'])): ?>
                                            <i class="bi bi-calendar-check"></i> <?= date('d M Y', strtotime($s['tanggal_dikeluarkan'])) ?>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($s['masa_berlaku'])): ?>
                                            <i class="bi bi-calendar-event"></i> <?= date('d M Y', strtotime($s['masa_berlaku'])) ?>
                                        <?php else: ?>
                                            <span class="text-muted">Seumur Hidup</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="bi bi-award"></i>
                        <h5>Belum ada data sertifikasi</h5>
                        <p>Data sertifikasi pelatih akan ditampilkan di sini</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Prosedur Pendaftaran Section -->
        <div id="prosedur-pendaftaran" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-clipboard-check-fill"></i> Prosedur Pendaftaran Atlet PTMSI</h3>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="text-primary mb-3"><i class="bi bi-1-circle-fill"></i> Persyaratan Umum</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Warga Negara Indonesia</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Fotokopi KTP/KK</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Pas foto 3x4 (2 lembar)</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Surat rekomendasi dari klub</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Surat pernyataan orang tua (untuk U-18)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="text-primary mb-3"><i class="bi bi-2-circle-fill"></i> Langkah Pendaftaran</h5>
                            <ol class="list-unstyled">
                                <li class="mb-2"><strong>1.</strong> Download formulir pendaftaran</li>
                                <li class="mb-2"><strong>2.</strong> Isi formulir dengan lengkap dan benar</li>
                                <li class="mb-2"><strong>3.</strong> Lampirkan dokumen persyaratan</li>
                                <li class="mb-2"><strong>4.</strong> Submit formulir ke sekretariat PTMSI</li>
                                <li class="mb-2"><strong>5.</strong> Tunggu verifikasi (maks. 7 hari kerja)</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="bi bi-info-circle-fill me-3" style="font-size: 1.5rem;"></i>
                        <div>
                            <strong>Informasi Penting:</strong> Pendaftaran dapat dilakukan secara online melalui website atau langsung ke sekretariat PTMSI Sumbar. Untuk informasi lebih lanjut hubungi: <strong>0812-3456-7890</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Download Formulir Section -->
        <div id="download-formulir" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-download"></i> Download Formulir Atlet/Klub</h3>
            </div>

            <div class="download-section">
                <h5><i class="bi bi-file-earmark-arrow-down-fill"></i> Formulir Tersedia</h5>
                <div class="download-grid">
                    <a href="<?= base_url('assets/formulir/formulir-pendaftaran-atlet.pdf') ?>" class="download-item" target="_blank">
                        <span><i class="bi bi-file-pdf-fill text-danger me-2"></i> Formulir Pendaftaran Atlet</span>
                        <i class="bi bi-download"></i>
                    </a>
                    <a href="<?= base_url('assets/formulir/formulir-pendaftaran-klub.pdf') ?>" class="download-item" target="_blank">
                        <span><i class="bi bi-file-pdf-fill text-danger me-2"></i> Formulir Pendaftaran Klub</span>
                        <i class="bi bi-download"></i>
                    </a>
                    <a href="<?= base_url('assets/formulir/formulir-perpindahan-klub.pdf') ?>" class="download-item" target="_blank">
                        <span><i class="bi bi-file-pdf-fill text-danger me-2"></i> Formulir Perpindahan Klub</span>
                        <i class="bi bi-download"></i>
                    </a>
                    <a href="<?= base_url('assets/formulir/formulir-pembaruan-data.pdf') ?>" class="download-item" target="_blank">
                        <span><i class="bi bi-file-pdf-fill text-danger me-2"></i> Formulir Pembaruan Data</span>
                        <i class="bi bi-download"></i>
                    </a>
                </div>
            </div>

            <div class="mt-4 text-center">
                <a href="<?= base_url('pendaftaran-atlet') ?>" class="btn btn-lg" style="background: linear-gradient(90deg, #1E90FF 60%, #003366 100%); color: #fff; border-radius: 30px; padding: 12px 32px;">
                    <i class="bi bi-person-plus-fill"></i> Daftar Atlet Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    // Filter functionality
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