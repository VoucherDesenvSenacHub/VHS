<?php

namespace Src\Application\Controllers;

use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Models\UserModel;

use Respect\Validation\Validator as v;

require_once __DIR__ . '/../application/core/controller.php';

class SignUpController extends Controller {
    public UserModel $userModel;

    public function index() {
        try {
            $this->userModel = $this->model("user");

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
            );
            
            $schema->assert($_POST);

            $_POST["password"] = password_hash($_POST["password"], PASSWORD_BCRYPT, [
                "cost" => 14
            ]);

            $this->userModel->create($_POST["name"], $_POST["email"], $_POST["password"], $_POST["username"], $_POST["date_birthday"]);
        } catch (NestedValidationException $exception) {
            echo $exception->getFullMessage();
        }
        
    }
}