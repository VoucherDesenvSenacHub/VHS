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
        $limit = 8;
        $offset = $page * $limit;
        $filterContent = $_GET["content"] ?? "";
        $ordering = isset($_GET["ordering"]) ? "ASC" : "DESC";
        
        $idUser = $_SESSION["user"]["id"];

        $comments = $this->commentModel->getStudioComments($offset, $limit + 1, $idUser, $filterContent, $ordering);
        
        $nextPage = 0;
        
        if (count($comments) > $limit) {
            array_pop($comments);
            $nextPage = 1;
        }

        $this->view("studio/comments/index", ["comments" => $comments, "next_page" => $nextPage]);   
    }
}