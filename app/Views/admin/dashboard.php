<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-100 py-4 px-3">
    <!-- Welcome Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="text-primary mb-3">
                                <i class='bx bx-smile me-2'></i>Selamat Datang, Admin PTMSI Sumbar! 🎉
                            </h3>
                            <p class="text-muted mb-4 fs-5">
                                Semoga hari ini menyenangkan! Mari kita kelola PTMSI Sumbar dengan semangat.
                                <br><span class="fw-bold text-warning">Anda memiliki <?= $statistik['pendaftaran_atlet_pending'] + $statistik['pendaftaran_pelatih_pending'] ?> pendaftaran</span> yang menunggu persetujuan.
                            </p>
                            <div class="d-flex gap-3">
                                <a href="<?= base_url('admin/pendaftaran/atlet') ?>" class="btn btn-primary">
                                    <i class='bx bx-user-plus me-2'></i>Lihat Pendaftaran
                                </a>
                                <a href="<?= base_url('admin/event') ?>" class="btn btn-outline-info">
                                    <i class='bx bx-trophy me-2'></i>Kelola Event
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="position-relative">
                                <i class='bx bx-trophy display-1 text-primary opacity-25'></i>
                                <div class="position-absolute top-50 start-50 translate-middle">
                                    <i class='bx bx-table-tennis display-4 text-warning'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-gradient rounded-3 p-3">
                                <i class='bx bx-buildings text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Klub</h6>
                            <h3 class="mb-0"><?= $statistik['total_klub'] ?></h3>
                            <small class="text-success">
                                <i class='bx bx-up-arrow-alt'></i> <?= $statistik['klub_aktif'] ?> Aktif
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-gradient rounded-3 p-3">
                                <i class='bx bx-user text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Atlet</h6>
                            <h3 class="mb-0"><?= $statistik['total_atlet'] ?></h3>
                            <small class="text-success">
                                <i class='bx bx-check'></i> Terdaftar
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-gradient rounded-3 p-3">
                                <i class='bx bx-user-check text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Pelatih</h6>
                            <h3 class="mb-0"><?= $statistik['total_pelatih'] ?></h3>
                            <small class="text-info">
                                <i class='bx bx-medal'></i> Bersertifikat
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-gradient rounded-3 p-3">
                                <i class='bx bx-time-five text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Pendaftaran Pending</h6>
                            <h3 class="mb-0"><?= $statistik['pendaftaran_atlet_pending'] + $statistik['pendaftaran_pelatih_pending'] ?></h3>
                            <small class="text-warning">
                                <i class='bx bx-hourglass'></i> Menunggu Verifikasi
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="row g-4 mb-5">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-gradient rounded-3 p-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <i class='bx bx-trophy text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Event Aktif</h6>
                            <h3 class="mb-0"><?= $statistik['event_aktif'] ?></h3>
                            <small class="text-primary">
                                <i class='bx bx-calendar'></i> Turnamen Berlangsung
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-gradient rounded-3 p-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                <i class='bx bx-news text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Berita</h6>
                            <h3 class="mb-0"><?= $statistik['total_berita'] ?></h3>
                            <small class="text-danger">
                                <i class='bx bx-edit'></i> Artikel Dipublikasi
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activity -->
    <div class="row g-4 mb-5">
        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 pb-0">
                    <h5 class="card-title mb-1">
                        <i class='bx bx-zap text-primary me-2'></i>Aksi Cepat
                    </h5>
                    <p class="text-muted small mb-0">Hal yang sering dilakukan</p>
                </div>
                <div class="card-body pt-3">
                    <div class="d-grid gap-3">
                        <a href="<?= base_url('admin/pendaftaran/atlet/pending') ?>" class="btn btn-outline-primary btn-lg position-relative">
                            <i class='bx bx-user-plus me-2'></i>Verifikasi Atlet
                            <?php if ($statistik['pendaftaran_atlet_pending'] > 0): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?= $statistik['pendaftaran_atlet_pending'] ?>
                                </span>
                            <?php endif; ?>
                        </a>
                        <a href="<?= base_url('admin/pendaftaran/pelatih/pending') ?>" class="btn btn-outline-success btn-lg position-relative">
                            <i class='bx bx-user-check me-2'></i>Verifikasi Pelatih
                            <?php if ($statistik['pendaftaran_pelatih_pending'] > 0): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?= $statistik['pendaftaran_pelatih_pending'] ?>
                                </span>
                            <?php endif; ?>
                        </a>
                        <a href="<?= base_url('admin/generate-matches') ?>" class="btn btn-outline-danger btn-lg">
                            <i class='bx bx-dice me-2'></i>Generate Pertandingan
                        </a>
                        <a href="<?= base_url('admin/hasil-pertandingan') ?>" class="btn btn-outline-warning btn-lg">
                            <i class='bx bx-trophy me-2'></i>Input Hasil
                        </a>
                        <a href="<?= base_url('admin/event') ?>" class="btn btn-outline-info btn-lg">
                            <i class='bx bx-trophy me-2'></i>Kelola Event
                        </a>
                        <a href="<?= base_url('admin/berita') ?>" class="btn btn-outline-warning btn-lg">
                            <i class='bx bx-news me-2'></i>Tulis Berita
                        </a>
                        <hr>
                        <a href="<?= base_url('admin/analytics') ?>" class="btn btn-outline-secondary btn-lg">
                            <i class='bx bx-bar-chart me-2'></i>Analytics Dashboard
                        </a>
                        <a href="<?= base_url('admin/analytics/audit-log') ?>" class="btn btn-outline-secondary btn-lg">
                            <i class='bx bx-history me-2'></i>Audit Log
                        </a>
                        <a href="<?= base_url('admin/analytics/approval-workflow') ?>" class="btn btn-outline-secondary btn-lg">
                            <i class='bx bx-check-double me-2'></i>Approval Workflow
                        </a>
                        <a href="<?= base_url('admin/analytics/backup') ?>" class="btn btn-outline-secondary btn-lg">
                            <i class='bx bx-save me-2'></i>Backup & Export
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Events -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">
                            <i class='bx bx-calendar text-info me-2'></i>Event Mendatang
                        </h5>
                        <p class="text-muted small mb-0">Turnamen yang akan datang</p>
                    </div>
                    <a href="<?= base_url('admin/event') ?>" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="card-body pt-3">
                    <?php if (!empty($eventMendatang)): ?>
                        <div class="list-group list-group-flush">
                            <?php foreach ($eventMendatang as $event): ?>
                                <div class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-primary bg-gradient rounded-circle p-2">
                                                <i class='bx bx-trophy text-white'></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1"><?= esc($event['nama_event']) ?></h6>
                                            <small class="text-muted">
                                                <i class='bx bx-calendar me-1'></i><?= date('d M Y', strtotime($event['tanggal_mulai'])) ?>
                                            </small>
                                            <br>
                                            <span class="badge bg-<?= $event['status'] == 'aktif' ? 'success' : 'secondary' ?> mt-1">
                                                <?= ucfirst($event['status']) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class='bx bx-calendar-x display-4 text-muted mb-3'></i>
                            <p class="text-muted">Belum ada event mendatang</p>
                            <a href="<?= base_url('admin/event') ?>" class="btn btn-sm btn-primary">Buat Event Baru</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Recent News -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">
                            <i class='bx bx-news text-warning me-2'></i>Berita Terbaru
                        </h5>
                        <p class="text-muted small mb-0">Artikel yang dipublikasi</p>
                    </div>
                    <a href="<?= base_url('admin/berita') ?>" class="btn btn-sm btn-outline-primary">Kelola</a>
                </div>
                <div class="card-body pt-3">
                    <?php if (!empty($beritaTerbaru)): ?>
                        <div class="list-group list-group-flush">
                            <?php foreach ($beritaTerbaru as $berita): ?>
                                <div class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="bg-warning bg-gradient rounded-circle p-2">
                                                <i class='bx bx-news text-white'></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1"><?= esc(substr($berita['judul'], 0, 40)) ?>...</h6>
                                            <small class="text-muted">
                                                <i class='bx bx-time me-1'></i><?= date('d M Y', strtotime($berita['tanggal_publikasi'])) ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class='bx bx-news display-4 text-muted mb-3'></i>
                            <p class="text-muted">Belum ada berita</p>
                            <a href="<?= base_url('admin/berita') ?>" class="btn btn-sm btn-primary">Tulis Berita</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Motivational Footer -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class='bx bx-table-tennis display-3 text-white mb-3'></i>
                    </div>
                    <h4 class="text-white mb-3">
                        <i class='bx bx-heart me-2'></i>Semangat Mengelola PTMSI Sumbar!
                    </h4>
                    <p class="text-white-50 mb-4 fs-5 mx-auto" style="max-width: 600px;">
                        "Olahraga tenis meja bukan hanya tentang kemenangan, tapi tentang membangun karakter dan sportivitas.
                        Terima kasih sudah berkontribusi untuk kemajuan tenis meja Sumatera Barat!"
                    </p>
                    <div class="d-flex justify-content-center gap-3">
                        <span class="badge bg-white text-primary px-3 py-2">
                            <i class='bx bx-trophy me-1'></i>Prestasi
                        </span>
                        <span class="badge bg-white text-primary px-3 py-2">
                            <i class='bx bx-heart me-1'></i>Sportivitas
                        </span>
                        <span class="badge bg-white text-primary px-3 py-2">
                            <i class='bx bx-group me-1'></i>Kebersamaan
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>