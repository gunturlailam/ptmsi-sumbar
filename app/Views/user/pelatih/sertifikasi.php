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
                                <i class='bx bx-award me-2'></i>Sertifikasi Pelatih
                            </h3>
                            <p class="text-muted mb-0">
                                Kelola sertifikasi dan lisensi pelatih Anda
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

    <!-- Sertifikasi Aktif -->
    <div class="row mb-5">
        <div class="col-12">
            <h5 class="mb-4">
                <i class='bx bx-check-circle me-2'></i>Sertifikasi Aktif
            </h5>

            <?php if (empty($sertifikasi_aktif)): ?>
                <div class="alert alert-info border-0" role="alert">
                    <i class='bx bx-info-circle me-2'></i>
                    <strong>Belum ada sertifikasi aktif</strong>. Hubungi admin untuk menambahkan sertifikasi.
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($sertifikasi_aktif as $sert): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <div class="mb-3">
                                        <span class="badge bg-success">
                                            <i class='bx bx-check me-1'></i>Aktif
                                        </span>
                                    </div>
                                    <h5 class="card-title mb-2">
                                        <?= esc($sert['jenis_sertifikasi']) ?>
                                    </h5>
                                    <p class="card-text text-muted small mb-3">
                                        <i class='bx bx-calendar me-1'></i>
                                        Dikeluarkan: <?= date('d/m/Y', strtotime($sert['tanggal_dikeluarkan'])) ?>
                                    </p>
                                    <?php if ($sert['tanggal_kadaluarsa']): ?>
                                        <p class="card-text text-muted small mb-3">
                                            <i class='bx bx-time me-1'></i>
                                            Kadaluarsa: <?= date('d/m/Y', strtotime($sert['tanggal_kadaluarsa'])) ?>
                                        </p>
                                    <?php endif; ?>
                                    <?php if ($sert['file_url']): ?>
                                        <a href="<?= base_url($sert['file_url']) ?>" target="_blank" class="btn btn-sm btn-outline-primary w-100">
                                            <i class='bx bx-download me-1'></i>Unduh Sertifikat
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Riwayat Sertifikasi -->
    <div class="row">
        <div class="col-12">
            <h5 class="mb-4">
                <i class='bx bx-history me-2'></i>Riwayat Sertifikasi
            </h5>

            <?php if (empty($sertifikasi_riwayat)): ?>
                <div class="alert alert-info border-0" role="alert">
                    <i class='bx bx-info-circle me-2'></i>
                    <strong>Belum ada riwayat sertifikasi</strong>.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Jenis Sertifikasi</th>
                                <th>Dikeluarkan</th>
                                <th>Kadaluarsa</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sertifikasi_riwayat as $sert): ?>
                                <tr>
                                    <td>
                                        <strong><?= esc($sert['jenis_sertifikasi']) ?></strong>
                                    </td>
                                    <td>
                                        <?= date('d/m/Y', strtotime($sert['tanggal_dikeluarkan'])) ?>
                                    </td>
                                    <td>
                                        <?= $sert['tanggal_kadaluarsa'] ? date('d/m/Y', strtotime($sert['tanggal_kadaluarsa'])) : '-' ?>
                                    </td>
                                    <td>
                                        <?php
                                        $status = 'Aktif';
                                        $badgeClass = 'bg-success';
                                        if ($sert['tanggal_kadaluarsa'] && strtotime($sert['tanggal_kadaluarsa']) < time()) {
                                            $status = 'Kadaluarsa';
                                            $badgeClass = 'bg-danger';
                                        }
                                        ?>
                                        <span class="badge <?= $badgeClass ?>">
                                            <?= $status ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($sert['file_url']): ?>
                                            <a href="<?= base_url($sert['file_url']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class='bx bx-download'></i>
                                            </a>
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
<?= $this->endSection() ?>