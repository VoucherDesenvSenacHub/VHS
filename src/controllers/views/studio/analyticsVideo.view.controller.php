<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;
use Src\Infra\Model\AvaliationModel;
use Src\Infra\Model\UsersFollowersModel;
use Src\Infra\Model\CommentModel;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../infra/models/video.php';
require_once __DIR__ . '/../../../infra/models/usersFollowers.php';
require_once __DIR__ . '/../../../infra/models/comment.php';

class StudioAnalyticsVideoViewController extends Controller
{
    private VideoModel $videoModel;
    private AvaliationModel $avaliationModel;
    private UsersFollowersModel $usersFollowersModel;
    private CommentModel $commentModel;

    public function index()
    {
        $this->videoModel = $this->model("video");
        $this->avaliationModel = $this->model("avaliation");

        $id =  $_GET["id"] ?? null;
        $userId = $_SESSION['user']['id'];

        if ($id) {
            // Video Analytics
            $video = $this->videoModel->getVideoByID($id);
            $weeklyViews = $this->videoModel->getViewsCountByWeekDayVideoId($id);
            $weeklyAvaliations = $this->avaliationModel->getWeeklyCountAvaliationsByVideoId($id);
            $videoData = $video[0] ?? [];
            $isGeneral = false;
            $latestVideos = [];
            $latestComments = [];
            $followersCount = 0;
        } else {
            // Channel Analytics (General)
            $this->usersFollowersModel = $this->model("usersFollowers");
            $this->commentModel = $this->model("comment");

            $viewsData = $this->videoModel->getAllViewsByUserId($userId);
            $avgStars = $this->videoModel->getAverageAvailableVideosByUserId($userId);
            $weeklyViews = $this->videoModel->getViewsCountByWeekDay($userId);

            $followersData = $this->usersFollowersModel->getCountUserFollowers($userId);
            $followersCount = $followersData[0]['COUNT(id)'] ?? 0;

            $latestVideos = $this->videoModel->getLastVideosByUserId($userId, 0, 3);
            $latestComments = $this->commentModel->getStudioComments(0, 5, $userId, '', 'DESC');

            $videoData = [
                'title' => 'Visão Geral do Canal',
                'views' => $viewsData[0]['views'] ?? 0,
                'avg_views' => number_format($viewsData[0]['average'] ?? 0, 0),
                'avg_stars' => number_format($avgStars[0]['average'] ?? 0, 1),
                'comments' => 0, // Not used in general view cards directly
                'shared' => 0
            ];
            $weeklyAvaliations = [];
            $isGeneral = true;
        }

        $categorias = $this->videoModel->getAllCategories();

        $this->view("/studio/content/video/analytics", [
            "video" => $videoData,
            "weeklyViews" => $weeklyViews,
            "weeklyAvaliations" => $weeklyAvaliations,
            "categorias" => $categorias,
            "isGeneral" => $isGeneral,
            "latestVideos" => $latestVideos,
            "latestComments" => $latestComments,
            "followersCount" => $followersCount
        ]);
    }
}
