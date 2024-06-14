<?php
class Router {
    private $routes = [];

    public function add($route, $handler) {
        $this->routes[$route] = $handler;
    }

    public function dispatch($requestUri) {
        $parsedUrl = parse_url($requestUri);
        $path = $parsedUrl['path'];

        if (array_key_exists($path, $this->routes)) {
            $handler = $this->routes[$path];
            $this->callHandler($handler);
        } else {
            http_response_code(404);
            require_once "../app/views/404.php";
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
