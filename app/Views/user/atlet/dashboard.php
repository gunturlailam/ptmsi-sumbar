<?= $this->extend('user/atlet/layouts/main') ?>

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
                                <i class='bx bx-smile me-2'></i>Selamat Datang, <?= esc($user['nama_lengkap']) ?>! 🎉
                            </h3>
                            <p class="text-muted mb-4 fs-5">
                                Semoga hari ini menyenangkan! Mari kita raih prestasi terbaik.
                                <?php if (isset($atlet['nama_klub'])): ?>
                                    <br><span class="fw-bold text-info">Klub: <?= esc($atlet['nama_klub']) ?></span>
                                <?php endif; ?>
                            </p>
                            <div class="d-flex gap-3">
                                <a href="<?= base_url('user/atlet/daftar-turnamen') ?>" class="btn btn-primary">
                                    <i class='bx bx-trophy me-2'></i>Daftar Turnamen
                                </a>
                                <a href="<?= base_url('user/atlet/profil') ?>" class="btn btn-outline-info">
                                    <i class='bx bx-user me-2'></i>Profil Saya
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="position-relative">
                                <i class='bx bx-trophy display-1 text-primary opacity-25'></i>
                                <div class="position-absolute top-50 start-50 translate-middle">
                                    <i class='bx bx-run display-4 text-success'></i>
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
                                <i class='bx bx-trophy text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Turnamen</h6>
                            <h3 class="mb-0"><?= $statistik['total_turnamen'] ?></h3>
                            <small class="text-success">
                                <i class='bx bx-up-arrow-alt'></i> Diikuti
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
                                <i class='bx bx-fist-raised text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Pertandingan</h6>
                            <h3 class="mb-0"><?= $statistik['total_pertandingan'] ?></h3>
                            <small class="text-success">
                                <i class='bx bx-check'></i> Selesai
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
                                <i class='bx bx-medal text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Kemenangan</h6>
                            <h3 class="mb-0"><?= $statistik['menang'] ?></h3>
                            <small class="text-info">
                                <i class='bx bx-star'></i> Prestasi
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
                                <i class='bx bx-chart-line text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Win Rate</h6>
                            <h3 class="mb-0"><?= $statistik['win_rate'] ?>%</h3>
                            <small class="text-warning">
                                <i class='bx bx-trending-up'></i> Performa
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Navigasi -->
    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <a href="<?= base_url('user/atlet/profil') ?>" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 menu-card" style="transition: all 0.3s ease;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <div class="bg-primary bg-gradient rounded-3 p-3 d-inline-block">
                                <i class='bx bx-user text-white fs-3'></i>
                            </div>
                        </div>
                        <h5 class="card-title mb-2">Profil Atlet</h5>
                        <p class="card-text text-muted small">Kelola data pribadi dan informasi atlet</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4">
            <a href="<?= base_url('user/atlet/kartu') ?>" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 menu-card" style="transition: all 0.3s ease;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <div class="bg-success bg-gradient rounded-3 p-3 d-inline-block">
                                <i class='bx bx-id-card text-white fs-3'></i>
                            </div>
                        </div>
                        <h5 class="card-title mb-2">Kartu Atlet</h5>
                        <p class="card-text text-muted small">Lihat dan unduh kartu identitas atlet</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4">
            <a href="<?= base_url('user/atlet/daftar-turnamen') ?>" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 menu-card" style="transition: all 0.3s ease;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <div class="bg-warning bg-gradient rounded-3 p-3 d-inline-block">
                                <i class='bx bx-trophy text-white fs-3'></i>
                            </div>
                        </div>
                        <h5 class="card-title mb-2">Daftar Turnamen</h5>
                        <p class="card-text text-muted small">Daftar dan ikuti turnamen tersedia</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4">
            <a href="<?= base_url('user/atlet/riwayat-pertandingan') ?>" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 menu-card" style="transition: all 0.3s ease;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <div class="bg-danger bg-gradient rounded-3 p-3 d-inline-block">
                                <i class='bx bx-history text-white fs-3'></i>
                            </div>
                        </div>
                        <h5 class="card-title mb-2">Riwayat Pertandingan</h5>
                        <p class="card-text text-muted small">Lihat hasil dan riwayat pertandingan</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4">
            <a href="<?= base_url('user/atlet/ranking-pribadi') ?>" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 menu-card" style="transition: all 0.3s ease;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <div class="bg-info bg-gradient rounded-3 p-3 d-inline-block">
                                <i class='bx bx-chart-line text-white fs-3'></i>
                            </div>
                        </div>
                        <h5 class="card-title mb-2">Ranking Pribadi</h5>
                        <p class="card-text text-muted small">Lihat peringkat dan perkembangan</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
    .menu-card:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
    }
</style>
<?= $this->endSection() ?>