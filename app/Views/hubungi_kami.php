<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - PTMSI Sumbar</title>
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #E8F2FF 0%, #F0F8FF 100%);
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
            padding: 35px;
            margin-bottom: 40px;
            box-shadow: 0 10px 40px rgba(30, 144, 255, 0.15);
            position: relative;
            overflow: hidden;
            border: 2px solid #E8F2FF;
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
            padding: 16px 28px;
            border-radius: 25px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            margin: 8px;
            position: relative;
            z-index: 1;
            border: 2px solid transparent;
            font-size: 1.05rem;
        }

        .submenu-nav .nav-link:hover {
            background: linear-gradient(135deg, #E8F2FF 0%, #fff 100%);
            color: var(--primary-blue);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(30, 144, 255, 0.2);
            border-color: var(--secondary-blue);
        }

        .submenu-nav .nav-link.active {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--light-blue) 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(30, 144, 255, 0.4);
        }

        .submenu-nav .nav-link i {
            font-size: 1.2rem;
            margin-right: 8px;
        }

        .section-card {
            background: white;
            border-radius: 25px;
            padding: 35px;
            margin-bottom: 35px;
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.12);
            border: 2px solid #E8F2FF;
            transition: all 0.3s ease;
        }

        .section-card:hover {
            box-shadow: 0 12px 40px rgba(30, 144, 255, 0.18);
            transform: translateY(-2px);
        }

        .section-title {
            color: var(--primary-blue);
            font-size: 1.9rem;
            font-weight: 900;
            margin-bottom: 25px;
            padding: 20px;
            background: linear-gradient(to right, #E8F2FF 0%, transparent 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .section-title i {
            color: var(--secondary-blue);
            font-size: 2rem;
        }

        .contact-card {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--light-blue) 100%);
            color: white;
            border-radius: 25px;
            padding: 35px;
            margin-bottom: 25px;
            transition: all 0.4s ease;
            box-shadow: 0 8px 25px rgba(30, 144, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .contact-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        }

        .contact-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 35px rgba(30, 144, 255, 0.4);
        }

        .contact-card i {
            font-size: 3.5rem;
            margin-bottom: 18px;
            position: relative;
            z-index: 1;
            animation: bounce 2s ease-in-out infinite;
        }

        .contact-card h4 {
            font-weight: 900;
            margin-bottom: 12px;
            font-size: 1.4rem;
            position: relative;
            z-index: 1;
        }

        .contact-card p {
            margin: 0;
            opacity: 0.95;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }

        .contact-card a {
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .contact-card a:hover {
            text-decoration: underline;
        }

        .contact-card .btn-light {
            background: white;
            color: var(--primary-blue);
            border: none;
            padding: 12px 24px;
            border-radius: 20px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .contact-card .btn-light:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .form-card {
            background: linear-gradient(135deg, #E8F2FF 0%, #F8F9FA 100%);
            padding: 35px;
            border-radius: 25px;
            border: 2px solid #E8F2FF;
            box-shadow: 0 4px 20px rgba(30, 144, 255, 0.08);
            transition: all 0.3s ease;
        }

        .form-card:hover {
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.15);
            transform: translateY(-2px);
        }

        .form-label {
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 15px;
            border: 2px solid #E8F2FF;
            padding: 12px 18px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 0.2rem rgba(30, 144, 255, 0.25);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--light-blue) 100%);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 20px;
            font-weight: 700;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(30, 144, 255, 0.3);
            font-size: 1.05rem;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(30, 144, 255, 0.4);
            color: white;
        }

        .btn-submit i {
            font-size: 1.2rem;
            margin-right: 8px;
        }

        .map-container {
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(30, 144, 255, 0.15);
            margin-bottom: 35px;
            border: 3px solid #E8F2FF;
            transition: all 0.3s ease;
        }

        .map-container:hover {
            box-shadow: 0 12px 40px rgba(30, 144, 255, 0.25);
            transform: translateY(-3px);
        }

        .map-container iframe {
            width: 100%;
            height: 450px;
            border: none;
        }

        .alert {
            border-radius: 20px;
            border: 2px solid;
            padding: 18px 20px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .alert-success {
            background: linear-gradient(135deg, #E8F5E9 0%, #C8E6C9 100%);
            border-color: #66BB6A;
            color: #2E7D32;
        }

        .alert-danger {
            background: linear-gradient(135deg, #FFEBEE 0%, #FFCDD2 100%);
            border-color: #EF5350;
            color: #C62828;
        }

        .alert-info {
            background: linear-gradient(135deg, #E8F2FF 0%, #BBDEFB 100%);
            border-color: var(--secondary-blue);
            color: var(--primary-blue);
            font-weight: 600;
        }

        .alert i {
            font-size: 1.3rem;
            margin-right: 10px;
        }

        .text-danger {
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 1.8rem;
            }

            .submenu-nav .nav-link {
                display: block;
                margin: 5px 0;
            }

            .section-card {
                padding: 20px;
            }

            .form-card {
                padding: 20px;
            }

            .contact-card {
                padding: 25px;
            }

            .contact-card i {
                font-size: 2.5rem;
            }

            .map-container iframe {
                height: 300px;
            }
        }
    </style>
</head>

<body>
    <?= $this->include('layouts/header') ?>

    <div class="hero-section">
        <div class="container">
            <h1><i class="bi bi-envelope"></i> Hubungi Kami</h1>
            <p>Kontak dan Informasi PTMSI Sumatera Barat</p>
        </div>
    </div>

    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle"></i> <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Sub Menu Navigation -->
        <div class="submenu-nav">
            <ul class="nav nav-pills justify-content-center flex-wrap">
                <li class="nav-item">
                    <a class="nav-link active" href="#alamat-sekretariat" data-bs-toggle="pill">
                        <i class="bi bi-geo-alt"></i> Alamat Sekretariat
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#kontak-resmi" data-bs-toggle="pill">
                        <i class="bi bi-telephone"></i> Kontak Resmi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#whatsapp-admin" data-bs-toggle="pill">
                        <i class="bi bi-whatsapp"></i> WhatsApp Admin
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#formulir-kontak" data-bs-toggle="pill">
                        <i class="bi bi-chat-dots"></i> Formulir Pengaduan
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <!-- 1. Alamat Sekretariat -->
            <div class="tab-pane fade show active" id="alamat-sekretariat">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-geo-alt"></i> Alamat Sekretariat PTMSI Sumbar
                    </h2>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="contact-card">
                                <i class="bi bi-building"></i>
                                <h4>Kantor Sekretariat</h4>
                                <p><strong>Alamat:</strong></p>
                                <p>Jl. Khatib Sulaiman No. 52</p>
                                <p>Padang, Sumatera Barat 25136</p>
                                <p class="mt-3"><strong>Jam Operasional:</strong></p>
                                <p>Senin - Jumat: 08.00 - 16.00 WIB</p>
                                <p>Sabtu: 08.00 - 12.00 WIB</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-card">
                                <i class="bi bi-pin-map"></i>
                                <h4>Lokasi Latihan</h4>
                                <p><strong>GOR Haji Agus Salim</strong></p>
                                <p>Jl. Sudirman, Padang</p>
                                <p class="mt-3"><strong>Fasilitas:</strong></p>
                                <p>• 8 Meja Tenis Meja Standar ITTF</p>
                                <p>• Ruang Ganti & Toilet</p>
                                <p>• Tribun Penonton</p>
                            </div>
                        </div>
                    </div>

                    <!-- Google Maps -->
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.3089876543!2d100.3644!3d-0.9471!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMMKwNTYnNDkuNiJTIDEwMMKwMjEnNTEuOCJF!5e0!3m2!1sen!2sid!4v1234567890"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- 2. Kontak Resmi -->
            <div class="tab-pane fade" id="kontak-resmi">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-telephone"></i> Kontak Resmi PTMSI Sumbar
                    </h2>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="contact-card text-center">
                                <i class="bi bi-envelope-at"></i>
                                <h4>Email Resmi</h4>
                                <p><a href="mailto:ptmsi.sumbar@gmail.com" class="text-white">ptmsi.sumbar@gmail.com</a></p>
                                <p><a href="mailto:info@ptmsisumbar.or.id" class="text-white">info@ptmsisumbar.or.id</a></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-card text-center">
                                <i class="bi bi-telephone-fill"></i>
                                <h4>Telepon Kantor</h4>
                                <p><a href="tel:+62751123456" class="text-white">(0751) 123-456</a></p>
                                <p><a href="tel:+62751789012" class="text-white">(0751) 789-012</a></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-card text-center">
                                <i class="bi bi-phone"></i>
                                <h4>HP Sekretaris</h4>
                                <p><a href="tel:+6281234567890" class="text-white">0812-3456-7890</a></p>
                                <p class="small">Senin - Jumat (08.00-16.00)</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="contact-card text-center">
                                <i class="bi bi-facebook"></i>
                                <h4>Facebook</h4>
                                <p><a href="https://facebook.com/ptmsisumbar" target="_blank" class="text-white">@ptmsisumbar</a></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-card text-center">
                                <i class="bi bi-instagram"></i>
                                <h4>Instagram</h4>
                                <p><a href="https://instagram.com/ptmsisumbar" target="_blank" class="text-white">@ptmsisumbar</a></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-card text-center">
                                <i class="bi bi-youtube"></i>
                                <h4>YouTube</h4>
                                <p><a href="https://youtube.com/@ptmsisumbar" target="_blank" class="text-white">PTMSI Sumbar</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. WhatsApp Admin -->
            <div class="tab-pane fade" id="whatsapp-admin">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-whatsapp"></i> Kontak WhatsApp Admin
                    </h2>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-card">
                                <i class="bi bi-person-badge"></i>
                                <h4>Admin Pendaftaran Atlet</h4>
                                <p><strong>Nama:</strong> Budi Santoso</p>
                                <p><strong>WhatsApp:</strong></p>
                                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20bertanya%20tentang%20pendaftaran%20atlet"
                                    target="_blank"
                                    class="btn btn-light mt-2">
                                    <i class="bi bi-whatsapp"></i> Chat WhatsApp
                                </a>
                                <p class="mt-3 small">Layanan: Senin-Jumat (08.00-17.00)</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-card">
                                <i class="bi bi-trophy"></i>
                                <h4>Admin Event & Turnamen</h4>
                                <p><strong>Nama:</strong> Siti Rahma</p>
                                <p><strong>WhatsApp:</strong></p>
                                <a href="https://wa.me/6281298765432?text=Halo,%20saya%20ingin%20bertanya%20tentang%20event%20dan%20turnamen"
                                    target="_blank"
                                    class="btn btn-light mt-2">
                                    <i class="bi bi-whatsapp"></i> Chat WhatsApp
                                </a>
                                <p class="mt-3 small">Layanan: Senin-Jumat (08.00-17.00)</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="contact-card">
                                <i class="bi bi-building"></i>
                                <h4>Admin Klub & Organisasi</h4>
                                <p><strong>Nama:</strong> Ahmad Fauzi</p>
                                <p><strong>WhatsApp:</strong></p>
                                <a href="https://wa.me/6281356789012?text=Halo,%20saya%20ingin%20bertanya%20tentang%20klub%20dan%20organisasi"
                                    target="_blank"
                                    class="btn btn-light mt-2">
                                    <i class="bi bi-whatsapp"></i> Chat WhatsApp
                                </a>
                                <p class="mt-3 small">Layanan: Senin-Jumat (08.00-17.00)</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-card">
                                <i class="bi bi-award"></i>
                                <h4>Admin Sertifikasi</h4>
                                <p><strong>Nama:</strong> Dewi Lestari</p>
                                <p><strong>WhatsApp:</strong></p>
                                <a href="https://wa.me/6281445678901?text=Halo,%20saya%20ingin%20bertanya%20tentang%20sertifikasi"
                                    target="_blank"
                                    class="btn btn-light mt-2">
                                    <i class="bi bi-whatsapp"></i> Chat WhatsApp
                                </a>
                                <p class="mt-3 small">Layanan: Senin-Jumat (08.00-17.00)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Formulir Pengaduan/Pertanyaan -->
            <div class="tab-pane fade" id="formulir-kontak">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-chat-dots"></i> Formulir Pengaduan & Pertanyaan
                    </h2>

                    <div class="form-card">
                        <form action="<?= base_url('hubungi-kami/submit') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama" required
                                        value="<?= old('nama') ?>">
                                    <?php if (session('errors.nama')): ?>
                                        <small class="text-danger"><?= session('errors.nama') ?></small>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" required
                                        value="<?= old('email') ?>">
                                    <?php if (session('errors.email')): ?>
                                        <small class="text-danger"><?= session('errors.email') ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No. Telepon/HP</label>
                                    <input type="tel" class="form-control" name="telepon"
                                        value="<?= old('telepon') ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Subjek <span class="text-danger">*</span></label>
                                    <select class="form-select" name="subjek" required>
                                        <option value="">-- Pilih Subjek --</option>
                                        <option value="Pendaftaran Atlet" <?= old('subjek') == 'Pendaftaran Atlet' ? 'selected' : '' ?>>Pendaftaran Atlet</option>
                                        <option value="Pendaftaran Klub" <?= old('subjek') == 'Pendaftaran Klub' ? 'selected' : '' ?>>Pendaftaran Klub</option>
                                        <option value="Event & Turnamen" <?= old('subjek') == 'Event & Turnamen' ? 'selected' : '' ?>>Event & Turnamen</option>
                                        <option value="Sertifikasi" <?= old('subjek') == 'Sertifikasi' ? 'selected' : '' ?>>Sertifikasi</option>
                                        <option value="Pengaduan" <?= old('subjek') == 'Pengaduan' ? 'selected' : '' ?>>Pengaduan</option>
                                        <option value="Lainnya" <?= old('subjek') == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                    </select>
                                    <?php if (session('errors.subjek')): ?>
                                        <small class="text-danger"><?= session('errors.subjek') ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pesan/Pertanyaan <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="pesan" rows="6" required><?= old('pesan') ?></textarea>
                                <?php if (session('errors.pesan')): ?>
                                    <small class="text-danger"><?= session('errors.pesan') ?></small>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn btn-submit">
                                <i class="bi bi-send"></i> Kirim Pesan
                            </button>
                        </form>
                    </div>

                    <div class="alert alert-info mt-4">
                        <i class="bi bi-info-circle"></i>
                        <strong>Catatan:</strong> Pesan Anda akan dibalas melalui email dalam waktu 1x24 jam (hari kerja).
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('layouts/footer') ?>

</body>

</html>