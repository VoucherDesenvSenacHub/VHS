<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../infra/models/video.php';

class StudioContentVideoViewController extends Controller
{
    public VideoModel $videoModel;

    public function index()
    {
        $this->videoModel = new VideoModel();

        $author_id = $_SESSION["user"]["id"];

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
        $offset = $page * 8;
        $page += 1;

        $videos = $this->videoModel->getAllVideos($author_id, $offset);

        $this->view("/studio/content/index", [
            "videos" => $videos
        ]);
    }
}
