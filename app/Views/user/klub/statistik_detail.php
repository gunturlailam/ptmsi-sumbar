<?= $this->extend('user/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-xxl py-4">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="text-primary mb-3">
                                <i class='bx bx-bar-chart me-2'></i>Statistik Detail Klub
                            </h3>
                            <p class="text-muted mb-0">
                                Analisis mendalam data klub Anda
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('user/klub/dashboard') ?>" class="btn btn-outline-secondary">
                                <i class='bx bx-arrow-back me-2'></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Utama -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1">Total Atlet Aktif</p>
                            <h3 class="text-primary mb-0"><?= $total_atlet ?></h3>
                        </div>
                        <div class="text-primary" style="font-size: 2.5rem; opacity: 0.2;">
                            <i class='bx bx-user'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1">Total Pelatih</p>
                            <h3 class="text-success mb-0"><?= $total_pelatih ?></h3>
                        </div>
                        <div class="text-success" style="font-size: 2.5rem; opacity: 0.2;">
                            <i class='bx bx-user-check'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1">Turnamen Diikuti</p>
                            <h3 class="text-info mb-0"><?= count($turnamen_diikuti) ?></h3>
                        </div>
                        <div class="text-info" style="font-size: 2.5rem; opacity: 0.2;">
                            <i class='bx bx-trophy'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1">Total Medali</p>
                            <h3 class="text-warning mb-0"><?= count($medali) ?></h3>
                        </div>
                        <div class="text-warning" style="font-size: 2.5rem; opacity: 0.2;">
                            <i class='bx bx-medal'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Atlet per Kategori Usia -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0">
                        <i class='bx bx-pie-chart me-2'></i>Atlet per Kategori Usia
                    </h5>
                </div>
                <div class="card-body p-4">
                    <?php if (empty($atlet_per_kategori)): ?>
                        <p class="text-muted text-center mb-0">Tidak ada data</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kategori</th>
                                        <th class="text-end">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($atlet_per_kategori as $row): ?>
                                        <tr>
                                            <td><?= esc($row['kategori_usia']) ?></td>
                                            <td class="text-end">
                                                <span class="badge bg-primary"><?= $row['total'] ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Atlet per Gender -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0">
                        <i class='bx bx-pie-chart me-2'></i>Atlet per Gender
                    </h5>
                </div>
                <div class="card-body p-4">
                    <?php if (empty($atlet_per_gender)): ?>
                        <p class="text-muted text-center mb-0">Tidak ada data</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Gender</th>
                                        <th class="text-end">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($atlet_per_gender as $row): ?>
                                        <tr>
                                            <td>
                                                <?= $row['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge bg-success"><?= $row['total'] ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Top 10 Atlet -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0">
                        <i class='bx bx-star me-2'></i>Top 10 Atlet Terbaik
                    </h5>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($top_atlet)): ?>
                        <div class="p-4 text-center text-muted">
                            Tidak ada data atlet
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Peringkat</th>
                                        <th>Nama Atlet</th>
                                        <th>Kategori Usia</th>
                                        <th class="text-end">Poin</th>
                                        <th class="text-end">Posisi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($top_atlet as $atlet): ?>
                                        <tr>
                                            <td>
                                                <span class="badge bg-primary"><?= $no++ ?></span>
                                            </td>
                                            <td><?= esc($atlet['nama_lengkap']) ?></td>
                                            <td><?= esc($atlet['kategori_usia']) ?></td>
                                            <td class="text-end">
                                                <strong><?= $atlet['poin'] ?? 0 ?></strong>
                                            </td>
                                            <td class="text-end">
                                                <?php if ($atlet['posisi']): ?>
                                                    <span class="badge bg-warning">#<?= $atlet['posisi'] ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Turnamen yang Diikuti -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0">
                        <i class='bx bx-list-check me-2'></i>Turnamen yang Diikuti
                    </h5>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($turnamen_diikuti)): ?>
                        <div class="p-4 text-center text-muted">
                            Belum mengikuti turnamen
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Turnamen</th>
                                        <th class="text-end">Jumlah Atlet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($turnamen_diikuti as $turnamen): ?>
                                        <tr>
                                            <td><?= esc($turnamen['nama_event']) ?></td>
                                            <td class="text-end">
                                                <span class="badge bg-info"><?= $turnamen['jumlah_atlet'] ?> atlet</span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Medali yang Diraih -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0">
                        <i class='bx bx-medal me-2'></i>Medali yang Diraih
                    </h5>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($medali)): ?>
                        <div class="p-4 text-center text-muted">
                            Belum ada medali yang diraih
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Jenis Medali</th>
                                        <th class="text-end">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($medali as $medal): ?>
                                        <tr>
                                            <td>
                                                <?php
                                                $badgeClass = match ($medal['jenis_medali']) {
                                                    'Emas' => 'bg-warning',
                                                    'Perak' => 'bg-secondary',
                                                    'Perunggu' => 'bg-danger',
                                                    default => 'bg-secondary'
                                                };
                                                ?>
                                                <span class="badge <?= $badgeClass ?>"><?= $medal['jenis_medali'] ?></span>
                                            </td>
                                            <td class="text-end">
                                                <strong><?= $medal['total'] ?></strong>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Options -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0 p-4">
                    <h5 class="mb-0">
                        <i class='bx bx-download me-2'></i>Opsi Ekspor Data
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="<?= base_url('user/klub/export-atlet-csv') ?>" class="btn btn-outline-primary w-100">
                                <i class='bx bx-file me-2'></i>Export Data Atlet (CSV)
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= base_url('user/klub/export-pelatih-csv') ?>" class="btn btn-outline-success w-100">
                                <i class='bx bx-file me-2'></i>Export Data Pelatih (CSV)
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= base_url('user/klub/export-laporan-pdf') ?>" class="btn btn-outline-danger w-100">
                                <i class='bx bx-file me-2'></i>Export Laporan (PDF)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>