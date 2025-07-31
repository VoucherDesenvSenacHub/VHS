<?php

namespace Src\Application\Routes;

class Router {
    private $routes = [];

    public function post(string $path, $controller) {
        $this->routes["POST"][$path] = function() use ($controller)  {
            (new $controller())->handle();
        };
    }
    public function get(string $path, $controller) {
        $this->routes["GET"][$path] = function() use ($controller)  {
            (new $controller())->handle();
        };
    }

    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['PATH_INFO'] ?? '/';

        if (isset($this->routes[$method][$path])) {
            return $this->routes[$method][$path]();
        } 

        http_response_code(404);
        echo 'Not Found';
        // TODO: Envie para uma página de erro 404
    }
}