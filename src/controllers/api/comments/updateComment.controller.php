<?php 

use Src\Application\Core\Controller;
use Src\Infra\Model\CommentModel;
use Respect\Validation\Validator as v;
use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';

class UpdateCommentController extends Controller {
    private CommentModel $commentModel;

    public function index() {
        try {
            
            
            $schema = v::key('content', v::stringType()->length(min: 1, max:200));
            if (!$schema->validate($_POST)) {
                
                http_response_code(400); 
                header('Content-Type: application/json');
                $response = [
                    "error" => "O comentário deve ter entre 1 e 200 caracteres" 
                ];
                echo json_encode($response);
                exit; 
            }
            
            
            $this->commentModel = $this->model("comment");
        
            $commentId = $_GET["commentId"];
            $newContent = $_POST["content"];

            $commentExists = $this->commentModel->getCommentById($commentId);
        
            
            if(empty($commentExists)) {
                
                http_response_code(404); 
                header('Content-Type: application/json');
                echo json_encode(["error" => "Comentário não encontrado."]);
                exit; 
            }
        
            $commentExists = $commentExists[0];

            
            if($commentExists["user_id"] !== $_SESSION["user"]["id"]) {
                
                
                http_response_code(403); 
                header('Content-Type: application/json');
                echo json_encode(["error" => "Você não tem permissão para editar este comentário."]);
                exit; 
            }
        
            
            $this->commentModel->updateComment($commentId, $newContent);
            
           
            
            http_response_code(200); 
            header('Content-Type: application/json');
            echo json_encode([
                "success" => true,
                "message" => "Comentário editado com sucesso.",
                "newContent" => $newContent 
            ]);
            exit; 

        } catch(Exception $e) {
            

            http_response_code(500); 
            header('Content-Type: application/json');
            echo json_encode(["error" => "Ocorreu um erro interno no servidor."]);
            exit; 
        }
    }
}