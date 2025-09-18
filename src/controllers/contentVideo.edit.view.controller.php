<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;

require_once __DIR__ . '/../application/core/controller.php';
require_once __DIR__ . '/../infra/models/video.php';

class ContentVideoEditViewController extends Controller
{
    public VideoModel $videoModel;

    public function index()
    {
        $this->videoModel = $this->model("video");

        $id =  $_GET["id"] ?? null;

        $video_id = $this->videoModel->getVideoByID($id);
        $categorias = $this->videoModel->getAllCategories();

        $this->view("/studio/content/video/index", [
            "video_id" => $video_id,
            "categorias" => $categorias
        ]);
    }
}
