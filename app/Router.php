<?php
class Router {
    private $routes = [];

    public function add($route, $handler) {
        $this->routes[$route] = $handler;
    }

    public function dispatch($requestUri) {
        if (array_key_exists($requestUri, $this->routes)) {
            $handler = $this->routes[$requestUri];
            $this->callHandler($handler);
        } else {
             // Si la ruta no coincide con ninguna de las rutas definidas, mostrar error 404
             $this->callHandler('ErrorController@notFound');
        }
    }

    private function callHandler($handler) {
        $parts = explode('@', $handler);
        $controllerName = $parts[0];
        $method = $parts[1];
        
        require_once "../app/controllers/$controllerName.php";
        $controller = new $controllerName();
        $controller->$method();
    }
}
