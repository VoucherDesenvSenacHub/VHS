<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;
use Src\Infra\Model\AvaliationModel;

use function Src\Application\Utils\Redirect\redirect;

class StudioAnalyticsVideoViewController extends Controller
{
    private VideoModel $videoModel;
    private AvaliationModel $avaliationModel;

    public function index()
    {
        $this->videoModel = $this->model("video");
        $this->avaliationModel = $this->model("avaliation");

        $id =  $_GET["id"] ?? null;
        $userId = $_SESSION['user']['id'];

        if (!$id) {
            redirect("/VHS/studio/analytics");
            return;
        }

        // Video Analytics
        $video = $this->videoModel->getVideoByID($id);
        $weeklyViews = $this->videoModel->getViewsCountByWeekDayVideoId($id);
        $weeklyAvaliations = $this->avaliationModel->getWeeklyCountAvaliationsByVideoId($id);
        $videoData = $video[0] ?? [];
        $isGeneral = false;
        $latestVideos = [];
        $latestComments = [];
        $followersCount = 0;


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
