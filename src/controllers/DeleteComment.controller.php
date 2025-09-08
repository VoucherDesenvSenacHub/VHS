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
    
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $token = $_POST['delete_token'] ?? null;
            
                if (!$token || !isset($_SESSION['delete_tokens'][$token])) {
                    echo json_encode(["status" => "error", "message" => "Token inválido"]);
                    exit;
                }
            
                $commentId = $_SESSION['delete_tokens'][$token];
                unset($_SESSION['delete_tokens'][$token]);
            
                $commentModel = new CommentModel();
                $success = $commentModel->delete($commentId);
            
                if($success){
                    return redirect("/VHS/src/views/pages/home/video/index.php");
                }

            }
            
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
}