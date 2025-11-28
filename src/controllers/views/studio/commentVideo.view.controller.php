<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\CommentModel;
use Src\Infra\Model\VideoModel;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../infra/models/video.php';

class StudioCommentsVideoViewController extends Controller
{
    public CommentModel $commentModel;
    public VideoModel $videoModel;

    public function index()
    {
        $this->commentModel = $this->model("comment");
        $this->videoModel = $this->model("video");

        $id =  $_GET["id"] ?? null;

        $page = $_GET["page"] ?? 0;

        if (!is_numeric($page) || $page < 0) {
            $page = 0;
        }

        $limit = 8;
        $offset = $page * $limit;
        $filterContent = $_GET["content"] ?? "";
        $ordering = isset($_GET["ordering"]) ? "ASC" : "DESC";

        $video = $this->videoModel->getVideoById($id);

        $comments = $this->commentModel->getStudioVideoComments($id, $offset, $limit + 1, $filterContent, $ordering);

        $nextPage = 0;
        
        if (count($comments) > $limit) {
            array_pop($comments);
            $nextPage = 1;
        }

        $this->view("/studio/content/video/comments", [
            "video" => $video,
            "comments" => $comments,
            "next_page" => $nextPage
        ]);
    }
}
