<?php

namespace Src\Application\Controllers;

use Error;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;

use Respect\Validation\Validator as v;
use Src\Infra\Model\UserModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../application/core/controller.php';
require_once __DIR__ . '/../application/utils/verifyRecaptcha.php';

class SignUpController extends Controller {
    private UserModel $userModel;

    public function index() {
        try {
            $this->userModel = $this->model("user");
            
            $_POST["keep_logged_in"] = isset($_POST["keep_logged_in"]) ? "on" : "off";

            $schema = 
            v::key(
                'name',
                v::stringType()->length(3, 150)->setTemplate("Nome inválido!")
            )->key(
                'username',
                v::stringType()->length(3, 60)->setTemplate("Nome de usuário inválido!")
            )->key(
                'email',
                v::email()->setTemplate("Email inválido!"),
            )->key(
                'date_birthday',
                v::stringType()->date()->setTemplate("Data de nascimento inválida!"),
            );

            $schema->assert($_POST);

            $user = $this->userModel->getUserByUsername($_POST["username"]);
            
            $errors = [];

            if(!empty($user)) {
                $errors["username"] = "Nome de usuário já cadastrado!";
            }
            
            $user = $this->userModel->getUserByEmail(strtolower($_POST["email"]));

            if(!empty($user)) {
                $errors["email"] = "Email já cadastrado!";
            }

            if(count($errors) > 0) {
                throw new Error(serialize($errors));
            }

            redirect("/VHS/auth/signup/password", [
                "fields" => $_POST
            ]);
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