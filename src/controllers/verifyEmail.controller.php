<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\UserModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../application/core/controller.php';

class VerifyEmailController extends Controller {
    private UserModel $userModel;

    public function index() {
        $this->userModel = new UserModel();

        if(!isset($_GET["id"])) {
            return redirect("/VHS/auth/signup");
        }

        $id = base64_decode($_GET["id"]);

        $user = $this->userModel->getUserById($id);

        if(!$user) {
            return redirect("/VHS/auth/signup");
        }

        if($user[0]["verified_email"]) {
            return redirect("/VHS/home");
        }

        $this->userModel->verifyEmail(
            $user[0]["id"]
        );

        return redirect("/VHS/home");
    }
}