<?php

require_once __DIR__ . '/../../application/routes/route.config.php';
require_once __DIR__ . '/../../vendor/routes.autoload.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

use Dotenv\Dotenv;
use Src\Application\Controllers\CategoriesViewController;
use Src\Application\Controllers\CreateUserController;
use Src\Application\Controllers\SignUpController;
use Src\Application\Controllers\SignUpViewController;
use Src\Application\Controllers\CreatePasswordController;
use Src\Application\Controllers\HomeController;
use Src\Application\Controllers\VerifyEmailController;
use Src\Application\Middlewares\RedirectUserLoggedMiddleware;
use Src\Application\Controllers\SignInController;
use Src\Application\Controllers\VerifyEmailViewController;
use Src\Application\Middlewares\RedirectUserNotLoggedMiddleware;
use Src\Application\Routes\Router;
use Src\Controllers\SignInViewController;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

$router = new Router();

#api routes
$router->post('/api/v1/auth/signin', SignInController::class);

$router->post("/api/v1/signup/password", CreateUserController::class, RedirectUserLoggedMiddleware::class);
$router->post('/api/v1/auth/signup', SignUpController::class);


$router->get('/home', HomeController::class);

#views routes
$router->get('/home', HomeController::class, RedirectUserNotLoggedMiddleware::class);
$router->get('/home/categories', CategoriesViewController::class, RedirectUserNotLoggedMiddleware::class);

$router->get('/auth/signin', SignInViewController::class, RedirectUserLoggedMiddleware::class);
$router->get("/auth/signup", SignUpViewController::class, RedirectUserLoggedMiddleware::class);
$router->get("/auth/signup/password", CreatePasswordController::class, RedirectUserLoggedMiddleware::class);

$router->get("/auth/signup/verify-email", VerifyEmailViewController::class);
$router->get("/api/v1/auth/signup/verify-email", VerifyEmailController::class);


$router->run();