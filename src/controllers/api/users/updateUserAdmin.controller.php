<?php

namespace Src\Application\Controllers;

use Error;
use Src\Application\Core\Controller;

use Src\Infra\Model\UserModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../application/helpers/verifyRecaptcha.php';

class UpdateUserAdminController extends Controller {
    private UserModel $userModel;

    public function index() {
        try {
            $this->userModel = $this->model("user");
            $user_update = $this->userModel->updateUserAdmin($_POST["user_id"], $_POST["name"], $_POST["role"], $_POST["status"]);
            if ($user_update){
                return redirect("/VHS/admin/users", ["success" => "O usuário foi atualizado com sucesso"]);
            }

        } catch (Error $e) {
            return redirect("/VHS/admin/users", ["errors" => $e->getMessage()]);
        }
    }
}