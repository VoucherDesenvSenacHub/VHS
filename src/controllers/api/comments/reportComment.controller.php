<?php 

use Src\Application\Core\Controller;
use Src\Infra\Model\CommentModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';

class ReportCommentController extends Controller {
    private CommentModel $commentModel;

    public function index() {
        try {

            $this->commentModel = $this->model("comment");
    
            $commentId = $_GET["commentId"];
            $commentExists = $this->commentModel->getCommentById($commentId);
        
    
            if(empty($commentExists)) {
                redirect($_SERVER["HTTP_REFERER"]."#comments", ["error"=> "Comentário não encontrado"]);
                return;
            }
        
            $commentExists = $commentExists[0];

            
            $videoId = $commentExists["video_id"];
            $referer = $_SERVER["HTTP_REFERER"]."#comments" ?? "/VHS/home/video?videoId=$videoId#comments";

            if($commentExists["user_id"] === $_SESSION["user"]["id"]) {
                redirect($referer, ["errors"=> "Você não pode denunciar seu próprio comentário"]);
                return;
            }

            $reportCommentExists = $this->commentModel->getReportCommentsByUserIdAndCommentId($_SESSION["user"]["id"], $commentId);

            if(!empty($reportCommentExists)) {
                redirect($referer, ["errors"=> "Você já denunciou este comentário"]);
                return;
            }

            $this->commentModel->createReportComment($commentId, $_SESSION["user"]["id"]);
        
            redirect($referer, ["success"=> "Comentário denunciado com sucesso!"]);

        } catch(Exception $e) {
            redirect($referer, statusCode: 500);
        }
    }
}