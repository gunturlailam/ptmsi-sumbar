<?= $this->extend('layouts/public_main') ?>

<?= $this->section('css') ?>
<style>
    .hero-modern {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        padding: 100px 0 80px;
        margin-bottom: 60px;
        position: relative;
        overflow: hidden;
        border-bottom: 1px solid rgba(245, 158, 11, 0.1);
    }

    .hero-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .hero-subtitle {
        font-size: 1.3rem;
        opacity: 0.9;
        font-weight: 400;
    }

    .card-modern {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
    }

    .section-title-modern {
        font-size: 2rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title-modern i {
        color: #667eea;
        font-size: 2.2rem;
    }

    .nav-pills-modern {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 1rem;
        margin-bottom: 2rem;
    }

    .nav-pills-modern .nav-link {
        color: #4a5568;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 16px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        margin: 0 0.25rem;
    }

    .nav-pills-modern .nav-link:hover {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        transform: translateY(-2px);
    }

    .nav-pills-modern .nav-link.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .service-card {
        background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
        border-radius: 20px;
        padding: 2rem;
        height: 100%;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.15);
        border-color: #667eea;
    }

    .service-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .service-icon i {
        font-size: 2rem;
        color: white;
    }

    .service-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1rem;
    }

    .btn-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 16px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .btn-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-outline-modern {
        background: transparent;
        color: #667eea;
        border: 2px solid #667eea;
        padding: 0.75rem 2rem;
        border-radius: 16px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-outline-modern:hover {
        background: #667eea;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .info-box-modern {
        background: rgba(102, 126, 234, 0.1);
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .info-box-modern i {
        color: #667eea;
        font-size: 1.5rem;
    }

    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .nav-pills-modern .nav-link {
            margin: 0.25rem 0;
            display: block;
        }

        .service-card {
            margin-bottom: 1.5rem;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Hero Section -->
<div class="hero-modern">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="hero-title">
                <i class="bx bx-globe"></i> Layanan Online
            </h1>
            <p class="hero-subtitle">Pendaftaran dan Pengajuan Online PTMSI Sumbar</p>
        </div>
    </div>
</div>

<div class="container">
    <!-- Sub Menu Navigation -->
    <div class="nav-pills-modern">
        <ul class="nav nav-pills justify-content-center flex-wrap">
            <li class="nav-item">
                <a class="nav-link active" href="#pendaftaran-atlet" data-bs-toggle="pill">
                    <i class="bx bx-user-plus"></i> Pendaftaran Atlet/Klub
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#pendaftaran-turnamen" data-bs-toggle="pill">
                    <i class="bx bx-trophy"></i> Pendaftaran Turnamen
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#informasi-layanan" data-bs-toggle="pill">
                    <i class="bx bx-info-circle"></i> Informasi Layanan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#kontak-bantuan" data-bs-toggle="pill">
                    <i class="bx bx-headphone"></i> Bantuan
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content">
        <!-- 1. Pendaftaran Atlet/Klub Online -->
        <div class="tab-pane fade show active" id="pendaftaran-atlet">
            <div class="card-modern fade-in">
                <h2 class="section-title-modern">
                    <i class="bx bx-user-plus"></i> Pendaftaran Atlet/Klub Online
                </h2>

                <div class="info-box-modern">
                    <div class="d-flex align-items-center">
                        <i class="bx bx-info-circle me-3"></i>
                        <div>
                            <strong>Sistem Pendaftaran Terintegrasi:</strong>
                            <p class="mb-0 mt-2">PTMSI Sumbar telah memiliki sistem pendaftaran online yang terintegrasi. Silakan gunakan sistem resmi untuk pendaftaran.</p>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bx bx-buildings"></i>
                            </div>
                            <h4 class="service-title">Pendaftaran Klub</h4>
                            <div class="info-box-modern mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-check-circle me-3"></i>
                                    <div>
                                        <strong>Sistem Resmi Tersedia</strong>
                                        <p class="mb-0 mt-1">Gunakan sistem pendaftaran klub resmi PTMSI Sumbar dengan fitur lengkap dan terintegrasi.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <a href="<?= base_url('registration/klub-register') ?>" class="btn-modern">
                                    <i class="bx bx-right-arrow-circle"></i> Daftar Klub Resmi
                                </a>
                                <a href="<?= base_url('login') ?>" class="btn-outline-modern">
                                    <i class="bx bx-log-in"></i> Login Klub
                                </a>
                            </div>
                            <hr class="my-3">
                            <small class="text-muted">
                                <strong>Fitur Sistem Resmi:</strong><br>
                                • Upload dokumen SK & identitas<br>
                                • Verifikasi otomatis admin<br>
                                • Dashboard klub lengkap<br>
                                • Kelola atlet & pelatih
                            </small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bx bx-user"></i>
                            </div>
                            <h4 class="service-title">Pendaftaran Atlet</h4>
                            <div class="info-box-modern mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-shield-check me-3"></i>
                                    <div>
                                        <strong>Melalui Klub Terdaftar</strong>
                                        <p class="mb-0 mt-1">Pendaftaran atlet harus melalui klub yang sudah terdaftar dan terverifikasi di PTMSI Sumbar.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-info">
                                <i class="bx bx-info-circle me-2"></i>
                                <strong>Cara Mendaftar Atlet:</strong>
                                <ol class="mb-0 mt-2">
                                    <li>Klub login ke sistem</li>
                                    <li>Pilih menu "Kelola Atlet"</li>
                                    <li>Klik "Tambah Atlet Baru"</li>
                                    <li>Isi data & upload dokumen</li>
                                    <li>Tunggu verifikasi admin</li>
                                </ol>
                            </div>
                            <div class="d-grid">
                                <a href="<?= base_url('login') ?>" class="btn-outline-modern">
                                    <i class="bx bx-log-in"></i> Login untuk Daftar Atlet
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Pendaftaran Turnamen -->
        <div class="tab-pane fade" id="pendaftaran-turnamen">
            <div class="card-modern fade-in">
                <h2 class="section-title-modern">
                    <i class="bx bx-trophy"></i> Pendaftaran Turnamen Online
                </h2>

                <div class="info-box-modern">
                    <div class="d-flex align-items-center">
                        <i class="bx bx-calendar-event me-3"></i>
                        <div>
                            <strong>Sistem Turnamen Terintegrasi:</strong>
                            <p class="mb-0 mt-2">Gunakan sistem pendaftaran turnamen resmi dengan validasi otomatis dan fitur lengkap.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="service-card text-center">
                            <div class="service-icon mx-auto">
                                <i class="bx bx-trophy"></i>
                            </div>
                            <h4 class="service-title">Sistem Turnamen Resmi</h4>

                            <div class="info-box-modern mb-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="bx bx-check-circle me-3"></i>
                                    <div>
                                        <strong>Fitur Sistem Turnamen:</strong>
                                        <ul class="list-unstyled mb-0 mt-2 text-start">
                                            <li>✅ Validasi otomatis (usia, gender, kuota)</li>
                                            <li>✅ Upload bukti pembayaran</li>
                                            <li>✅ Tracking status real-time</li>
                                            <li>✅ Notifikasi verifikasi</li>
                                            <li>✅ Riwayat pendaftaran</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-3">
                                <a href="<?= base_url('tournament') ?>" class="btn-modern">
                                    <i class="bx bx-show"></i> Lihat Turnamen Tersedia
                                </a>
                                <a href="<?= base_url('login') ?>" class="btn-outline-modern">
                                    <i class="bx bx-log-in"></i> Login untuk Mendaftar
                                </a>
                            </div>

                            <hr class="my-4">

                            <div class="alert alert-info text-start">
                                <i class="bx bx-info-circle me-2"></i>
                                <strong>Cara Mendaftar Turnamen:</strong>
                                <ol class="mb-0 mt-2">
                                    <li><strong>Atlet:</strong> Login → Lihat Turnamen → Pilih & Daftar</li>
                                    <li><strong>Klub:</strong> Login → Dashboard → Pendaftaran Turnamen</li>
                                    <li>Sistem akan validasi otomatis kelayakan</li>
                                    <li>Upload bukti bayar (jika ada biaya)</li>
                                    <li>Tunggu verifikasi admin</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Informasi Layanan -->
        <div class="tab-pane fade" id="informasi-layanan">
            <div class="card-modern fade-in">
                <h2 class="section-title-modern">
                    <i class="bx bx-info-circle"></i> Informasi Layanan PTMSI Sumbar
                </h2>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bx bx-buildings"></i>
                            </div>
                            <h4 class="service-title">Layanan Klub</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i> Pendaftaran klub baru</li>
                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i> Verifikasi dokumen klub</li>
                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i> Pengelolaan anggota</li>
                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i> Dashboard klub terintegrasi</li>
                            </ul>
                            <a href="<?= base_url('registration/klub-register') ?>" class="btn-outline-modern">
                                <i class="bx bx-right-arrow-alt"></i> Daftar Klub
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bx bx-user"></i>
                            </div>
                            <h4 class="service-title">Layanan Atlet</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i> Pendaftaran melalui klub</li>
                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i> Kartu anggota digital</li>
                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i> Tracking ranking</li>
                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i> Riwayat pertandingan</li>
                            </ul>
                            <a href="<?= base_url('login') ?>" class="btn-outline-modern">
                                <i class="bx bx-right-arrow-alt"></i> Login Atlet
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bx bx-trophy"></i>
                            </div>
                            <h4 class="service-title">Layanan Turnamen</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i> Pendaftaran online</li>
                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i> Validasi otomatis</li>
                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i> Upload bukti bayar</li>
                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i> Tracking status</li>
                            </ul>
                            <a href="<?= base_url('tournament') ?>" class="btn-outline-modern">
                                <i class="bx bx-right-arrow-alt"></i> Lihat Turnamen
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bx bx-award"></i>
                            </div>
                            <h4 class="service-title">Layanan Pelatih</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i> Pendaftaran melalui klub</li>
                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i> Sertifikasi pelatih</li>
                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i> Manajemen atlet</li>
                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i> Laporan kegiatan</li>
                            </ul>
                            <a href="<?= base_url('login') ?>" class="btn-outline-modern">
                                <i class="bx bx-right-arrow-alt"></i> Login Pelatih
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Kontak & Bantuan -->
        <div class="tab-pane fade" id="kontak-bantuan">
            <div class="card-modern fade-in">
                <h2 class="section-title-modern">
                    <i class="bx bx-headphone"></i> Bantuan & Kontak
                </h2>

                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="service-card text-center">
                            <div class="service-icon mx-auto">
                                <i class="bx bx-help-circle"></i>
                            </div>
                            <h4 class="service-title">Butuh Bantuan?</h4>

                            <div class="info-box-modern mb-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="bx bx-phone me-3"></i>
                                    <div>
                                        <strong>Kontak PTMSI Sumatera Barat:</strong>
                                        <p class="mb-0 mt-2">
                                            <strong>Telepon:</strong> (0751) 123-4567<br>
                                            <strong>Email:</strong> info@ptmsi-sumbar.org<br>
                                            <strong>WhatsApp:</strong> +62 812-3456-7890
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info text-start">
                                <i class="bx bx-time me-2"></i>
                                <strong>Jam Layanan:</strong><br>
                                Senin - Jumat: 08:00 - 16:00 WIB<br>
                                Sabtu: 08:00 - 12:00 WIB<br>
                                Minggu & Hari Libur: Tutup
                            </div>

                            <div class="d-grid gap-2">
                                <a href="<?= base_url('hubungi-kami') ?>" class="btn-modern">
                                    <i class="bx bx-envelope"></i> Kirim Pesan
                                </a>
                                <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success" style="border-radius: 16px; padding: 0.75rem 2rem;">
                                    <i class="bx bxl-whatsapp me-2"></i> Chat WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    // Fade in animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });

    // Smooth scroll for tab navigation
    document.querySelectorAll('a[data-bs-toggle="pill"]').forEach(link => {
        link.addEventListener('shown.bs.tab', function(e) {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>
<?= $this->endSection() ?>