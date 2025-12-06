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
