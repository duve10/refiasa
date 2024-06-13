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
$router->add('/usuarios', 'UsuarioController@index');
$router->add('/usuarios/apiGetUsuarios', 'UsuarioController@apiGetUsuarios');
$router->add('/mascotas', 'MascotaController@index');
$router->add('/mascotas/apiGetMascotas', 'MascotaController@apiGetMascotas');
$router->add('/citas', 'CitaController@index');
$router->add('/citas/apiGetCitas', 'CitaController@apiGetCitas');
$router->add('/atenciones', 'AtencionController@index');
$router->add('/atenciones/apiGetAtenciones', 'AtencionController@apiGetAtenciones');
$router->add('/products', 'HomeController@products');
$router->add('/logout', 'AuthController@logout');

$requestUri = str_replace('/refiasa/public', '', $_SERVER['REQUEST_URI']);
$router->dispatch($requestUri);

