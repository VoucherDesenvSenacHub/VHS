<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Application\Utils\EmailTransporter;
use Src\Infra\Model\UserModel;

require_once __DIR__ . '/../application/core/controller.php';
require_once __DIR__ . '/../application/utils/emailTransporter.php';

class VerifyEmailUserController extends Controller {
    private UserModel $userModel;

    public function index() {
        $this->userModel = $this->model("user");

        if(!isset($_GET["id"])) {
            http_response_code(400);
            redirect("/VHS/src/application/routes/route.php/auth/signup");
            return;
        };

        $userId = $_GET["id"];

        $user = $this->userModel->getUserById($userId); 

        if(empty($user)) {
            http_response_code(400);
            redirect("/VHS/src/application/routes/route.php/auth/signup");
            return;
        }

        $this->userModel->verifyEmail($userId);
        $this->view("/auth/register/verify-email/index");
    }
}