<?php
session_start();

require_once '../app/config.php'; // Incluir configuración
require_once '../app/Router.php';

$router = new Router();



// Definir las rutas
$router->add('/', 'HomeController@index');
$router->add('/login', 'AuthController@login');
$router->add('/login', 'AuthController@login');

$router->add('/dashboard', 'HomeController@dashboard');

$router->add('/clientes', 'ClienteController@index');
$router->add('/clientes/apiGetClientes', 'ClienteController@apiGetClientes');
$router->add('/clientes/apiGetClientesSelect', 'ClienteController@apiGetClientesSelect');

$router->add('/usuarios', 'UsuarioController@index');
$router->add('/usuarios/apiGetUsuarios', 'UsuarioController@apiGetUsuarios');

$router->add('/perfiles', 'PerfilController@index');
$router->add('/perfiles/apiGetPerfiles', 'PerfilController@apiGetPerfiles');

$router->add('/servicios', 'ServicioController@index');
$router->add('/servicios/apiGetServicios', 'ServicioController@apiGetServicios');

$router->add('/mascotas', 'MascotaController@index');
$router->add('/mascotas/apiGetMascotas', 'MascotaController@apiGetMascotas');
$router->add('/mascotas/apiGetMascotasByCliente', 'MascotaController@apiGetMascotasByCliente');

$router->add('/citas', 'CitaController@index');
$router->add('/citas/registro', 'CitaController@registro');
$router->add('/citas/apiGetCitas', 'CitaController@apiGetCitas');
$router->add('/citas/apiRegistrar', 'CitaController@apiRegistrar');

$router->add('/calendario', 'CalendarioController@index');
$router->add('/calendario/apiGetCitasAtenciones', 'CalendarioController@apiGetCitasAtenciones');

$router->add('/atenciones', 'AtencionController@index');
$router->add('/atenciones/apiGetAtenciones', 'AtencionController@apiGetAtenciones');

$router->add('/products', 'HomeController@products');
$router->add('/logout', 'AuthController@logout');

$requestUri = str_replace('/refiasa/public', '', $_SERVER['REQUEST_URI']);
$router->dispatch($requestUri);

