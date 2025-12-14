<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Pembinaan - PTMSI Sumbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/ptmsi-style.css') ?>">
    <style>
        .nav-menu-card {
            background: linear-gradient(135deg, #fff 0%, #E8F2FF 100%);
            border-radius: 20px;
            padding: 30px 20px;
            text-align: center;
            text-decoration: none;
            display: block;
            border: 2px solid #E8F2FF;
            transition: all 0.4s ease;
            height: 100%;
        }

        .nav-menu-card:hover {
            background: linear-gradient(135deg, #1E90FF 0%, #003366 100%);
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(30, 144, 255, 0.3);
            border-color: #1E90FF;
        }

        .nav-menu-card .nav-icon-wrapper {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1E90FF, #00BFFF);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            transition: all 0.4s ease;
        }

        .nav-menu-card:hover .nav-icon-wrapper {
            background: #fff;
            transform: scale(1.1) rotate(5deg);
        }

        .nav-menu-card .nav-icon-wrapper i {
            font-size: 2rem;
            color: #fff;
            transition: all 0.4s ease;
        }

        .nav-menu-card:hover .nav-icon-wrapper i {
            color: #1E90FF;
        }

        .nav-menu-card h6 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #003366;
            margin-bottom: 8px;
            transition: all 0.4s ease;
        }

        .nav-menu-card:hover h6 {
            color: #fff;
        }

        .nav-menu-card p {
            font-size: 0.85rem;
            color: #666;
            margin: 0;
            transition: all 0.4s ease;
        }

        .nav-menu-card:hover p {
            color: rgba(255, 255, 255, 0.9);
        }

        .program-card {
            background: linear-gradient(135deg, #fff 0%, #F8F9FA 100%);
            border-radius: 25px;
            padding: 30px;
            border: 2px solid #E8F2FF;
            transition: all 0.4s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .program-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(180deg, #1E90FF 0%, #00BFFF 100%);
        }

        .program-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(30, 144, 255, 0.25);
            border-color: #1E90FF;
        }

        .program-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: linear-gradient(135deg, #1E90FF, #00BFFF);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 8px 25px rgba(30, 144, 255, 0.3);
        }

        .program-icon i {
            font-size: 2.5rem;
            color: #fff;
        }

        .program-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #003366;
            margin-bottom: 15px;
        }

        .program-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            font-size: 0.95rem;
            color: #555;
        }

        .program-info i {
            color: #1E90FF;
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .kegiatan-card {
            background: #fff;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 20px;
            border: 2px solid #E8F2FF;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .kegiatan-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(180deg, #1E90FF 0%, #00BFFF 100%);
        }

        .kegiatan-card:hover {
            transform: translateX(10px);
            box-shadow: 0 10px 40px rgba(30, 144, 255, 0.2);
            border-color: #1E90FF;
        }

        .kegiatan-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            background: linear-gradient(135deg, #1E90FF, #00BFFF);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .kegiatan-icon i {
            font-size: 1.8rem;
            color: #fff;
        }

        .badge-status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            background: linear-gradient(135deg, #28a745, #20c997);
            color: #fff;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .info-box {
            background: linear-gradient(135deg, #E8F2FF 0%, #fff 100%);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            border: 2px solid #E8F2FF;
            transition: all 0.3s ease;
        }

        .info-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(30, 144, 255, 0.2);
            border-color: #1E90FF;
        }

        .info-box i {
            font-size: 3rem;
            color: #1E90FF;
            margin-bottom: 15px;
        }

        .info-box h5 {
            color: #003366;
            font-weight: 700;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?= $this->include('layouts/navbar') ?>

    <!-- Hero Section -->
    <div class="hero-modern">
        <div class="container">
            <div class="hero-content text-center">
                <h1 class="hero-title">
                    <i class="bi bi-mortarboard-fill"></i> Program Pembinaan
                </h1>
                <p class="hero-subtitle">Membangun Atlet Berprestasi Melalui Pembinaan Berkelanjutan</p>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Sub Menu Navigation -->
        <div class="row g-3 mb-5">
            <div class="col-md-3 col-6">
                <a href="#puslatda" class="nav-menu-card">
                    <div class="nav-icon-wrapper">
                        <i class="bi bi-building-fill"></i>
                    </div>
                    <h6>Puslatda</h6>
                    <p>Pemusatan latihan</p>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="#pembinaan-usia-dini" class="nav-menu-card">
                    <div class="nav-icon-wrapper">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h6>Usia Dini</h6>
                    <p>Pembinaan U-12</p>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="#talent-scouting" class="nav-menu-card">
                    <div class="nav-icon-wrapper">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <h6>Talent Scouting</h6>
                    <p>Pencarian bakat</p>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="#coaching-clinic" class="nav-menu-card">
                    <div class="nav-icon-wrapper">
                        <i class="bi bi-award-fill"></i>
                    </div>
                    <h6>Coaching Clinic</h6>
                    <p>Pelatihan pelatih</p>
                </a>
            </div>
        </div>

        <!-- Puslatda Section -->
        <div id="puslatda" class="card-modern">
            <h2 class="section-title-modern">
                <i class="bi bi-building-fill"></i> Pemusatan Latihan Daerah (Puslatda)
            </h2>

            <div class="alert alert-info d-flex align-items-center mb-4" role="alert" style="border-radius: 20px; border-left: 5px solid #0dcaf0;">
                <i class="bi bi-info-circle-fill me-3" style="font-size: 2rem;"></i>
                <div>
                    <strong>Puslatda</strong> adalah program pemusatan latihan untuk atlet-atlet terpilih yang bertujuan meningkatkan kemampuan teknis dan mental bertanding.
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="program-card">
                        <div class="program-icon">
                            <i class="bi bi-calendar-range-fill"></i>
                        </div>
                        <h4 class="program-title">Puslatda Reguler</h4>
                        <div class="program-info">
                            <i class="bi bi-clock-fill"></i>
                            <span>Senin - Jumat, 16:00 - 19:00</span>
                        </div>
                        <div class="program-info">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>GOR Haji Agus Salim</span>
                        </div>
                        <div class="program-info">
                            <i class="bi bi-people-fill"></i>
                            <span>25 Atlet Terpilih</span>
                        </div>
                        <p class="text-muted mt-3">Program latihan rutin untuk atlet binaan PTMSI Sumbar dengan fokus peningkatan teknik dasar.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="program-card">
                        <div class="program-icon">
                            <i class="bi bi-trophy-fill"></i>
                        </div>
                        <h4 class="program-title">Puslatda Pra-Kejuaraan</h4>
                        <div class="program-info">
                            <i class="bi bi-clock-fill"></i>
                            <span>Intensif 2 Minggu</span>
                        </div>
                        <div class="program-info">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>Lokasi Disesuaikan</span>
                        </div>
                        <div class="program-info">
                            <i class="bi bi-people-fill"></i>
                            <span>15-20 Atlet</span>
                        </div>
                        <p class="text-muted mt-3">Pemusatan latihan intensif sebagai persiapan menghadapi kejuaraan provinsi dan nasional.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="program-card">
                        <div class="program-icon">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <h4 class="program-title">Puslatda Atlet Muda</h4>
                        <div class="program-info">
                            <i class="bi bi-clock-fill"></i>
                            <span>Sabtu - Minggu, 08:00 - 12:00</span>
                        </div>
                        <div class="program-info">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>GOR Haji Agus Salim</span>
                        </div>
                        <div class="program-info">
                            <i class="bi bi-people-fill"></i>
                            <span>30 Atlet U-12 & U-15</span>
                        </div>
                        <p class="text-muted mt-3">Program pembinaan khusus untuk atlet muda dengan fokus pengembangan bakat dan karakter.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pembinaan Usia Dini Section -->
        <div id="pembinaan-usia-dini" class="card-modern mt-5">
            <h2 class="section-title-modern">
                <i class="bi bi-people-fill"></i> Program Pembinaan Usia Dini
            </h2>

            <p class="lead mb-4" style="color: #555; line-height: 1.8;">Program pembinaan usia dini bertujuan mengenalkan olahraga tenis meja sejak dini dan mengembangkan minat serta bakat anak-anak usia 6-12 tahun.</p>

            <div class="kegiatan-card">
                <div class="d-flex align-items-start gap-3">
                    <div class="kegiatan-icon">
                        <i class="bi bi-controller"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="fw-bold text-primary mb-2">Program Mini Tenis Meja</h5>
                        <div class="mb-3">
                            <span class="badge-status me-2">Berlangsung</span>
                            <span class="text-muted">
                                <i class="bi bi-calendar"></i> Setiap Sabtu |
                                <i class="bi bi-clock"></i> 09:00 - 11:00 WIB |
                                <i class="bi bi-people"></i> Usia 6-9 tahun
                            </span>
                        </div>
                        <p class="text-muted mb-0">Pengenalan dasar tenis meja dengan peralatan mini dan metode bermain sambil belajar untuk anak usia dini.</p>
                    </div>
                </div>
            </div>

            <div class="kegiatan-card">
                <div class="d-flex align-items-start gap-3">
                    <div class="kegiatan-icon">
                        <i class="bi bi-trophy"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="fw-bold text-primary mb-2">Kelas Teknik Dasar U-12</h5>
                        <div class="mb-3">
                            <span class="badge-status me-2">Berlangsung</span>
                            <span class="text-muted">
                                <i class="bi bi-calendar"></i> Senin & Rabu |
                                <i class="bi bi-clock"></i> 15:00 - 17:00 WIB |
                                <i class="bi bi-people"></i> Usia 10-12 tahun
                            </span>
                        </div>
                        <p class="text-muted mb-0">Pembelajaran teknik dasar seperti forehand, backhand, servis, dan footwork untuk kategori U-12.</p>
                    </div>
                </div>
            </div>

            <div class="kegiatan-card">
                <div class="d-flex align-items-start gap-3">
                    <div class="kegiatan-icon">
                        <i class="bi bi-heart"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="fw-bold text-primary mb-2">Program Sekolah Tenis Meja</h5>
                        <div class="mb-3">
                            <span class="badge-status me-2">Berlangsung</span>
                            <span class="text-muted">
                                <i class="bi bi-calendar"></i> Selasa & Kamis |
                                <i class="bi bi-clock"></i> 14:00 - 16:00 WIB |
                                <i class="bi bi-people"></i> SD/MI
                            </span>
                        </div>
                        <p class="text-muted mb-0">Kerjasama dengan sekolah-sekolah untuk memperkenalkan tenis meja sebagai ekstrakurikuler dan mencari bibit atlet.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Talent Scouting Section -->
        <div id="talent-scouting" class="card-modern mt-5">
            <h2 class="section-title-modern">
                <i class="bi bi-star-fill"></i> Talent Scouting
            </h2>

            <div class="alert alert-success d-flex align-items-center mb-4" role="alert" style="border-radius: 20px; border-left: 5px solid #28a745;">
                <i class="bi bi-check-circle-fill me-3" style="font-size: 2rem;"></i>
                <div>
                    <strong>Program pencarian dan pengembangan bakat</strong> atlet muda berbakat melalui seleksi, tes kemampuan, dan pembinaan berkelanjutan.
                </div>
            </div>

            <div class="info-grid">
                <div class="info-box">
                    <i class="bi bi-search"></i>
                    <h5>Seleksi Terbuka</h5>
                    <p class="text-muted">Seleksi terbuka untuk atlet muda berbakat dari seluruh Sumbar</p>
                </div>
                <div class="info-box">
                    <i class="bi bi-clipboard-check"></i>
                    <h5>Tes Kemampuan</h5>
                    <p class="text-muted">Tes fisik, teknik, dan mental untuk menilai potensi atlet</p>
                </div>
                <div class="info-box">
                    <i class="bi bi-graph-up-arrow"></i>
                    <h5>Pembinaan Lanjutan</h5>
                    <p class="text-muted">Program pembinaan khusus untuk atlet terpilih</p>
                </div>
            </div>
        </div>

        <!-- Coaching Clinic Section -->
        <div id="coaching-clinic" class="card-modern mt-5">
            <h2 class="section-title-modern">
                <i class="bi bi-award-fill"></i> Coaching Clinic & Pelatihan Wasit
            </h2>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="program-card">
                        <div class="program-icon">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <h4 class="program-title">Coaching Clinic</h4>
                        <p class="text-muted mb-3">Program pelatihan dan peningkatan kompetensi pelatih tenis meja melalui workshop dan seminar.</p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Pelatihan Teknik Modern</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Strategi Coaching</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Sport Psychology</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Sertifikasi Pelatih</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="program-card">
                        <div class="program-icon">
                            <i class="bi bi-flag-fill"></i>
                        </div>
                        <h4 class="program-title">Pelatihan Wasit</h4>
                        <p class="text-muted mb-3">Program pelatihan dan sertifikasi wasit tenis meja untuk memenuhi kebutuhan wasit berkualitas.</p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Peraturan Pertandingan</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Teknik Perwasitan</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Praktik Lapangan</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Sertifikasi Wasit</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="alert alert-warning d-flex align-items-center mt-4" role="alert" style="border-radius: 20px; border-left: 5px solid #ffc107;">
                <i class="bi bi-exclamation-triangle-fill me-3" style="font-size: 2rem;"></i>
                <div>
                    <strong>Informasi Pendaftaran:</strong> Untuk mendaftar coaching clinic atau pelatihan wasit, silakan hubungi sekretariat PTMSI Sumbar di <strong>0812-3456-7890</strong>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('layouts/footer') ?>

    <script>
        // Smooth scroll untuk navigasi
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>

</html>