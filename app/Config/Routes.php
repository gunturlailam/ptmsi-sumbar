<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Beranda::index');
$routes->get('beranda', 'Beranda::index');
$routes->get('profil', 'Profil::index');
$routes->get('atlet-pelatih', 'AtletPelatih::index');
$routes->get('event', 'Event::index');
$routes->get('event/detail/(:num)', 'Event::detail/$1');
$routes->get('event/turnamen', 'Event::turnamen');
$routes->get('event/pertandingan', 'Event::pertandingan');
$routes->get('event/pertandingan/(:num)', 'Event::pertandingan/$1');
$routes->get('event/hasil', 'Event::hasil');
$routes->get('event/hasil/(:num)', 'Event::hasil/$1');
$routes->get('event/bracket/(:num)', 'Event::bracket/$1');
$routes->get('pembinaan', 'Pembinaan::index');
$routes->get('pembinaan/detail/(:num)', 'Pembinaan::detail/$1');
$routes->get('klub-pengurus', 'KlubPengurus::index');
$routes->get('klub-pengurus/klub/organisasi/(:num)', 'KlubPengurus::getKlubByOrganisasi/$1');
$routes->get('klub-pengurus/pengurus/organisasi/(:num)', 'KlubPengurus::getPengurusByOrganisasi/$1');
$routes->get('klub-pengurus/search', 'KlubPengurus::searchKlub');
$routes->get('berita', 'Berita::index');
$routes->get('berita/kategori/(:segment)', 'Berita::kategori/$1');
$routes->get('berita/search', 'Berita::search');
$routes->get('berita/(:segment)', 'Berita::detail/$1');
$routes->get('galeri', 'Galeri::index');
$routes->get('galeri/foto', 'Galeri::foto');
$routes->get('galeri/video', 'Galeri::video');
$routes->get('galeri/event/(:num)', 'Galeri::event/$1');
$routes->get('dokumen', 'Dokumen::index');
$routes->get('dokumen/download/(:num)', 'Dokumen::download/$1');
$routes->get('dokumen/search', 'Dokumen::search');
$routes->get('ranking', 'RankingStatistik::index');
$routes->get('ranking/kategori/(:segment)', 'RankingStatistik::index/$1');
$routes->get('layanan-online', 'LayananOnline::index');
$routes->post('layanan-online/submit-atlet', 'LayananOnline::submitAtlet');
$routes->post('layanan-online/submit-klub', 'LayananOnline::submitKlub');
$routes->post('layanan-online/submit-turnamen', 'LayananOnline::submitTurnamen');
$routes->post('layanan-online/submit-sk-klub', 'LayananOnline::submitSkKlub');
$routes->post('layanan-online/submit-sertifikasi', 'LayananOnline::submitSertifikasi');
$routes->get('hubungi-kami', 'HubungiKami::index');
$routes->post('hubungi-kami/submit', 'HubungiKami::submitPesan');

// Tournament Registration Routes (Public Access)
$routes->group('tournament', function ($routes) {
    $routes->get('/', 'TournamentRegistration::index');
    $routes->get('detail/(:num)', 'TournamentRegistration::detail/$1');
    $routes->get('daftar/(:num)', 'TournamentRegistration::daftar/$1');
    $routes->post('proses-pendaftaran/(:num)', 'TournamentRegistration::prosesPendaftaran/$1');
    $routes->get('upload-bukti/(:num)', 'TournamentRegistration::uploadBuktiPembayaran/$1');
    $routes->post('upload-bukti/(:num)', 'TournamentRegistration::uploadBuktiPembayaran/$1');
});

// Auth Routes
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/login', 'Auth::attemptLogin');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register', 'Auth::attemptRegister');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('auth/forgot-password', 'Auth::forgotPassword');
$routes->post('auth/forgot-password', 'Auth::sendResetLink');

// Shorthand routes for convenience
$routes->get('login', 'Auth::login');
$routes->get('register', 'Auth::register');
$routes->get('logout', 'Auth::logout');

// Registration Routes
$routes->group('registration', function ($routes) {
    // Klub Registration (Public)
    $routes->get('klub-register', 'Registration::klubRegister');
    $routes->post('klub-register', 'Registration::klubRegisterSubmit');

    // Atlet Registration (Klub Only)
    $routes->get('atlet-register', 'Registration::atletRegister');
    $routes->post('atlet-register', 'Registration::atletRegisterSubmit');

    // Pelatih Registration (Klub Only)
    $routes->get('pelatih-register', 'Registration::pelatihRegister');
    $routes->post('pelatih-register', 'Registration::pelatihRegisterSubmit');

    // Success page
    $routes->get('success', 'Registration::success');

    // Klub verification actions
    $routes->post('klub-verify-atlet/(:num)', 'Registration::klubVerifyAtlet/$1');
});

