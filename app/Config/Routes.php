<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Front');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function(){return view("hal404");});
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Sistem::index');
$routes->get('signin', 'Sistem::index');
$routes->get('setpass', 'Sistem::setpass');
$routes->post('login', 'Sistem::Login');
$routes->post('gantipassword', 'Sistem::UpdatePassword');
$routes->get('logout', 'Sistem::Logout');
$routes->get('beranda', 'Dashboard::index');
$routes->post('updateprofil', 'Dashboard::updateprofil_upload');
$routes->post('updateprofil2', 'Dashboard::updateprofil');
$routes->post('hapusfoto', 'Dashboard::hapusfotoprofil');
//------------------------------------------------------------
$routes->get('001', 'Basis::x001');
$routes->get('002', 'Basis::x002');
$routes->get('003', 'Basis::x003');
//------------------------------------------------------------
$routes->get('Si933', 'Si933::index');
$routes->group('Si933', function($routes){
    $routes->get('data', 'Si933::json');
    $routes->post('filter', 'Si933::filter');
    $routes->post('tambah', 'Si933::add');
    $routes->post('edit', 'Si933::update');
    $routes->post('hapus', 'Si933::delete');
});
//------------------------------------------------------------
$routes->get('Me776', 'Me776::index');
$routes->group('Me776', function($routes){
    $routes->get('data', 'Me776::json');
    $routes->post('filter', 'Me776::filter');
    $routes->post('tambah', 'Me776::add');
    $routes->post('edit', 'Me776::update');
    $routes->post('hapus', 'Me776::delete');
});
//------------------------------------------------------------
$routes->get('Le409', 'Le409::index');
$routes->group('Le409', function($routes){
    $routes->get('data', 'Le409::json');
    $routes->post('filter', 'Le409::filter');
    $routes->post('tambah', 'Le409::add');
    $routes->post('edit', 'Le409::update');
    $routes->post('hapus', 'Le409::delete');
});
//------------------------------------------------------------
$routes->get('Fo110', 'Fo110::index');
$routes->group('Fo110', function($routes){
    $routes->get('data', 'Fo110::json');
    $routes->post('filter', 'Fo110::filter');
    $routes->post('tambah', 'Fo110::add');
    $routes->post('edit', 'Fo110::update');
    $routes->post('hapus', 'Fo110::delete');
});
//------------------------------------------------------------
$routes->get('Ka556', 'Ka556::index');
$routes->group('Ka556', function($routes){
    $routes->get('data', 'Ka556::json');
    $routes->post('filter', 'Ka556::filter');
    $routes->post('tambah', 'Ka556::add');
    $routes->post('edit', 'Ka556::update');
    $routes->post('hapus', 'Ka556::delete');
});
//------------------------------------------------------------
$routes->get('Dr699', 'Dr699::index');
$routes->group('Dr699', function($routes){
    $routes->get('data', 'Dr699::json');
    $routes->post('filter', 'Dr699::filter');
    $routes->post('tambah', 'Dr699::add');
    $routes->post('edit', 'Dr699::update');
    $routes->post('hapus', 'Dr699::delete');
});
//------------------------------------------------------------
$routes->get('Ak755', 'Ak755::index');
$routes->group('Ak755', function($routes){
    $routes->get('data', 'Ak755::json');
    $routes->post('filter', 'Ak755::filter');
    $routes->post('tambah', 'Ak755::add');
    $routes->post('edit', 'Ak755::update');
    $routes->post('hapus', 'Ak755::delete');
    $routes->post('reset', 'Ak755::reset');
});

$routes->get('Pa002', 'Pa002::index');
$routes->group('Pa002', function($routes){
    $routes->get('data', 'Pa002::json');
    $routes->post('filter', 'Pa002::filter');
    $routes->post('tambah', 'Pa002::add');
    $routes->post('edit', 'Pa002::update');
    $routes->post('hapus', 'Pa002::delete');
    $routes->post('reset', 'Pa002::reset');
});

$routes->get('Pu002', 'Pu002::index');
$routes->group('Pu002', function($routes){
    $routes->get('data', 'Pu002::json');
    $routes->post('filter', 'Pu002::filter');
    $routes->post('tambah', 'Pu002::add');
    $routes->post('edit', 'Pu002::update');
    $routes->post('hapus', 'Pu002::delete');
    $routes->post('reset', 'Pu002::reset');
    $routes->post('ambil', 'Pu002::getkab');
    $routes->post('ambil1', 'Pu002::getkec');
    $routes->post('ambil2', 'Pu002::getds');
    $routes->post('ambil', 'Pu002::upkab');
    $routes->post('ambil1', 'Pu002::upkec');
    $routes->post('ambil2', 'Pu002::upds');
});

