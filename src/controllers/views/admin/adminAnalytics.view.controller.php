<?php

namespace Src\Application\Controllers;

use Src\Infra\Model\CategoryModel;
use Src\Infra\Model\UserModel;
use Src\Infra\Model\CommentModel;

require_once __DIR__ . "/../../../application/core/controller.php";

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;

class AdminAnalyticsViewController extends Controller
{
    private UserModel $userModel;
    private CategoryModel $categoryModel;
    private CommentModel $commentModel;
    private VideoModel $videoModel;
    public function index()
    {
        $this->userModel = $this->model("user");
        $this->categoryModel = $this->model("category");
        $this->commentModel = $this->model("comment");
        $this->videoModel = $this->model("video");

        $allUsers = $this->userModel->getAllUsers();
        $allVideos = $this->videoModel->countAllVideos();
        $allChannels = $this->userModel->getAllChannels();
        $allReports = $this->commentModel->getAllReports();
        $lastsReportsComments = $this->commentModel->getReportComments(0, 7, 'DESC');
        $categoriesTotal = $this->categoryModel->getCountVideosByCategories();
        $allCountUsersLoginWeekday = $this->userModel->getCountUsersLoginByWeekDay();

        $last_comments = [];
        foreach ($lastsReportsComments as $report) {
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

            $last_comments[] = [
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

        $activities = [
            [
                "data" => "Hoje",
                "time" => "10:00",
                "usuario1" => "Freitasdev",
                "description" => "baniu o usuário",
                "usuario2" => "Cirilo",
                "causa" => "Incompetência"
            ],
            [
                "data" => "Hoje",
                "time" => "11:30",
                "usuario1" => "Freitasdev",
                "description" => "baniu o usuário",
                "usuario2" => "Cirilo",
                "causa" => "Incompetência"
            ],
            [
                "data" => "Ontem",
                "time" => "14:20",
                "usuario1" => "Freitasdev",
                "description" => "baniu o usuário",
                "usuario2" => "Cirilo",
                "causa" => "Incompetência"
            ]
        ];

        $this->view("admin/analytics/index", [
            "all_users" => $allUsers[0]['all_users'],
            "all_videos" => $allVideos[0]['all_videos'],
            "all_channels" => $allChannels[0]['all_channels'],
            "all_reports" => $allReports[0]['all_reports'],
            "lasts_reports_comments" => $last_comments,
            "categories_total" => $categoriesTotal,
            "all_count_users_login_weekday" => $allCountUsersLoginWeekday,
            "activities" => $activities
        ]);
    }
}
