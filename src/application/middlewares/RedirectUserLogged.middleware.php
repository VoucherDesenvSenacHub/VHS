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
        if(!isset($_COOKIE["token"])) return;
        
        $userModel = new UserModel();

        $token = $_COOKIE["token"];
        $user = $userModel->getUserByToken($token);

        if(!empty($user)) {
            http_response_code(403);
            return redirect("/VHS/home");
        } 
    }
}