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
