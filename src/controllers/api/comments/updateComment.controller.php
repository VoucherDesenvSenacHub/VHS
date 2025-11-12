<?php 

use Src\Application\Core\Controller;
use Src\Infra\Model\CommentModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';

class UpdateCommentController extends Controller {
    private CommentModel $commentModel;

    public function index() {
        try {

            $this->commentModel = $this->model("comment");
        
            $commentId = $_GET["commentId"];
            $newContent = $_POST["content"];
        
            $commentExists = $this->commentModel->getCommentById($commentId);
        
            if(empty($commentExists)) {
                redirect($_SERVER["HTTP_REFERER"]."#comments", statusCode: 404);
                return;
            }
        
            $commentExists = $commentExists[0];

            if($commentExists["user_id"] !== $_SESSION["user"]["id"]) {
                redirect($_SERVER["HTTP_REFERER"]."#comments", statusCode: 403);
                return;
            }
        
            $this->commentModel->updateComment($commentId, $newContent);
            redirect($_SERVER["HTTP_REFERER"]."#comments");

        } catch(Exception $e) {
            redirect($_SERVER["HTTP_REFERER"]."#comments", statusCode: 500);
        }
    }
}