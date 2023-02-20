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
$routes->get('/', 'InicioController::index', ['filter'=> 'webauth']);
$routes->get('login', 'LoginController::index');
$routes->get('logout', 'LoginController::logout');

$routes->group('/web', static function($routes) {
    $routes->get('validation/(:any)', 'LoginController::validation/$1');
    $routes->get('clientes', 'ClienteManagerController::index',  ['filter'=> 'webauth']);
    $routes->get('clientes/create', 'ClienteManagerController::create',  ['filter'=> 'webauth']);
    $routes->get('perfil', 'PerfilController::index', ['filter'=> 'webauth']);
    $routes->get('perfil/change', 'PerfilController::changeClave', ['filter'=> 'webauth']);
    $routes->get('inicio', 'InicioController::index', ['filter'=> 'webauth']);
    $routes->get('perfil/informe', 'PerfilController::informePdf', ['filter'=> 'webauth']);
});

$routes->group('/conf', ['namespace'=> 'App\Controllers\Configuration', 'filter'=> 'webauth'], static function($routes) {
    $routes->get('municipios', 'MunicipiosController::index');
    $routes->get('residuos', 'ResiduosController::index');
    $routes->get('usuarios', 'UsuariosController::index');
    $routes->get('empleados', 'EmpleadosController::index');
});

$routes->post('/api_token', 'AuthController::autenticar', ['namespace' => 'App\Controllers\RestApi']);

$routes->group('/api', ['namespace'=> 'App\Controllers\RestApi','filter'=>'jwtauth'], static function($routes) {
    $routes->get('clientes', 'ClientesController::index');
    $routes->post('cliente/create', 'ClientesController::salvarCliente');
    $routes->put('cliente/edita/(:num)', 'ClientesController::editaCliente/$1');
    $routes->delete('cliente/remove/(:num)', 'ClientesController::removeCliente/$1');
    $routes->get('cliente/show/(:num)', 'ClientesController::showCliente/$1');
    $routes->get('cliente/require', 'ClientesController::requiereCliente');

    $routes->get('municipios', 'MunicipiosController::index');
    $routes->post('municipio/salvar', 'MunicipiosController::salvarMunicipio');
    $routes->put('municipio/edita/(:num)', 'MunicipiosController::editaMunicipio/$1');
    $routes->delete('municipio/remove/(:num)', 'MunicipiosController::removeMunicipio/$1');
    $routes->get('municipio/show/(:num)', 'MunicipiosController::showMunicipio/$1');
    $routes->get('municipios/masivos', 'MunicipiosController::cargueMasivo');

    $routes->get('usuarios', 'UsuariosController::index');
    $routes->post('usuario/create', 'UsuariosController::salvarUsuario');
    $routes->put('usuario/edita/(:num)', 'UsuariosController::editaUsuario/$1');
    $routes->delete('usuario/remove/(:num)', 'UsuariosController::removeUsuario/$1');
    $routes->get('usuario/show/(:num)', 'UsuariosController::showUsuario/$1');
    $routes->get('usuarios/masivos', 'UsuariosController::cargueMasivo');

    $routes->get('empleados', 'EmpleadosController::index');
    $routes->post('empleado/create', 'EmpleadosController::salvarEmpleado');
    $routes->put('empleado/edita/(:num)', 'EmpleadosController::editaEmpleado/$1');
    $routes->delete('empleado/remove/(:num)', 'EmpleadosController::removeEmpleado/$1');
    $routes->get('empleado/show/(:num)', 'EmpleadosController::showEmpleado/$1');
    $routes->get('empleados/masivos', 'EmpleadosController::cargueMasivo');

    $routes->get('tipo_residuos', 'TipoResiduoController::index');
    $routes->post('tipo_residuo/create', 'TipoResiduoController::salvaTipo');
    $routes->put('tipo_residuo/edita/(:num)', 'TipoResiduoController::editaTipo/$1');
    $routes->delete('tipo_residuo/remove/(:num)', 'TipoResiduoController::removeTipo/$1');
    $routes->get('tipo_residuo/show/(:num)', 'TipoResiduoController::showTipo/$1');
    $routes->get('tipo_residuos/masivos', 'TipoResiduoController::cargueMasivo');

    $routes->get('vehiculos', 'VehiculosController::index');
    $routes->post('vehiculo/create', 'VehiculosController::salvaVehiculo');
    $routes->put('vehiculo/edita/(:num)', 'VehiculosController::editaVehiculo/$1');
    $routes->delete('vehiculo/remove/(:num)', 'VehiculosController::removeVehiculo/$1');
    $routes->get('vehiculo/show/(:num)', 'VehiculosController::showVehiculo/$1');
    $routes->get('vehiculos/masivos', 'VehiculosController::cargueMasivo');

    $routes->get('cargos', 'CargosController::index');
    $routes->post('cargo/create', 'CargosController::salvaCargo');
    $routes->put('cargo/edita/(:num)', 'CargosController::editaCargo/$1');
    $routes->delete('cargo/remove/(:num)', 'CargosController::removeCargo/$1');
    $routes->get('cargo/show/(:num)', 'CargosController::showCargo/$1');
    $routes->get('cargos/masivos', 'CargosController::cargueMasivo');
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
