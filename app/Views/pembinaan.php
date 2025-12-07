<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Program Pembinaan - PTMSI Sumbar') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #003366;
            --secondary-blue: #1E90FF;
            --light-blue: #00BFFF;
        }

        body {
            background: linear-gradient(135deg, #E8F2FF 0%, #F0F8FF 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.5;
            }

            50% {
                opacity: 0.8;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--light-blue) 100%);
            color: white;
            padding: 60px 0 40px;
            margin-bottom: 50px;
            border-radius: 0 0 50px 50px;
            box-shadow: 0 15px 50px rgba(30, 144, 255, 0.25);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: pulse 8s ease-in-out infinite;
        }

        .hero-section h1 {
            font-size: 2.8rem;
            font-weight: 900;
            margin-bottom: 15px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.8s ease-out;
        }

        .submenu-nav {
            background: white;
            border-radius: 30px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(30, 144, 255, 0.15);
            position: relative;
            overflow: hidden;
        }

        .submenu-nav::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(30, 144, 255, 0.05) 0%, transparent 70%);
        }

        .submenu-nav .nav-link {
            color: var(--primary-blue);
            font-weight: 700;
            padding: 14px 28px;
            border-radius: 25px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            margin: 5px;
            position: relative;
            z-index: 1;
        }

        .submenu-nav .nav-link:hover,
        .submenu-nav .nav-link.active {
            background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--light-blue) 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(30, 144, 255, 0.3);
        }

        .section-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            color: var(--primary-blue);
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid var(--secondary-blue);
        }

        .program-card {
            background: linear-gradient(135deg, var(--light-blue) 0%, #fff 100%);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            border-left: 5px solid var(--secondary-blue);
            transition: all 0.3s ease;
        }

        .program-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .program-icon {
            background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--primary-blue) 100%);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .kegiatan-item {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid var(--secondary-blue);
            transition: all 0.3s ease;
        }

        .kegiatan-item:hover {
            background: var(--light-blue);
            transform: translateX(5px);
        }

        .badge-custom {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .badge-berlangsung {
            background: #d4edda;
            color: #155724;
        }

        .info-box {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid var(--secondary-blue);
            margin-bottom: 25px;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 1.8rem;
            }

            .submenu-nav .nav-link {
                display: block;
                margin: 5px 0;
            }
        }
    </style>
</head>

