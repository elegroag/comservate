<?php
namespace Config;
use CodeIgniter\Router\Router;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);


/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'InicioController::index');
$routes->get('login', 'LoginController::index');

$routes->group('/web', static function($routes) {
    $routes->get('clientes', 'ClienteManagerController::index');
    $routes->get('clientes/create', 'ClienteManagerController::create');
});

$routes->get('perfil', 'PerfilController::index');

$routes->group('/conf', ['namespace'=> 'App\Controllers\Configuration'], static function($routes) {
    $routes->get('municipios', 'MunicipiosController::index');
    $routes->get('residuos', 'ResiduosController::index');
    $routes->get('usuarios', 'UsuariosController::index');
    $routes->get('empleados', 'EmpleadosController::index');
});

$routes->post('/api_token', 'AuthController::autenticar', ['namespace' => 'App\Controllers\RestApi']);

$routes->group('/api', ['namespace'=> 'App\Controllers\RestApi','filter'=>'jwtauth'], static function($routes) {
    $routes->get('clientes', 'ClientesController::index');
    $routes->post('clientes/salvar', 'ClientesController::salvarCliente');
    $routes->put('clientes/edita/(:num)', 'ClientesController::editaCliente/$1');
    $routes->get('clientes/(:num)', 'ClientesController::showCliente/$1');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
