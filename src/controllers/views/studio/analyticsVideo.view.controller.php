<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;
use Src\Infra\Model\AvaliationModel;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../infra/models/video.php';

class StudioAnalyticsVideoViewController extends Controller
{
    private VideoModel $videoModel;
    private AvaliationModel $avaliationModel;

    public function index()
    {
        $this->videoModel = $this->model("video");
        $this->avaliationModel = $this->model("avaliation");

        $id =  $_GET["id"] ?? "";

        $video = $this->videoModel->getVideoByID($id);
        $weeklyViews = $this->videoModel->getViewsCountByWeekDayVideoId($id);
        $weeklyAvaliations = $this->avaliationModel->getWeeklyCountAvaliationsByVideoId($id);
        $categorias = $this->videoModel->getAllCategories();

        $this->view("/studio/content/video/analytics", [
            "video" => $video[0] ?? [],
            "weeklyViews" => $weeklyViews,
            "weeklyAvaliations" => $weeklyAvaliations,
            "categorias" => $categorias
        ]);
    }
}
