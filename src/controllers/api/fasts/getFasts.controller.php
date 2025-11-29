<?php

use Src\Application\Core\Controller;
use Src\Infra\Model\FastLikeModel;
use Src\Infra\Model\FastModel;

use function src\views\components\FastComponent\FastComponent;

require_once __DIR__ . "/../../../views/components/fastComponent/fastComponent.php";

class GetFastsController extends Controller
{
    private FastModel $fastModel;
    private FastLikeModel $fastLikeModel;


    public function index()
    {
        $this->fastModel = $this->model("fast");
        $this->fastLikeModel = $this->model("fastLike");

        $page = $_GET["page"] ?? 1;

        if ($page <= 0 || !is_numeric($page)) {
            $page = 1;
        }

        $limit = 5;
        $offset = ($page - 1) * $limit;

        $fasts = $this->fastModel->getFasts($limit, $offset);
        $fastsHTML = "";


        header('Content-Type: text/html');
        foreach ($fasts as $fast) {
            $fastsHTML .= FastComponent(
                [
                    "id" => $fast["id"],
                    "url" => "/VHS/public/videos/" . $fast["url"] . ".mp4",
                    "title" => $fast["title"],
                    "user" => $fast["username"],
                    "avatar_url" => $fast["avatar_url"],
                    "likes" => $this->fastLikeModel->countLikes($fast["id"]),
                    "user_liked" => $this->fastLikeModel->getLikeByUserAndFast($_SESSION["user"]["id"], $fast["id"]) ? true : false
                ]
            );

        }
        echo $fastsHTML;

    }
}