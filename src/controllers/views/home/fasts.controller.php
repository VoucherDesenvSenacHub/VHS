<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\UserModel;
use Src\Infra\Model\CategoryModel;
use Src\Infra\Model\FastLikeModel;
use Src\Infra\Model\FastModel;
use Src\Infra\Model\VideoModel;

class FastController extends Controller
{
    private FastModel $fastModel;
    private FastLikeModel $fastLikeModel;

    public function index()
    {
        $this->fastModel = $this->model("fast");
        $this->fastLikeModel = $this->model("fastLike");

        $fastId = $_GET['id'] ?? null;
        $fasts = [];

        if ($fastId) {
            $specificFast = $this->fastModel->getFastById($fastId);
            if (!empty($specificFast)) {
                $fasts = [$specificFast];
            }
        }

        $otherFasts = $this->fastModel->getFasts(0, 5);

        if ($fastId) {
            $otherFasts = array_filter($otherFasts, function ($fast) use ($fastId) {
                return $fast['id'] !== $fastId;
            });
        }

        $fasts = array_merge($fasts, $otherFasts);

        $fasts = array_map(function ($fast) {
            $fast["user_liked"] = $this->fastLikeModel->getLikeByUserAndFast($_SESSION["user"]["id"], $fast["id"]) ? true : false;
            $fast["likes"] = $this->fastLikeModel->countLikes($fast["id"]);
            return $fast;
        }, $fasts);

        $this->view("/home/fast/index", $fasts);
    }
}
