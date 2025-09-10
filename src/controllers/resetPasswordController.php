<?php

namespace Src\Application\Controllers;

use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Model\UserModel;
use Respect\Validation\Validator as v;

require_once __DIR__ . '/../application/core/controller.php';
require_once __DIR__ . '/../application/utils/redirect.php';

use function Src\Application\Utils\Redirect\redirect;

class ResetPasswordController extends Controller {
    public UserModel $userModel;

    public function index() {
        try {
            $this->userModel = $this->model("user");

            $schema = 
            v::key('email', v::email())
             ->key('newpassword', v::stringType()->length(8, 16));

            $schema->assert($_POST);

            $_POST["newpassword"] = password_hash($_POST["newpassword"], PASSWORD_BCRYPT, [
                "cost" => 14
            ]);

            $this->userModel->resetpassword($_POST["email"], $_POST["newpassword"]);

            return redirect("../../../auth/login?success=1", [
                "messages" => ["Senha redefinida com sucesso! Faça login."]
            ]);

        } catch (NestedValidationException $exception) {
            return redirect("../../../auth/new-password?error=1", [
                "errors" => $exception->getMessages(),
                "fields" => $_POST
            ]);
        }
    }
}
