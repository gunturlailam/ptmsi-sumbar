<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%); min-height: 100vh;">
    <!-- Header Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-2" style="font-weight: 900; color: #003366;">
                                <i class="fas fa-users me-3"></i>Dashboard Klub
                            </h1>
                            <p class="mb-0" style="font-weight: 500; color: #666;">
                                Selamat datang, <strong><?= esc($klub['nama']) ?></strong>
                            </p>
                            <p class="mb-0" style="font-weight: 500; color: #1E90FF;">
                                <i class="fas fa-map-marker-alt me-2"></i><?= esc($klub['alamat']) ?>
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="me-3">
                                    <?php if ($status_aktif): ?>
                                        <span class="badge px-3 py-2" style="background: linear-gradient(45deg, #28a745, #20c997); color: white; border-radius: 20px; font-weight: 700;">
                                            <i class="fas fa-check-circle me-1"></i>Aktif
                                        </span>
                                    <?php else: ?>
                                        <span class="badge px-3 py-2" style="background: linear-gradient(45deg, #ffc107, #e0a800); color: white; border-radius: 20px; font-weight: 700;">
                                            <i class="fas fa-clock me-1"></i>Menunggu Verifikasi
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 60px; height: 60px; background: linear-gradient(45deg, #1E90FF, #00BFFF); color: white; font-weight: 700; font-size: 24px;">
                                    <?= strtoupper(substr($klub['nama'], 0, 1)) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($status_aktif): ?>
        <!-- Statistik Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-lg h-100" style="border-radius: 25px; background: linear-gradient(135deg, #28a745, #20c997);">
                    <div class="card-body text-center text-white p-4">
                        <div class="mb-3">
                            <i class="fas fa-running" style="font-size: 3rem; opacity: 0.8;"></i>
                        </div>
                        <h3 class="mb-1" style="font-weight: 900;"><?= $statistik['total_atlet'] ?></h3>
                        <p class="mb-0" style="font-weight: 600;">Total Atlet</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-lg h-100" style="border-radius: 25px; background: linear-gradient(135deg, #007bff, #0056b3);">
                    <div class="card-body text-center text-white p-4">
                        <div class="mb-3">
                            <i class="fas fa-chalkboard-teacher" style="font-size: 3rem; opacity: 0.8;"></i>
                        </div>
                        <h3 class="mb-1" style="font-weight: 900;"><?= $statistik['total_pelatih'] ?></h3>
                        <p class="mb-0" style="font-weight: 600;">Total Pelatih</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-lg h-100" style="border-radius: 25px; background: linear-gradient(135deg, #ffc107, #e0a800);">
                    <div class="card-body text-center text-white p-4">
                        <div class="mb-3">
                            <i class="fas fa-clock" style="font-size: 3rem; opacity: 0.8;"></i>
                        </div>
                        <h3 class="mb-1" style="font-weight: 900;"><?= $statistik['pendaftaran_pending'] ?></h3>
                        <p class="mb-0" style="font-weight: 600;">Menunggu Verifikasi</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-lg h-100" style="border-radius: 25px; background: linear-gradient(135deg, #dc3545, #c82333);">
                    <div class="card-body text-center text-white p-4">
                        <div class="mb-3">
                            <i class="fas fa-trophy" style="font-size: 3rem; opacity: 0.8;"></i>
                        </div>
                        <h3 class="mb-1" style="font-weight: 900;"><?= $statistik['event_tersedia'] ?></h3>
                        <p class="mb-0" style="font-weight: 600;">Event Tersedia</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Navigasi -->
        <div class="row">
            <div class="col-md-4 mb-4">
                <a href="<?= base_url('user/klub/data-klub') ?>" class="text-decoration-none">
                    <div class="card border-0 shadow-lg h-100 menu-card" style="border-radius: 25px; background: rgba(255,255,255,0.95); transition: all 0.4s ease;">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                                    <i class="fas fa-building text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                                </div>
                            </div>
                            <h5 class="mb-2" style="font-weight: 700; color: #003366;">Data Klub</h5>
                            <p class="mb-0" style="color: #666; font-weight: 500;">Kelola informasi dan data klub</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="<?= base_url('user/klub/kelola-atlet') ?>" class="text-decoration-none">
                    <div class="card border-0 shadow-lg h-100 menu-card" style="border-radius: 25px; background: rgba(255,255,255,0.95); transition: all 0.4s ease;">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #28a745, #20c997); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                                    <i class="fas fa-running text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                                </div>
                            </div>
                            <h5 class="mb-2" style="font-weight: 700; color: #003366;">Kelola Atlet</h5>
                            <p class="mb-0" style="color: #666; font-weight: 500;">Tambah dan verifikasi atlet klub</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="<?= base_url('user/klub/kelola-pelatih') ?>" class="text-decoration-none">
                    <div class="card border-0 shadow-lg h-100 menu-card" style="border-radius: 25px; background: rgba(255,255,255,0.95); transition: all 0.4s ease;">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #ffc107, #e0a800); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                                    <i class="fas fa-chalkboard-teacher text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                                </div>
                            </div>
                            <h5 class="mb-2" style="font-weight: 700; color: #003366;">Kelola Pelatih</h5>
                            <p class="mb-0" style="color: #666; font-weight: 500;">Tambah pelatih dan wasit</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="<?= base_url('user/klub/pendaftaran-turnamen') ?>" class="text-decoration-none">
                    <div class="card border-0 shadow-lg h-100 menu-card" style="border-radius: 25px; background: rgba(255,255,255,0.95); transition: all 0.4s ease;">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #dc3545, #c82333); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                                    <i class="fas fa-trophy text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                                </div>
                            </div>
                            <h5 class="mb-2" style="font-weight: 700; color: #003366;">Pendaftaran Turnamen</h5>
                            <p class="mb-0" style="color: #666; font-weight: 500;">Daftarkan atlet ke turnamen</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="<?= base_url('user/klub/kelola-anggota') ?>" class="text-decoration-none">
                    <div class="card border-0 shadow-lg h-100 menu-card" style="border-radius: 25px; background: rgba(255,255,255,0.95); transition: all 0.4s ease;">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #6f42c1, #5a32a3); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                                    <i class="fas fa-users text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                                </div>
                            </div>
                            <h5 class="mb-2" style="font-weight: 700; color: #003366;">Kelola Anggota</h5>
                            <p class="mb-0" style="color: #666; font-weight: 500;">Manajemen semua anggota klub</p>
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

    <?php else: ?>
        <!-- Dashboard Belum Aktif -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <i class="fas fa-exclamation-triangle" style="font-size: 4rem; color: #ffc107;"></i>
                        </div>
                        <h3 class="mb-3" style="font-weight: 900; color: #003366;">Klub Belum Aktif</h3>
                        <p class="mb-4" style="color: #666; font-weight: 500; font-size: 1.1rem;">
                            Klub Anda sedang dalam proses verifikasi oleh Admin Provinsi.
                            Silakan tunggu konfirmasi atau hubungi admin jika ada pertanyaan.
                        </p>
                        <div class="alert alert-warning" role="alert" style="border-radius: 15px;">
                            <strong>Status:</strong> <?= ucfirst(esc($klub['status'])) ?><br>
                            <strong>Tanggal Daftar:</strong> <?= date('d F Y', strtotime($klub['tanggal_berdiri'])) ?>
                        </div>
                        <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 20px; font-weight: 600;">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
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