<?php

namespace Src\Application\Middlewares;

require_once __DIR__ . '/../../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

use Src\Infra\Model\UserModel;

require_once __DIR__ . "/../../infra/models/user.php";
require_once __DIR__ . "/../../application/helpers/redirect.php";

use function Src\Application\Utils\Redirect\redirect;

class RedirectUserNotLoggedMiddleware {
    public function execute() {

        if(!isset($_COOKIE["token"])) {
            http_response_code(401);
            return redirect("/VHS/auth/signin");
        }

        $userModel = new UserModel();

        $token = $_COOKIE["token"];
        $user = $userModel->getUserByToken($token);

        if(!$user) {
            http_response_code(403);
            return redirect("/VHS/auth/signin");
        }

        $_SESSION["user"] = $user[0];
    }
}