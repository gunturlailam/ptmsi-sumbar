<?= $this->extend('user/pelatih/layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-100 py-4 px-3">
    <!-- Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="text-primary mb-3">
                                <i class='bx bx-group me-2'></i>Atlet Binaan
                            </h3>
                            <p class="text-muted mb-0">
                                Kelola dan pantau perkembangan atlet yang Anda latih
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('user/pelatih/dashboard') ?>" class="btn btn-outline-secondary">
                                <i class='bx bx-arrow-back me-2'></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <h6 class="text-muted mb-2">Atlet Aktif</h6>
                    <h3 class="text-primary fw-bold"><?= count($atlet_aktif) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <h6 class="text-muted mb-2">Total Atlet</h6>
                    <h3 class="text-success fw-bold"><?= count($riwayat_atlet) ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <h6 class="text-muted mb-2">Pengalaman</h6>
                    <h3 class="text-info fw-bold"><?= $pelatih['dibuat_pada'] ? (date('Y') - date('Y', strtotime($pelatih['dibuat_pada']))) : 0 ?> Tahun</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <h6 class="text-muted mb-2">Spesialisasi</h6>
                    <h3 class="text-warning fw-bold"><?= esc($pelatih['spesialisasi'] ?? 'Umum') ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Atlet Aktif -->
    <div class="row mb-5">
        <div class="col-12">
            <h5 class="mb-4">
                <i class='bx bx-star me-2'></i>Atlet Aktif (<?= count($atlet_aktif) ?>)
            </h5>

            <?php if (empty($atlet_aktif)): ?>
                <div class="alert alert-info border-0" role="alert">
                    <i class='bx bx-info-circle me-2'></i>
                    <strong>Belum ada atlet aktif</strong>. Mulai latih atlet baru untuk memulai.
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($atlet_aktif as $atlet): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <!-- Header -->
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar me-3" style="width: 50px; height: 50px; background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 fw-bold"><?= esc($atlet['nama_lengkap']) ?></h6>
                                            <small class="text-muted"><?= esc($atlet['kategori_usia'] ?? '-') ?></small>
                                        </div>
                                    </div>

                                    <!-- Info -->
                                    <div class="mb-3">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <small class="text-muted">Ranking</small>
                                                <div class="fw-bold text-primary">
                                                    <?= $atlet['posisi'] ? '#' . $atlet['posisi'] : '-' ?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted">Poin</small>
                                                <div class="fw-bold text-success">
                                                    <?= $atlet['poin'] ?? 0 ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Durasi Latihan -->
                                    <div class="alert alert-light py-2 px-3 mb-3" style="border-radius: 10px; font-size: 0.85rem;">
                                        <i class="fas fa-calendar me-1"></i>
                                        Sejak <?= date('d/m/Y', strtotime($atlet['tanggal_mulai'])) ?>
                                    </div>

                                    <!-- Catatan -->
                                    <?php if (!empty($atlet['catatan'])): ?>
                                        <div class="alert alert-info py-2 px-3 mb-3" style="border-radius: 10px; font-size: 0.85rem;">
                                            <i class="fas fa-sticky-note me-1"></i>
                                            <?= esc(substr($atlet['catatan'], 0, 50)) ?>...
                                        </div>
                                    <?php endif; ?>

                                    <!-- Action -->
                                    <a href="<?= base_url('user/pelatih/atlet-detail/' . $atlet['id_atlet']) ?>"
                                        class="btn btn-sm btn-primary w-100" style="border-radius: 10px;">
                                        <i class='bx bx-show me-1'></i>Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Riwayat Atlet -->
    <div class="row">
        <div class="col-12">
            <h5 class="mb-4">
                <i class='bx bx-history me-2'></i>Riwayat Atlet (<?= count($riwayat_atlet) ?>)
            </h5>

            <?php if (empty($riwayat_atlet)): ?>
                <div class="alert alert-info border-0" role="alert">
                    <i class='bx bx-info-circle me-2'></i>
                    <strong>Belum ada riwayat</strong>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Atlet</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Status</th>
                                <th>Durasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($riwayat_atlet as $atlet): ?>
                                <tr>
                                    <td>
                                        <strong><?= esc($atlet['nama_lengkap']) ?></strong>
                                    </td>
                                    <td>
                                        <?= date('d/m/Y', strtotime($atlet['tanggal_mulai'])) ?>
                                    </td>
                                    <td>
                                        <?= $atlet['tanggal_selesai'] ? date('d/m/Y', strtotime($atlet['tanggal_selesai'])) : '-' ?>
                                    </td>
                                    <td>
                                        <?php
                                        $statusClass = match ($atlet['status']) {
                                            'aktif' => 'bg-success',
                                            'selesai' => 'bg-info',
                                            'berhenti' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                        $statusLabel = match ($atlet['status']) {
                                            'aktif' => 'Aktif',
                                            'selesai' => 'Selesai',
                                            'berhenti' => 'Berhenti',
                                            default => 'Tidak Diketahui'
                                        };
                                        ?>
                                        <span class="badge <?= $statusClass ?>">
                                            <?= $statusLabel ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                        $tanggalSelesai = $atlet['tanggal_selesai'] ?? date('Y-m-d');
                                        $durasi = date_diff(
                                            date_create($atlet['tanggal_mulai']),
                                            date_create($tanggalSelesai)
                                        )->days;
                                        echo $durasi . ' hari';
                                        ?>
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

<?= $this->endSection() ?>