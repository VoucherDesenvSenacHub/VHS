<?php

namespace Src\Application\Controllers;

use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Models\UserModel;
use Src\Application\Utils\Redirect;

use Respect\Validation\Validator as v;

require_once __DIR__ . '/../application/core/controller.php';
require_once __DIR__ . '/../application/utils/redirect.php';

use function Src\Application\Utils\Redirect\redirect;

class SignInController extends Controller {
    public UserModel $userModel;

    public function index() {
        try {
            $this->userModel = $this->model("user");

            $_POST["keep_logged_in"] = isset($_POST["keep_logged_in"]) ? "on" : "off";

            $schema =
            v::key(
                'email',
                v::email(),
            )->key(
                'password',
                v::stringType()->length(8, 16)
            )->key(
                'keep_logged_in',
                v::stringType()
            )->key(
                'token_recaptcha',
                v::stringType()
            );
            
            $schema->assert($_POST);

            $user = $this->userModel->findUserByEmail($_POST["email"]);

            $password = password_verify($_POST["password"], $user[0]["password"]);

            if ($password && $_POST["keep_logged_in"] == "on") {
                return redirect("/VHS/src/views/pages/home/index.php", $user[0]);
            }
            else
            {
                return redirect("/VHS/src/views/pages/auth/login/index.php", ['Acesso negado!']);
            }

        } catch (NestedValidationException $exception) {
            echo $exception->getFullMessage();
        }
        
    }
}