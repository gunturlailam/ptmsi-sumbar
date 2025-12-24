<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?= base_url('user/atlet/dashboard') ?>" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="<?= base_url('assets/img/gambar-ptmsi.png') ?>" alt="PTMSI" style="width: 32px; height: 32px;">
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">PTMSI Atlet</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item <?= (current_url() == base_url('user/atlet/dashboard')) ? 'active' : '' ?>">
            <a href="<?= base_url('user/atlet/dashboard') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Profil Atlet -->
        <li class="menu-item <?= (strpos(current_url(), 'user/atlet/profil') !== false) ? 'active' : '' ?>">
            <a href="<?= base_url('user/atlet/profil') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Profil Atlet</div>
            </a>
        </li>

        <!-- Kartu Atlet -->
        <li class="menu-item <?= (strpos(current_url(), 'user/atlet/kartu') !== false) ? 'active' : '' ?>">
            <a href="<?= base_url('user/atlet/kartu') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-id-card"></i>
                <div data-i18n="Analytics">Kartu Atlet</div>
            </a>
        </li>

        <!-- Daftar Turnamen -->
        <li class="menu-item <?= (strpos(current_url(), 'user/atlet/daftar-turnamen') !== false) ? 'active' : '' ?>">
            <a href="<?= base_url('user/atlet/daftar-turnamen') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-trophy"></i>
                <div data-i18n="Analytics">Daftar Turnamen</div>
            </a>
        </li>

        <!-- Riwayat Pertandingan -->
        <li class="menu-item <?= (strpos(current_url(), 'user/atlet/riwayat-pertandingan') !== false) ? 'active' : '' ?>">
            <a href="<?= base_url('user/atlet/riwayat-pertandingan') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-history"></i>
                <div data-i18n="Analytics">Riwayat Pertandingan</div>
            </a>
        </li>

        <!-- Ranking Pribadi -->
        <li class="menu-item <?= (strpos(current_url(), 'user/atlet/ranking-pribadi') !== false) ? 'active' : '' ?>">
            <a href="<?= base_url('user/atlet/ranking-pribadi') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-chart-line"></i>
                <div data-i18n="Analytics">Ranking Pribadi</div>
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