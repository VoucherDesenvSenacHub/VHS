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

class RedirectUserLoggedMiddleware {
    public function execute() {
        if(isset($_COOKIE["token"]) || isset($_SESSION["token"])) {
            $token = $_COOKIE["token"] ?? $_SESSION["token"];
            
            $userModel = new UserModel();
            $user = $userModel->getUserByToken($token);

            if(!empty($user)) {
                redirect("/VHS/src/views/pages/home", ['user' => $user]);
            }
        }
    }
}