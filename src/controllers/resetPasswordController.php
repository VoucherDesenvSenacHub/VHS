<?php

namespace Src\Application\Controllers;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Rules\Lowercase;
use Src\Application\Core\Controller;
use Src\Infra\Models\UserModel;

use Respect\Validation\Validator as v;

require_once __DIR__ . '/../application/core/controller.php';

class ResetpasswordController extends Controller {
    public UserModel $userModel;

    public function index() {
        try {
            $this->userModel = $this->model("user");

            $schema = 
            v::key(
                'email',
                v::email(),
            )
            ->key(
                'newpassword',
                v::stringType()->length(8, 16)
            );

            $schema->assert($_POST);
            $_POST["newpassword"] =
            password_hash($_POST["newpassword"], PASSWORD_BCRYPT, [
                "cost" => 14
            ]);
            $this->userModel->resetpassword($_POST["email"], $_POST["newpassword"]);

        } catch (NestedValidationException $exception) {
            echo $exception->getFullMessage();
        }
        
    }
}