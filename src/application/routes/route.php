<?php

require_once __DIR__ . '/../../application/routes/route.config.php';
require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../controllers/signUp.controller.php';
require_once __DIR__ . '/../../controllers/Comment.controller.php';
require_once __DIR__ . '/../../controllers/DeleteComment.controller.php';

use Dotenv\Dotenv;
use Src\Application\Controllers\CommentController;
use Src\Application\Controllers\DeleteCommentController;
use Src\Application\Controllers\SignUpController;
use Src\Application\Routes\Router;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

$router = new Router();

$router->post('/api/v1/auth/signup', SignUpController::class);

$router->post('/api/v1/home/video/', CommentController::class);

$router->post('/api/v1/home/video/delete', DeleteCommentController::class);

$router->run();


