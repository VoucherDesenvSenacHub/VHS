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

        if (!is_numeric($page) || $page < 0) {
            $page = 0;
        }

        $search = $_GET["search"] ?? null;
        $sort = $_GET["sort"] ?? 'desc';

        $limit = 8;
        $offset = $page * $limit;

        $videos = $this->videoModel->getAllVideos($author_id, $offset, $limit + 1, $search, $sort);

        $nextPage = 0;

        if (count($videos) > $limit) {
            array_pop($videos);
            $nextPage = 1;
        }

        $this->view("/studio/content/index", [
            "videos" => $videos,
            "next_page" => $nextPage,
            "search" => $search,
            "sort" => $sort
        ]);
    }
}
