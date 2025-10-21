<?php

require_once __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__ . "/../../vendor/routes.autoload.php";
require_once __DIR__ . "/../../application/routes/route.config.php";

use Src\Application\Middlewares\{
    RedirectUserLoggedMiddleware     AS RedirectUserLogged,
    RedirectUserNotLoggedMiddleware  AS RedirectUserNotLogged,
    RedirectUserNotCreatorMiddleware AS RedirectUserNotCreator,
    RedirectUserNotAdminMiddleware   AS RedirectUserNotAdmin
};

use Src\Application\Controllers\{
    SignUpController,
    SignInController,
    DeleteUserController,
    CreateUserController,
    UpdateUserController,
    VerifyEmailController,
    DeleteCommentsController,
    InactivateUserController,
    CreateFastVideoController,
    UpdateUserAdminController,
    DeleteReportCommentsController
};

use Src\Application\Controllers\{
    HomeController,
    StudioController,
    SignUpViewController,
    SignInViewController,
    CreatePasswordController,
    CategoriesViewController,
    StudioFastViewController,
    AdminUsersViewController,
    StudioVideoViewController,
    VerifyEmailViewController,
    UserSettingsViewController,
    AdminAnalyticsViewController,
    AdminCategoriesViewController,
    AdminComplaintManagementViewController
};

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

use Src\Application\Routes\Router;
$router = new Router();

# -- API Routes -- #

$router->POST("/api/v1/auth/signin", SignInController::class);
$router->POST("/api/v1/auth/signup", SignUpController::class);
$router->POST("/api/v1/user/delete", DeleteUserController::class, RedirectUserNotAdmin::class);
$router->POST("/api/v1/signup/password", CreateUserController::class, RedirectUserLogged::class);
$router->POST("/api/v1/user/settings", UpdateUserController::class, RedirectUserNotLogged::class);
$router->POST("/api/v1/users/block", InactivateUserController::class, RedirectUserNotAdmin::class);
$router->POST("/api/v1/user/update", UpdateUserAdminController::class, RedirectUserNotAdmin::class);
$router->POST("/api/v1/fast-video", CreateFastVideoController::class, RedirectUserNotCreator::class);
$router->POST("/api/v1/comments/delete", DeleteCommentsController::class, RedirectUserNotAdmin::class);
$router->POST("/api/v1/comments/report/remove", DeleteReportCommentsController::class, RedirectUserNotAdmin::class);

# -- VIEWS Routes -- #

$router->GET("/home", HomeController::class, RedirectUserNotLogged::class);
$router->GET("/auth/signup/verify-email", VerifyEmailViewController::class);
$router->GET("/api/v1/auth/signup/verify-email", VerifyEmailController::class);
$router->GET("/studio", StudioController::class, RedirectUserNotCreator::class);
$router->GET("/auth/signin", SignInViewController::class, RedirectUserLogged::class);
$router->GET("/auth/signup", SignUpViewController::class, RedirectUserLogged::class);
$router->GET("/admin/users", AdminUsersViewController::class, RedirectUserNotAdmin::class);
$router->GET("/home/categories", CategoriesViewController::class, RedirectUserNotLogged::class);
$router->GET("/user/settings", UserSettingsViewController::class, RedirectUserNotLogged::class);
$router->GET("/auth/signup/password", CreatePasswordController::class, RedirectUserLogged::class);
$router->GET("/admin/analytics", AdminAnalyticsViewController::class, RedirectUserNotAdmin::class);
$router->GET("/studio/create/fast", StudioFastViewController::class, RedirectUserNotCreator::class);
$router->GET("/admin/categories", AdminCategoriesViewController::class, RedirectUserNotAdmin::class);
$router->GET("/studio/create/video", StudioVideoViewController::class, RedirectUserNotCreator::class);
$router->GET("/admin/complaints", AdminComplaintManagementViewController::class, RedirectUserNotAdmin::class);