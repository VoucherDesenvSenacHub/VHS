<?php

namespace Src\Application\Controllers;


use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;

class ShareVideoController extends Controller
{
  private VideoModel $videoModel;

  public function index()
  {
    try {
      header("Content-Type: application/json", true, 200);

      $this->videoModel = $this->model("video");
      $videoId = $_POST["video_id"] ?? "";
      
      $video = $this->videoModel->getVideoById($videoId);

      if (!$video) {  
        header("Content-Type: application/json", true, 404);
        echo json_encode([
          "status" => "error",
          "message" => "Video not found"
        ]);
        return; 
      }

      $this->videoModel->addShareCount($videoId);

    } catch (\Throwable $th) {
      header("Content-Type: application/json", true, 500);
      echo json_encode([
        "status" => "error",
        "message" => "Internal server error"
      ]);
    }
  }
}
