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
                                <i class='bx bx-chart-line me-2'></i>Ranking Pribadi
                            </h3>
                            <p class="text-muted mb-0">
                                Lihat peringkat dan perkembangan Anda
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

    <!-- Ranking Info -->
    <div class="row mb-5">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary bg-gradient border-0">
                    <h5 class="text-white mb-0">
                        <i class='bx bx-medal me-2'></i>Riwayat Ranking
                    </h5>
                </div>
                <div class="card-body p-4">
                    <?php if (empty($ranking)): ?>
                        <div class="alert alert-info border-0" role="alert">
                            <i class='bx bx-info-circle me-2'></i>
                            <strong>Belum ada data ranking</strong>. Data ranking akan muncul setelah Anda mengikuti pertandingan.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Bulan/Tahun</th>
                                        <th>Peringkat</th>
                                        <th>Poin</th>
                                        <th>Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ranking as $rank): ?>
                                        <tr>
                                            <td>
                                                <strong>
                                                    <?= date('F Y', mktime(0, 0, 0, $rank['bulan'], 1, $rank['tahun'])) ?>
                                                </strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">
                                                    #<?= $rank['peringkat'] ?? '-' ?>
                                                </span>
                                            </td>
                                            <td>
                                                <strong><?= $rank['poin'] ?? 0 ?></strong>
                                            </td>
                                            <td>
                                                <?= esc($rank['kategori'] ?? '-') ?>
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

        <!-- Info Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info bg-gradient border-0">
                    <h5 class="text-white mb-0">
                        <i class='bx bx-info-circle me-2'></i>Tentang Ranking
                    </h5>
                </div>
                <div class="card-body p-4">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <i class='bx bx-check text-success me-2'></i>
                            <small><strong>Ranking</strong> diperbarui setiap bulan</small>
                        </li>
                        <li class="mb-3">
                            <i class='bx bx-check text-success me-2'></i>
                            <small><strong>Poin</strong> diperoleh dari hasil pertandingan</small>
                        </li>
                        <li class="mb-3">
                            <i class='bx bx-check text-success me-2'></i>
                            <small><strong>Kategori</strong> berdasarkan usia dan jenis kelamin</small>
                        </li>
                        <li>
                            <i class='bx bx-check text-success me-2'></i>
                            <small><strong>Peringkat</strong> menentukan seeding di turnamen</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-primary) 100%) !important;
    }

    .bg-info.bg-gradient {
        background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%) !important;
    }
</style>
<?= $this->endSection() ?>