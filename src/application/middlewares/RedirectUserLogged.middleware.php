<?php

namespace Src\Application\Middlewares;

require_once __DIR__ . '/../../../vendor/autoload.php';

use Dotenv\Dotenv;

use Src\Infra\Model\UserModel;

require_once __DIR__ . "/../../infra/models/user.php";
require_once __DIR__ . "/../../application/utils/redirect.php";

use function Src\Application\Utils\Redirect\redirect;

class RedirectUserLoggedMiddleware {
    public function execute() {
        unset($_SESSION["token"]);

        if(isset($_COOKIE["token"])) {
            $token = $_COOKIE["token"];
            
            $userModel = new UserModel();
            $user = $userModel->getUserByToken($token);

            if(!empty($user)) {
                $_SESSION["user"] = $user[0];
                return redirect("/VHS/home");
            }
        }
    }
}