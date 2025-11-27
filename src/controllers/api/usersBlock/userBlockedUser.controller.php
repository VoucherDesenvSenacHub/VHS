<?php

namespace Src\Application\Controllers;

use Error;
use Src\Application\Core\Controller;
use Src\Infra\Model\CommentModel;
use Src\Infra\Model\UsersBlockModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../application/utils/verifyRecaptcha.php';

class UserBlockedUserController extends Controller {
    private UsersBlockModel $usersBlockModel;
    private CommentModel $commentModel;

    public function index() {
        try {
            $this->usersBlockModel = $this->model("usersBlock");
            $this->commentModel = $this->model("comment");
            if ($_POST["userId"] == $_POST["userBlockedId"]){
                return redirect("/VHS/studio/comments", ["errors" => ["não pode se blockear na aplicação"]], 403);
            }
            $userBlock = $this->usersBlockModel->userBlockedUser($_POST["userId"], $_POST["userBlockedId"]);
            $commentsDeleted = $this->commentModel->deleteCommentsInChannelBlocked($_POST["userId"], $_POST["userBlockedId"]);
            if ($userBlock && $commentsDeleted) {
                return redirect("/VHS/studio/comments", ["success" => "O usuário foi deletado com sucesso"]);
            }

        } catch (Error $e) {
            return redirect("/VHS/studio/comments", ["errors" => $e->getMessage()], 400);
        }
    }
}