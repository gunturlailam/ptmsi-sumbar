<?= $this->extend('user/pelatih/layouts/main') ?>

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
                                Kelola atlet binaan dan sertifikasi Anda dengan mudah.
                                <?php if (isset($pelatih['tingkat_sertifikasi'])): ?>
                                    <br><span class="fw-bold text-info">Sertifikasi: <?= esc($pelatih['tingkat_sertifikasi']) ?></span>
                                <?php endif; ?>
                            </p>
                            <div class="d-flex gap-3">
                                <a href="<?= base_url('user/pelatih/atlet-binaan') ?>" class="btn btn-primary">
                                    <i class='bx bx-group me-2'></i>Atlet Binaan
                                </a>
                                <a href="<?= base_url('user/pelatih/profil') ?>" class="btn btn-outline-info">
                                    <i class='bx bx-user me-2'></i>Profil Saya
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="position-relative">
                                <i class='bx bx-award display-1 text-primary opacity-25'></i>
                                <div class="position-absolute top-50 start-50 translate-middle">
                                    <i class='bx bx-medal display-4 text-success'></i>
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
                                <i class='bx bx-group text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Atlet Binaan</h6>
                            <h3 class="mb-0"><?= $statistik['total_atlet'] ?></h3>
                            <small class="text-success">
                                <i class='bx bx-up-arrow-alt'></i> Aktif
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
                                <i class='bx bx-award text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Sertifikasi</h6>
                            <h3 class="mb-0"><?= $statistik['total_sertifikasi'] ?></h3>
                            <small class="text-success">
                                <i class='bx bx-check'></i> Aktif
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
                                <i class='bx bx-trophy text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Atlet Juara</h6>
                            <h3 class="mb-0"><?= $statistik['atlet_juara'] ?></h3>
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
                                <i class='bx bx-calendar text-white fs-4'></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Pengalaman</h6>
                            <h3 class="mb-0"><?= $statistik['tahun_pengalaman'] ?> Thn</h3>
                            <small class="text-warning">
                                <i class='bx bx-trending-up'></i> Profesional
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
            <a href="<?= base_url('user/pelatih/profil') ?>" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 menu-card" style="transition: all 0.3s ease;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <div class="bg-primary bg-gradient rounded-3 p-3 d-inline-block">
                                <i class='bx bx-user text-white fs-3'></i>
                            </div>
                        </div>
                        <h5 class="card-title mb-2">Profil Pelatih</h5>
                        <p class="card-text text-muted small">Kelola data pribadi dan informasi pelatih</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4">
            <a href="<?= base_url('user/pelatih/sertifikasi') ?>" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 menu-card" style="transition: all 0.3s ease;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <div class="bg-success bg-gradient rounded-3 p-3 d-inline-block">
                                <i class='bx bx-award text-white fs-3'></i>
                            </div>
                        </div>
                        <h5 class="card-title mb-2">Sertifikasi</h5>
                        <p class="card-text text-muted small">Lihat dan kelola sertifikasi Anda</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4">
            <a href="<?= base_url('user/pelatih/atlet-binaan') ?>" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 menu-card" style="transition: all 0.3s ease;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <div class="bg-info bg-gradient rounded-3 p-3 d-inline-block">
                                <i class='bx bx-group text-white fs-3'></i>
                            </div>
                        </div>
                        <h5 class="card-title mb-2">Atlet Binaan</h5>
                        <p class="card-text text-muted small">Kelola daftar atlet yang Anda latih</p>
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