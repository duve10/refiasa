<?php

date_default_timezone_set('UTC');
date_default_timezone_set("America/Mexico_City");
session_start();

require_once '../app/config.php'; // Incluir configuración
require_once '../app/Router.php';

$router = new Router();



// Definir las rutas
$router->add('/', 'HomeController@index');
$router->add('/login', 'AuthController@login');
$router->add('/login', 'AuthController@login');
$router->add('/mimascota', 'MiMascotaController@index');

$router->add('/dashboard', 'HomeController@dashboard');

$router->add('/clientes', 'ClienteController@index');
$router->add('/clientes/apiGetClientes', 'ClienteController@apiGetClientes');
$router->add('/clientes/apiGetClientesSelect', 'ClienteController@apiGetClientesSelect');
$router->add('/clientes/apiRegistrar', 'ClienteController@apiRegistrar');

$router->add('/usuarios', 'UsuarioController@index');
$router->add('/usuarios/apiGetUsuarios', 'UsuarioController@apiGetUsuarios');
$router->add('/usuarios/apiRegistrar', 'UsuarioController@apiRegistrar');
$router->add('/usuarios/apiEliminar', 'UsuarioController@apiEliminar');
$router->add('/usuarios/apiGetVetSelect', 'UsuarioController@apiGetVetSelect');

$router->add('/perfiles', 'PerfilController@index');
$router->add('/perfiles/apiGetPerfiles', 'PerfilController@apiGetPerfiles');

$router->add('/reportes', 'ReportesController@index');

$router->add('/servicios', 'ServicioController@index');
$router->add('/servicios/apiGetServicios', 'ServicioController@apiGetServicios');
$router->add('/servicios/apiRegistrar', 'ServicioController@apiRegistrar');
$router->add('/servicios/apiEliminar', 'ServicioController@apiEliminar');

$router->add('/productos', 'ProductoController@index');
$router->add('/productos/apiGetProductos', 'ProductoController@apiGetProductos');
$router->add('/productos/apiRegistrar', 'ProductoController@apiRegistrar');
$router->add('/productos/apiEliminar', 'ProductoController@apiEliminar');

$router->add('/mascotas', 'MascotaController@index');
$router->add('/mascotas/apiGetMascotas', 'MascotaController@apiGetMascotas');
$router->add('/mascotas/apiGetMascotasByCliente', 'MascotaController@apiGetMascotasByCliente');
$router->add('/mascotas/apiRegistrar', 'MascotaController@apiRegistrar');
$router->add('/mascotas/apiEliminar', 'MascotaController@apiEliminar');

$router->add('/razas/apiGetRaza', 'RazaController@apiGetRaza');

$router->add('/citas', 'CitaController@index');
$router->add('/citas/registro', 'CitaController@registro');
$router->add('/citas/apiGetCitas', 'CitaController@apiGetCitas');
$router->add('/citas/apiRegistrar', 'CitaController@apiRegistrar');
$router->add('/citas/getApiListaHorasPorFecha', 'CitaController@getApiListaHorasPorFecha');
$router->add('/citas/apiEliminar', 'CitaController@apiEliminar');
$router->add('/citas/getServiciosCita', 'CitaController@getServiciosCita');
$router->add('/citas/apiUpdateEstadoCita', 'CitaController@apiUpdateEstadoCita');

$router->add('/calendario', 'CalendarioController@index');
$router->add('/calendario/apiGetCitasAtenciones', 'CalendarioController@apiGetCitasAtenciones');

$router->add('/atenciones', 'AtencionController@index');
$router->add('/atenciones/rtatenciones', 'AtencionController@rtAtenciones');
$router->add('/atenciones/apiGetAtenciones', 'AtencionController@apiGetAtenciones');
$router->add('/atenciones/apiGetTodayAtenciones', 'AtencionController@apiGetTodayAtenciones');
$router->add('/atenciones/registro', 'AtencionController@registro');
$router->add('/atenciones/apiRegistrar', 'AtencionController@apiRegistrar');
$router->add('/atenciones/apiActualizarRT', 'AtencionController@apiActualizarRT');
$router->add('/atenciones/apiEliminar', 'AtencionController@apiEliminar');
$router->add('/atenciones/getServicioProducto', 'AtencionController@getServicioProducto');
$router->add('/atenciones/apiMes', 'AtencionController@apiMes');

$router->add('/products', 'HomeController@products');
$router->add('/logout', 'AuthController@logout');

$requestUri = str_replace('/refiasa/public', '', $_SERVER['REQUEST_URI']);
$router->dispatch($requestUri);