// User Dashboard Routes (Protected)
$routes->group('user', ['namespace' => 'App\Controllers\User'], function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('profile', 'Dashboard::profile');
    $routes->post('profile/update', 'Dashboard::updateProfile');

    // Atlet Dashboard Routes
    $routes->group('atlet', function ($routes) {
        $routes->get('dashboard', 'AtletDashboard::index');
        $routes->get('profil', 'AtletDashboard::profil');
        $routes->get('kartu-atlet', 'AtletDashboard::kartuAtlet');
        $routes->get('daftar-turnamen', 'AtletDashboard::daftarTurnamen');
        $routes->get('riwayat-pertandingan', 'AtletDashboard::riwayatPertandingan');
        $routes->get('ranking-pribadi', 'AtletDashboard::rankingPribadi');
        $routes->get('lengkapi-profil', 'AtletDashboard::lengkapiProfil');
    });

    // Klub Dashboard Routes
    $routes->group('klub', function ($routes) {
        $routes->get('dashboard', 'KlubDashboard::index');
        $routes->get('data-klub', 'KlubDashboard::dataKlub');
        $routes->get('kelola-atlet', 'KlubDashboard::kelolaAtlet');
        $routes->get('kelola-pelatih', 'KlubDashboard::kelolaPelatih');
        $routes->get('pendaftaran-turnamen', 'KlubDashboard::pendaftaranTurnamen');
        $routes->get('kelola-anggota', 'KlubDashboard::kelolaAnggota');

        // Atlet CRUD routes
        $routes->post('tambah-atlet', 'KlubDashboard::tambahAtlet');
        $routes->get('get-atlet-data/(:num)', 'KlubDashboard::getAtletData/$1');
        $routes->post('update-atlet/(:num)', 'KlubDashboard::updateAtlet/$1');
        $routes->post('nonaktifkan-atlet/(:num)', 'KlubDashboard::nonaktifkanAtlet/$1');

        // Atlet verification routes
        $routes->post('approve-atlet', 'KlubDashboard::approveAtlet');
        $routes->post('reject-atlet', 'KlubDashboard::rejectAtlet');
        $routes->get('detail-atlet/(:num)', 'KlubDashboard::detailAtlet/$1');

        // Pelatih detail routes
        $routes->get('detail-pendaftaran-pelatih/(:num)', 'KlubDashboard::detailPendaftaranPelatih/$1');
        $routes->get('detail-pelatih/(:num)', 'KlubDashboard::detailPelatih/$1');

        // Tournament registration detail route
        $routes->get('detail-pendaftaran-turnamen/(:num)', 'KlubDashboard::detailPendaftaranTurnamen/$1');

        // Legacy route for backward compatibility
        $routes->post('verifikasi-atlet/(:num)', 'KlubDashboard::verifikasiAtlet/$1');
    });
});