<body>
    <?= $this->include('layouts/header') ?>

    <div class="hero-section">
        <div class="container">
            <h1><i class="bi bi-mortarboard"></i> Program Pembinaan</h1>
            <p>Membangun Atlet Berprestasi Melalui Pembinaan Berkelanjutan</p>
        </div>
    </div>

    <div class="container">
        <!-- Sub Menu Navigation -->
        <div class="submenu-nav">
            <ul class="nav nav-pills justify-content-center flex-wrap">
                <li class="nav-item">
                    <a class="nav-link active" href="#puslatda" data-bs-toggle="pill">
                        <i class="bi bi-building"></i> Puslatda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pembinaan-usia-dini" data-bs-toggle="pill">
                        <i class="bi bi-people"></i> Pembinaan Usia Dini
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#talent-scouting" data-bs-toggle="pill">
                        <i class="bi bi-star"></i> Talent Scouting
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#coaching-clinic" data-bs-toggle="pill">
                        <i class="bi bi-award"></i> Coaching Clinic
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <!-- 1. Pemusatan Latihan Daerah (Puslatda) -->
            <div class="tab-pane fade show active" id="puslatda">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-building"></i> Pemusatan Latihan Daerah (Puslatda)
                    </h2>

                    <div class="info-box">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle" style="font-size: 2rem; color: var(--secondary-blue); margin-right: 15px;"></i>
                            <div>
                                <strong>Puslatda</strong> adalah program pemusatan latihan untuk atlet-atlet terpilih yang bertujuan meningkatkan kemampuan teknis dan mental bertanding.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="program-card">
                                <div class="program-icon">
                                    <i class="bi bi-calendar-range"></i>
                                </div>
                                <h4 style="color: var(--primary-blue); font-weight: 700;">Puslatda Reguler</h4>
                                <p class="mb-2"><i class="bi bi-clock text-primary"></i> Senin - Jumat, 16:00 - 19:00</p>
                                <p class="mb-2"><i class="bi bi-geo-alt text-primary"></i> GOR Haji Agus Salim</p>
                                <p class="mb-2"><i class="bi bi-people text-primary"></i> 25 Atlet Terpilih</p>
                                <p class="text-muted mt-3">Program latihan rutin untuk atlet binaan PTMSI Sumbar dengan fokus peningkatan teknik dasar.</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="program-card">
                                <div class="program-icon">
                                    <i class="bi bi-trophy"></i>
                                </div>
                                <h4 style="color: var(--primary-blue); font-weight: 700;">Puslatda Pra-Kejuaraan</h4>
                                <p class="mb-2"><i class="bi bi-clock text-primary"></i> Intensif 2 Minggu</p>
                                <p class="mb-2"><i class="bi bi-geo-alt text-primary"></i> Lokasi Disesuaikan</p>
                                <p class="mb-2"><i class="bi bi-people text-primary"></i> 15-20 Atlet</p>
                                <p class="text-muted mt-3">Pemusatan latihan intensif sebagai persiapan menghadapi kejuaraan provinsi dan nasional.</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="program-card">
                                <div class="program-icon">
                                    <i class="bi bi-star"></i>
                                </div>
                                <h4 style="color: var(--primary-blue); font-weight: 700;">Puslatda Atlet Muda</h4>
                                <p class="mb-2"><i class="bi bi-clock text-primary"></i> Sabtu - Minggu, 08:00 - 12:00</p>
                                <p class="mb-2"><i class="bi bi-geo-alt text-primary"></i> GOR Haji Agus Salim</p>
                                <p class="mb-2"><i class="bi bi-people text-primary"></i> 30 Atlet U-12 & U-15</p>
                                <p class="text-muted mt-3">Program pembinaan khusus untuk atlet muda dengan fokus pengembangan bakat dan karakter.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Program Pembinaan Usia Dini -->
            <div class="tab-pane fade" id="pembinaan-usia-dini">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-people"></i> Program Pembinaan Usia Dini
                    </h2>

                    <p class="lead mb-4">Program pembinaan usia dini bertujuan mengenalkan olahraga tenis meja sejak dini dan mengembangkan minat serta bakat anak-anak usia 6-12 tahun.</p>

                    <div class="kegiatan-item">
                        <div class="d-flex align-items-start">
                            <div class="program-icon me-3" style="width: 50px; height: 50px; font-size: 1.5rem;">
                                <i class="bi bi-controller"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 style="color: var(--primary-blue); font-weight: 700;">Program Mini Tenis Meja</h5>
                                <p class="mb-2">
                                    <span class="badge-custom badge-berlangsung me-2">Berlangsung</span>
                                    <i class="bi bi-calendar"></i> Setiap Sabtu
                                    <i class="bi bi-clock ms-2"></i> 09:00 - 11:00 WIB
                                    <i class="bi bi-people ms-2"></i> Usia 6-9 tahun
                                </p>
                                <p class="text-muted">Pengenalan dasar tenis meja dengan peralatan mini dan metode bermain sambil belajar untuk anak usia dini.</p>
                            </div>
                        </div>
                    </div>

                    <div class="kegiatan-item">
                        <div class="d-flex align-items-start">
                            <div class="program-icon me-3" style="width: 50px; height: 50px; font-size: 1.5rem;">
                                <i class="bi bi-trophy"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 style="color: var(--primary-blue); font-weight: 700;">Kelas Teknik Dasar U-12</h5>
                                <p class="mb-2">
                                    <span class="badge-custom badge-berlangsung me-2">Berlangsung</span>
                                    <i class="bi bi-calendar"></i> Senin & Rabu
                                    <i class="bi bi-clock ms-2"></i> 15:00 - 17:00 WIB
                                    <i class="bi bi-people ms-2"></i> Usia 10-12 tahun
                                </p>
                                <p class="text-muted">Pembelajaran teknik dasar seperti forehand, backhand, servis, dan footwork untuk kategori U-12.</p>
                            </div>
                        </div>
                    </div>

                    <div class="kegiatan-item">
                        <div class="d-flex align-items-start">
                            <div class="program-icon me-3" style="width: 50px; height: 50px; font-size: 1.5rem;">
                                <i class="bi bi-heart"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 style="color: var(--primary-blue); font-weight: 700;">Program Sekolah Tenis Meja</h5>
                                <p class="mb-2">
                                    <span class="badge-custom badge-berlangsung me-2">Berlangsung</span>
                                    <i class="bi bi-calendar"></i> Selasa & Kamis
                                    <i class="bi bi-clock ms-2"></i> 14:00 - 16:00 WIB
                                    <i class="bi bi-people ms-2"></i> SD/MI
                                </p>
                                <p class="text-muted">Kerjasama dengan sekolah-sekolah untuk memperkenalkan tenis meja sebagai ekstrakurikuler dan mencari bibit atlet.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Talent Scouting -->
            <div class="tab-pane fade" id="talent-scouting">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-star"></i> Talent Scouting
                    </h2>

                    <div class="alert alert-success">
                        <i class="bi bi-check-circle"></i>
                        <strong>Program pencarian dan pengembangan bakat</strong> atlet muda berbakat melalui seleksi, tes kemampuan, dan pembinaan berkelanjutan.
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <div class="text-center p-4 bg-light rounded">
                                <i class="bi bi-search" style="font-size: 3rem; color: var(--secondary-blue);"></i>
                                <h5 class="mt-3" style="color: var(--primary-blue);">Seleksi Terbuka</h5>
                                <p class="text-muted">Seleksi terbuka untuk atlet muda berbakat dari seluruh Sumbar</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-4 bg-light rounded">
                                <i class="bi bi-clipboard-check" style="font-size: 3rem; color: var(--secondary-blue);"></i>
                                <h5 class="mt-3" style="color: var(--primary-blue);">Tes Kemampuan</h5>
                                <p class="text-muted">Tes fisik, teknik, dan mental untuk menilai potensi atlet</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-4 bg-light rounded">
                                <i class="bi bi-graph-up-arrow" style="font-size: 3rem; color: var(--secondary-blue);"></i>
                                <h5 class="mt-3" style="color: var(--primary-blue);">Pembinaan Lanjutan</h5>
                                <p class="text-muted">Program pembinaan khusus untuk atlet terpilih</p>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i>
                        Data atlet hasil talent scouting akan ditampilkan setelah proses seleksi selesai.
                    </div>
                </div>
            </div>

            <!-- 4. Coaching Clinic & Pelatihan Wasit -->
            <div class="tab-pane fade" id="coaching-clinic">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-award"></i> Coaching Clinic & Pelatihan Wasit
                    </h2>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="program-card">
                                <h5 style="color: var(--primary-blue);">
                                    <i class="bi bi-mortarboard"></i> Coaching Clinic
                                </h5>
                                <p class="text-muted">Program pelatihan dan peningkatan kompetensi pelatih tenis meja melalui workshop dan seminar.</p>
                                <ul class="list-unstyled mt-3">
                                    <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Pelatihan Teknik Modern</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Strategi Coaching</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Sport Psychology</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Sertifikasi Pelatih</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="program-card">
                                <h5 style="color: var(--primary-blue);">
                                    <i class="bi bi-flag"></i> Pelatihan Wasit
                                </h5>
                                <p class="text-muted">Program pelatihan dan sertifikasi wasit tenis meja untuk memenuhi kebutuhan wasit berkualitas.</p>
                                <ul class="list-unstyled mt-3">
                                    <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Peraturan Pertandingan</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Teknik Perwasitan</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Praktik Lapangan</li>
                                    <li class="mb-2"><i class="bi bi-check-circle text-success"></i> Sertifikasi Wasit</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                        <strong>Informasi Pendaftaran:</strong> Untuk mendaftar coaching clinic atau pelatihan wasit, silakan hubungi sekretariat PTMSI Sumbar di <strong>0812-3456-7890</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('layouts/footer') ?>

</body>

</html>