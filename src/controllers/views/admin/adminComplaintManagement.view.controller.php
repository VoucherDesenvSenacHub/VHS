<?php

namespace Src\Application\Controllers;

use Src\Infra\Model\CommentModel;
use Src\Infra\Model\UserModel;
use Src\Infra\Model\VideoModel;

require_once __DIR__ . "/../../../application/core/controller.php";

use Src\Application\Core\Controller;

class AdminComplaintManagementViewController extends Controller {
    private CommentModel $commentModel;
    private UserModel $userModel;
    private VideoModel $videoModel;
    public function index() {
        $this->commentModel = $this->model("comment");
        $this->userModel = $this->model("user");
        $this->videoModel = $this->model("video");

        $page = $_GET["page"] ?? 0;

         if (!is_numeric($page) || $page < 0) {
            $page = 0;
        }
        
        $filterComment = $_GET["comment"] ?? "";
        $sort = $_GET["sort"] ?? 'desc';
        
        $limit = 7;
        $offset = $page * $limit;
        $report_comments = $this->commentModel->getReportComments($offset, $limit + 1, $sort);

        $nextPageReportComments = 0;

        if (count($report_comments) > $limit) {
            array_pop($report_comments);
            $nextPageReportComments = 1;
        }

        $comments = [];

        foreach($report_comments as $report){
            $userData = $this->userModel->getUserById($report["user_id"])[0];
            $commentData = $this->commentModel->getCommentById($report["comment_id"])[0];
            $userReported = $this->userModel->getUserById($commentData["user_id"])[0];
            $videoData = $this->videoModel->getVideoById($commentData["video_id"])[0];

            if ($userReported["status"] == 0) {
                continue;
            }

            if (isset($filterComment) && $filterComment != "") {
                if (stripos($commentData["content"], $filterComment) === false) {
                    continue;
                }
            }

            $comments[] = [
                "reported_user_id" => $userReported["id"],
                "report_id" => $report["id"],
                "comment_id" => $report["comment_id"],
                "user_id" => $report["user_id"],
                "user_img" => $userReported["avatar_url"],
                "thumbnail_url" => $videoData["thumbnail_url"],
                "name" => $userReported["name"],
                "name_admin" => $userData["name"],
                "text" => $commentData["content"],
                "created_at" => $commentData["created_at"]
            ];
        }
        
        $this->view("admin/complaintManagement/index", [
            "comments" => $comments, 
            "next_page_report_comments" => $nextPageReportComments,
            "search" => $filterComment,
            "sort" => $sort
        ]);        
    }   
}