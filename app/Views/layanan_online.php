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

        .form-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
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

        .info-box {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid var(--secondary-blue);
            margin-bottom: 20px;
        }

        .info-box i {
            font-size: 2rem;
            color: var(--secondary-blue);
            margin-right: 15px;
        }

        .alert {
            border-radius: 10px;
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
            <h1><i class="bi bi-globe"></i> Layanan Online</h1>
            <p>Pendaftaran dan Pengajuan Online PTMSI Sumbar</p>
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
                    <a class="nav-link active" href="#pendaftaran-atlet" data-bs-toggle="pill">
                        <i class="bi bi-person-plus"></i> Pendaftaran Atlet/Klub
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pendaftaran-turnamen" data-bs-toggle="pill">
                        <i class="bi bi-trophy"></i> Pendaftaran Turnamen
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pengajuan-sk" data-bs-toggle="pill">
                        <i class="bi bi-file-earmark-text"></i> Pengajuan SK Klub
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pengajuan-sertifikasi" data-bs-toggle="pill">
                        <i class="bi bi-award"></i> Pengajuan Sertifikasi
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <!-- 1. Pendaftaran Atlet/Klub Online -->
            <div class="tab-pane fade show active" id="pendaftaran-atlet">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-person-plus"></i> Pendaftaran Atlet/Klub Online
                    </h2>

                    <div class="info-box">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle"></i>
                            <div>
                                <strong>Informasi Penting:</strong>
                                <p class="mb-0">Pastikan data yang Anda masukkan sudah benar. Pendaftaran akan diverifikasi oleh admin PTMSI Sumbar.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-card">
                                <h4 class="text-primary mb-3"><i class="bi bi-person"></i> Pendaftaran Atlet</h4>
                                <form action="<?= base_url('layanan-online/submit-atlet') ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap Atlet</label>
                                        <input type="text" class="form-control" name="nama_atlet" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tanggal_lahir" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" name="jenis_kelamin" required>
                                            <option value="">Pilih...</option>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Klub</label>
                                        <input type="text" class="form-control" name="klub" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">No. HP</label>
                                        <input type="tel" class="form-control" name="nohp" required>
                                    </div>
                                    <button type="submit" class="btn btn-submit w-100">
                                        <i class="bi bi-send"></i> Kirim Pendaftaran Atlet
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-card">
                                <h4 class="text-primary mb-3"><i class="bi bi-building"></i> Pendaftaran Klub</h4>
                                <form action="<?= base_url('layanan-online/submit-klub') ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Klub</label>
                                        <input type="text" class="form-control" name="nama_klub" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat Lengkap</label>
                                        <textarea class="form-control" name="alamat" rows="2" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Penanggung Jawab</label>
                                        <input type="text" class="form-control" name="penanggung_jawab" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">No. Telepon</label>
                                        <input type="tel" class="form-control" name="telepon" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Berdiri</label>
                                        <input type="date" class="form-control" name="tanggal_berdiri" required>
                                    </div>
                                    <button type="submit" class="btn btn-submit w-100">
                                        <i class="bi bi-send"></i> Kirim Pendaftaran Klub
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Pendaftaran Turnamen -->
            <div class="tab-pane fade" id="pendaftaran-turnamen">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-trophy"></i> Pendaftaran Turnamen Online
                    </h2>

                    <div class="info-box">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar-event"></i>
                            <div>
                                <strong>Event Tersedia:</strong>
                                <p class="mb-0">Pilih event yang ingin Anda ikuti dan lengkapi formulir pendaftaran.</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-card">
                        <form action="<?= base_url('layanan-online/submit-turnamen') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pilih Event/Turnamen</label>
                                    <select class="form-select" name="id_event" required>
                                        <option value="">-- Pilih Event --</option>
                                        <?php if (!empty($events)): ?>
                                            <?php foreach ($events as $event): ?>
                                                <option value="<?= $event['id_event'] ?>">
                                                    <?= esc($event['judul']) ?> (<?= date('d M Y', strtotime($event['tanggal_mulai'])) ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kategori Pendaftaran</label>
                                    <select class="form-select" name="kategori" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="tunggal_putra">Tunggal Putra</option>
                                        <option value="tunggal_putri">Tunggal Putri</option>
                                        <option value="ganda_putra">Ganda Putra</option>
                                        <option value="ganda_putri">Ganda Putri</option>
                                        <option value="ganda_campuran">Ganda Campuran</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Atlet 1</label>
                                    <input type="text" class="form-control" name="atlet1" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Atlet 2 (untuk ganda)</label>
                                    <input type="text" class="form-control" name="atlet2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Klub</label>
                                    <input type="text" class="form-control" name="klub" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No. HP</label>
                                    <input type="tel" class="form-control" name="nohp" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-submit">
                                <i class="bi bi-send"></i> Daftar Turnamen
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- 3. Pengajuan SK Klub -->
            <div class="tab-pane fade" id="pengajuan-sk">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-file-earmark-text"></i> Pengajuan SK Klub Baru
                    </h2>

                    <div class="info-box">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clipboard-check"></i>
                            <div>
                                <strong>Persyaratan SK Klub:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>Surat permohonan pendirian klub</li>
                                    <li>AD/ART klub</li>
                                    <li>Susunan pengurus</li>
                                    <li>Minimal 10 anggota atlet</li>
                                    <li>Fasilitas latihan yang memadai</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-card">
                        <form action="<?= base_url('layanan-online/submit-sk-klub') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Klub</label>
                                    <input type="text" class="form-control" name="nama_klub" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Berdiri</label>
                                    <input type="date" class="form-control" name="tanggal_berdiri" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" name="alamat" rows="2" required></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Ketua Klub</label>
                                    <input type="text" class="form-control" name="ketua" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No. HP Ketua</label>
                                    <input type="tel" class="form-control" name="nohp_ketua" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah Anggota Atlet</label>
                                <input type="number" class="form-control" name="jumlah_atlet" min="10" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload Dokumen Persyaratan (PDF/ZIP)</label>
                                <input type="file" class="form-control" name="dokumen" accept=".pdf,.zip">
                                <small class="text-muted">Maksimal 5MB</small>
                            </div>
                            <button type="submit" class="btn btn-submit">
                                <i class="bi bi-send"></i> Ajukan SK Klub
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- 4. Pengajuan Sertifikasi Pelatih/Wasit -->
            <div class="tab-pane fade" id="pengajuan-sertifikasi">
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="bi bi-award"></i> Pengajuan Sertifikasi Pelatih/Wasit
                    </h2>

                    <div class="info-box">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-mortarboard"></i>
                            <div>
                                <strong>Jenis Sertifikasi:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>Pelatih Level Dasar (C)</li>
                                    <li>Pelatih Level Menengah (B)</li>
                                    <li>Pelatih Level Lanjut (A)</li>
                                    <li>Wasit Daerah</li>
                                    <li>Wasit Nasional</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-card">
                        <form action="<?= base_url('layanan-online/submit-sertifikasi') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIK</label>
                                    <input type="text" class="form-control" name="nik" maxlength="16" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Sertifikasi</label>
                                    <select class="form-select" name="jenis_sertifikasi" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="Pelatih C">Pelatih Level Dasar (C)</option>
                                        <option value="Pelatih B">Pelatih Level Menengah (B)</option>
                                        <option value="Pelatih A">Pelatih Level Lanjut (A)</option>
                                        <option value="Wasit Daerah">Wasit Daerah</option>
                                        <option value="Wasit Nasional">Wasit Nasional</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Klub/Organisasi</label>
                                    <input type="text" class="form-control" name="klub" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No. HP</label>
                                    <input type="tel" class="form-control" name="nohp" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pengalaman (tahun)</label>
                                <input type="number" class="form-control" name="pengalaman" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload Dokumen Pendukung (PDF)</label>
                                <input type="file" class="form-control" name="dokumen" accept=".pdf">
                                <small class="text-muted">KTP, Ijazah, Sertifikat sebelumnya (jika ada)</small>
                            </div>
                            <button type="submit" class="btn btn-submit">
                                <i class="bi bi-send"></i> Ajukan Sertifikasi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('layouts/footer') ?>

</body>

</html>