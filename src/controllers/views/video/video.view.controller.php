<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\AvaliationModel as ModelAvaliationModel;
use Src\Infra\Model\UserModel;
use Src\Infra\Model\VideoModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';

class VideoController extends Controller {
    private VideoModel $videoModel;
    private ModelAvaliationModel $avaliationModel;

    public function index() {
        $this->videoModel = $this->model('video');
        $this->avaliationModel = $this->model("avaliation");
        
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

        $this->view("/home/video/index", [
            "video" => $video,
            "releated_videos" => $relatedVideos,
            "user_avaliation" => $stars
        ]);
    }
}