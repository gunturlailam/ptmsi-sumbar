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
                                <i class='bx bx-award me-2'></i>Sertifikasi Pelatih
                            </h3>
                            <p class="text-muted mb-0">
                                Kelola sertifikasi pelatih klub Anda
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

    <!-- Daftar Pelatih dengan Sertifikasi -->
    <div class="row">
        <div class="col-12">
            <?php if (empty($pelatih_sertifikasi)): ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <i class='bx bx-inbox display-1 text-muted mb-3'></i>
                        <h5 class="text-muted mb-2">Belum ada pelatih dengan sertifikasi</h5>
                        <p class="text-muted mb-4">Klub Anda belum memiliki pelatih dengan sertifikasi yang terdaftar.</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($pelatih_sertifikasi as $pelatih): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <div class="mb-3">
                                        <span class="badge bg-success">
                                            <i class='bx bx-check-circle me-1'></i>Aktif
                                        </span>
                                    </div>
                                    <h5 class="card-title mb-2">
                                        <?= esc($pelatih['nama_lengkap']) ?>
                                    </h5>
                                    <p class="card-text text-muted small mb-2">
                                        <i class='bx bx-award me-1'></i>
                                        <?= esc($pelatih['tingkat_sertifikasi'] ?? '-') ?>
                                    </p>
                                    <p class="card-text text-muted small mb-3">
                                        <i class='bx bx-calendar me-1'></i>
                                        Sertifikasi: <?= isset($pelatih['tanggal_sertifikasi']) ? date('d/m/Y', strtotime($pelatih['tanggal_sertifikasi'])) : '-' ?>
                                    </p>
                                    <a href="<?= base_url('user/klub/detail-pelatih/' . $pelatih['id_pelatih']) ?>" class="btn btn-sm btn-outline-primary w-100">
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
</div>
<?= $this->endSection() ?>