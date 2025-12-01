<?php

require_once __DIR__ . "/../../application/routes/route.config.php";
require_once __DIR__ . "/../../vendor/routes.autoload.php";
require_once __DIR__ . "/../../../vendor/autoload.php";

use Src\Application\Middlewares\{
    RedirectUserLoggedMiddleware,
    RedirectUserNotLoggedMiddleware,
    RedirectUserNotCreatorMiddleware,
    RedirectUserNotAdminMiddleware
};

use Src\Application\Controllers\{
    AddLikeFastController,
    AddViewFastController,
    CategoriesViewController,
    AdminCategoriesViewController,
    CreateCategoriesController,
    UpdateCategoriesController,
    DeleteCategoriesController,
    StudioContentVideoViewController,
    CreateUserController,
    SignUpController,
    SignUpViewController,
    CreatePasswordController,
    HomeController,
    SearchVideoController,
    UserSettingsViewController,
    VerifyEmailController,
    SignInController,
    UpdateUserController,
    VideoCreateController,
    StudioCreateVideoViewController,
    VerifyEmailViewController,
    CreateFastVideoController,
    VideoUpdateController,
    StudioFastViewController,
    StudioUpdateVideoViewController,
    SignInViewController,
    EditChannelController,
    EditChannelViewController,
    AdminAnalyticsViewController,
    AdminComplaintManagementViewController,
    AdminUsersViewController,
    CreateCommentController,
    DeleteUserController,
    UpdateUserAdminController,
    DeleteCommentsController,
    InactivateUserController,
    DeleteReportCommentsController,
    FastController,
    VideoAvaliationController,
    VideoController,
    StudioAnalyticsVideoViewController,
    VideoDeleteController,
    StudioCommentsViewController,
    LikeCommentsCreatorController,
    DeleteCommentStudioController,
    UserBlockedUserController,
    StudioAnalyticsViewController,
    StudioContentFastViewController,
    DeleteFastController,
    StudioUpdateFastViewController,
    FastUpdateController,
    CreateEventController,
    StudioCreateEventsViewController,
    EventsController
};

use Dotenv\Dotenv;
Dotenv::createImmutable(__DIR__ . "/../../..")->load();

use Src\Application\Routes\Router;
$router = new Router();

# -- API Routes -- #

$router->POST("/api/v1/auth/signin", SignInController::class);
$router->POST("/api/v1/admin/categories", CreateCategoriesController::class, RedirectUserNotAdminMiddleware::class);
$router->POST("/api/v1/admin/categories/update", UpdateCategoriesController::class, RedirectUserNotAdminMiddleware::class);
$router->POST("/api/v1/admin/categories/delete", DeleteCategoriesController::class, RedirectUserNotAdminMiddleware::class);
$router->POST("/api/v1/signup/password", CreateUserController::class, RedirectUserLoggedMiddleware::class);
$router->POST("/api/v1/auth/signup", SignUpController::class);
$router->POST("/api/v1/user/settings", UpdateUserController::class, RedirectUserNotLoggedMiddleware::class);
$router->POST("/api/v1/fast-video", CreateFastVideoController::class, RedirectUserNotCreatorMiddleware::class);
$router->POST("/api/v1/channel/edit", EditChannelController::class, RedirectUserNotCreatorMiddleware::class);
$router->POST("/api/v1/user/delete", DeleteUserController::class, RedirectUserNotAdminMiddleware::class);
$router->POST("/api/v1/user/update", UpdateUserAdminController::class, RedirectUserNotAdminMiddleware::class);
$router->POST("/api/v1/comment", CreateCommentController::class, RedirectUserNotLoggedMiddleware::class);
$router->POST("/api/v1/comments/delete", DeleteCommentsController::class, RedirectUserNotAdminMiddleware::class);
$router->POST("/api/v1/users/block", inactivateUserController::class, RedirectUserNotAdminMiddleware::class);
$router->POST("/api/v1/comments/report/remove", DeleteReportCommentsController::class, RedirectUserNotAdminMiddleware::class);
$router->POST("/api/v1/comments/report", ReportCommentController::class, RedirectUserNotLoggedMiddleware::class);
$router->POST("/api/v1/json/video/rating", VideoAvaliationController::class);
$router->POST("/api/v1/comment/edit", UpdateCommentController::class, RedirectUserNotLoggedMiddleware::class);
$router->POST("/api/v1/comment/delete", DeleteCommentController::class, RedirectUserNotAdminMiddleware::class);
$router->POST("/api/v1/json/fast/like", AddLikeFastController::class, RedirectUserNotLoggedMiddleware::class);
$router->POST("/api/v1/json/fast/view", AddViewFastController::class);
$router->POST("/api/v1/studio/create/video", VideoCreateController::class);
$router->POST("/api/v1/studio/content/video/edit", VideoUpdateController::class);
$router->POST("/api/v1/video/delete", VideoDeleteController::class);
$router->POST("/api/v1/studio/comments/creator-like", LikeCommentsCreatorController::class, RedirectUserNotCreatorMiddleware::class);
$router->POST("/api/v1/studio/comment/delete", DeleteCommentStudioController::class, RedirectUserNotCreatorMiddleware::class);
$router->POST("/api/v1/studio/users/block", UserBlockedUserController::class, RedirectUserNotCreatorMiddleware::class);
$router->POST("/api/v1/fast/delete", DeleteFastController::class, RedirectUserNotCreatorMiddleware::class);
$router->POST("/api/v1/fast/edit", FastUpdateController::class, RedirectUserNotCreatorMiddleware::class);
$router->POST("/api/v1/studio/create/event", CreateEventController::class, RedirectUserNotCreatorMiddleware::class);

