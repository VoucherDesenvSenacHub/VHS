<?php

namespace Src\Application\Middlewares;

require_once __DIR__ . '/../../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

use Src\Infra\Model\UserModel;

require_once __DIR__ . "/../../infra/models/user.php";
require_once __DIR__ . "/../../application/utils/redirect.php";

use function Src\Application\Utils\Redirect\redirect;

class RedirectUserNotLoggedMiddleware {
    public function execute() {
        if(!isset($_COOKIE["token"]) && !isset($_SESSION["token"])) {
            return redirect("../../../application/routes/route.php/auth/signin");
        }
        else{
            $token = $_COOKIE["token"] ?? $_SESSION["token"];
            $userModel = new UserModel();
            $user = $userModel->getUserByToken($token);
            $_SESSION["user"] = $user[0];
        }
    }
}