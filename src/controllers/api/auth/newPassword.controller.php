<?php

namespace Src\Application\Controllers;

use Error;
use Src\Application\Core\Controller;
use Src\Infra\Model\UserModel;
use function Src\Application\Utils\Redirect\redirect;

class NewPasswordController extends Controller {
    private UserModel $userModel;

    public function index()
    {
        try {
            $this->userModel = $this->model("user");

            $token = $_POST['token'] ?? '';
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($password !== $confirmPassword) {
                throw new Error("As senhas não coincidem!");
            }

            if (strlen($password) < 8) {
                throw new Error("A senha deve ter pelo menos 8 caracteres!");
            }

            $users = $this->userModel->getUserByResetPasswordToken($token);

            if (empty($users)) {
                throw new Error("Token inválido ou expirado!");
            }

            $user = $users[0];
            
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $this->userModel->updateUser(
                $user['id'], 
                $user['name'], 
                $user['email'], 
                $user['username'], 
                $hashedPassword, 
                $user['avatar_url']
            );

            $this->userModel->updateResetPasswordToken($user['id'], null);

            redirect("/VHS/auth/signin", [
                "success" => "Senha redefinida com sucesso!"
            ]);

        } catch (\Throwable $e) {
             $msg = $e->getMessage();
             $unserialized = @unserialize($msg);
             if ($unserialized !== false && isset($unserialized['error'])) {
                 $msg = $unserialized['error'];
             }
             
             redirect("/VHS/auth/reset-password?step=2&token=" . $token . "&error=1", [
                "error" => $msg
            ]);
        }
    }
}
