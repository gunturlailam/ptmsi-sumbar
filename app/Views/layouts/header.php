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

    .navbar {
        background: rgba(255, 255, 255, 0.98) !important;
        box-shadow: 0 2px 12px rgba(30, 144, 255, 0.12);
        border-radius: 0 0 18px 18px;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    .navbar-brand {
        font-weight: bold;
        color: #003366 !important;
        letter-spacing: 1px;
        font-size: 1.3rem;
        transition: color 0.2s;
    }

    .navbar-brand:hover {
        color: #1E90FF !important;
    }

    .navbar-nav .nav-link {
        color: #003366 !important;
        font-weight: 500;
        margin-right: 4px;
        border-radius: 16px;
        transition: background 0.2s, color 0.2s, transform 0.2s;
        padding: 8px 16px;
        font-size: 0.98rem;
    }

    .navbar-nav .nav-link.active,
    .navbar-nav .nav-link:hover {
        background: linear-gradient(90deg, #1E90FF 60%, #003366 100%);
        color: #fff !important;
        box-shadow: 0 2px 8px rgba(30, 144, 255, 0.2);
        transform: translateY(-2px);
    }

    .navbar-toggler {
        border: 2px solid #003366;
        border-radius: 8px;
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 0 0.2rem rgba(30, 144, 255, 0.25);
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 51, 102, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    .navbar .logo {
        width: 36px;
        height: 36px;
        margin-right: 10px;
        border-radius: 50%;
        border: 2px solid #1E90FF;
        background: #fff;
        object-fit: cover;
        box-shadow: 0 2px 8px rgba(30, 144, 255, 0.2);
    }

    .dropdown-menu {
        border-radius: 12px;
        border: 1px solid #E8F2FF;
        box-shadow: 0 4px 16px rgba(30, 144, 255, 0.15);
        margin-top: 8px;
    }

    .dropdown-item {
        color: #003366;
        padding: 10px 16px;
        transition: background 0.2s, color 0.2s;
    }

    .dropdown-item:hover {
        background: linear-gradient(90deg, #1E90FF 60%, #003366 100%);
        color: #fff;
    }

    .dropdown-item.active {
        background: linear-gradient(90deg, #1E90FF 60%, #003366 100%);
        color: #fff;
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
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == '' || uri_string() == 'beranda') ? 'active' : '' ?>"
                            href="<?= base_url('/') ?>">
                            <i class="bi bi-house-door"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= uri_string() == 'profil' ? 'active' : '' ?>"
                            href="<?= base_url('profil') ?>">
                            <i class="bi bi-info-circle"></i> Profil
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= (strpos(uri_string(), 'event') !== false || strpos(uri_string(), 'atlet-pelatih') !== false || strpos(uri_string(), 'berita') !== false || strpos(uri_string(), 'galeri') !== false || strpos(uri_string(), 'dokumen') !== false || strpos(uri_string(), 'ranking') !== false || strpos(uri_string(), 'kontak') !== false) ? 'active' : '' ?>"
                            href="#" id="menuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-list"></i> Menu
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="menuDropdown">
                            <li>
                                <a class="dropdown-item <?= strpos(uri_string(), 'atlet-pelatih') !== false ? 'active' : '' ?>"
                                    href="<?= base_url('atlet-pelatih') ?>">
                                    <i class="bi bi-people"></i> Atlet & Pelatih
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= strpos(uri_string(), 'event') !== false ? 'active' : '' ?>"
                                    href="<?= base_url('event') ?>">
                                    <i class="bi bi-trophy"></i> Kejuaraan & Event
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= strpos(uri_string(), 'berita') !== false ? 'active' : '' ?>"
                                    href="<?= base_url('berita') ?>">
                                    <i class="bi bi-newspaper"></i> Berita
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= strpos(uri_string(), 'galeri') !== false ? 'active' : '' ?>"
                                    href="<?= base_url('galeri') ?>">
                                    <i class="bi bi-images"></i> Galeri
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= strpos(uri_string(), 'dokumen') !== false ? 'active' : '' ?>"
                                    href="<?= base_url('dokumen') ?>">
                                    <i class="bi bi-file-earmark-text"></i> Dokumen & Regulasi
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item <?= strpos(uri_string(), 'ranking') !== false ? 'active' : '' ?>"
                                    href="<?= base_url('ranking') ?>">
                                    <i class="bi bi-bar-chart"></i> Ranking & Statistik
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item <?= strpos(uri_string(), 'kontak') !== false ? 'active' : '' ?>"
                                    href="<?= base_url('kontak') ?>">
                                    <i class="bi bi-envelope"></i> Hubungi Kami
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>