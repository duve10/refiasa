<?php

$routes = [
    '' => 'HomeController@index',
    'home' => 'HomeController@index',
    // Agrega más rutas aquí
];

function handleRoute($routes) {
    $url = isset($_GET['url']) ? $_GET['url'] : '';
    $url = rtrim($url, '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);

    if (array_key_exists($url, $routes)) {
        list($controller, $method) = explode('@', $routes[$url]);
        require_once "../app/controllers/$controller.php";
        $controller = new $controller();
        $controller->$method();
    } else {
        require_once '../app/controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
    }
}

handleRoute($routes);
