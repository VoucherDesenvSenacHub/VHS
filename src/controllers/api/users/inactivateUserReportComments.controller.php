<?php

namespace Src\Application\Controllers;

use Error;
use Src\Application\Core\Controller;

use Src\Infra\Model\UserModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../application/utils/verifyRecaptcha.php';

class InactivateUserController extends Controller {
    private UserModel $userModel;

    public function index() {
        try {
            $this->userModel = $this->model("user");
            $user_inactivate = $this->userModel->blockUser($_POST["user_id"]);
            if ($user_inactivate) {
                return redirect("/VHS/admin/complaints", ["success" => "O usuário foi deletado com sucesso"]);
            }

        } catch (Error $e) {
            return redirect("/VHS/admin/complaints", ["errors" => "Erro interno do servidor"]);
        }
    }
}