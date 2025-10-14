<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;

require_once __DIR__ . '/../../../infra/models/video.php';
require_once __DIR__ . '/../../../application/core/controller.php';

class StudioCreateVideoViewController extends Controller {
    
    public VideoModel $videoModel;
    
    public function index() {
        $this->videoModel = new VideoModel();
        $categories = $this->videoModel->getAllCategories();

        $this->view("/studio/content/create/video/index", [
            "categories" => $categories
        ]);
    }
}