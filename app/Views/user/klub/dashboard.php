<?= $this->extend('user/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <!-- Header Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-2" style="font-weight: 900; color: #2d3748;">
                                <i class="bx bx-home-circle me-2"></i>Dashboard Klub
                            </h1>
                            <p class="mb-0" style="font-weight: 500; color: #666;">
                                Selamat datang, <strong><?= esc($klub['nama']) ?></strong>
                            </p>
                            <p class="mb-0" style="font-weight: 500; color: #667eea;">
                                <i class="bx bx-map-pin me-2"></i><?= esc($klub['alamat']) ?>
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="me-3">
                                    <?php if ($status_aktif): ?>
                                        <span class="badge px-3 py-2" style="background: linear-gradient(45deg, #28a745, #20c997); color: white; border-radius: 20px; font-weight: 700;">
                                            <i class="bx bx-check-circle me-1"></i>Aktif
                                        </span>
                                    <?php else: ?>
                                        <span class="badge px-3 py-2" style="background: linear-gradient(45deg, #ffc107, #e0a800); color: white; border-radius: 20px; font-weight: 700;">
                                            <i class="bx bx-time me-1"></i>Menunggu Verifikasi
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 60px; height: 60px; background: linear-gradient(45deg, #667eea, #764ba2); color: white; font-weight: 700; font-size: 24px;">
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
                <div class="card border-0 shadow-lg">
                    <div class="card-body text-center text-white p-4" style="background: linear-gradient(135deg, #28a745, #20c997); border-radius: 12px;">
                        <div class="mb-3">
                            <i class="bx bx-run" style="font-size: 2rem; opacity: 0.8;"></i>
                        </div>
                        <h3 class="mb-1" style="font-weight: 900;"><?= $statistik['total_atlet'] ?></h3>
                        <p class="mb-0" style="font-weight: 600;">Total Atlet</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-lg">
                    <div class="card-body text-center text-white p-4" style="background: linear-gradient(135deg, #007bff, #0056b3); border-radius: 12px;">
                        <div class="mb-3">
                            <i class="bx bx-user-voice" style="font-size: 2rem; opacity: 0.8;"></i>
                        </div>
                        <h3 class="mb-1" style="font-weight: 900;"><?= $statistik['total_pelatih'] ?></h3>
                        <p class="mb-0" style="font-weight: 600;">Total Pelatih</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-lg">
                    <div class="card-body text-center text-white p-4" style="background: linear-gradient(135deg, #ffc107, #e0a800); border-radius: 12px;">
                        <div class="mb-3">
                            <i class="bx bx-time" style="font-size: 2rem; opacity: 0.8;"></i>
                        </div>
                        <h3 class="mb-1" style="font-weight: 900;"><?= $statistik['pendaftaran_pending'] ?></h3>
                        <p class="mb-0" style="font-weight: 600;">Menunggu Verifikasi</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-lg">
                    <div class="card-body text-center text-white p-4" style="background: linear-gradient(135deg, #dc3545, #c82333); border-radius: 12px;">
                        <div class="mb-3">
                            <i class="bx bx-trophy" style="font-size: 2rem; opacity: 0.8;"></i>
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
                    <div class="card border-0 shadow-lg menu-card">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #667eea, #764ba2); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                                    <i class="bx bx-building text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                                </div>
                            </div>
                            <h5 class="mb-2" style="font-weight: 700; color: #2d3748;">Data Klub</h5>
                            <p class="mb-0" style="color: #666; font-weight: 500;">Kelola informasi dan data klub</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="<?= base_url('user/klub/kelola-atlet') ?>" class="text-decoration-none">
                    <div class="card border-0 shadow-lg menu-card">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #28a745, #20c997); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                                    <i class="bx bx-run text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                                </div>
                            </div>
                            <h5 class="mb-2" style="font-weight: 700; color: #2d3748;">Kelola Atlet</h5>
                            <p class="mb-0" style="color: #666; font-weight: 500;">Tambah dan verifikasi atlet klub</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="<?= base_url('user/klub/kelola-pelatih') ?>" class="text-decoration-none">
                    <div class="card border-0 shadow-lg menu-card">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #ffc107, #e0a800); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                                    <i class="bx bx-user-voice text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                                </div>
                            </div>
                            <h5 class="mb-2" style="font-weight: 700; color: #2d3748;">Kelola Pelatih</h5>
                            <p class="mb-0" style="color: #666; font-weight: 500;">Tambah pelatih dan wasit</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="<?= base_url('user/klub/pendaftaran-turnamen') ?>" class="text-decoration-none">
                    <div class="card border-0 shadow-lg menu-card">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #dc3545, #c82333); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                                    <i class="bx bx-trophy text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                                </div>
                            </div>
                            <h5 class="mb-2" style="font-weight: 700; color: #2d3748;">Pendaftaran Turnamen</h5>
                            <p class="mb-0" style="color: #666; font-weight: 500;">Daftarkan atlet ke turnamen</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="<?= base_url('user/klub/kelola-anggota') ?>" class="text-decoration-none">
                    <div class="card border-0 shadow-lg menu-card">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #6f42c1, #5a32a3); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                                    <i class="bx bx-users text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                                </div>
                            </div>
                            <h5 class="mb-2" style="font-weight: 700; color: #2d3748;">Kelola Anggota</h5>
                            <p class="mb-0" style="color: #666; font-weight: 500;">Manajemen semua anggota klub</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="<?= base_url('user/klub/statistik-detail') ?>" class="text-decoration-none">
                    <div class="card border-0 shadow-lg menu-card">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #20c997, #17a2b8); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                                    <i class="bx bx-bar-chart text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                                </div>
                            </div>
                            <h5 class="mb-2" style="font-weight: 700; color: #2d3748;">Statistik Detail</h5>
                            <p class="mb-0" style="color: #666; font-weight: 500;">Analisis data klub mendalam</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="<?= base_url('user/klub/laporan-kegiatan') ?>" class="text-decoration-none">
                    <div class="card border-0 shadow-lg menu-card">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #fd7e14, #e0a800); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                                    <i class="bx bx-file text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                                </div>
                            </div>
                            <h5 class="mb-2" style="font-weight: 700; color: #2d3748;">Laporan Kegiatan</h5>
                            <p class="mb-0" style="color: #666; font-weight: 500;">Kelola laporan kegiatan klub</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="<?= base_url('profil') ?>" class="text-decoration-none">
                    <div class="card border-0 shadow-lg menu-card">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #17a2b8, #138496); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                                    <i class="bx bx-user text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                                </div>
                            </div>
                            <h5 class="mb-2" style="font-weight: 700; color: #2d3748;">Profil</h5>
                            <p class="mb-0" style="color: #666; font-weight: 500;">Kelola profil pengguna</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    <?php else: ?>
        <!-- Dashboard Belum Aktif -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <i class="bx bx-exclamation-triangle" style="font-size: 4rem; color: #ffc107;"></i>
                        </div>
                        <h3 class="mb-3" style="font-weight: 900; color: #2d3748;">Klub Belum Aktif</h3>
                        <p class="mb-4" style="color: #666; font-weight: 500; font-size: 1.1rem;">
                            Klub Anda sedang dalam proses verifikasi oleh Admin Provinsi.
                            Silakan tunggu konfirmasi atau hubungi admin jika ada pertanyaan.
                        </p>
                        <div class="alert alert-warning" role="alert">
                            <strong>Status:</strong> <?= ucfirst(esc($klub['status'])) ?><br>
                            <strong>Tanggal Daftar:</strong> <?= date('d F Y', strtotime($klub['tanggal_berdiri'])) ?>
                        </div>
                        <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-secondary px-4 py-2">
                            <i class="bx bx-log-out me-2"></i>Logout
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