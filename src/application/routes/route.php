<?php

require_once __DIR__ . '/../../application/routes/route.config.php';
require_once __DIR__ . '/../../vendor/routes.autoload.php';

use Src\Application\Routes\Router;
use Src\Application\Controllers\SignUpController;

$router = new Router();

$router->post('/api/v1/auth/signup', SignUpController::class);

$router->run();