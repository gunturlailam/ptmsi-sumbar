<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - PTMSI Sumbar' : 'PTMSI Sumbar' ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/ptmsi-style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/public-style.css') ?>">

    <?= $this->renderSection('css') ?>

    <style>
        :root {
            --primary: #f59e0b;
            --secondary: #d97706;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
            --light: #f8f9fa;
            --dark: #1f2937;
            --darker: #111827;
            --card-dark: #1e293b;
            --text-light: #e5e7eb;
            --text-muted: #9ca3af;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0f172a;
            color: var(--text-light);
        }

        /* ===== NAVBAR PREMIUM ===== */
        .navbar-premium {
            background: linear-gradient(135deg, var(--darker) 0%, #0f172a 100%);
            box-shadow: 0 4px 20px rgba(245, 158, 11, 0.2);
            padding: 0.75rem 0;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(245, 158, 11, 0.1);
        }

        .navbar-premium.sticky-top {
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        /* Brand Premium */
        .brand-premium {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 900;
            color: var(--primary) !important;
            transition: all 0.3s ease;
        }

        .brand-premium:hover {
            transform: scale(1.05);
        }

        .brand-icon {
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(245, 158, 11, 0.15);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            transition: all 0.3s ease;
            color: var(--primary);
        }

        .brand-premium:hover .brand-icon {
            background: rgba(245, 158, 11, 0.25);
            transform: rotate(10deg);
            box-shadow: 0 0 15px rgba(245, 158, 11, 0.3);
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .brand-name {
            font-size: 1.1rem;
            font-weight: 900;
            letter-spacing: 1px;
            color: var(--primary);
        }

        .brand-subtitle {
            font-size: 0.75rem;
            opacity: 0.8;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: var(--text-muted);
        }

        /* Navigation Links */
        .nav-icon-link {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            color: var(--text-muted) !important;
            font-size: 1.3rem;
            transition: all 0.3s ease;
            margin: 0 0.25rem;
        }

        .nav-icon-link:hover {
            background: rgba(245, 158, 11, 0.15);
            color: var(--primary) !important;
            transform: translateY(-3px);
        }

        .nav-icon-link.active {
            background: rgba(245, 158, 11, 0.2);
            color: var(--primary) !important;
            box-shadow: 0 0 15px rgba(245, 158, 11, 0.3);
        }

        .nav-label {
            display: none;
            position: absolute;
            bottom: -30px;
            background: rgba(17, 24, 39, 0.95);
            color: var(--primary);
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.75rem;
            white-space: nowrap;
            font-weight: 600;
            pointer-events: none;
            animation: slideUp 0.3s ease;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .nav-icon-link:hover .nav-label {
            display: block;
        }

        /* Navbar Divider */
        .nav-divider {
            width: 1px;
            height: 30px;
            background: rgba(245, 158, 11, 0.2);
            margin: 0 0.5rem;
            list-style: none;
        }

        /* Notification Badge */
        .notification-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: bold;
            border: 2px solid var(--darker);
            box-shadow: 0 2px 8px rgba(255, 107, 107, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 2px 8px rgba(255, 107, 107, 0.4);
            }

            50% {
                box-shadow: 0 2px 15px rgba(255, 107, 107, 0.7);
            }
        }

        /* Dropdown Menu */
        .dropdown-menu {
            border: none;
            border-radius: 12px;
            background: var(--card-dark);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            animation: slideDown 0.3s ease;
            border: 1px solid rgba(245, 158, 11, 0.1);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            color: var(--text-light);
            transition: all 0.3s ease;
            padding: 0.75rem 1.5rem;
        }

        .dropdown-item:hover {
            background: rgba(245, 158, 11, 0.15);
            color: var(--primary);
            transform: translateX(5px);
        }

        .dropdown-item i {
            margin-right: 0.5rem;
            color: var(--primary);
        }

        .dropdown-divider {
            border-color: rgba(245, 158, 11, 0.1);
        }

        /* Mobile Navbar */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(17, 24, 39, 0.95);
                border-radius: 12px;
                padding: 1rem;
                margin-top: 1rem;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(245, 158, 11, 0.1);
            }

            .nav-icon-link {
                width: 100%;
                justify-content: flex-start;
                padding: 0.75rem 1rem;
                border-radius: 8px;
                margin: 0.25rem 0;
            }

            .nav-label {
                display: inline !important;
                position: static;
                background: none;
                color: var(--primary);
                padding: 0;
                margin-left: 0.75rem;
                font-size: 1rem;
                animation: none;
                border: none;
            }

            .nav-divider {
                margin: 0.5rem 0;
                width: 100%;
                height: 1px;
            }
        }

        /* ===== FOOTER PREMIUM ===== */
        .footer {
            background: linear-gradient(135deg, var(--darker) 0%, #0f172a 100%);
            color: var(--text-light);
            padding: 4rem 0 1.5rem;
            margin-top: 4rem;
            position: relative;
            overflow: hidden;
            border-top: 2px solid rgba(245, 158, 11, 0.2);
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(245, 158, 11, 0.5), transparent);
        }

        .footer h5,
        .footer h6 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .footer h5 i,
        .footer h6 i {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .footer-link {
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 0;
            font-size: 0.95rem;
        }

        .footer-link:hover {
            color: var(--primary);
            padding-left: 8px;
            transform: translateX(5px);
        }

        .footer-link i {
            color: var(--primary);
            font-size: 1.2rem;
            min-width: 20px;
        }

        .footer hr {
            border-color: rgba(245, 158, 11, 0.15);
            margin: 2.5rem 0;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(245, 158, 11, 0.1);
        }

        .footer-bottom a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .footer-bottom a:hover {
            color: var(--primary);
        }

        .footer-bottom p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Contact Info Styling */
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.4;
            margin: 0;
        }

        .contact-item i {
            color: var(--primary);
            font-size: 1.2rem;
            min-width: 20px;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .contact-item span {
            word-break: break-word;
        }

        /* Social Buttons */
        .btn-outline-light {
            color: var(--primary);
            border-color: rgba(245, 158, 11, 0.4);
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 1.2rem;
        }

        .btn-outline-light:hover {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-color: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
        }

        /* ===== GENERAL STYLES ===== */
        .hero-section {
            background: linear-gradient(135deg, var(--darker) 0%, #0f172a 100%);
            color: var(--primary);
            padding: 4rem 0;
            margin-bottom: 3rem;
            border-bottom: 1px solid rgba(245, 158, 11, 0.1);
        }

        .hero-section h1 {
            font-weight: 900;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .hero-section p {
            font-size: 1.1rem;
            opacity: 0.9;
            color: var(--text-light);
        }

        .card {
            border: 1px solid rgba(245, 158, 11, 0.1);
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            background: var(--card-dark);
            color: var(--text-light);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.2);
            border-color: rgba(245, 158, 11, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.4);
            color: white;
        }

        .section-title {
            font-weight: 900;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: var(--primary);
            position: relative;
            padding-bottom: 1rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 2px;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 2rem;
        }

        .breadcrumb-item {
            color: var(--text-muted);
        }

        .breadcrumb-item.active {
            color: var(--primary);
            font-weight: 600;
        }

        .breadcrumb-item a {
            color: var(--text-muted);
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            color: var(--primary);
        }

        .badge {
            padding: 0.5rem 1rem;
            font-weight: 600;
            border-radius: 20px;
        }

        .container-xxl {
            max-width: 1400px;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 1.8rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .brand-premium {
                gap: 0.5rem;
            }

            .brand-icon {
                width: 35px;
                height: 35px;
                font-size: 1.5rem;
            }

            .brand-name {
                font-size: 1rem;
            }

            .brand-subtitle {
                font-size: 0.65rem;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar Premium -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top navbar-premium">
        <div class="container-xxl">
            <!-- Brand -->
            <a class="navbar-brand brand-premium" href="<?= base_url() ?>">
                <div class="brand-icon">
                    <i class='bx bx-table-tennis'></i>
                </div>
                <div class="brand-text">
                    <div class="brand-name">PTMSI</div>
                    <div class="brand-subtitle">Sumbar</div>
                </div>
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- Main Menu -->
                    <li class="nav-item">
                        <a class="nav-link nav-icon-link <?= current_url() == base_url() ? 'active' : '' ?>" href="<?= base_url() ?>" title="Beranda">
                            <i class='bx bx-home'></i>
                            <span class="nav-label">Beranda</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-icon-link <?= strpos(current_url(), 'event') !== false ? 'active' : '' ?>" href="<?= base_url('event') ?>" title="Event">
                            <i class='bx bx-trophy'></i>
                            <span class="nav-label">Event</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-icon-link <?= strpos(current_url(), 'ranking') !== false ? 'active' : '' ?>" href="<?= base_url('ranking') ?>" title="Ranking">
                            <i class='bx bx-chart-line'></i>
                            <span class="nav-label">Ranking</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-icon-link <?= strpos(current_url(), 'berita') !== false ? 'active' : '' ?>" href="<?= base_url('berita') ?>" title="Berita">
                            <i class='bx bx-news'></i>
                            <span class="nav-label">Berita</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-icon-link <?= strpos(current_url(), 'galeri') !== false ? 'active' : '' ?>" href="<?= base_url('galeri') ?>" title="Galeri">
                            <i class='bx bx-image'></i>
                            <span class="nav-label">Galeri</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-icon-link <?= strpos(current_url(), 'dokumen') !== false ? 'active' : '' ?>" href="<?= base_url('dokumen') ?>" title="Dokumen">
                            <i class='bx bx-file'></i>
                            <span class="nav-label">Dokumen</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-icon-link <?= strpos(current_url(), 'live-scoring') !== false ? 'active' : '' ?>" href="<?= base_url('live-scoring') ?>" title="Live Scoring">
                            <i class='bx bx-play-circle'></i>
                            <span class="nav-label">Live</span>
                        </a>
                    </li>

                    <!-- Divider -->
                    <li class="nav-divider"></li>

                    <!-- Notification -->
                    <li class="nav-item position-relative">
                        <a class="nav-link nav-icon-link" href="<?= base_url('notifications') ?>" title="Notifikasi">
                            <i class='bx bx-bell'></i>
                            <span class="notification-badge" id="notifBadge" style="display: none;">0</span>
                        </a>
                    </li>

                    <!-- Kontak -->
                    <li class="nav-item">
                        <a class="nav-link nav-icon-link <?= strpos(current_url(), 'hubungi-kami') !== false ? 'active' : '' ?>" href="<?= base_url('hubungi-kami') ?>" title="Kontak">
                            <i class='bx bx-envelope'></i>
                        </a>
                    </li>

                    <!-- Auth Menu -->
                    <?php if (session()->get('logged_in')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class='bx bx-user-circle'></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="<?= base_url('user/dashboard') ?>"><i class='bx bx-grid-alt'></i>Dashboard</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('user/profile') ?>"><i class='bx bx-user'></i>Profil</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>"><i class='bx bx-log-out'></i>Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-link nav-login" href="<?= base_url('auth/login') ?>" title="Login">
                                <i class='bx bx-log-in'></i>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container-xxl">
            <div class="row mb-4">
                <!-- Brand Section -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>
                        <i class='bx bx-table-tennis'></i>PTMSI Sumbar
                    </h5>
                    <p class="text-muted small mb-3">
                        Persatuan Tenis Meja Seluruh Indonesia Sumatera Barat
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-light" title="Facebook">
                            <i class='bx bxl-facebook'></i>
                        </a>
                        <a href="#" class="btn btn-outline-light" title="Instagram">
                            <i class='bx bxl-instagram'></i>
                        </a>
                        <a href="#" class="btn btn-outline-light" title="Twitter">
                            <i class='bx bxl-twitter'></i>
                        </a>
                        <a href="#" class="btn btn-outline-light" title="YouTube">
                            <i class='bx bxl-youtube'></i>
                        </a>
                    </div>
                </div>

                <!-- Main Menu -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6>
                        <i class='bx bx-menu'></i>Menu Utama
                    </h6>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url() ?>" class="footer-link"><i class='bx bx-home'></i>Beranda</a></li>
                        <li><a href="<?= base_url('event') ?>" class="footer-link"><i class='bx bx-trophy'></i>Event</a></li>
                        <li><a href="<?= base_url('ranking') ?>" class="footer-link"><i class='bx bx-chart-line'></i>Ranking</a></li>
                        <li><a href="<?= base_url('berita') ?>" class="footer-link"><i class='bx bx-news'></i>Berita</a></li>
                    </ul>
                </div>

                <!-- Information -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6>
                        <i class='bx bx-info-circle'></i>Informasi
                    </h6>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url('galeri') ?>" class="footer-link"><i class='bx bx-image'></i>Galeri</a></li>
                        <li><a href="<?= base_url('dokumen') ?>" class="footer-link"><i class='bx bx-file'></i>Dokumen</a></li>
                        <li><a href="<?= base_url('live-scoring') ?>" class="footer-link"><i class='bx bx-play-circle'></i>Live Scoring</a></li>
                        <li><a href="<?= base_url('hubungi-kami') ?>" class="footer-link"><i class='bx bx-envelope'></i>Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h6>
                        <i class='bx bx-phone'></i>Kontak
                    </h6>
                    <div class="contact-info">
                        <p class="contact-item mb-3">
                            <i class='bx bx-phone'></i>
                            <span>+62 751 XXXXXX</span>
                        </p>
                        <p class="contact-item mb-3">
                            <i class='bx bx-envelope'></i>
                            <span>info@ptmsi-sumbar.id</span>
                        </p>
                        <p class="contact-item">
                            <i class='bx bx-map'></i>
                            <span>Padang, Sumatera Barat</span>
                        </p>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p class="text-muted small mb-0">
                    &copy; 2025 PTMSI Sumatera Barat. All rights reserved.
                </p>
                <div>
                    <a href="#" class="text-muted small me-3">Privacy Policy</a>
                    <a href="#" class="text-muted small">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Notification Script - DISABLED (notification table doesn't exist yet) -->
    <!-- Re-enable after running migrations -->
    <!-- <script>
        <?php if (session()->get('logged_in')): ?>
            // Load unread notifications count
            fetch('<?= base_url('notifications/unread') ?>')
                .then(response => response.json())
                .then(data => {
                    if (data && data.unread_count > 0) {
                        const badge = document.getElementById('notifBadge');
                        if (badge) {
                            badge.textContent = data.unread_count;
                            badge.style.display = 'flex';
                        }
                    }
                })
                .catch(error => {
                    // Silently fail if notification table doesn't exist
                    console.log('Notifications not available yet');
                });
        <?php endif; ?>
    </script> -->

    <?= $this->renderSection('scripts') ?>
</body>

</html>