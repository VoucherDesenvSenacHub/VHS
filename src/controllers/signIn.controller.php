<?php

namespace Src\Application\Controllers;

use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Models\UserModel;

use Respect\Validation\Validator as v;

require_once __DIR__ . '/../application/core/controller.php';
require_once __DIR__ . '/../application/utils/redirect.php';

use function Src\Application\Utils\Redirect\redirect;
require_once __DIR__ . '/../application/utils/verifyRecaptcha.php';
use function Src\Application\Utils\verifyRecaptcha;

class SignInController extends Controller {
    public UserModel $userModel;

    public function index() {
        $token = $_POST['g-recaptcha-response'] ?? '';
        try {
            $this->userModel = $this->model("user");

            $_POST["keep_logged_in"] = isset($_POST["keep_logged_in"]) ? "on" : "off";

            $schema = v::key(
                'email',
                v::email()->setName('email')->setTemplate('O email deve ser um endereço de email válido')
            )->key(
                'password',
                v::stringType()->length(8, 16)->setName('password')->setTemplate(template: 'A senha deve ter entre 8 e 16 caracteres')
            )->key(
                'keep_logged_in',
                v::stringType()->setName('keep_logged_in')->setTemplate('A opção "Lembrar de mim" deve ser uma string')
            )->key(
                'g-recaptcha-response',
                v::stringType()->setName('g-recaptcha-response')->setTemplate('O token do reCAPTCHA deve ser uma string')
            );
            
            $schema->assert($_POST);

            $user = $this->userModel->findUserByEmail($_POST["email"]);

            $password = password_verify($_POST["password"], $user[0]["password"]);

            if (!verifyRecaptcha($token)) {
                return redirect("/VHS/src/views/pages/auth/login/index.php?error=1", [
                    'errors' => ['Falha na verificação do reCAPTCHA. Tente novamente.']
                ]);
            }

            if ($password && $_POST["keep_logged_in"] == "on") {
                setcookie("token", $user[0]["id"], time() + (86400 * 30), "/", );
                return redirect("/VHS/src/views/pages/home/index.php", ['user' => $user[0]]);
            }
            elseif ($password && $_POST["keep_logged_in"] == "off") {
                return redirect("/VHS/src/views/pages/home/index.php", ['user' => $user[0]]);
            }
            else
            {
                return redirect("/VHS/src/views/pages/auth/login/index.php?error=1", ['errors' => ["Email ou senha incorretos"]]);
            }

        } catch (NestedValidationException $exception) {
            $messages = [];
            foreach ($exception->getMessages() as $message) {
                $messages[] = $message;
            }
            return redirect("/VHS/src/views/pages/auth/login/index.php?error=1", ['errors' => $messages]);
        }
        
    }
}