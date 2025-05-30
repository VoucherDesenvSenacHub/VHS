<?php

require_once __DIR__ . '/../../application/routes/route.config.php';
require_once __DIR__ . '/../../vendor/routes.autoload.php';
require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../controllers/listVideo.controller.php';
require_once __DIR__ . '/../../controllers/listVideoCategory.controller.php';

use Dotenv\Dotenv;
use Src\Application\Routes\Router;
use Src\Application\Controllers\SignUpController;
use Src\Application\Controllers\ListVideoController;
use Src\Application\Controllers\ListVideoCategoryController;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

$router = new Router();

$router->post('/api/v1/auth/signup', SignUpController::class);
$router->post('/api/v1/auth/verify-email', VerifyEmailController::class);
$router->get('/api/v1/videos/popular', ListVideoController::class);
$router->get('/api/v1/videos/popularCategory', ListVideoCategoryController::class);


$router->run();


