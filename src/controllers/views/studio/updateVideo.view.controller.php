<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../infra/models/video.php';

class StudioUpdateVideoViewController extends Controller
{
    public VideoModel $videoModel;

    public function index()
    {
        $this->videoModel = $this->model("video");

        $id =  $_GET["id"] ?? null;

        $video = $this->videoModel->getVideoByID($id);
        $categorias = $this->videoModel->getAllCategories();

        $this->view("/studio/content/video/index", [
            "video" => $video,
            "categorias" => $categorias
        ]);
    }
}
