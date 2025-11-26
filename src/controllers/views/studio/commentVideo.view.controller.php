<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\CommentModel;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../infra/models/video.php';

class StudioCommentsVideoViewController extends Controller
{
    public CommentModel $commentModel;

    public function index()
    {
        $this->commentModel = $this->model("comment");

        $id =  $_GET["id"] ?? null;

        // $comments = $this->commentModel->getStudioComments($page, 7, $idUser, $filterContent, $ordering);
        // $comments = array_slice($comments, 0, 7);

        $this->view("/studio/content/video/comments", [
           "comments" => $comments
        ]);
    }
}
