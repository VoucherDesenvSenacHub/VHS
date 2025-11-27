<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\AvaliationModel as ModelAvaliationModel;
use Src\Infra\Model\CommentModel;
use Src\Infra\Model\UserModel;
use Src\Infra\Model\VideoModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';

class VideoController extends Controller {
    private VideoModel $videoModel;
    private ModelAvaliationModel $avaliationModel;

    private CommentModel $commentModel;

    public function index() {
        $this->videoModel = $this->model('video');
        $this->avaliationModel = $this->model("avaliation");
        $this->commentModel = $this->model("comment");
        
        $video = $this->videoModel->getVideoById($_GET['id'] ?? "");

        if(empty($video)) return redirect("/404");
    
        $video = $video[0];

        $relatedVideos = $this->videoModel->getVideosByCategory($video["category_id"]); 

        $this->videoModel->incrementViewCount($_GET["id"]);

        $userAvaliation = $this->avaliationModel->getAvaliation(
            $video["id"],
            $_SESSION["user"]["id"]
        );

        $stars = 0;

        if(!empty($userAvaliation)) {
            $stars = $userAvaliation[0]["stars"];
        }

        $page = $_GET["page"] ?? 0;

        if(!is_numeric($page) || $page < 0) {
            $page = 0;
        }

        $limit = 10;
        $offset = $page * $limit;


        $comments = $this->commentModel->getCommentsByVideoId($video["id"], $offset, $limit + 1);
        $totalComments = $this->commentModel->getTotalCommentsByVideoId($video["id"]);
        $totalComments = $totalComments[0]["total"] ?? 0;

        $this->view("/home/video/index", [
            "video" => $video,
            "releated_videos" => $relatedVideos,
            "user_avaliation" => $stars,
            "comments" => $comments,
            "total_comments"=> $totalComments,
            "offset"=> $offset,
            "limit"=> $limit,
            "has_more_comments" => count($comments) > $limit
        ]);
    }
}