<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;
use Src\Infra\Model\AvaliationModel;
use Src\Infra\Model\CommentModel;

use function Src\Application\Utils\Redirect\redirect;

class StudioAnalyticsVideoViewController extends Controller
{
    private VideoModel $videoModel;
    private AvaliationModel $avaliationModel;
    private CommentModel $commentModel;

    public function index()
    {
        $this->videoModel = $this->model("video");
        $this->avaliationModel = $this->model("avaliation");
        $this->commentModel = $this->model("comment");

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
        $Allcomments = $this->commentModel->getTotalCommentsByVideoId($videoData['id']);
        $AveregeVideo = $this->videoModel->getAverageVideoByVideoId($videoData['id']);


        $categorias = $this->videoModel->getAllCategories();

        $this->view("/studio/content/video/analytics", [
            "video" => $videoData,
            "weeklyViews" => $weeklyViews,
            "weeklyAvaliations" => $weeklyAvaliations,
            "categorias" => $categorias,
            "Allcomments" => $Allcomments,
            "Averegevideo" => $AveregeVideo
        ]);
    }
}
