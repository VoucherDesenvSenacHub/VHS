<?php 

use Src\Application\Core\Controller;
use Src\Infra\Model\CommentModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';

class DeleteCommentController extends Controller {
    private CommentModel $commentModel;

    public function index() {
        $this->commentModel = $this->model("comment");

        $commentId = $_GET["commentId"];

        $commentExists = $this->commentModel->getCommentById($commentId);

        if(empty($commentExists)) {
            redirect($_SERVER["HTTP_REFERER"]."#comments", ["errors" => "Comentário não encontrado"]);
            return;
        }

        $commentExists = $commentExists[0];

        if($_SESSION["user"]["role"] === "USER" && $commentExists["user_id"] !== $_SESSION["user"]["id"]) {
            redirect($_SERVER["HTTP_REFERER"]."#comments", ["errors" => "Você não tem permissão para deletar esse comentário"]);
            return;
        }

        $this->commentModel->deleteComment($commentId);

        redirect($_SERVER["HTTP_REFERER"]."#comments", ["success" => "Comentário deletado com sucesso"]);
    }
}