$routes->get('Pv002', 'Pv002::index');
$routes->group('Pv002', function($routes){
    $routes->get('data', 'Pv002::json');
    $routes->post('filter', 'Pv002::filter');
    $routes->post('tambah', 'Pv002::add');
    $routes->post('edit', 'Pv002::update');
    $routes->post('hapus', 'Pv002::delete');
    $routes->post('reset', 'Pv002::reset');
});
$routes->get('Kc002', 'Kc002::index');
$routes->group('Kc002', function($routes){
    $routes->get('data', 'Kc002::json');
    $routes->post('filter', 'Kc002::filter');
    $routes->post('tambah', 'Kc002::add');
    $routes->post('edit', 'Kc002::update');
    $routes->post('hapus', 'Kc002::delete');
    $routes->post('reset', 'Kc002::reset');
});

$routes->get('Kb002', 'Kb002::index');
$routes->group('Kb002', function($routes){
    $routes->get('data', 'Kb002::json');
    $routes->post('filter', 'Kb002::filter');
    $routes->post('tambah', 'Kb002::add');
    $routes->post('edit', 'Kb002::update');
    $routes->post('hapus', 'Kb002::delete');
    $routes->post('reset', 'Kb002::reset');
});
$routes->get('Ds002', 'Ds002::index');
$routes->group('Ds002', function($routes){
    $routes->get('data', 'Ds002::json');
    $routes->post('filter', 'Ds002::filter');
    $routes->post('tambah', 'Ds002::add');
    $routes->post('edit', 'Ds002::update');
    $routes->post('hapus', 'Ds002::delete');
    $routes->post('reset', 'Ds002::reset');
});
$routes->get('Pg003', 'Pg003::index');
$routes->group('Pg003', function($routes){
    $routes->get('kab', 'Pg003::kab');
    $routes->get('data', 'Pg003::json');
    $routes->post('filter', 'Pg003::filter');
    $routes->post('tambah', 'Pg003::add');
    $routes->post('edit', 'Pg003::update');
    $routes->post('hapus', 'Pg003::delete');
    $routes->post('reset', 'Pg003::reset');
    $routes->post('ambil', 'Pu002::upkab');
    $routes->post('ambil1', 'Pu002::upkec');
    $routes->post('ambil2', 'Pu002::upds');
});
$routes->get('Ju002', 'Ju002::index');
$routes->group('Ju002', function($routes){
    $routes->get('data', 'Ju002::json');
    $routes->post('filter', 'Ju002::filter');
    $routes->post('tambah', 'Ju002::add');
    $routes->post('edit', 'Ju002::update');
    $routes->post('hapus', 'Ju002::delete');
    $routes->post('reset', 'Ju002::reset');
});
$routes->get('Tr002', 'Tr002::index');
$routes->group('Tr002', function($routes){
    $routes->get('data', 'Tr002::json');
    $routes->post('filter', 'Tr002::filter');
    $routes->post('tambah', 'Tr002::add');
    $routes->post('edit', 'Tr002::update');
    $routes->post('hapus', 'Tr002::delete');
    $routes->post('reset', 'Tr002::reset');
});
$routes->get('Ut002/(:num)', 'Ut002::index/$1');
$routes->group('Ut002', function($routes){
    $routes->get('data', 'Ut002::json');
    $routes->post('filter', 'Ut002::filter');
    $routes->post('tambah', 'Ut002::add');
    $routes->post('edit', 'Ut002::update');
    $routes->post('hapus', 'Ut002::delete');
    $routes->post('reset', 'Ut002::reset');
});
$routes->get('Va002', 'Va002::index');
$routes->group('Va002', function($routes){
    $routes->get('data', 'Va002::json');
    $routes->post('filter', 'Va002::filter');
    $routes->post('tambah', 'Va002::add');
    $routes->post('edit', 'Va002::update');
    $routes->post('hapus', 'Va002::delete');
    $routes->post('reset', 'Va002::reset');
});
$routes->get('Ra002', 'Ra002::index');
$routes->group('Ra002', function($routes){
    $routes->get('data', 'Ra002::json');
    $routes->post('filter', 'Ra002::filter');
    $routes->post('filterData', 'Ra002::filterData');
    $routes->post('tambah', 'Ra002::add');
    $routes->post('edit', 'Ra002::update');
    $routes->post('hapus', 'Ra002::delete');
    $routes->post('reset', 'Ra002::reset');
});
$routes->get('Pn002', 'Pn002::index');
$routes->group('Pn002', function($routes){
    $routes->get('data', 'Pn002::json');
    $routes->get('ambil', 'Pn002::get');
    $routes->post('filter', 'Pn002::filter');
    $routes->post('tambah', 'Pn002::add');
    $routes->post('edit', 'Pn002::update');
    $routes->post('hapus', 'Pn002::delete');
    $routes->post('reset', 'Pn002::reset');
});
$routes->get('Pk002', 'Pk002::index');
$routes->group('Pk002', function($routes){
    $routes->get('data', 'Pk002::json');
    $routes->post('filter', 'Pk002::filter');
    $routes->post('tambah', 'Pk002::add');
    $routes->post('edit', 'Pk002::update');
    $routes->post('hapus', 'Pk002::delete');
    $routes->post('reset', 'Pk002::reset');
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}