<?php

namespace Src\Application\Controllers;

use Exception;
use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';

class VideoController extends Controller {
    private VideoModel $videoModel;

    public function index() {
        $this->videoModel = $this->model('video');
        
        $video = $this->videoModel->getVideoById($_GET['id'] ?? "")[0];

        if(empty($video)) {
            return redirect("/404");
        }

        $relatedVideos = $this->videoModel->getVideosByCategory($video["category_id"]); 
        $this->videoModel->incrementViewCount($_GET["id"]);

        $this->view("/home/video/index", [
            "video" => $video,
            "releated_videos" => $relatedVideos,
        ]);
    }
}