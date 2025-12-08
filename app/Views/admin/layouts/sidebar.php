<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?= base_url('admin/dashboard') ?>" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="<?= base_url('assets/img/gambar-ptmsi.png') ?>" alt="PTMSI" width="40">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">PTMSI Admin</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item <?= url_is('admin/dashboard*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/dashboard') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <!-- Manajemen Konten -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Manajemen Konten</span>
        </li>

        <!-- Berita -->
        <li class="menu-item <?= url_is('admin/berita*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/berita') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div data-i18n="Berita">Berita</div>
            </a>
        </li>

        <!-- Event -->
        <li class="menu-item <?= url_is('admin/event*') ? 'active open' : '' ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-trophy"></i>
                <div data-i18n="Event">Event & Kejuaraan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= url_is('admin/event') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/event') ?>" class="menu-link">
                        <div data-i18n="Daftar Event">Daftar Event</div>
                    </a>
                </li>
                <li class="menu-item <?= url_is('admin/pertandingan*') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/pertandingan') ?>" class="menu-link">
                        <div data-i18n="Pertandingan">Pertandingan</div>
                    </a>
                </li>
                <li class="menu-item <?= url_is('admin/hasil*') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/hasil') ?>" class="menu-link">
                        <div data-i18n="Hasil">Hasil Pertandingan</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Galeri -->
        <li class="menu-item <?= url_is('admin/galeri*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/galeri') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-image"></i>
                <div data-i18n="Galeri">Galeri</div>
            </a>
        </li>

        <!-- Dokumen -->
        <li class="menu-item <?= url_is('admin/dokumen*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/dokumen') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Dokumen">Dokumen & Regulasi</div>
            </a>
        </li>

        <!-- Manajemen Data -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Manajemen Data</span>
        </li>

        <!-- Atlet -->
        <li class="menu-item <?= url_is('admin/atlet*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/atlet') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Atlet">Atlet</div>
            </a>
        </li>

        <!-- Pelatih -->
        <li class="menu-item <?= url_is('admin/pelatih*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/pelatih') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-check"></i>
                <div data-i18n="Pelatih">Pelatih</div>
            </a>
        </li>

        <!-- Klub -->
        <li class="menu-item <?= url_is('admin/klub*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/klub') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-buildings"></i>
                <div data-i18n="Klub">Klub</div>
            </a>
        </li>

        <!-- Pengurus -->
        <li class="menu-item <?= url_is('admin/pengurus*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/pengurus') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Pengurus">Pengurus</div>
            </a>
        </li>

        <!-- Layanan -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Layanan</span>
        </li>

        <!-- Pendaftaran -->
        <li class="menu-item <?= url_is('admin/pendaftaran*') ? 'active open' : '' ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-clipboard"></i>
                <div data-i18n="Pendaftaran">Pendaftaran</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?= url_is('admin/pendaftaran/atlet*') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/pendaftaran/atlet') ?>" class="menu-link">
                        <div data-i18n="Atlet">Atlet</div>
                    </a>
                </li>
                <li class="menu-item <?= url_is('admin/pendaftaran/klub*') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/pendaftaran/klub') ?>" class="menu-link">
                        <div data-i18n="Klub">Klub</div>
                    </a>
                </li>
                <li class="menu-item <?= url_is('admin/pendaftaran/event*') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/pendaftaran/event') ?>" class="menu-link">
                        <div data-i18n="Event">Event</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Sertifikasi -->
        <li class="menu-item <?= url_is('admin/sertifikasi*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/sertifikasi') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-certification"></i>
                <div data-i18n="Sertifikasi">Sertifikasi</div>
            </a>
        </li>

        <!-- Pesan Kontak -->
        <li class="menu-item <?= url_is('admin/pesan*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/pesan') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div data-i18n="Pesan">Pesan Kontak</div>
            </a>
        </li>

        <!-- Sistem -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Sistem</span>
        </li>

        <!-- Users -->
        <li class="menu-item <?= url_is('admin/users*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/users') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Users">Users</div>
            </a>
        </li>

        <!-- Pengaturan -->
        <li class="menu-item <?= url_is('admin/settings*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/settings') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Pengaturan">Pengaturan</div>
            </a>
        </li>
    </ul>
</aside>