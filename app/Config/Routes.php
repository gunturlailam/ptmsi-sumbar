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
$routes->post('layanan-online/submit-atlet', 'LayananOnline::submitPendaftaranAtlet');
$routes->post('layanan-online/submit-klub', 'LayananOnline::submitPendaftaranKlub');
$routes->post('layanan-online/submit-turnamen', 'LayananOnline::submitPendaftaranAtlet');
$routes->post('layanan-online/submit-sk-klub', 'LayananOnline::submitPendaftaranKlub');
$routes->post('layanan-online/submit-sertifikasi', 'LayananOnline::submitSertifikasi');
$routes->get('hubungi-kami', 'HubungiKami::index');
$routes->post('hubungi-kami/submit', 'HubungiKami::submitPesan');

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

// User Dashboard Routes (Protected)
$routes->group('user', ['namespace' => 'App\Controllers\User'], function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('profile', 'Dashboard::profile');
    $routes->post('profile/update', 'Dashboard::updateProfile');
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

    // Pendaftaran
    $routes->get('pendaftaran/atlet', 'Pendaftaran::atlet');
    $routes->get('pendaftaran/klub', 'Pendaftaran::klub');
    $routes->get('pendaftaran/event', 'Pendaftaran::event');
    $routes->post('pendaftaran/approve/(:num)', 'Pendaftaran::approve/$1');
    $routes->post('pendaftaran/reject/(:num)', 'Pendaftaran::reject/$1');

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
});
