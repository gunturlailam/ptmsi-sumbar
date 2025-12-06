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
            background: #E8F2FF;
            min-height: 100vh;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }

        .navbar-ptmsi {
            background: linear-gradient(90deg, #003366 60%, #1E90FF 100%);
            box-shadow: 0 2px 16px rgba(30, 144, 255, 0.08);
        }

        .navbar-ptmsi .navbar-brand {
            font-weight: bold;
            color: #fff !important;
            letter-spacing: 1px;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-ptmsi .navbar-brand img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid #fff;
        }

        .navbar-ptmsi .nav-link {
            color: #E8F2FF !important;
            font-weight: 500;
            margin-right: 6px;
            border-radius: 20px;
            transition: background 0.2s, color 0.2s;
            padding: 8px 18px !important;
        }

        .navbar-ptmsi .nav-link.active,
        .navbar-ptmsi .nav-link:hover {
            background: #1E90FF !important;
            color: #fff !important;
        }

        .navbar-ptmsi .dropdown-menu {
            border-radius: 14px;
            min-width: 220px;
            box-shadow: 0 4px 24px rgba(30, 144, 255, 0.13);
        }

        .navbar-ptmsi .dropdown-item {
            color: #003366;
            font-weight: 500;
            border-radius: 10px;
            transition: background 0.2s;
        }

        .navbar-ptmsi .dropdown-item:hover {
            background: #E8F2FF;
            color: #1E90FF;
        }

        @media (max-width: 991px) {
            .navbar-ptmsi .nav-link {
                margin-bottom: 6px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-ptmsi sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <img src="<?= base_url('assets/img/gambar-ptmsi.png') ?>" alt="Logo PTMSI">
                PTMSI Sumbar
            </a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPTMSI"
                aria-controls="navbarPTMSI" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarPTMSI">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link<?= url_is('/') ? ' active' : '' ?>" href="<?= base_url('/') ?>">
                            <i class="bi bi-house-door"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= url_is('profil*') ? ' active' : '' ?>" href="<?= base_url('profil') ?>">
                            <i class="bi bi-person-badge"></i> Profil
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle<?= (
                                                                url_is('atlet-pelatih*') ||
                                                                url_is('kejuaraan-event*') || url_is('event*') ||
                                                                url_is('pembinaan*') ||
                                                                url_is('klub-pengurus*') ||
                                                                url_is('berita*') ||
                                                                url_is('galeri*') ||
                                                                url_is('dokumen*') ||
                                                                url_is('ranking*') ||
                                                                url_is('layanan*') ||
                                                                url_is('kontak*')
                                                            ) ? ' active' : '' ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu Lainnya
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('atlet-pelatih') ?>"><i class="bi bi-people"></i> Atlet & Pelatih</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('event') ?>"><i class="bi bi-trophy"></i> Kejuaraan & Event</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('pembinaan') ?>"><i class="bi bi-mortarboard"></i> Program Pembinaan</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('klub-pengurus') ?>"><i class="bi bi-diagram-3"></i> Klub & Pengurus</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('berita') ?>"><i class="bi bi-newspaper"></i> Berita</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('galeri') ?>"><i class="bi bi-images"></i> Galeri</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('dokumen') ?>"><i class="bi bi-file-earmark-text"></i> Dokumen & Regulasi</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('ranking') ?>"><i class="bi bi-bar-chart"></i> Ranking & Statistik</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('layanan') ?>"><i class="bi bi-globe"></i> Layanan Online</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('kontak') ?>"><i class="bi bi-envelope"></i> Hubungi Kami</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex ms-lg-4 mt-3 mt-lg-0">
                    <a href="<?= base_url('login') ?>" class="btn btn-primary px-4 py-2 fw-bold" style="border-radius: 22px; background: #1E90FF; color: #fff;">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                </div>
            </div>
        </div>
    </nav>