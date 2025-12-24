<?= $this->extend('layouts/public_main') ?>

<?= $this->section('content') ?>
<div class="container-xxl py-5">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="text-primary mb-2">
                        <i class='bx bx-star me-2'></i>Atlet Terbaik
                    </h2>
                    <p class="text-muted mb-0">Atlet dengan rating tertinggi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Athletes -->
    <div class="row">
        <div class="col-12">
            <?php if (empty($top_athletes)): ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <i class='bx bx-star display-4 text-muted mb-3'></i>
                        <h5 class="text-muted mb-2">Belum ada data</h5>
                        <p class="text-muted">Atlet terbaik akan ditampilkan setelah ada rating</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php $no = 1;
                    foreach ($top_athletes as $atlet): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-grow-1">
                                            <h5 class="card-title mb-1">
                                                <?php if ($no == 1): ?>
                                                    <span class="badge bg-warning text-dark me-2">🥇</span>
                                                <?php elseif ($no == 2): ?>
                                                    <span class="badge bg-secondary me-2">🥈</span>
                                                <?php elseif ($no == 3): ?>
                                                    <span class="badge bg-danger me-2">🥉</span>
                                                <?php endif; ?>
                                                <a href="<?= base_url('live-scoring/atlet/' . $atlet['id_atlet']) ?>" class="text-decoration-none">
                                                    <?= esc($atlet['nama_lengkap']) ?>
                                                </a>
                                            </h5>
                                            <small class="text-muted"><?= esc($atlet['nama_klub'] ?? '-') ?></small>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-primary">
                                                <i class='bx bx-star'></i>
                                                <?= number_format($atlet['rata_rata'], 2) ?>
                                            </span>
                                            <small class="text-muted"><?= $atlet['total_rating'] ?> rating</small>
                                        </div>
                                    </div>

                                    <div class="rating-display">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class='bx bxs-star' style="color: <?= $i <= round($atlet['rata_rata']) ? '#ffc107' : '#e2e8f0' ?>; font-size: 1.2rem;"></i>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php $no++;
                    endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>