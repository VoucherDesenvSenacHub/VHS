<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\AvaliationModel;
use Src\Infra\Model\VideoModel;

require_once __DIR__ . '/../../../application/core/controller.php';

class VideoAvaliationController extends Controller {
    private AvaliationModel $avaliationModel;
    private VideoModel $videoModel;

    public function index() {
        $contentType = "Content-Type: application/json";

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');  
        }
        
        $this->avaliationModel = $this->model('avaliation');
        
        if(!isset($_POST["stars"]) || !isset($_POST["videoId"])) {
            header($contentType, true, 400);
            echo json_encode([
                "success" => false,
                "message"=> "Corpo da requisição inválido!"
            ]); 
            return;
        }

        $stars = $_POST["stars"];
        $videoId = $_POST["videoId"];
        $currentUserId = $_SESSION["user"]["id"];
        
        $this->videoModel = $this->model("video");
        
        if(empty($this->videoModel->getVideoById($videoId))) {
            header($contentType, true, 404);
            echo json_encode([
                "success"=> false,
                "message"=> "Vídeo não encontrado"
            ]);
            return;
        }

        $existsAvaliation = $this->avaliationModel->getAvaliation(
            $videoId,
            $currentUserId,
        );


        if(empty($existsAvaliation)) {
            $this->avaliationModel->addAvaliation($stars, $videoId, $currentUserId);
        } else {
            $this->avaliationModel->updateAvaliation($stars, $videoId, $currentUserId);
        }
        

        header($contentType, true, 201);
        echo json_encode([
            "success" => true,
            "message" => "Vídeo avaliado com sucesso!"
        ]);
    }
}