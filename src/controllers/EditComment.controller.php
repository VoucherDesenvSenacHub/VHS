<?php

namespace Src\Application\Controllers;
require_once __DIR__ . '/../application/utils/redirect.php';

use function Src\Application\Utils\Redirect\redirect;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Models\CommentModel;
use Respect\Validation\Validator as v;

require_once __DIR__ . '/../application/core/controller.php';

class EditCommentController extends Controller {
    public CommentModel $commentModel;

    public function index() {
        $data = json_decode(file_get_contents("php://input"), true);

        $commentId = $data["comment_id"] ?? null;
        $content = $data["content"] ?? null;
        $userId = $_SESSION["user_id"] ?? null;

        if (!$commentId || !$content || !$userId) {
            echo json_encode(["status" => "error", "message" => "Dados inválidos"]);
            return;
        }

        $commentModel = new CommentModel();
        $updated = $commentModel->edit($commentId, $content);

        if ($updated) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Falha ao atualizar"]);
        }
    }
}