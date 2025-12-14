<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%); min-height: 100vh;">
    <!-- Header Dashboard -->
    <div class="row mb-4"></div>
    <div class="col-12">
        <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="mb-2" style="font-weight: 900; color: #003366;">
                            <i class="fas fa-tachometer-alt me-3"></i>Dashboard Atlet
                        </h1>
                        <p class="mb-0" style="font-weight: 500; color: #666;">
                            Selamat datang, <strong><?= esc($user['nama_lengkap']) ?></strong>
                        </p>
                        <?php if (isset($atlet['nama_klub'])): ?>
                            <p class="mb-0" style="font-weight: 500; color: #1E90FF;">
                                <i class="fas fa-users me-2"></i><?= esc($atlet['nama_klub']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="me-3">
                                <span class="badge px-3 py-2" style="background: linear-gradient(45deg, #28a745, #20c997); color: white; border-radius: 20px; font-weight: 700;">
                                    <?= ucfirst(esc($atlet['status'] ?? 'Belum Aktif')) ?>
                                </span>
                            </div>
                            <?php if (!empty($atlet['foto'])): ?>
                                <img src="<?= base_url('uploads/atlet/' . esc($atlet['foto'])) ?>"
                                    alt="Foto Atlet"
                                    class="rounded-circle"
                                    style="width: 60px; height: 60px; object-fit: cover; border: 3px solid #1E90FF;">
                            <?php else: ?>
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 60px; height: 60px; background: linear-gradient(45deg, #1E90FF, #00BFFF); color: white; font-weight: 700; font-size: 24px;">
                                    <?= strtoupper(substr($user['nama_lengkap'], 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-lg h-100" style="border-radius: 25px; background: linear-gradient(135deg, #28a745, #20c997);">
            <div class="card-body text-center text-white p-4">
                <div class="mb-3">
                    <i class="fas fa-trophy" style="font-size: 3rem; opacity: 0.8;"></i>
                </div>
                <h3 class="mb-1" style="font-weight: 900;"><?= $statistik['total_turnamen'] ?></h3>
                <p class="mb-0" style="font-weight: 600;">Total Turnamen</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-lg h-100" style="border-radius: 25px; background: linear-gradient(135deg, #007bff, #0056b3);">
            <div class="card-body text-center text-white p-4">
                <div class="mb-3">
                    <i class="fas fa-fist-raised" style="font-size: 3rem; opacity: 0.8;"></i>
                </div>
                <h3 class="mb-1" style="font-weight: 900;"><?= $statistik['total_pertandingan'] ?></h3>
                <p class="mb-0" style="font-weight: 600;">Total Pertandingan</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-lg h-100" style="border-radius: 25px; background: linear-gradient(135deg, #ffc107, #e0a800);">
            <div class="card-body text-center text-white p-4">
                <div class="mb-3">
                    <i class="fas fa-medal" style="font-size: 3rem; opacity: 0.8;"></i>
                </div>
                <h3 class="mb-1" style="font-weight: 900;"><?= $statistik['menang'] ?></h3>
                <p class="mb-0" style="font-weight: 600;">Kemenangan</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-lg h-100" style="border-radius: 25px; background: linear-gradient(135deg, #dc3545, #c82333);">
            <div class="card-body text-center text-white p-4">
                <div class="mb-3">
                    <i class="fas fa-percentage" style="font-size: 3rem; opacity: 0.8;"></i>
                </div>
                <h3 class="mb-1" style="font-weight: 900;"><?= $statistik['win_rate'] ?>%</h3>
                <p class="mb-0" style="font-weight: 600;">Win Rate</p>
            </div>
        </div>
    </div>
</div>

<!-- Menu Navigasi -->
<div class="row">
    <div class="col-md-4 mb-4">
        <a href="<?= base_url('user/atlet/profil') ?>" class="text-decoration-none">
            <div class="card border-0 shadow-lg h-100 menu-card" style="border-radius: 25px; background: rgba(255,255,255,0.95); transition: all 0.4s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                            <i class="fas fa-user text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                        </div>
                    </div>
                    <h5 class="mb-2" style="font-weight: 700; color: #003366;">Profil Atlet</h5>
                    <p class="mb-0" style="color: #666; font-weight: 500;">Kelola data pribadi dan informasi atlet</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-4">
        <a href="<?= base_url('user/atlet/kartu') ?>" class="text-decoration-none">
            <div class="card border-0 shadow-lg h-100 menu-card" style="border-radius: 25px; background: rgba(255,255,255,0.95); transition: all 0.4s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #28a745, #20c997); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                            <i class="fas fa-id-card text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                        </div>
                    </div>
                    <h5 class="mb-2" style="font-weight: 700; color: #003366;">Kartu Atlet</h5>
                    <p class="mb-0" style="color: #666; font-weight: 500;">Lihat dan unduh kartu identitas atlet</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-4">
        <a href="<?= base_url('user/atlet/daftar-turnamen') ?>" class="text-decoration-none">
            <div class="card border-0 shadow-lg h-100 menu-card" style="border-radius: 25px; background: rgba(255,255,255,0.95); transition: all 0.4s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #ffc107, #e0a800); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                            <i class="fas fa-trophy text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                        </div>
                    </div>
                    <h5 class="mb-2" style="font-weight: 700; color: #003366;">Daftar Turnamen</h5>
                    <p class="mb-0" style="color: #666; font-weight: 500;">Daftar dan ikuti turnamen tersedia</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-4">
        <a href="<?= base_url('user/atlet/riwayat-pertandingan') ?>" class="text-decoration-none">
            <div class="card border-0 shadow-lg h-100 menu-card" style="border-radius: 25px; background: rgba(255,255,255,0.95); transition: all 0.4s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #dc3545, #c82333); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                            <i class="fas fa-history text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                        </div>
                    </div>
                    <h5 class="mb-2" style="font-weight: 700; color: #003366;">Riwayat Pertandingan</h5>
                    <p class="mb-0" style="color: #666; font-weight: 500;">Lihat hasil dan riwayat pertandingan</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-4">
        <a href="<?= base_url('user/atlet/ranking-pribadi') ?>" class="text-decoration-none">
            <div class="card border-0 shadow-lg h-100 menu-card" style="border-radius: 25px; background: rgba(255,255,255,0.95); transition: all 0.4s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #6f42c1, #5a32a3); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                            <i class="fas fa-chart-line text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                        </div>
                    </div>
                    <h5 class="mb-2" style="font-weight: 700; color: #003366;">Ranking Pribadi</h5>
                    <p class="mb-0" style="color: #666; font-weight: 500;">Lihat peringkat dan perkembangan</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-4">
        <a href="<?= base_url('auth/logout') ?>" class="text-decoration-none">
            <div class="card border-0 shadow-lg h-100 menu-card" style="border-radius: 25px; background: rgba(255,255,255,0.95); transition: all 0.4s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #6c757d, #5a6268); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                            <i class="fas fa-sign-out-alt text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                        </div>
                    </div>
                    <h5 class="mb-2" style="font-weight: 700; color: #003366;">Keluar</h5>
                    <p class="mb-0" style="color: #666; font-weight: 500;">Logout dari sistem</p>
                </div>
            </div>
        </a>
    </div>
</div>
</div>

<style>
    .menu-card:hover {
        transform: translateY(-10px) !important;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
    }

    .menu-card:hover .icon-circle {
        background: linear-gradient(45deg, #003366, #1E90FF) !important;
        transform: rotate(360deg) !important;
    }

    .menu-card:hover .icon-circle i {
        transform: scale(1.2) !important;
    }
</style>
<?= $this->endSection() ?>