# -- Views Routes -- #

$router->GET("/studio/create/event", StudioCreateEventsViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->GET("/home/events", EventsController::class, RedirectUserNotLoggedMiddleware::class);
$router->GET("/home", HomeController::class, RedirectUserNotLoggedMiddleware::class);
$router->GET("/home/categories", CategoriesViewController::class, RedirectUserNotLoggedMiddleware::class);
$router->GET("/auth/signin", SignInViewController::class, RedirectUserLoggedMiddleware::class);
$router->GET("/auth/signup", SignUpViewController::class, RedirectUserLoggedMiddleware::class);
$router->GET("/auth/signup/password", CreatePasswordController::class, RedirectUserLoggedMiddleware::class);
$router->GET("/auth/signup/verify-email", VerifyEmailViewController::class);
$router->GET("/api/v1/auth/signup/verify-email", VerifyEmailController::class);
$router->GET("/studio/create/video", StudioCreateVideoViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->GET("/studio/create/fast", StudioFastViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->GET("/studio/content/video", StudioContentVideoViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->GET("/studio/content/video/edit", StudioUpdateVideoViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->GET("/studio/content/video/analytic", StudioAnalyticsVideoViewController::class);
$router->GET("/studio/analytics", StudioAnalyticsViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->GET("/studio/create/video", StudioCreateVideoViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->GET("/studio/create/fast", StudioFastViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->GET("/studio/content/fast", StudioContentFastViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->GET("/studio/content/fast/edit", StudioUpdateFastViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->GET("/api/v1/ajax/fasts", GetFastsController::class, RedirectUserNotLoggedMiddleware::class);
$router->GET("/studio/comments", StudioCommentsViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->GET("/home/search/video", SearchVideoController::class);
$router->GET("/user/settings", UserSettingsViewController::class, RedirectUserNotLoggedMiddleware::class);
$router->GET("/studio/channel/edit", EditChannelViewController::class, RedirectUserNotCreatorMiddleware::class);
$router->GET("/admin/analytics", AdminAnalyticsViewController::class, RedirectUserNotAdminMiddleware::class);
$router->GET("/admin/categories", AdminCategoriesViewController::class, RedirectUserNotAdminMiddleware::class);
$router->GET("/admin/complaints", AdminComplaintManagementViewController::class, RedirectUserNotAdminMiddleware::class);
$router->GET("/admin/users", AdminUsersViewController::class, RedirectUserNotAdminMiddleware::class);
$router->GET("/home/video", VideoController::class, RedirectUserNotLoggedMiddleware::class);
$router->GET("/home/fasts", FastController::class, RedirectUserNotLoggedMiddleware::class);

$router->run();