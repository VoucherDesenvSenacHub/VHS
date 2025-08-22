<?php

namespace Src\Application\Controllers;

use Error;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;

use Respect\Validation\Validator as v;
use Src\Infra\Model\UserModel;
use Src\Infra\Models\CategoryModel;

use function Src\Application\Utils\Redirect\redirect;
use function Src\Application\Utils\verifyRecaptcha;

require_once __DIR__ . '/../application/core/controller.php';
require_once __DIR__ . '/../application/utils/verifyRecaptcha.php';

class CreateUserController extends Controller {
    private UserModel $userModel;

    public function index() {
        try {
            $this->userModel = $this->model("user");

            $_POST += $_SESSION["redirect_data"]["fields"];
            
            $_POST["keep_logged_in"] = isset($_POST["keep_logged_in"]) ? "on" : "off";

            $schema = 
            v::key(
                'name',
                v::stringType()->length(3, 150)
            )->key(
                'email',
                v::email(),
            )->key(
                'password',
                v::stringType()->length(8, 16)->equals($_POST["confirm_password"])->setTemplate("Senha inválida!")
            )->key(
                'confirm_password',
                v::stringType()->length(8, 16)->equals($_POST["password"])->setTemplate("Senhas não conferem!")
            )->key(
                'date_birthday',
                v::stringType()->date()
            )->key(
                "username", 
                v::stringType()->length(3, 60)
            )->key(
                "g-recaptcha-response",
                v::stringType()
            )->key(
                'keep_logged_in',
                v::stringType()->setName('keep_logged_in')->setTemplate('A opção "Lembrar de mim" deve ser uma string')
            );

            
            $schema->assert($_POST);
            
            $isValidRecaptcha = verifyRecaptcha($_POST["g-recaptcha-response"]);
            
            if(!$isValidRecaptcha) {
                throw new Error("Captcha inválido!");
            }

            $errors = [];

            $_POST["email"] = strtolower($_POST["email"]);

            $user = $this->userModel->getUserByUsername(strtolower($_POST["username"]));
        
            if(!empty($user)) {
                $errors["username"] = "Nome de usuário já cadastrado!";
            }
            
            $user = $this->userModel->getUserByEmail($_POST["email"]);

            if(!empty($user)) {
                $errors["email"] = "Email já cadastrado!";
            }

            if(count($errors) > 0) {
                throw new Error(serialize($errors));
            }

            $_POST["password"] = password_hash($_POST["password"], PASSWORD_BCRYPT, [
                "cost" => 14
            ]);

            $token = uniqid(more_entropy: true) . uniqid(more_entropy: true);

            $id = $this->userModel->create($_POST["name"], $_POST["email"], $_POST["password"], $_POST["username"], $_POST["date_birthday"], $token);
            $this->userModel->updateUserToken($id, $token);

            if($_POST["keep_logged_in"] === "on") {
                setcookie("token", $token, time() + 86400 * 30, "/");
                return redirect("/VHS/home");
            }

            $_SESSION["token"] = $token;

            return redirect("/VHS/home");
        } catch (NestedValidationException | Error  $exception) {

            if($exception instanceof Error) {
                return redirect("/VHS/auth/signup", [
                    "errors" => unserialize($exception->getMessage()),
                    "fields" => $_POST
                ]);
            } 

            redirect("/VHS/auth/signup", [
                "errors" => $exception->getMessages(),
                "fields" => $_POST
            ]);
        }
    }
}