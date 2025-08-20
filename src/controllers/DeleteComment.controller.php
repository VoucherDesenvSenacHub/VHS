<?php

namespace Src\Application\Controllers;
require_once __DIR__ . '/../application/utils/redirect.php';

use function Src\Application\Utils\Redirect\redirect;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Models\CommentModel;
use Respect\Validation\Validator as v;

require_once __DIR__ . '/../application/core/controller.php';

class DeleteCommentController extends Controller {
    public CommentModel $commentModel;

    public function index() {
        try {
            $this->commentModel = $this->model("Comment");
    
            $schema = 
            v::key('id', v::stringType()->length(1, 23))
            ->key('user_id', v::stringType()->length(1, 23));

            $schema->assert($_POST);
    
            $deleted = $this->commentModel->delete($_POST['id'], $_POST['id']);
    
            if ($deleted) {
                echo json_encode(["status" => "success", "message" => "Comentário deletado"]);
            } else {
                http_response_code(403); // Forbidden
                echo json_encode(["status" => "error", "message" => "Não autorizado a deletar este comentário"]);
            }
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}