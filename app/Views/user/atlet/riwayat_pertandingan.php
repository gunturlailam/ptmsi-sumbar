<?= $this->extend('user/atlet/layouts/main') ?>

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
                                <i class='bx bx-history me-2'></i>Riwayat Pertandingan
                            </h3>
                            <p class="text-muted mb-0">
                                Lihat hasil dan riwayat pertandingan Anda
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="<?= base_url('user/atlet/dashboard') ?>" class="btn btn-outline-secondary">
                                <i class='bx bx-arrow-back me-2'></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Pertandingan -->
    <div class="row">
        <div class="col-12">
            <?php if (empty($riwayat)): ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <i class='bx bx-inbox display-1 text-muted mb-3'></i>
                        <h5 class="text-muted mb-2">Belum ada riwayat pertandingan</h5>
                        <p class="text-muted mb-4">Anda belum mengikuti pertandingan apapun. Daftar turnamen untuk memulai!</p>
                        <a href="<?= base_url('user/atlet/daftar-turnamen') ?>" class="btn btn-primary">
                            <i class='bx bx-trophy me-2'></i>Daftar Turnamen
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($riwayat as $pertandingan): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <h6 class="card-title mb-2">
                                        <?= esc($pertandingan['nama_event'] ?? 'Turnamen') ?>
                                    </h6>
                                    <p class="card-text text-muted small mb-3">
                                        <i class='bx bx-calendar me-1'></i>
                                        <?= isset($pertandingan['tanggal_mulai']) ? date('d/m/Y', strtotime($pertandingan['tanggal_mulai'])) : '-' ?>
                                    </p>

                                    <div class="mb-3 p-3 bg-light rounded">
                                        <small class="text-muted d-block mb-2">Hasil Pertandingan</small>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-bold">Anda</span>
                                            <span class="badge bg-secondary">vs</span>
                                            <span class="fw-bold">Lawan</span>
                                        </div>
                                    </div>

                                    <a href="<?= base_url('event/bracket/' . ($pertandingan['id_event'] ?? '#')) ?>" class="btn btn-sm btn-outline-primary w-100">
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