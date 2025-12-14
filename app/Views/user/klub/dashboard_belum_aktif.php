<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #003366 0%, #1E90FF 50%, #00BFFF 100%); min-height: 100vh;">
    <!-- Header Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
                <div class="card-body p-4">
                    <div class="row align-items-center"></div>
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
                                <span class="badge px-3 py-2" style="background: linear-gradient(45deg, #ffc107, #e0a800); color: white; border-radius: 20px; font-weight: 700;">
                                    <i class="fas fa-clock me-1"></i><?= ucfirst(esc($klub['status'])) ?>
                                </span>
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

<!-- Status Verifikasi -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-lg" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
            <div class="card-body text-center p-5">
                <div class="mb-4">
                    <i class="fas fa-hourglass-half" style="font-size: 5rem; color: #ffc107; animation: pulse 2s infinite;"></i>
                </div>
                <h2 class="mb-3" style="font-weight: 900; color: #003366;">Klub Sedang Dalam Proses Verifikasi</h2>
                <p class="mb-4" style="color: #666; font-weight: 500; font-size: 1.2rem; line-height: 1.6;">
                    Terima kasih telah mendaftar sebagai klub PTMSI Sumatera Barat.
                    Saat ini data klub Anda sedang dalam proses verifikasi oleh Admin Provinsi.
                </p>

                <div class="row justify-content-center mb-4">
                    <div class="col-md-8">
                        <div class="alert alert-info" role="alert" style="border-radius: 20px; border: none; background: linear-gradient(45deg, #17a2b8, #138496); color: white;">
                            <div class="row text-center">
                                <div class="col-md-4 mb-2">
                                    <strong>Status:</strong><br>
                                    <?= ucfirst(esc($klub['status'])) ?>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <strong>Tanggal Daftar:</strong><br>
                                    <?= date('d F Y', strtotime($klub['tanggal_berdiri'])) ?>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <strong>Estimasi:</strong><br>
                                    3-5 Hari Kerja
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Informasi Proses Verifikasi -->
<div class="row mb-4">
    <div class="col-md-6 mb-4">
        <div class="card border-0 shadow-lg h-100" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
            <div class="card-header border-0" style="background: linear-gradient(45deg, #28a745, #20c997); border-radius: 25px 25px 0 0;">
                <h5 class="mb-0 text-white" style="font-weight: 700;">
                    <i class="fas fa-list-check me-2"></i>Proses Verifikasi
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="timeline">
                    <div class="timeline-item completed">
                        <div class="timeline-marker">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 style="font-weight: 700; color: #28a745;">Pendaftaran Berhasil</h6>
                            <p class="mb-0 small text-muted">Data klub telah diterima sistem</p>
                        </div>
                    </div>
                    <div class="timeline-item active">
                        <div class="timeline-marker">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 style="font-weight: 700; color: #ffc107;">Verifikasi Admin</h6>
                            <p class="mb-0 small text-muted">Admin sedang memeriksa dokumen</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker">
                            <i class="fas fa-hourglass"></i>
                        </div>
                        <div class="timeline-content">
                            <h6 style="font-weight: 700; color: #6c757d;">Aktivasi Klub</h6>
                            <p class="mb-0 small text-muted">Klub akan diaktifkan setelah verifikasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card border-0 shadow-lg h-100" style="border-radius: 25px; background: rgba(255,255,255,0.95);">
            <div class="card-header border-0" style="background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 25px 25px 0 0;">
                <h5 class="mb-0 text-white" style="font-weight: 700;">
                    <i class="fas fa-info-circle me-2"></i>Informasi Penting
                </h5>
            </div>
            <div class="card-body p-4">
                <ul class="list-unstyled mb-0">
                    <li class="mb-3">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <strong>Dokumen Lengkap:</strong> Pastikan semua dokumen telah diupload dengan benar
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-clock text-warning me-2"></i>
                        <strong>Waktu Verifikasi:</strong> Proses verifikasi membutuhkan 3-5 hari kerja
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-envelope text-info me-2"></i>
                        <strong>Notifikasi:</strong> Anda akan mendapat email konfirmasi hasil verifikasi
                    </li>
                    <li class="mb-0">
                        <i class="fas fa-phone text-primary me-2"></i>
                        <strong>Bantuan:</strong> Hubungi admin jika ada pertanyaan
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Aksi yang Tersedia -->
<div class="row">
    <div class="col-md-4 mb-4">
        <a href="<?= base_url('user/klub/data-klub') ?>" class="text-decoration-none">
            <div class="card border-0 shadow-lg h-100 menu-card" style="border-radius: 25px; background: rgba(255,255,255,0.95); transition: all 0.4s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #1E90FF, #00BFFF); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                            <i class="fas fa-eye text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                        </div>
                    </div>
                    <h5 class="mb-2" style="font-weight: 700; color: #003366;">Lihat Data Klub</h5>
                    <p class="mb-0" style="color: #666; font-weight: 500;">Periksa data yang telah didaftarkan</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4 mb-4">
        <a href="mailto:admin@ptmsi-sumbar.org" class="text-decoration-none">
            <div class="card border-0 shadow-lg h-100 menu-card" style="border-radius: 25px; background: rgba(255,255,255,0.95); transition: all 0.4s ease;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <div class="icon-circle mx-auto" style="width: 70px; height: 70px; background: linear-gradient(45deg, #28a745, #20c997); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.4s ease;">
                            <i class="fas fa-envelope text-white" style="font-size: 24px; transition: all 0.4s ease;"></i>
                        </div>
                    </div>
                    <h5 class="mb-2" style="font-weight: 700; color: #003366;">Hubungi Admin</h5>
                    <p class="mb-0" style="color: #666; font-weight: 500;">Kirim email jika ada pertanyaan</p>
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
    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    .timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e0e0e0;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 30px;
    }

    .timeline-marker {
        position: absolute;
        left: -22px;
        top: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
    }

    .timeline-item.completed .timeline-marker {
        background: #28a745;
    }

    .timeline-item.active .timeline-marker {
        background: #ffc107;
    }

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