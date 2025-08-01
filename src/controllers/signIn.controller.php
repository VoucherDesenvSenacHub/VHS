<?php

namespace Src\Application\Controllers;

use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Models\UserModel;

use Respect\Validation\Validator as v;

require_once __DIR__ . '/../application/core/controller.php';

class SignInController extends Controller {
    public UserModel $userModel;

    public function index() {
        try {
            $this->userModel = $this->model("user");

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
                'recaptcha',
                v::stringType()
            );
            
            $schema->assert($_POST);

            $user = $this->userModel->findUserByEmail($_POST["email"]);

            $password = password_verify($_POST["password"], $user[0]["password"]);

            return !!$password;

        } catch (NestedValidationException $exception) {
            echo $exception->getFullMessage();
        }
        
    }
}