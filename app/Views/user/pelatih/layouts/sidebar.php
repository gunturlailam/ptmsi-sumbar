<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?= base_url('user/pelatih/dashboard') ?>" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="<?= base_url('assets/img/gambar-ptmsi.png') ?>" alt="PTMSI" style="width: 32px; height: 32px;">
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">PTMSI Pelatih</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item <?= (current_url() == base_url('user/pelatih/dashboard')) ? 'active' : '' ?>">
            <a href="<?= base_url('user/pelatih/dashboard') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Profil Pelatih -->
        <li class="menu-item <?= (strpos(current_url(), 'user/pelatih/profil') !== false) ? 'active' : '' ?>">
            <a href="<?= base_url('user/pelatih/profil') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Profil Pelatih</div>
            </a>
        </li>

        <!-- Sertifikasi -->
        <li class="menu-item <?= (strpos(current_url(), 'user/pelatih/sertifikasi') !== false) ? 'active' : '' ?>">
            <a href="<?= base_url('user/pelatih/sertifikasi') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-award"></i>
                <div data-i18n="Analytics">Sertifikasi</div>
            </a>
        </li>

        <!-- Atlet Binaan -->
        <li class="menu-item <?= (strpos(current_url(), 'user/pelatih/atlet-binaan') !== false) ? 'active' : '' ?>">
            <a href="<?= base_url('user/pelatih/atlet-binaan') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Analytics">Atlet Binaan</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Lainnya</span>
        </li>

        <!-- Profil -->
        <li class="menu-item <?= (current_url() == base_url('profil')) ? 'active' : '' ?>">
            <a href="<?= base_url('profil') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Profil</div>
            </a>
        </li>

        <!-- Logout -->
        <li class="menu-item">
            <a href="<?= base_url('auth/logout') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-log-out"></i>
                <div data-i18n="Analytics">Logout</div>
            </a>
        </li>
    </ul>
</aside>