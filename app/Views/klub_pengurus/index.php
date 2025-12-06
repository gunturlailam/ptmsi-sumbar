<?php $title = isset($title) ? $title : 'Klub & Pengurus - PTMSI Sumbar'; ?>
<?= $this->include('layouts/header') ?>

<style>
    body {
        background: #E8F2FF;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    }

    .klub-section {
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

    .kl ub-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    .klub-card {
        background: linear-gradient(135deg, #E8F2FF 0%, #fff 100%);
        border-radius: 16px;
        padding: 24px;
        border-left: 5px solid #1E90FF;
        transition: all 0.3s;
    }

    .klub-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(30, 144, 255, 0.2);
    }

    .klub-header {
        display: flex;
        align-items: start;
        gap: 16px;
        margin-bottom: 16px;
        padding-bottom: 16px;
        border-bottom: 2px solid #E8F2FF;
    }

    .klub-icon {
        background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
        color: #fff;
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        flex-shrink: 0;
    }

    .klub-title {
        flex: 1;
    }

    .klub-title h4 {
        color: #003366;
        font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 4px;
    }

    .klub-badge {
        background: #E8F2FF;
        color: #1E90FF;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .klub-info {
        margin-bottom: 8px;
        font-size: 0.95rem;
        color: #666;
    }

    .klub-info i {
        color: #1E90FF;
        margin-right: 8px;
        width: 20px;
    }

    .kontak-card {
        background: #F8F9FA;
        border-radius: 12px;
        padding: 20px;
        border-left: 4px solid #1E90FF;
        margin-bottom: 16px;
        transition: all 0.3s;
    }

    .kontak-card:hover {
        background: #E8F2FF;
        transform: translateX(4px);
        box-shadow: 0 2px 12px rgba(30, 144, 255, 0.1);
    }

    .kontak-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .kontak-icon {
        background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
        color: #fff;
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }

    .kontak-title {
        color: #003366;
        font-weight: bold;
        font-size: 1.1rem;
    }

    .kontak-info {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 6px;
    }

    .kontak-info i {
        color: #1E90FF;
        margin-right: 8px;
    }

    .syarat-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .syarat-item {
        background: #F8F9FA;
        border-radius: 10px;
        padding: 16px;
        display: flex;
        align-items: start;
        gap: 12px;
        transition: all 0.3s;
    }

    .syarat-item:hover {
        background: #E8F2FF;
        transform: translateX(4px);
    }

    .syarat-number {
        background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
        color: #fff;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        flex-shrink: 0;
    }

    .syarat-content {
        flex: 1;
        color: #555;
        line-height: 1.6;
    }

    .wasit-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
    }

    .wasit-table thead {
        background: linear-gradient(135deg, #003366 0%, #1E90FF 100%);
        color: #fff;
    }

    .wasit-table thead th {
        padding: 16px 12px;
        text-align: left;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .wasit-table thead th:first-child {
        border-radius: 12px 0 0 0;
    }

    .wasit-table thead th:last-child {
        border-radius: 0 12px 0 0;
    }

    .wasit-table tbody tr {
        background: #fff;
        transition: all 0.3s;
        border-bottom: 1px solid #f0f0f0;
    }

    .wasit-table tbody tr:hover {
        background: #F8F9FA;
        transform: scale(1.01);
    }

    .wasit-table tbody td {
        padding: 14px 12px;
        vertical-align: middle;
        color: #333;
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

    .badge-lisensi {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: #fff;
    }

    .empt y-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .empty-state i {
        font-size: 4rem;
        color: #ccc;
        margin-bottom: 20px;
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
    }

    @media (max-width: 767px) {
        .page-header h1 {
            font-size: 1.5rem;
        }

        .section-card {
            padding: 20px 16px;
        }

        .klub-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<section
    class="klub-section">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-building"></i> Klub & Pengurus PTMSI Sumbar</h1>
            <p>Informasi lengkap klub, kontak, syarat pendirian, dan database wasit</p>
        </div>
    </div>

    <div class="container">
        <!-- Sub Menu Navigation -->
        <div class="submenu-nav">
            <h4><i class="bi bi-list-ul"></i> Menu Navigasi</h4>
            <div class="submenu-grid">
                <a href="#daftar-klub" class="submenu-item">
                    <i class="bi bi-building-fill"></i>
                    <span>Daftar Klub Tenis Meja</span>
                </a>
                <a href="#kontak-klub" class="submenu-item">
                    <i class="bi bi-telephone-fill"></i>
                    <span>Kontak Klub</span>
                </a>
                <a href="#syarat-pendirian" class="submenu-item">
                    <i class="bi bi-clipboard-check-fill"></i>
                    <span>Syarat Pendirian Klub Baru</span>
                </a>
                <a href="#database-wasit" class="submenu-item">
                    <i class="bi bi-flag-fill"></i>
                    <span>Database Wasit & Ofisial</span>
                </a>
            </div>
        </div>

        <!-- Daftar Klub Tenis Meja se-Sumatera Barat -->
        <div id="daftar-klub" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-building-fill"></i> Daftar Klub Tenis Meja se-Sumatera Barat</h3>
                <div class="filter-group">
                    <select id="filterKabKota" class="form-select">
                        <option value="">Semua Kab/Kota</option>
                        <option value="Padang">Padang</option>
                        <option value="Bukittinggi">Bukittinggi</option>
                        <option value="Payakumbuh">Payakumbuh</option>
                        <option value="Solok">Solok</option>
                        <option value="Padang Panjang">Padang Panjang</option>
                    </select>
                    <input type="text" id="searchKlub" class="form-control" placeholder="Cari klub...">
                </div>
            </div>

            <?php if (!empty($klub)): ?>
                <div class="klub-grid">
                    <?php foreach ($klub as $k): ?>
                        <div class="klub-card">
                            <div class="klub-header">
                                <div class="klub-icon">
                                    <i class="bi bi-building"></i>
                                </div>
                                <div class="klub-title">
                                    <h4><?= esc($k['nama']) ?></h4>
                                    <span class="klub-badge">
                                        <?= esc($k['nama_organisasi'] ?? 'PTMSI Sumbar') ?>
                                    </span>
                                </div>
                            </div>

                            <div class="klub-info">
                                <i class="bi bi-geo-alt-fill"></i>
                                <?= esc($k['alamat'] ?? 'Alamat belum tersedia') ?>
                            </div>

                            <?php if (!empty($k['penanggung_jawab'])): ?>
                                <div class="klub-info">
                                    <i class="bi bi-person-fill"></i>
                                    PJ: <?= esc($k['penanggung_jawab']) ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($k['telepon'])): ?>
                                <div class="klub-info">
                                    <i class="bi bi-telephone-fill"></i>
                                    <?= esc($k['telepon']) ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($k['tanggal_berdiri'])): ?>
                                <div class="klub-info">
                                    <i class="bi bi-calendar-check"></i>
                                    Berdiri: <?= date('d M Y', strtotime($k['tanggal_berdiri'])) ?>
                                </div>
                            <?php endif; ?>

                            <div class="klub-info">
                                <i class="bi bi-check-circle-fill"></i>
                                Status: <strong><?= esc(ucfirst($k['status'] ?? 'aktif')) ?></strong>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-building-x"></i>
                    <h5>Belum ada data klub</h5>
                    <p>Data klub akan ditampilkan di sini</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Kontak Klub -->
        <div id="kontak-klub" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-telephone-fill"></i> Kontak Klub</h3>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="bi bi-info-circle-fill me-3" style="font-size: 1.5rem;"></i>
                        <div>
                            Berikut adalah informasi kontak lengkap klub-klub tenis meja di Sumatera Barat. Untuk informasi lebih lanjut, silakan hubungi langsung klub yang bersangkutan.
                        </div>
                    </div>
                </div>
            </div>

            <?php if (!empty($klub)): ?>
                <div class="row g-3">
                    <?php foreach ($klub as $k): ?>
                        <div class="col-md-6">
                            <div class="kontak-card">
                                <div class="kontak-header">
                                    <div class="kontak-icon">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <div class="kontak-title"><?= esc($k['nama']) ?></div>
                                </div>
                                <div class="kontak-info">
                                    <i class="bi bi-geo-alt"></i>
                                    <?= esc($k['alamat'] ?? 'Alamat belum tersedia') ?>
                                </div>
                                <?php if (!empty($k['penanggung_jawab'])): ?>
                                    <div class="kontak-info">
                                        <i class="bi bi-person"></i>
                                        PJ: <?= esc($k['penanggung_jawab']) ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($k['telepon'])): ?>
                                    <div class="kontak-info">
                                        <i class="bi bi-telephone"></i>
                                        <a href="tel:<?= esc($k['telepon']) ?>" style="color: #1E90FF; text-decoration: none;">
                                            <?= esc($k['telepon']) ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-telephone-x"></i>
                    <h5>Belum ada data kontak klub</h5>
                    <p>Informasi kontak klub akan ditampilkan di sini</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Syarat Pendirian Klub Baru -->
        <div id="syarat-pendirian" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-clipboard-check-fill"></i> Syarat Pendirian Klub Baru</h3>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <p style="color: #555; font-size: 1rem; line-height: 1.8;">
                        Untuk mendirikan klub tenis meja baru yang terdaftar di PTMSI Sumatera Barat, berikut adalah persyaratan dan prosedur yang harus dipenuhi:
                    </p>
                </div>
            </div>

            <div class="syarat-list">
                <div class="syarat-item">
                    <div class="syarat-number">1</div>
                    <div class="syarat-content">
                        <strong>Surat Permohonan Pendirian Klub</strong><br>
                        Mengajukan surat permohonan pendirian klub yang ditujukan kepada Ketua Umum PTMSI Sumatera Barat dengan melampirkan proposal kegiatan klub.
                    </div>
                </div>

                <div class="syarat-item">
                    <div class="syarat-number">2</div>
                    <div class="syarat-content">
                        <strong>Akta Pendirian Klub</strong><br>
                        Memiliki akta pendirian klub yang telah disahkan oleh notaris dan terdaftar di instansi terkait.
                    </div>
                </div>

                <div class="syarat-item">
                    <div class="syarat-number">3</div>
                    <div class="syarat-content">
                        <strong>Struktur Kepengurusan</strong><br>
                        Memiliki struktur kepengurusan yang jelas minimal terdiri dari Ketua, Sekretaris, dan Bendahara dengan melampirkan fotokopi KTP pengurus.
                    </div>
                </div>

                <div class="syarat-item">
                    <div class="syarat-number">4</div>
                    <div class="syarat-content">
                        <strong>Anggota Minimal</strong><br>
                        Memiliki minimal 10 (sepuluh) orang anggota aktif dengan melampirkan daftar nama, alamat, dan fotokopi KTP anggota.
                    </div>
                </div>

                <div class="syarat-item">
                    <div class="syarat-number">5</div>
                    <div class="syarat-content">
                        <strong>Sarana dan Prasarana</strong><br>
                        Memiliki atau memiliki akses ke sarana latihan berupa meja tenis meja standar minimal 2 (dua) meja beserta perlengkapannya.
                    </div>
                </div>

                <div class="syarat-item">
                    <div class="syarat-number">6</div>
                    <div class="syarat-content">
                        <strong>Program Kerja</strong><br>
                        Menyusun program kerja klub untuk jangka waktu minimal 1 (satu) tahun yang mencakup kegiatan latihan rutin dan target prestasi.
                    </div>
                </div>

                <div class="syarat-item">
                    <div class="syarat-number">7</div>
                    <div class="syarat-content">
                        <strong>Rekomendasi</strong><br>
                        Mendapatkan rekomendasi dari PTMSI Kabupaten/Kota setempat (jika ada) atau langsung dari PTMSI Provinsi Sumatera Barat.
                    </div>
                </div>

                <div class="syarat-item">
                    <div class="syarat-number">8</div>
                    <div class="syarat-content">
                        <strong>Biaya Administrasi</strong><br>
                        Membayar biaya administrasi pendaftaran klub sesuai dengan ketentuan yang berlaku di PTMSI Sumatera Barat.
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-3" style="font-size: 1.5rem;"></i>
                    <div>
                        <strong>Informasi Lebih Lanjut:</strong> Untuk konsultasi dan pengajuan pendirian klub baru, silakan hubungi Sekretariat PTMSI Sumbar di <strong>0812-3456-7890</strong> atau email ke <strong>sekretariat@ptmsisumbar.or.id</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Database Wasit & Ofisial Pertandingan -->
        <div id="database-wasit" class="section-card">
            <div class="section-header">
                <h3><i class="bi bi-flag-fill"></i> Database Wasit & Ofisial Pertandingan</h3>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill me-3" style="font-size: 1.5rem;"></i>
                        <div>
                            Database wasit dan ofisial pertandingan tenis meja yang terdaftar dan bersertifikat di PTMSI Sumatera Barat.
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <?php if (!empty($wasit)): ?>
                    <table class="wasit-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Lisensi</th>
                                <th>Kab/Kota</th>
                                <th>Kontak</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($wasit as $w): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <div class="avatar-cell">
                                            <img src="<?= base_url('assets/img/orang.jpg') ?>"
                                                alt="<?= esc($w['nama']) ?>">
                                            <div class="name-info">
                                                <span class="name"><?= esc($w['nama']) ?></span>
                                                <span class="sub-info"><?= esc($w['jenis']) ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if ($w['jenis'] == 'Wasit'): ?>
                                            <i class="bi bi-flag-fill text-primary"></i> Wasit
                                        <?php else: ?>
                                            <i class="bi bi-person-badge text-success"></i> Ofisial
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge-lisensi">
                                            <?= esc($w['lisensi']) ?>
                                        </span>
                                    </td>
                                    <td><?= esc($w['kab_kota']) ?></td>
                                    <td>
                                        <?php if (!empty($w['telepon'])): ?>
                                            <i class="bi bi-telephone"></i> <?= esc($w['telepon']) ?>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Aktif</span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="bi bi-flag"></i>
                        <h5>Belum ada data wasit & ofisial</h5>
                        <p>Database wasit dan ofisial akan ditampilkan di sini</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="text-primary mb-3">
                                    <i class="bi bi-flag-fill"></i> Menjadi Wasit
                                </h5>
                                <p class="text-muted">
                                    Untuk menjadi wasit tenis meja bersertifikat, Anda harus mengikuti pelatihan dan ujian sertifikasi yang diselenggarakan oleh PTMSI.
                                </p>
                                <ul class="list-unstyled mt-3">
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Mengikuti Pelatihan Wasit</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Lulus Ujian Teori & Praktik</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Mendapat Sertifikat Lisensi</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="text-success mb-3">
                                    <i class="bi bi-person-badge-fill"></i> Menjadi Ofisial
                                </h5>
                                <p class="text-muted">
                                    Ofisial pertandingan bertugas membantu kelancaran jalannya pertandingan seperti pencatat skor, pengatur jadwal, dan koordinator teknis.
                                </p>
                                <ul class="list-unstyled mt-3">
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Mengikuti Pelatihan Ofisial</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Memahami Sistem Pertandingan</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Mendapat Sertifikat</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

        // Filter klub
        const filterKabKota = document.getElementById('filterKabKota');
        const searchKlub = document.getElementById('searchKlub');
        const klubCards = document.querySelectorAll('.klub-card');

        if (filterKabKota) {
            filterKabKota.addEventListener('change', filterKlubFunction);
        }

        if (searchKlub) {
            searchKlub.addEventListener('input', filterKlubFunction);
        }

        function filterKlubFunction() {
            const kabKotaValue = filterKabKota ? filterKabKota.value.toLowerCase() : '';
            const searchValue = searchKlub ? searchKlub.value.toLowerCase() : '';

            klubCards.forEach(card => {
                const klubText = card.querySelector('.klub-title h4').textContent.toLowerCase();
                const alamatText = card.querySelector('.klub-info').textContent.toLowerCase();

                const matchKabKota = !kabKotaValue || alamatText.includes(kabKotaValue);
                const matchSearch = !searchValue || klubText.includes(searchValue);

                card.style.display = matchKabKota && matchSearch ? 'block' : 'none';
            });
        }
    });
</script>

<?= $this->include('layouts/footer') ?>