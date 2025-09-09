<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Models\CommentModel;

require_once __DIR__ . '/../application/core/controller.php';

class EditCommentController extends Controller {
    public CommentModel $commentModel;

    public function index() {

        try{ 
            $this->commentModel = $this->model("Comment");
            
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $commentId = $_POST['comment_id'] ?? null;
            $content   = $_POST['content'] ?? null;

            if (!$commentId || !$content) {
                echo json_encode(["status" => "error", "message" => "Campos obrigatórios ausentes"]);
                return;
            }

            $commentModel = new CommentModel();
            $success = $commentModel->edit($commentId, $content);

            if ($success) {
                echo json_encode(["status" => "success", "message" => "Comentário atualizado"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Falha ao atualizar"]);
            }
        }

    } catch (\Exception $e) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }

    }
}
