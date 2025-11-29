<?php



namespace Src\Application\Controllers;

use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Model\UserModel;
use Respect\Validation\Validator as v;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../application/utils/redirect.php';
require_once __DIR__ . '/../../../application/utils/verifyRecaptcha.php';

use function Src\Application\Utils\Redirect\redirect;
use function Src\Application\Utils\verifyRecaptcha;

class SignInController extends Controller {
    public UserModel $userModel;

    public function index() {
        $recaptcha = $_POST['g-recaptcha-response'] ?? '';

        try {
            $this->userModel = $this->model("user");

            $_POST["keep_logged_in"] = isset($_POST["keep_logged_in"]) ? "on" : "off";

            $schema = v::key(
                'email',
                v::email()->setName('email')->setTemplate('O email deve ser um endereço de email válido')
            )->key(
                'password',
                v::stringType()->length(8, 16)->setName('password')->setTemplate( 'A senha deve ter entre 8 e 16 caracteres')
            )->key(
                'keep_logged_in',
                v::stringType()->setName('keep_logged_in')->setTemplate('A opção "Lembrar de mim" deve ser uma string')
            )->key(
                'g-recaptcha-response',
                v::stringType()->setName('g-recaptcha-response')->setTemplate('O token do reCAPTCHA deve ser uma string')
            );
            
            $schema->assert($_POST);

            // if (!verifyRecaptcha($recaptcha)) {
            //     return redirect("/VHS/auth/signin?error=1", [
            //         'errors' => ['Falha na verificação do reCAPTCHA. Tente novamente.']
            //     ]);
            // }

            $user = $this->userModel->findUserByEmail($_POST["email"]);

            if(empty($user)) {
                return redirect("/VHS/auth/signin?error=1", ['errors' => ["E-mail ou senha incorretos"]]);
            }

            $passwordVerified = password_verify($_POST["password"], $user[0]["password"]);

            if(empty($passwordVerified)) {
                return redirect("/VHS/auth/signin?error=1", ['errors' => ["Email ou senha incorretos"]]);
            }

            $token = uniqid(more_entropy: true) . uniqid(more_entropy: true);
            $this->userModel->updateUserToken($user[0]["id"], $token);

            if ($_POST["keep_logged_in"] == "on") {
                setcookie("token", $token, time() + 3600 * 24 * 7, path: "/", httponly: true, secure: true);
            }

            if ($_POST["keep_logged_in"] == "off") {
                setcookie("token", $token, 0, "/", httponly: true, secure: true);
            }

            $this->userModel->updateUserLastLogin($user[0]["id"]);
        
            $_SESSION["user"] = $user[0];
            return redirect("/VHS/home");
        } catch (NestedValidationException $exception) {
            $messages = [];
            foreach ($exception->getMessages() as $message) {
                $messages[] = $message;
            }
            return redirect("/VHS/auth/signin?error=1", ['errors' => $messages, "fields" => $_POST]);
        }
        
    }
}