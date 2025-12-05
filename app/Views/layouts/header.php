<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'PTMSI Sumbar' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #0d6efd 0%, #6c757d 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.09);
            border-radius: 0 0 18px 18px;
            padding-top: 0.2rem;
            padding-bottom: 0.2rem;
        }

        .navbar-brand {
            font-weight: bold;
            color: #0d6efd !important;
            letter-spacing: 1px;
            font-size: 1.2rem;
        }

        .navbar-nav .nav-link {
            color: #212529 !important;
            font-weight: 500;
            margin-right: 4px;
            border-radius: 16px;
            transition: background 0.2s, color 0.2s;
            padding: 6px 14px;
            font-size: 0.98rem;
        }

        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:hover {
            background: linear-gradient(90deg, #0d6efd 60%, #ffc107 100%);
            color: #fff !important;
            box-shadow: 0 2px 8px rgba(13, 110, 253, 0.08);
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar .logo {
            width: 32px;
            margin-right: 8px;
            border-radius: 50%;
            border: 2px solid #ffc107;
            background: #fff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid px-3">
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url('/') ?>">
                <img src="<?= base_url('assets/img/gambar-ptmsi.png') ?>" alt="PTMSI" class="logo">
                PTMSI Sumbar
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link <?= uri_string() == '' ? 'active' : '' ?>" href="<?= base_url('/') ?>">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link <?= uri_string() == 'profil' ? 'active' : '' ?>" href="<?= base_url('profil') ?>">Profil</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="menuDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('atlet-pelatih') ?>">Atlet & Pelatih</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('event') ?>">Kejuaraan & Event</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('berita') ?>">Berita</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('galeri') ?>">Galeri</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('dokumen') ?>">Dokumen & Regulasi</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('ranking') ?>">Ranking & Statistik</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('kontak') ?>">Hubungi Kami</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>