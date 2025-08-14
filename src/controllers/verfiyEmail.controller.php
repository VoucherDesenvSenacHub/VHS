<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Application\Utils\EmailTransporter;
use Src\Infra\Model\UserModel;

require_once __DIR__ . '/../application/core/controller.php';
require_once __DIR__ . '/../application/utils/emailTransporter.php';

class VerifyEmailController extends Controller {
    private UserModel $userModel;

    public function index() {
        $this->userModel = $this->model("user");

        if(!isset($_COOKIE["token"])) {
            http_response_code(400);
            redirect("/VHS/src/application/routes/route.php/auth/signup");
            return;
        };

        $token = $_COOKIE["token"];

        $user = $this->userModel->getUserByToken($token);

        if(empty($user)) return http_response_code(400);
        
        if($user[0]["email_already_sent"]) {
            $this->view("/auth/register/verify-email/index", [
                "user" => $user[0],
            ]);
            return;
        }
        
        $this->userModel->markEmailAsSent($user[0]["id"]);
        
        $emailTransporter = new EmailTransporter();

        $file_path = __DIR__ . '/../application/utils/emails/createAccountEmail.html';
        
        $emailHTML = fopen($file_path, "r");
        $emailHTML = fread($emailHTML, filesize($file_path));
        $emailHTML = str_replace("[Nome do Usuário]", $user[0]["name"], $emailHTML);
        $emailTransporter->sendEmail($user[0]["email"], $user[0]["name"], "Bem-vindo ao nosso sistema", $emailHTML);

        $user["password"] = null;

        $this->view("/auth/register/verify-email/index", [
            "user" => $user[0],
        ]);
    }
}