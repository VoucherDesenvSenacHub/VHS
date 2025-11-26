<?php

require_once __DIR__ . '/../../application/routes/route.config.php';
require_once __DIR__ . '/../../vendor/routes.autoload.php';
require_once __DIR__ . '/../../../vendor/autoload.php';

use Dotenv\Dotenv;
use Src\Application\Routes\Router;
use Src\Application\Controllers\CategoriesViewController;
use Src\Application\Controllers\AdminCategoriesViewController;
use Src\Application\Controllers\CreateCategoriesController;
use Src\Application\Controllers\UpdateCategoriesController;
use Src\Application\Controllers\DeleteCategoriesController;
use Src\Application\Controllers\StudioContentVideoViewController;
use Src\Application\Controllers\CreateUserController;
use Src\Application\Controllers\SignUpController;
use Src\Application\Controllers\SignUpViewController;
use Src\Application\Controllers\CreatePasswordController;
use Src\Application\Controllers\HomeController;
use Src\Application\Controllers\UserSettingsViewController;
use Src\Application\Controllers\VerifyEmailController;
use Src\Application\Middlewares\RedirectUserLoggedMiddleware;
use Src\Application\Controllers\SignInController;
use Src\Application\Controllers\UpdateUserController;
use Src\Application\Controllers\VideoCreateController;
use Src\Application\Controllers\StudioCreateVideoViewController;
use Src\Application\Controllers\VerifyEmailViewController;
use Src\Application\Controllers\CreateFastVideoController;
use Src\Application\Controllers\VideoUpdateController;
use Src\Application\Middlewares\RedirectUserNotLoggedMiddleware;
use Src\Application\Controllers\StudioController;
use Src\Application\Controllers\StudioFastViewController;
use Src\Application\Controllers\StudioUpdateVideoViewController;
use Src\Application\Middlewares\RedirectUserNotCreatorMiddleware;
use Src\Application\Controllers\SignInViewController;
use Src\Application\Controllers\ViewEventsController;
use Src\Application\Controllers\EditChannelController;
use Src\Application\Controllers\EditChannelViewController;
use Src\Application\Middlewares\RedirectUserNotAdminMiddleware;
use Src\Application\Controllers\AdminAnalyticsViewController;
use Src\Application\Controllers\AdminComplaintManagementViewController;
use Src\Application\Controllers\AdminUsersViewController;
use Src\Application\Controllers\CreateCommentController;
use Src\Application\Controllers\DeleteUserController;
use Src\Application\Controllers\UpdateUserAdminController;
use Src\Application\Controllers\DeleteCommentsController;
use Src\Application\Controllers\InactivateUserController;
use Src\Application\Controllers\DeleteReportCommentsController;
use Src\Application\Controllers\VideoAvaliationController;
use Src\Application\Controllers\VideoController;
use Src\Application\Controllers\StudioAnalyticsVideoViewController;
use Src\Application\Controllers\VideoDeleteController;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();
$router = new Router();

# API Routes

$router->post('/api/v1/auth/signin', SignInController::class);

$router->post('/api/v1/admin/categories', CreateCategoriesController::class, RedirectUserNotAdminMiddleware::class);
$router->post('/api/v1/admin/categories/update', UpdateCategoriesController::class, RedirectUserNotAdminMiddleware::class);
$router->post('/api/v1/admin/categories/delete', DeleteCategoriesController::class, RedirectUserNotAdminMiddleware::class);

$router->post("/api/v1/signup/password", CreateUserController::class, RedirectUserLoggedMiddleware::class);
$router->post('/api/v1/auth/signup', SignUpController::class);
$router->post("/api/v1/user/settings", UpdateUserController::class, RedirectUserNotLoggedMiddleware::class);
$router->post('/api/v1/fast-video', CreateFastVideoController::class, RedirectUserNotCreatorMiddleware::class);

$router->post('/api/v1/channel/edit', EditChannelController::class, RedirectUserNotCreatorMiddleware::class);

$router->post('/api/v1/user/delete', DeleteUserController::class, RedirectUserNotAdminMiddleware::class);
$router->post('/api/v1/user/update', UpdateUserAdminController::class, RedirectUserNotAdminMiddleware::class);

$router->post("/api/v1/comment", CreateCommentController::class, RedirectUserNotLoggedMiddleware::class);
$router->post('/api/v1/comments/delete', DeleteCommentsController::class, RedirectUserNotAdminMiddleware::class);
$router->post('/api/v1/users/block', inactivateUserController::class, RedirectUserNotAdminMiddleware::class);
$router->post('/api/v1/comments/report/remove', DeleteReportCommentsController::class, RedirectUserNotAdminMiddleware::class);
$router->post('/api/v1/comments/report', ReportCommentController::class, RedirectUserNotLoggedMiddleware::class);
$router->post("/api/v1/json/video/rating", VideoAvaliationController::class);
$router->post('/api/v1/comment/edit', UpdateCommentController::class, RedirectUserNotLoggedMiddleware::class);
$router->post('/api/v1/comment/delete', DeleteCommentController::class, RedirectUserNotAdminMiddleware::class);
$router->post('/api/v1/studio/create/video', VideoCreateController::class);
$router->post('/api/v1/studio/content/video/edit', VideoUpdateController::class);
$router->post('/api/v1/video/delete', VideoDeleteController::class);

#views routes
$router->get('/home', HomeController::class);
$router->get('/home', HomeController::class, RedirectUserNotLoggedMiddleware::class);
$router->get('/home/categories', CategoriesViewController::class, RedirectUserNotLoggedMiddleware::class);

$router->get('/auth/signin', SignInViewController::class, RedirectUserLoggedMiddleware::class);
$router->get("/auth/signup", SignUpViewController::class, RedirectUserLoggedMiddleware::class);
$router->get("/auth/signup/password", CreatePasswordController::class, RedirectUserLoggedMiddleware::class);
$router->get("/auth/signup/verify-email", VerifyEmailViewController::class);
$router->get("/api/v1/auth/signup/verify-email", VerifyEmailController::class);

$router->get("/studio", StudioController::class, RedirectUserNotCreatorMiddleware::class);
$router->get("/studio/create/video", StudioCreateVideoViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->get("/studio/create/fast",StudioFastViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->get('/studio/content/video', StudioContentVideoViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->get('/studio/content/video/edit', StudioUpdateVideoViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->get('/studio/content/video/analytic', StudioAnalyticsVideoViewController::class);

$router->get("/user/settings", UserSettingsViewController::class, RedirectUserNotLoggedMiddleware::class);
$router->get("/home/events", ViewEventsController::class);
$router->get('/studio/channel/edit', EditChannelViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->get("/home/events", ViewEventsController::class, RedirectUserNotLoggedMiddleware::class);

$router->get("/admin/analytics", AdminAnalyticsViewController::class, RedirectUserNotAdminMiddleware::class);
$router->get("/admin/categories", AdminCategoriesViewController::class, RedirectUserNotAdminMiddleware::class);
$router->get("/admin/complaints", AdminComplaintManagementViewController::class, RedirectUserNotAdminMiddleware::class);
$router->get("/admin/users", AdminUsersViewController::class, RedirectUserNotAdminMiddleware::class);

$router->get("/home/video", VideoController::class, /*RedirectUserNotLoggedMiddleware::class*/);

$router->run();
