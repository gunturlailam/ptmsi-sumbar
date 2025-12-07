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
            padding: 14px 24px;
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

        .contact-card {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .contact-card i {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .contact-card h4 {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .contact-card p {
            margin: 0;
            opacity: 0.9;
        }

        .form-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 30px;
            border-radius: 10px;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
        }

        .map-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .map-container iframe {
            width: 100%;
            height: 400px;
            border: none;
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