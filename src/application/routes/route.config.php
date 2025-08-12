<?php

namespace Src\Application\Routes;

class Router {
    private $routes = [];

    public function post(string $path, $controller, $middleware = null) {
        $this->routes["POST"][$path] = function() use ($controller, $middleware)  {
            if($middleware !== null) {
                (new $middleware())->execute();
            }

            (new $controller())->index();
        };
    }
    public function get(string $path, $controller, $middleware = null) {
        $this->routes["GET"][$path] = function() use ($controller, $middleware)  {
            if($middleware !== null) {
                (new $middleware())->execute();
            }

            (new $controller())->index();
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
    }
}