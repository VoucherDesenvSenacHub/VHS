<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;

require_once __DIR__ . '/../application/core/controller.php';
require_once __DIR__ . '/../infra/models/video.php';

class VideoViewController extends Controller
{
    public VideoModel $videoModel;

    public function index()
    {
        $this->videoModel = new VideoModel();
        $categorias = $this->videoModel->getCategories();

        $this->view("/studio/content/create/video/index", [
            "categorias" => $categorias
        ]);
    }
}
