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

        $page = $_GET["page"] ?? 0;

        if(!is_numeric($page) || $page < 0) {
            $page = 0;
        }

        $limit = 8;
        $offset = $page * $limit;

        $videos = $this->videoModel->getAllVideos($author_id, $offset, $limit);

        $this->view("/studio/content/index", [
            "videos" => $videos
        ]);
    }
}
