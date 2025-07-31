<?php

require_once __DIR__ . '/../../application/routes/route.config.php';
require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../controllers/signUp.controller.php';
require_once __DIR__ . '/../../controllers/signIn.controller.php';

use Dotenv\Dotenv;
use Src\Application\Controllers\SignUpController;
use Src\Application\Controllers\SignInController;
use Src\Application\Routes\Router;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

$router = new Router();

$router->post('/api/v1/auth/signup', SignUpController::class);

$router->post('/api/v1/auth/signin', SignInController::class);

$router->run();


