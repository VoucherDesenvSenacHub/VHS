<?php

namespace Src\Application\Routes;

class Router {
    private $routes = [];

    public function __construct() {
        register_shutdown_function([$this, 'run']);
    }

    public function POST(string $path, $controller, $middleware = null) {
        $this->routes["POST"][$path] = function() use ($controller, $middleware)  {
            if ($middleware !== null) (new $middleware())->execute();
            (new $controller())->index();
        };
    }

    public function GET(string $path, $controller, $middleware = null) {
        $this->routes["GET"][$path] = function() use ($controller, $middleware)  {
            if ($middleware !== null) (new $middleware())->execute();
            (new $controller())->index();
        };
    }

    public function ALL(string $path, $controller, $middleware = null) {
        $this->routes["GET"][$path] = function() use($controller, $middleware) { 
            if ($middleware !== null) (new $middleware())->execute();
            (new $controller())->index();
        };

        $this->routes["POST"][$path] = function() use($controller, $middleware) { 
            if ($middleware !== null) (new $middleware())->execute();
            (new $controller())->index();
        };
    }
    
    public function run() {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $path = $_SERVER['PATH_INFO'] ?? '/';
        $pathWithoutGetArgs = explode('?', $path);

        if (isset($this->routes[$method][$pathWithoutGetArgs[0]])) {
            return $this->routes[$method][$pathWithoutGetArgs[0]]();
        }

        http_response_code(404);
        include __DIR__ . '/../../views/pages/responses/404.php';
        exit;
    }
}