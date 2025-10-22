<?php

namespace Src\Application\Controllers;

use Error;
use Src\Application\Core\Controller;

use Src\Infra\Model\CommentModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../application/utils/verifyRecaptcha.php';

class LikeCommentsCreatorController extends Controller {
    private CommentModel $commentModel;

    public function index() {
        try {
            $this->commentModel = $this->model("comment");
            $current_user_id = $_SESSION["user"]["id"];
            $author_id = $this->commentModel->getAuthorIdVideoCommentById($_POST["comment_id"]);
            
            if ($author_id[0]["author_id"] == $current_user_id){
                $like_add = $this->commentModel->addCreatorLikeToComment($_POST["comment_id"]);

                return $like_add ? redirect("/VHS/studio/comments", ["success" => "Você curtiu o comentário com sucesso"]) : null;
            }

            throw new Error("Usuário não autorizado a curtir este comentário");

        } catch (Error $e) {
            return redirect("/VHS/studio/comments", ["errors" => 'Erro interno do servidor']);
        }
    }
}