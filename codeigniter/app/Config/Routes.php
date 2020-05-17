<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
// $routes->get('/buku', 'Buku::index');
// $routes->get('/buku', "Buku::index");
// $routes->get('/buku/hapus/(:id)', "Buku::hapus");
// $routes->get('/buku/tambah/', "Buku::tambah");
// $routes->post('/buku/tambah/', "Buku::add");
// $routes->get('/laravel/edit/(:any)', "Laravel::edit");
// $routes->post('/laravel/edit/(:any)', "Laravel::update");
// $routes->get('/buku/edit/(:num)', 'Buku::edit/$1');
// $routes->post('/buku/edit/(:num)', 'Buku::update/$1');
// $routes->get('/auth', 'Auth::index');
// $routes->get('/auth/login', 'Auth::login');
// $routes->post('/auth/login', 'Auth::process');
// $routes->get('/user', 'User::index');
// $routes->get('/api/(:num)', 'Api::index/$1');
// $routes->get('/user/tambah/', 'User::tambah');
// $routes->post('/user/tambah/', 'User::add');
// $routes->get('/user/edit/(:num)', 'User::edit/$1');
// $routes->post('/user/edit/(:num)', 'User::update/$1');
// $routes->get('/user/hapus/(:num)', 'User::hapus/$1');
// $routes->post('/user/hapus/(:num)', 'User::delete/$1');
// $routes->get('/debug', function () {

// 	echo password_hash("admin", PASSWORD_DEFAULT);
// 	echo "<br>" . bin2hex(openssl_random_pseudo_bytes(32));
// });
$routes->post("/api/auth/login", "Api::loginAttempt");
$routes->post("/api/auth/user", "Api::userToken");
$routes->get("/api/user/", "Api::userAll");
$routes->get("/api/user/(:num)", "Api::userId/$1");
$routes->delete("/api/user/delete/(:num)", "Api::deleteUser/$1");
$routes->post("/api/user/edit/(:num)", "Api::editUser/$1");
$routes->post("/api/user/add", "Api::addUser");
$routes->get("/api/buku/", "Api::index");
$routes->get("/api/buku/(:num)", "Api::bukuId/$1");
$routes->delete("/api/buku/delete/(:num)", "Api::deleteBuku/$1");
$routes->post("/api/buku/edit/(:num)", "Api::editBuku/$1");
$routes->post("/api/buku/add", "Api::addBuku");
$routes->get("/api/level", "Api::listLevel");

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
