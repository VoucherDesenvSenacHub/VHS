<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\CommentModel;

require_once __DIR__ . '/../../../application/core/controller.php';

class StudioCommentsViewController extends Controller {
    private CommentModel $commentModel;

    public function index() {
        $this->commentModel = $this->model("comment");

        $page = $_GET["page"] ?? 0;
        $page = $page > 0 ? $page * 7 : $page;
        $filterContent = $_GET["content"] ?? "";
        $ordering = isset($_GET["ordering"]) ? "ASC" : "DESC";
        
        $idUser = $_SESSION["user"]["id"];

        $comments = $this->commentModel->getStudioComments($page, 7, $idUser, $filterContent, $ordering);
        $comments = array_slice($comments, 0, 7);

        $this->view("studio/comments/index", ["comments" => $comments]);   
    }
}