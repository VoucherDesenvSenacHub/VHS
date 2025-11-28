<?php

namespace Src\Application\Controllers;

use Error;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;

use Respect\Validation\Validator as v;
use Src\Application\Utils\EmailTransporter;
use Src\Infra\Model\UserModel;

use function Src\Application\Utils\Redirect\redirect;
use function Src\Application\Utils\verifyRecaptcha;

class ResetPasswordController extends Controller {
    private UserModel $userModel;

    public function index()
    {
        try {
            $this->userModel = $this->model("user");

            $email = $_POST["email"] ?? "";

            v::email()->assert($email);

            $user = $this->userModel->getUserByEmail($email);

            if(empty($user)) {
                throw new Error(serialize([
                    "error"=> "Email não encontrado!"
                ]));
            }

            $user = $user[0];

            if ($user['reset_password_token_created_at']) {
                $createdAt = new \DateTime($user['reset_password_token_created_at']);
                $now = new \DateTime();
                $interval = $now->diff($createdAt);

                if ($interval->days === 0 && $interval->h === 0 && $interval->i < 15) {
                    throw new Error("Um email de redefinição já foi enviado recentemente. Tente novamente em 15 minutos.");
                }
            }

            $token = uniqid("", true) . uniqid("", true);
            $this->userModel->updateResetPasswordToken($user["id"], $token);

            $emailTransporter = new EmailTransporter();

            $file_path = __DIR__ . '/../../../application/utils/emails/resetPasswordEmail.html';            
        
            $emailHTML = fopen($file_path, "r");
            $emailHTML = fread($emailHTML, filesize($file_path));
            $emailHTML = str_replace("[Nome do Usuário]", $user["name"], $emailHTML);
            $emailHTML = str_replace("[Link de Redefinição]", "http://localhost/VHS/auth/reset-password?step=2&token=" . $token, $emailHTML);


            $emailTransporter->sendEmail(
                $email,
                $user["name"],
                "Recuperação de senha",
                $emailHTML,
            );

            redirect("/VHS/auth/reset-password", [
                "success" => "Email enviado com sucesso!"
            ]);

        } catch (NestedValidationException $exception) {
            redirect("/VHS/auth/reset-password?error=1", [
                "error" => $exception->getMessages()
            ]);
        } catch (\Throwable $e) {
             $msg = $e->getMessage();
             $unserialized = @unserialize($msg);
             if ($unserialized !== false && isset($unserialized['error'])) {
                 $msg = $unserialized['error'];
             }
             
             redirect("/VHS/auth/reset-password?error=1", [
                "error" => $msg
            ]);
        }
    }
}