<?php

namespace Src\Application\Controllers;

use Error;
use Src\Application\Core\Controller;

use Src\Infra\Model\UserModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../application/utils/verifyRecaptcha.php';

class DeleteUserController extends Controller {
    private UserModel $userModel;

    public function index() {
        try {
            $this->userModel = $this->model("user");
            $user_delete = $this->userModel->deleteUser($_POST["id"]);
            if ($user_delete) {
                return redirect("/VHS/admin/users", ["success" => "O usuário foi deletado com sucesso"]);
            }

        } catch (Error $e) {
            return redirect("/VHS/admin/users", ["error" => $e->getMessage()]);
        }
    }
}