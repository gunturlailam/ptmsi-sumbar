<style>
    .navbar-ptmsi {
        background: linear-gradient(90deg, #003366 60%, #1E90FF 100%) !important;
        box-shadow: 0 2px 16px rgba(30, 144, 255, 0.08);
        padding-top: 0.7rem;
        padding-bottom: 0.7rem;
        border-bottom: 3px solid #E8F2FF;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    }

    .navbar-ptmsi .navbar-brand {
        font-weight: 900;
        color: #fff !important;
        letter-spacing: 1.5px;
        font-size: 1.35rem;
        display: flex;
        align-items: center;
        gap: 12px;
        text-shadow: 0 2px 8px rgba(30, 144, 255, 0.10);
    }

    .navbar-ptmsi .navbar-brand img {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid #fff;
        box-shadow: 0 2px 8px rgba(30, 144, 255, 0.10);
    }

    .navbar-ptmsi .nav-link {
        color: #fff !important;
        font-weight: 600;
        margin-right: 8px;
        border-radius: 22px;
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        padding: 10px 22px !important;
        font-size: 1.05rem;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .navbar-ptmsi .nav-link.active,
    .navbar-ptmsi .nav-link:hover {
        background: linear-gradient(90deg, #1E90FF 60%, #36a2ff 100%) !important;
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(30, 144, 255, 0.10);
        text-shadow: 0 2px 8px rgba(30, 144, 255, 0.10);
    }

    .navbar-ptmsi .dropdown-menu {
        border-radius: 16px;
        min-width: 220px;
        box-shadow: 0 8px 32px rgba(30, 144, 255, 0.13);
        border: none;
        margin-top: 8px;
    }

    .navbar-ptmsi .dropdown-item {
        color: #003366;
        font-weight: 500;
        border-radius: 12px;
        transition: background 0.2s, color 0.2s;
        padding: 10px 18px;
        font-size: 1.01rem;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .navbar-ptmsi .dropdown-item:hover {
        background: linear-gradient(90deg, #E8F2FF 60%, #b3e0ff 100%);
        color: #1E90FF;
    }

    .navbar-ptmsi .btn-login {
        border-radius: 22px;
        background: linear-gradient(90deg, #1E90FF 60%, #36a2ff 100%);
        color: #fff;
        font-weight: 700;
        padding: 10px 32px;
        box-shadow: 0 2px 8px rgba(30, 144, 255, 0.10);
        border: none;
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        font-size: 1.05rem;
        letter-spacing: 0.5px;
        border-radius: 24px;
    }

    .navbar-ptmsi .btn-login:hover {
        background: #1565c0;
        color: #fff;
        box-shadow: 0 4px 16px rgba(30, 144, 255, 0.13);
    }

    .navbar-ptmsi .dropdown-item-text {
        color: #6c757d !important;
        font-size: 0.875rem;
        padding: 0.25rem 1rem;
    }

    .navbar-ptmsi .dropdown-header {
        color: #003366 !important;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .navbar-ptmsi .text-danger {
        color: #dc3545 !important;
    }

    .navbar-ptmsi .text-danger:hover {
        background: #f8d7da !important;
        color: #721c24 !important;
    }

    @media (max-width: 991px) {
        .navbar-ptmsi .nav-link {
            margin-bottom: 6px;
            padding: 10px 16px !important;
            font-size: 1rem;
        }

        .navbar-ptmsi .btn-login {
            width: 100%;
            margin-top: 10px;
            padding: 10px 0;
        }
    }
</style>
<nav class="navbar navbar-expand-lg navbar-ptmsi sticky-top" style="z-index: 1055; position: relative;">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('/') ?>">
            <img src="<?= base_url('assets/img/gambar-ptmsi.png') ?>" alt="Logo PTMSI">
            PTMSI Sumbar
        </a>
        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPTMSI" aria-controls="navbarPTMSI" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarPTMSI">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
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
                                                            url_is('event*') ||
                                                            url_is('pembinaan*') ||
                                                            url_is('klub-pengurus*') ||
                                                            url_is('berita*') ||
                                                            url_is('galeri*') ||
                                                            url_is('dokumen*') ||
                                                            url_is('ranking*') ||
                                                            url_is('layanan-online*') ||
                                                            url_is('hubungi-kami*')
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
                        <li><a class="dropdown-item" href="<?= base_url('layanan-online') ?>"><i class="bi bi-globe"></i> Layanan Online</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= base_url('registration/klub-register') ?>"><i class="bi bi-building-add"></i> Daftar Klub</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('hubungi-kami') ?>"><i class="bi bi-envelope"></i> Hubungi Kami</a></li>
                    </ul>
                </li>
            </ul>
            <div class="d-flex ms-lg-4 mt-3 mt-lg-0">
                <?php if (session()->get('logged_in')): ?>
                    <div class="dropdown">
                        <button class="btn btn-login dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <?= esc(session()->get('nama_lengkap')) ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <h6 class="dropdown-header">Selamat datang!</h6>
                            </li>
                            <li><span class="dropdown-item-text"><small><i class="bi bi-person"></i> <?= esc(session()->get('nama_lengkap')) ?></small></span></li>
                            <li><span class="dropdown-item-text"><small><i class="bi bi-envelope"></i> <?= esc(session()->get('email')) ?></small></span></li>
                            <li><span class="dropdown-item-text"><small><i class="bi bi-shield"></i> <?= ucfirst(esc(session()->get('role'))) ?></small></span></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <?php if (session()->get('role') === 'admin'): ?>
                                <li><a class="dropdown-item" href="<?= base_url('admin/dashboard') ?>"><i class="bi bi-speedometer2"></i> Dashboard Admin</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="<?= base_url('user/dashboard') ?>"><i class="bi bi-speedometer2"></i> Dashboard Saya</a></li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?= base_url('user/profile') ?>"><i class="bi bi-person"></i> Profil Saya</a></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="<?= base_url('login') ?>" class="btn btn-login">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>