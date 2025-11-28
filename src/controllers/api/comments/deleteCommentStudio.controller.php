<?php 
namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\CommentModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';

class DeleteCommentStudioController extends Controller {
    private CommentModel $commentModel;

    public function index() {
        $this->commentModel = $this->model("comment");

        $commentId = $_POST["commentId"];
        $current_user_id = $_SESSION["user"]["id"];

        $commentExists = $this->commentModel->verifyCommentIdVideoForUser($current_user_id, $commentId);

        if($_SESSION["user"]["role"] === "USER" || $commentExists == false) {
            redirect($_SERVER["HTTP_REFERER"]."#comments", ["errors" => "Você não tem permissão para deletar esse comentário"], 403);
            return;
        }

        $this->commentModel->deleteComment($commentId);

        redirect("/VHS/studio/comments", ["success" => "Comentário deletado com sucesso"]);
    }
}