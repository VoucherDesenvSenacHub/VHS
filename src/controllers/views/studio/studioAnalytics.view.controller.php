<?php

namespace Src\Application\Controllers;


require_once __DIR__ . "/../../../application/core/controller.php";

use Src\Application\Core\Controller;
use Src\Infra\Model\CommentModel;
use Src\Infra\Model\UsersFollowersModel;
use Src\Infra\Model\VideoModel;

class StudioAnalyticsViewController extends Controller
{
    private UsersFollowersModel $usersFollowersModel;
    private VideoModel $videoModel;
    private CommentModel $commentModel;

    public function index()
    {
        $this->usersFollowersModel = $this->model('usersFollowers');
        $this->videoModel = $this->model('video');
        $this->commentModel = $this->model('comment');

        $userId = $_SESSION['user']['id'];

        // Fetch data similar to what was in StudioAnalyticsVideoViewController for General
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
            'comments' => 0,
            'shared' => 0
        ];

        $this->view("/studio/analytics/index", [
            "video" => $videoData,
            "weeklyViews" => $weeklyViews,
            "latestVideos" => $latestVideos,
            "latestComments" => $latestComments,
            "followersCount" => $followersCount
        ]);
    }
}
