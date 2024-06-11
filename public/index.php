<?php
session_start();

require_once '../app/config.php'; // Incluir configuración
require_once '../app/Router.php';

$router = new Router();

// Definir las rutas
$router->add('/', 'HomeController@index');
$router->add('/login', 'AuthController@login');
$router->add('/dashboard', 'HomeController@dashboard');
$router->add('/products', 'HomeController@products');
$router->add('/logout', 'AuthController@logout');

$requestUri = str_replace('/refiasa/public', '', $_SERVER['REQUEST_URI']);
$router->dispatch($requestUri);
