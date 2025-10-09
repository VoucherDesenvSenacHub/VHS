<?php

require_once __DIR__ . "/../../application/routes/route.config.php";
require_once __DIR__ . "/../../vendor/routes.autoload.php";
require_once __DIR__ . "/../../../vendor/autoload.php";

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

use Src\Application\Controllers\{
    CategoriesViewController,
    CreateUserController,
    SignUpController,
    SignUpViewController,
    CreatePasswordController,
    HomeController,
    UserSettingsViewController,
    VerifyEmailController,
    SignInController,
    UpdateUserController,
    VerifyEmailViewController,
    CreateFastVideoController,
    StudioController,
    StudioFastViewController,
    StudioVideoViewController,
    SignInViewController,
    ViewEventsController,
    AdminAnalyticsViewController,
    AdminCategoriesViewController,
    AdminComplaintManagementViewController,
    AdminUsersViewController,
    DeleteUserController,
    UpdateUserAdminController,
    DeleteCommentsController,
    InactivateUserController,
    DeleteReportCommentsController
};

use Src\Application\Middlewares\{
    RedirectUserLoggedMiddleware,
    RedirectUserNotLoggedMiddleware,
    RedirectUserNotCreatorMiddleware,
    RedirectUserNotAdminMiddleware
};

use Src\Application\Routes\Router;
$router = new Router();

# API Routes

$router->POST("/api/v1/auth/signin", SignInController::class);
$router->POST("/api/v1/signup/password", CreateUserController::class, RedirectUserLoggedMiddleware::class);
$router->POST("/api/v1/auth/signup", SignUpController::class);
$router->POST("/api/v1/user/settings", UpdateUserController::class, RedirectUserNotLoggedMiddleware::class);
$router->POST("/api/v1/fast-video", CreateFastVideoController::class, RedirectUserNotCreatorMiddleware::class);
$router->POST("/api/v1/user/delete", DeleteUserController::class, RedirectUserNotAdminMiddleware::class);
$router->POST("/api/v1/user/update", UpdateUserAdminController::class, RedirectUserNotAdminMiddleware::class);
$router->POST("/api/v1/comments/delete", DeleteCommentsController::class, RedirectUserNotAdminMiddleware::class);
$router->POST("/api/v1/users/block", InactivateUserController::class, RedirectUserNotAdminMiddleware::class);
$router->POST("/api/v1/comments/report/remove", DeleteReportCommentsController::class, RedirectUserNotAdminMiddleware::class);

# Views Routes

$router->GET("/home", HomeController::class, RedirectUserNotLoggedMiddleware::class);
$router->GET("/home/categories", CategoriesViewController::class, RedirectUserNotLoggedMiddleware::class);
$router->GET("/auth/signin", SignInViewController::class, RedirectUserLoggedMiddleware::class);
$router->GET("/auth/signup", SignUpViewController::class, RedirectUserLoggedMiddleware::class);
$router->GET("/auth/signup/password", CreatePasswordController::class, RedirectUserLoggedMiddleware::class);
$router->GET("/auth/signup/verify-email", VerifyEmailViewController::class);
$router->GET("/api/v1/auth/signup/verify-email", VerifyEmailController::class);
$router->GET("/studio", StudioController::class, RedirectUserNotCreatorMiddleware::class);
$router->GET("/studio/create/video", StudioVideoViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->GET("/studio/create/fast", StudioFastViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->GET("/user/settings", UserSettingsViewController::class, RedirectUserNotLoggedMiddleware::class);
$router->GET("/home/events", ViewEventsController::class, RedirectUserNotLoggedMiddleware::class);
$router->GET("/admin/analytics", AdminAnalyticsViewController::class, RedirectUserNotAdminMiddleware::class);
$router->GET("/admin/categories", AdminCategoriesViewController::class, RedirectUserNotAdminMiddleware::class);
$router->GET("/admin/complaints", AdminComplaintManagementViewController::class, RedirectUserNotAdminMiddleware::class);
$router->GET("/admin/users", AdminUsersViewController::class, RedirectUserNotAdminMiddleware::class);