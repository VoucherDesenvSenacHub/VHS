<?php

require_once __DIR__ . '/../../application/routes/route.config.php';
require_once __DIR__ . '/../../vendor/routes.autoload.php';
require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../controllers/signUp.controller.php';
require_once __DIR__ . '/../../controllers/signIn.controller.php';
require_once __DIR__ . '/../../controllers/signUpView.controller.php';
require_once __DIR__ . '/../../controllers/createPassword.controller.php';
require_once __DIR__ . '/../../controllers/home.controller.php';
#require_once __DIR__ . '/../../controllers/verfiyEmail.controller.php';
require_once __DIR__ . '/../../application/middlewares/RedirectUserLoggedMiddleware.php';
require_once __DIR__ . '/../../application/middlewares/RedirectUserNotLoggedMiddleware.php';
require_once __DIR__ . '/../../controllers/signIn.view.controller.php';

use Dotenv\Dotenv;
use Src\Application\Controllers\CreateUserController;
use Src\Application\Controllers\SignUpController;
use Src\Application\Controllers\SignUpViewController;
use Src\Application\Controllers\CreatePasswordController;
use Src\Application\Controllers\HomeController;
use Src\Application\Middlewares\RedirectUserLoggedMiddleware;
use Src\Application\Controllers\SignInController;
use Src\Application\Middlewares\RedirectUserNotLoggedMiddleware;
use Src\Application\Routes\Router;
use Src\Controllers\SignInViewController;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

$router = new Router();

$router->post("/api/v1/signup/password", CreateUserController::class, RedirectUserLoggedMiddleware::class);
#api routes
$router->post('/api/v1/auth/signup', SignUpController::class);
$router->post('/api/v1/auth/signin', SignInController::class);


#views routes
$router->get('/home', HomeController::class, RedirectUserNotLoggedMiddleware::class);
$router->get('/auth/signin', SignInViewController::class, RedirectUserLoggedMiddleware::class);

$router->get("/auth/signup", SignUpViewController::class, RedirectUserLoggedMiddleware::class);
$router->get("/auth/signup/password", CreatePasswordController::class, RedirectUserLoggedMiddleware::class);
$router->get("/auth/signup/password", CreatePasswordController::class, RedirectUserLoggedMiddleware::class);

$router->run();