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
            http_response_code(404);
            echo "404 Not Found";
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
