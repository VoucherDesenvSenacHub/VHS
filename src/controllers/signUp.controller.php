<?php

namespace Src\Application\Controllers;

use Error;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;

use Respect\Validation\Validator as v;
use Src\Infra\Model\UserModel;
use Src\Infra\Models\CategorieModel;
use Src\Infra\Models\CategoryModel;

use function Src\Application\Utils\verifyRecaptcha;

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
                v::stringType()->length(3, 150)
            )->key(
                'email',
                v::email(),
            )->key(
                'password',
                v::stringType()->length(8, 16)
            )->key(
                'date_birthday',
                v::stringType()->date()
            )->key(
                "username", 
                v::stringType()->length(3, 60)
            )->key(
                "token_recaptcha",
                v::stringType()
            );
            
            $schema->assert($_POST);
            
            $isValidRecaptcha = verifyRecaptcha($_POST["token_recaptcha"]);

            if(!$isValidRecaptcha) return throw new Error("- invalid reCAPTCHA");

            $isUserExists = $this->userModel->getUserByEmail($_POST["email"]);

            if(!empty($isUserExists)) {
                throw new Error("- Email already exists");
            }

            $isUserExists = $this->userModel->getUserByUsername($_POST["username"]);

            if(!empty($isUserExists)) {
                throw new Error("- Username already exists");
            }
            
            $_POST["password"] = password_hash($_POST["password"], PASSWORD_BCRYPT, [
                "cost" => 14
            ]);

            $token = uniqid(more_entropy: true) . uniqid(more_entropy: true);

            $this->userModel->create($_POST["name"], $_POST["email"], $_POST["password"], $_POST["username"], $_POST["date_birthday"], $token);

            echo $token;
            return;
        } catch (NestedValidationException | Error  $exception) {
            if($exception instanceof Error) {
                echo $exception->getMessage();
            } else {
                echo $exception->getFullMessage();
            }

        }
        
    }
}