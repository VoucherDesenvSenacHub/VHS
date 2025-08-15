<?php

require_once __DIR__ . '/../../application/routes/route.config.php';
require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../controllers/signUp.controller.php';
require_once __DIR__ . '/../../controllers/signUpView.controller.php';
require_once __DIR__ . '/../../controllers/createPassword.controller.php';
require_once __DIR__ . '/../../controllers/verfiyEmail.controller.php';
require_once __DIR__ . '/../../application/middlewares/RedirectUserLoggedMiddleware.php';

use Dotenv\Dotenv;
use Src\Application\Controllers\SignUpController;
use Src\Application\Controllers\SignUpViewController;
use Src\Application\Controllers\CreatePasswordController;
use Src\Application\Controllers\VerifyEmailController;
use Src\Application\Controllers\CategoriesViewController;
use Src\Application\Middlewares\RedirectUserLoggedMiddleware;
use Src\Application\Routes\Router;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

$router = new Router();

$router->post('/api/v1/auth/signup', SignUpController::class);

// Páginas (Views)
$router->all("/auth/signup", SignUpViewController::class, RedirectUserLoggedMiddleware::class);
$router->all("/auth/signup/password", CreatePasswordController::class, RedirectUserLoggedMiddleware::class);
$router->all("/pages/admin/categories", CategoriesViewController::class);

// $router->all("/auth/signup/verify-email", VerifyEmailController::class);

$router->run();