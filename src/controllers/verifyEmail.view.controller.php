<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Application\Utils\EmailTransporter;
use Src\Infra\Model\UserModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../application/core/controller.php';
require_once __DIR__ . '/../application/utils/emailTransporter.php';

class VerifyEmailViewController extends Controller {
    private UserModel $userModel;

    public function index() {
        $this->userModel = new UserModel();

        $emailTransporter = new EmailTransporter();
        
        if(!($_COOKIE["token"] || $_SESSION["token"])) {
            return redirect("/VHS/auth/signup");
        }
        
        $user = ($this->userModel->getUserByToken($_COOKIE["token"] ?? $_SESSION["token"]))[0];

        if(isset($_GET["verified"]) && $user["verified_email"]) {
            return redirect("/VHS/home");
        }

        if($user["email_already_sent"]) {
            $this->view("/auth/register/verify-email/index");
            return;
        }
        
        $file_path = __DIR__ . '/../application/utils/emails/createAccountEmail.html';
        
        $emailHTML = fopen($file_path, "r");
        $emailHTML = fread($emailHTML, filesize($file_path));
        $emailHTML = str_replace("[Nome do Usuário]", $user["name"], $emailHTML);
        $emailHTML = str_replace("[Link de Verificação]", "/VHS/api/v1/auth/signup/verify-email?id=" . base64_encode($user["id"]), $emailHTML);

        $emailTransporter->sendEmail($user["email"], $user["name"], "Bem-vindo ao nosso sistema", $emailHTML);

        $this->userModel->updateSentEmailStatus(
            $user["id"], 
            true
        );

        $this->view("/auth/register/verify-email/index");
    }
}