// Admin Routes (Protected)
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('dashboard', 'Dashboard::index');

    // Berita
    $routes->get('berita', 'Berita::index');
    $routes->get('berita/create', 'Berita::create');
    $routes->post('berita/store', 'Berita::store');
    $routes->get('berita/edit/(:num)', 'Berita::edit/$1');
    $routes->post('berita/update/(:num)', 'Berita::update/$1');
    $routes->get('berita/delete/(:num)', 'Berita::delete/$1');

    // Event
    $routes->get('event', 'Event::index');
    $routes->get('event/create', 'Event::create');
    $routes->post('event/store', 'Event::store');
    $routes->get('event/edit/(:num)', 'Event::edit/$1');
    $routes->post('event/update/(:num)', 'Event::update/$1');
    $routes->get('event/delete/(:num)', 'Event::delete/$1');

    // Pertandingan
    $routes->get('pertandingan', 'Pertandingan::index');
    $routes->get('pertandingan/detail/(:num)', 'Pertandingan::detail/$1');

    // Hasil
    $routes->get('hasil', 'Hasil::index');
    $routes->get('hasil/detail/(:num)', 'Hasil::detail/$1');

    // Atlet
    $routes->get('atlet', 'Atlet::index');
    $routes->get('atlet/get/(:segment)', 'Atlet::get/$1');
    $routes->get('atlet/create', 'Atlet::create');
    $routes->post('atlet/store', 'Atlet::store');
    $routes->get('atlet/edit/(:segment)', 'Atlet::edit/$1');
    $routes->post('atlet/update/(:segment)', 'Atlet::update/$1');
    $routes->post('atlet/delete/(:segment)', 'Atlet::delete/$1');

    // Pelatih
    $routes->get('pelatih', 'Pelatih::index');
    $routes->get('pelatih/get/(:segment)', 'Pelatih::get/$1');
    $routes->get('pelatih/create', 'Pelatih::create');
    $routes->post('pelatih/store', 'Pelatih::store');
    $routes->get('pelatih/edit/(:segment)', 'Pelatih::edit/$1');
    $routes->post('pelatih/update/(:segment)', 'Pelatih::update/$1');
    $routes->post('pelatih/delete/(:segment)', 'Pelatih::delete/$1');

    // Klub
    $routes->get('klub', 'Klub::index');
    $routes->get('klub/get/(:num)', 'Klub::get/$1');
    $routes->get('klub/create', 'Klub::create');
    $routes->post('klub/store', 'Klub::store');
    $routes->get('klub/edit/(:num)', 'Klub::edit/$1');
    $routes->post('klub/update/(:num)', 'Klub::update/$1');
    $routes->post('klub/delete/(:num)', 'Klub::delete/$1');

    // Pengurus
    $routes->get('pengurus', 'Pengurus::index');
    $routes->get('pengurus/get/(:num)', 'Pengurus::get/$1');
    $routes->get('pengurus/create', 'Pengurus::create');
    $routes->post('pengurus/store', 'Pengurus::store');
    $routes->get('pengurus/edit/(:num)', 'Pengurus::edit/$1');
    $routes->post('pengurus/update/(:num)', 'Pengurus::update/$1');
    $routes->post('pengurus/delete/(:num)', 'Pengurus::delete/$1');

    // Galeri
    $routes->get('galeri', 'Galeri::index');
    $routes->get('galeri/create', 'Galeri::create');
    $routes->post('galeri/store', 'Galeri::store');
    $routes->get('galeri/delete/(:num)', 'Galeri::delete/$1');

    // Dokumen
    $routes->get('dokumen', 'Dokumen::index');
    $routes->get('dokumen/create', 'Dokumen::create');
    $routes->post('dokumen/store', 'Dokumen::store');
    $routes->get('dokumen/edit/(:num)', 'Dokumen::edit/$1');
    $routes->post('dokumen/update/(:num)', 'Dokumen::update/$1');
    $routes->get('dokumen/delete/(:num)', 'Dokumen::delete/$1');

    // Pendaftaran - New URL Structure
    $routes->get('pendaftaran/atlet', 'PendaftaranAtlet::index');
    $routes->get('pendaftaran/atlet/pending', 'PendaftaranAtlet::pending');
    $routes->get('pendaftaran/atlet/detail/(:num)', 'PendaftaranAtlet::detail/$1');
    $routes->post('pendaftaran/atlet/verifikasi/(:num)', 'PendaftaranAtlet::verifikasi/$1');
    $routes->get('pendaftaran/atlet/delete/(:num)', 'PendaftaranAtlet::delete/$1');

    $routes->get('pendaftaran/klub', 'PendaftaranKlub::index');
    $routes->get('pendaftaran/klub/pending', 'PendaftaranKlub::pending');
    $routes->get('pendaftaran/klub/detail/(:num)', 'PendaftaranKlub::detail/$1');
    $routes->post('pendaftaran/klub/verifikasi/(:num)', 'PendaftaranKlub::verifikasi/$1');
    $routes->get('pendaftaran/klub/delete/(:num)', 'PendaftaranKlub::delete/$1');

    $routes->get('pendaftaran/pelatih', 'PendaftaranPelatih::index');
    $routes->get('pendaftaran/pelatih/pending', 'PendaftaranPelatih::pending');
    $routes->get('pendaftaran/pelatih/detail/(:num)', 'PendaftaranPelatih::detail/$1');
    $routes->post('pendaftaran/pelatih/verifikasi/(:num)', 'PendaftaranPelatih::verifikasi/$1');
    $routes->get('pendaftaran/pelatih/delete/(:num)', 'PendaftaranPelatih::delete/$1');

    $routes->get('pendaftaran/event', 'PendaftaranTurnamen::index');
    $routes->get('pendaftaran/event/detail/(:num)', 'PendaftaranTurnamen::byEvent/$1');
    $routes->get('pendaftaran/event/menunggu-konfirmasi', 'PendaftaranTurnamen::menungguKonfirmasi');
    $routes->get('pendaftaran/event/menunggu-verifikasi', 'PendaftaranTurnamen::menungguVerifikasi');
    $routes->post('pendaftaran/event/konfirmasi-pembayaran/(:num)', 'PendaftaranTurnamen::konfirmasiPembayaran/$1');
    $routes->post('pendaftaran/event/verifikasi/(:num)', 'PendaftaranTurnamen::verifikasi/$1');
    $routes->post('pendaftaran/event/generate-bracket/(:num)', 'PendaftaranTurnamen::generateBracket/$1');
    $routes->get('pendaftaran/event/bracket/(:num)', 'PendaftaranTurnamen::viewBracket/$1');
    $routes->post('pendaftaran/event/aktivasi-bracket/(:num)', 'PendaftaranTurnamen::aktivasiBracket/$1');

    // Pendaftaran - Legacy URLs (for backward compatibility)
    $routes->get('pendaftaran-atlet', 'PendaftaranAtlet::index');
    $routes->get('pendaftaran-atlet/pending', 'PendaftaranAtlet::pending');
    $routes->get('pendaftaran-atlet/detail/(:num)', 'PendaftaranAtlet::detail/$1');
    $routes->post('pendaftaran-atlet/verifikasi/(:num)', 'PendaftaranAtlet::verifikasi/$1');
    $routes->get('pendaftaran-atlet/delete/(:num)', 'PendaftaranAtlet::delete/$1');

    $routes->get('pendaftaran-turnamen', 'PendaftaranTurnamen::index');
    $routes->get('pendaftaran-turnamen/event/(:num)', 'PendaftaranTurnamen::byEvent/$1');
    $routes->get('pendaftaran-turnamen/menunggu-konfirmasi', 'PendaftaranTurnamen::menungguKonfirmasi');
    $routes->get('pendaftaran-turnamen/menunggu-verifikasi', 'PendaftaranTurnamen::menungguVerifikasi');
    $routes->post('pendaftaran-turnamen/konfirmasi-pembayaran/(:num)', 'PendaftaranTurnamen::konfirmasiPembayaran/$1');
    $routes->post('pendaftaran-turnamen/verifikasi/(:num)', 'PendaftaranTurnamen::verifikasi/$1');
    $routes->post('pendaftaran-turnamen/generate-bracket/(:num)', 'PendaftaranTurnamen::generateBracket/$1');
    $routes->get('pendaftaran-turnamen/bracket/(:num)', 'PendaftaranTurnamen::viewBracket/$1');
    $routes->post('pendaftaran-turnamen/aktivasi-bracket/(:num)', 'PendaftaranTurnamen::aktivasiBracket/$1');

    // Sertifikasi
    $routes->get('sertifikasi', 'Sertifikasi::index');
    $routes->post('sertifikasi/approve/(:num)', 'Sertifikasi::approve/$1');
    $routes->post('sertifikasi/reject/(:num)', 'Sertifikasi::reject/$1');

    // Pesan Kontak
    $routes->get('pesan', 'Pesan::index');
    $routes->get('pesan/view/(:num)', 'Pesan::view/$1');
    $routes->get('pesan/delete/(:num)', 'Pesan::delete/$1');

    // Users
    $routes->get('users', 'Users::index');
    $routes->get('users/create', 'Users::create');
    $routes->post('users/store', 'Users::store');
    $routes->get('users/edit/(:num)', 'Users::edit/$1');
    $routes->post('users/update/(:num)', 'Users::update/$1');
    $routes->get('users/delete/(:num)', 'Users::delete/$1');

    // Settings
    $routes->get('settings', 'Settings::index');
    $routes->post('settings/update', 'Settings::update');

    // Profile
    $routes->get('profile', 'Profile::index');
    $routes->post('profile/update', 'Profile::update');

    // Admin Features
    $routes->get('kelola-ranking', 'Dashboard::kelolaRanking');
    $routes->post('update-ranking-otomatis', 'Dashboard::updateRankingOtomatis');
});
