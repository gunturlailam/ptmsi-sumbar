<style>
    .navbar-ptmsi {
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 8px 32px rgba(102, 126, 234, 0.1);
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid rgba(102, 126, 234, 0.1);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .navbar-ptmsi.scrolled {
        background: rgba(255, 255, 255, 0.98) !important;
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.15);
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    .navbar-ptmsi .container {
        max-width: 1400px;
    }

    .navbar-ptmsi .navbar-nav {
        gap: 0.5rem;
    }

    .navbar-ptmsi .navbar-brand {
        font-weight: 800;
        color: var(--text-primary) !important;
        letter-spacing: -0.5px;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
    }

    .navbar-ptmsi .navbar-brand:hover {
        transform: translateY(-1px);
    }

    .navbar-ptmsi .navbar-brand img {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: white;
        border: 3px solid #667eea;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        transition: all 0.3s ease;
    }

    .navbar-ptmsi .navbar-brand:hover img {
        transform: rotate(5deg) scale(1.05);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
    }

    .navbar-ptmsi .nav-link {
        color: var(--text-secondary) !important;
        font-weight: 500;
        border-radius: 50px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 0.6rem 1rem !important;
        font-size: 0.9rem;
        letter-spacing: -0.2px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        overflow: hidden;
        white-space: nowrap;
    }

    .navbar-ptmsi .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 50px;
    }

    .navbar-ptmsi .nav-link.active,
    .navbar-ptmsi .nav-link:hover {
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.25);
    }

    .navbar-ptmsi .nav-link.active::before,
    .navbar-ptmsi .nav-link:hover::before {
        opacity: 1;
    }

    .navbar-ptmsi .nav-link span,
    .navbar-ptmsi .nav-link i {
        position: relative;
        z-index: 1;
    }

    .navbar-ptmsi .nav-link i {
        font-size: 1.1rem;
    }

    /* Dropdown styles */
    .navbar-ptmsi .dropdown-menu {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(102, 126, 234, 0.1);
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.15);
        padding: 0.75rem 0;
        margin-top: 0.5rem;
        min-width: 220px;
        opacity: 0;
        transform: translateY(-10px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .navbar-ptmsi .dropdown-menu.show {
        opacity: 1;
        transform: translateY(0);
    }

    .navbar-ptmsi .dropdown-item {
        color: #495057 !important;
        font-weight: 500;
        padding: 0.6rem 1.25rem;
        font-size: 0.9rem;
        border-radius: 12px;
        margin: 0 0.5rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        overflow: hidden;
        text-decoration: none;
    }

    .navbar-ptmsi .dropdown-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transition: left 0.3s ease;
        border-radius: 12px;
        z-index: 0;
    }

    .navbar-ptmsi .dropdown-item:hover::before {
        left: 0;
    }

    .navbar-ptmsi .dropdown-item:hover {
        color: white !important;
        transform: translateX(4px);
        text-decoration: none;
    }

    .navbar-ptmsi .dropdown-item i,
    .navbar-ptmsi .dropdown-item span {
        position: relative;
        z-index: 2;
    }

    .navbar-ptmsi .dropdown-item i {
        font-size: 1rem;
        width: 20px;
        text-align: center;
    }

    /* Dropdown arrow indicator */
    .navbar-ptmsi .dropdown-toggle::after {
        display: inline-block;
        margin-left: 0.5rem;
        vertical-align: 0.255em;
        content: "";
        border-top: 0.3em solid;
        border-right: 0.3em solid transparent;
        border-bottom: 0;
        border-left: 0.3em solid transparent;
        transition: transform 0.3s ease;
    }

    .navbar-ptmsi .dropdown-toggle[aria-expanded="true"]::after {
        transform: rotate(180deg);
    }

    .navbar-ptmsi .btn-login {
        border-radius: 50px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
        border: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.9rem;
        letter-spacing: -0.2px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .navbar-ptmsi .btn-login:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .navbar-ptmsi .dropdown-item-text {
        color: #6c757d !important;
        font-size: 0.875rem;
        padding: 0.25rem 1.25rem;
    }

    .navbar-ptmsi .dropdown-header {
        color: #003366 !important;
        font-weight: 600;
        font-size: 0.875rem;
        padding: 0.5rem 1.25rem;
    }

    .navbar-ptmsi .text-danger {
        color: #dc3545 !important;
    }

    .navbar-ptmsi .text-danger:hover {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
        color: white !important;
    }

    /* Ensure navbar stays on top */
    .navbar-ptmsi {
        z-index: 1055 !important;
        position: relative !important;
    }

    /* Tooltip for icon-only mode */
    .navbar-ptmsi .nav-link[data-bs-toggle="tooltip"] {
        position: relative;
    }

    /* Responsive adjustments */
    @media (max-width: 1400px) {
        .navbar-ptmsi .nav-link {
            padding: 0.5rem 0.8rem !important;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 1200px) {
        .navbar-ptmsi .nav-link span {
            display: none;
        }

        .navbar-ptmsi .nav-link {
            padding: 0.6rem !important;
            min-width: 44px;
            justify-content: center;
        }

        .navbar-ptmsi .nav-link i {
            font-size: 1.2rem;
        }

        /* Show tooltips on hover for icon-only mode */
        .navbar-ptmsi .nav-link:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: -35px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            white-space: nowrap;
            z-index: 1000;
            opacity: 0;
            animation: fadeInTooltip 0.3s ease forwards;
        }

        @keyframes fadeInTooltip {
            to {
                opacity: 1;
            }
        }
    }

    @media (max-width: 991px) {
        .navbar-ptmsi .nav-link {
            margin-bottom: 0.5rem;
            padding: 0.75rem 1rem !important;
            font-size: 0.95rem;
            justify-content: flex-start;
            min-width: auto;
        }

        .navbar-ptmsi .nav-link span {
            display: inline;
        }

        .navbar-ptmsi .btn-login {
            width: 100%;
            margin-top: 1rem;
            padding: 0.75rem 0;
            justify-content: center;
        }

        .navbar-nav {
            padding-top: 1rem;
        }

        .navbar-ptmsi .dropdown-menu {
            position: static !important;
            transform: none !important;
            box-shadow: none;
            border: none;
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .navbar-ptmsi .dropdown-item {
            margin: 0;
            border-radius: 0;
            padding-left: 2rem;
        }
    }

    @media (min-width: 992px) and (max-width: 1199px) {
        .navbar-ptmsi .navbar-brand {
            font-size: 1.3rem;
        }

        .navbar-ptmsi .navbar-brand img {
            width: 40px;
            height: 40px;
        }
    }
</style>
<nav class="navbar navbar-expand-lg navbar-ptmsi sticky-top" style="z-index: 1055 !important; position: relative !important;">
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
                    <a class="nav-link<?= url_is('/') ? ' active' : '' ?>" href="<?= base_url('/') ?>" data-tooltip="Beranda">
                        <i class="bx bx-home"></i> <span>Beranda</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?= url_is('profil*') ? ' active' : '' ?>" href="<?= base_url('profil') ?>" data-tooltip="Profil">
                        <i class="bx bx-user-badge"></i> <span>Profil</span>
                    </a>
                </li>

                <!-- Dropdown Informasi -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle<?= url_is('atlet-pelatih*') || url_is('event*') || url_is('berita*') || url_is('galeri*') ? ' active' : '' ?>" href="#" id="navbarInfoDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-tooltip="Informasi">
                        <i class="bx bx-info-circle"></i> <span>Informasi</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarInfoDropdown">
                        <li><a class="dropdown-item<?= url_is('atlet-pelatih*') ? ' active' : '' ?>" href="<?= base_url('atlet-pelatih') ?>">
                                <i class="bx bx-group"></i> Atlet & Pelatih
                            </a></li>
                        <li><a class="dropdown-item<?= url_is('event*') ? ' active' : '' ?>" href="<?= base_url('event') ?>">
                                <i class="bx bx-trophy"></i> Event
                            </a></li>
                        <li><a class="dropdown-item<?= url_is('berita*') ? ' active' : '' ?>" href="<?= base_url('berita') ?>">
                                <i class="bx bx-news"></i> Berita
                            </a></li>
                        <li><a class="dropdown-item<?= url_is('galeri*') ? ' active' : '' ?>" href="<?= base_url('galeri') ?>">
                                <i class="bx bx-images"></i> Galeri
                            </a></li>
                    </ul>
                </li>

                <!-- Dropdown Layanan -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle<?= url_is('dokumen*') || url_is('pembinaan*') || url_is('layanan-online*') ? ' active' : '' ?>" href="#" id="navbarLayananDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-tooltip="Layanan">
                        <i class="bx bx-cog"></i> <span>Layanan</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarLayananDropdown">
                        <li><a class="dropdown-item<?= url_is('dokumen*') ? ' active' : '' ?>" href="<?= base_url('dokumen') ?>">
                                <i class="bx bx-file"></i> Dokumen
                            </a></li>
                        <li><a class="dropdown-item<?= url_is('pembinaan*') ? ' active' : '' ?>" href="<?= base_url('pembinaan') ?>">
                                <i class="bx bx-graduation"></i> Pembinaan
                            </a></li>
                        <li><a class="dropdown-item<?= url_is('layanan-online*') ? ' active' : '' ?>" href="<?= base_url('layanan-online') ?>">
                                <i class="bx bx-globe"></i> Layanan Online
                            </a></li>
                    </ul>
                </li>

                <!-- Dropdown Data -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle<?= url_is('klub-pengurus*') || url_is('ranking*') ? ' active' : '' ?>" href="#" id="navbarDataDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-tooltip="Data">
                        <i class="bx bx-data"></i> <span>Data</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDataDropdown">
                        <li><a class="dropdown-item<?= url_is('klub-pengurus*') ? ' active' : '' ?>" href="<?= base_url('klub-pengurus') ?>">
                                <i class="bx bx-buildings"></i> Klub & Pengurus
                            </a></li>
                        <li><a class="dropdown-item<?= url_is('ranking*') ? ' active' : '' ?>" href="<?= base_url('ranking') ?>">
                                <i class="bx bx-bar-chart"></i> Ranking
                            </a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link<?= url_is('hubungi-kami*') ? ' active' : '' ?>" href="<?= base_url('hubungi-kami') ?>" data-tooltip="Kontak">
                        <i class="bx bx-envelope"></i> <span>Kontak</span>
                    </a>
                </li>
            </ul>
            <div class="d-flex ms-lg-4 mt-3 mt-lg-0">
                <?php if (session()->get('logged_in')): ?>
                    <div class="dropdown">
                        <button class="btn btn-login dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-user-circle"></i> <?= esc(session()->get('nama_lengkap')) ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <h6 class="dropdown-header">Selamat datang!</h6>
                            </li>
                            <li><span class="dropdown-item-text"><small><i class="bx bx-user"></i> <?= esc(session()->get('nama_lengkap')) ?></small></span></li>
                            <li><span class="dropdown-item-text"><small><i class="bx bx-envelope"></i> <?= esc(session()->get('email')) ?></small></span></li>
                            <li><span class="dropdown-item-text"><small><i class="bx bx-shield"></i> <?= ucfirst(esc(session()->get('role'))) ?></small></span></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <?php if (session()->get('role') === 'admin'): ?>
                                <li><a class="dropdown-item" href="<?= base_url('admin/dashboard') ?>"><i class="bx bx-tachometer"></i> <span>Dashboard Admin</span></a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="<?= base_url('user/dashboard') ?>"><i class="bx bx-tachometer"></i> <span>Dashboard Saya</span></a></li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider" style="margin: 0.75rem 0; border-color: rgba(102, 126, 234, 0.1);">
                            </li>
                            <li><a class="dropdown-item" href="<?= base_url('user/profile') ?>"><i class="bx bx-user"></i> <span>Profil Saya</span></a></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="bx bx-log-out"></i> <span>Logout</span></a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="<?= base_url('login') ?>" class="btn btn-login">
                        <i class="bx bx-log-in"></i> Login
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<script>
    // Ensure navbar functionality works on all pages
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Bootstrap components
        if (typeof bootstrap !== 'undefined') {
            // Initialize all dropdowns with enhanced animations
            const dropdownElementList = document.querySelectorAll('.dropdown-toggle');
            const dropdownList = [...dropdownElementList].map(dropdownToggleEl => {
                const dropdown = new bootstrap.Dropdown(dropdownToggleEl);

                // Add custom animation events
                dropdownToggleEl.addEventListener('show.bs.dropdown', function() {
                    const menu = this.nextElementSibling;
                    if (menu) {
                        menu.style.display = 'block';
                        setTimeout(() => menu.classList.add('show'), 10);
                    }
                });

                dropdownToggleEl.addEventListener('hide.bs.dropdown', function() {
                    const menu = this.nextElementSibling;
                    if (menu) {
                        menu.classList.remove('show');
                        setTimeout(() => {
                            if (!menu.classList.contains('show')) {
                                menu.style.display = 'none';
                            }
                        }, 300);
                    }
                });

                return dropdown;
            });

            // Initialize navbar collapse
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');

            if (navbarToggler && navbarCollapse) {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                    toggle: false
                });
            }
        }

        // Handle mobile navbar toggle
        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarCollapse = document.querySelector('.navbar-collapse');

        if (navbarToggler && navbarCollapse) {
            navbarToggler.addEventListener('click', function(e) {
                e.preventDefault();
                navbarCollapse.classList.toggle('show');
            });

            // Close mobile menu when clicking on nav links
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link:not(.dropdown-toggle)');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 991) {
                        navbarCollapse.classList.remove('show');
                    }
                });
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.closest('.navbar') && navbarCollapse.classList.contains('show')) {
                    navbarCollapse.classList.remove('show');
                }
            });
        }

        // Add smooth scroll behavior for anchor links
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
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        const navbarCollapse = document.querySelector('.navbar-collapse');
        if (window.innerWidth > 991 && navbarCollapse) {
            navbarCollapse.classList.remove('show');
        }
    });

    // Navbar scroll effect
    let lastScrollTop = 0;
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar-ptmsi');
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        lastScrollTop = scrollTop;
    });
</script>