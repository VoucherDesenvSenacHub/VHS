<?php

namespace Src\Application\Controllers;



use function Src\Application\Utils\Redirect\redirect;
use Src\Application\Core\Controller;
use Src\Infra\Model\FastLikeModel;

class AddLikeFastController extends Controller
{
    private FastLikeModel $fastLikeModel;

    public function index()
    {

        header("Content-Type: application/json");

        $this->fastLikeModel = $this->model("fastLike");

        $fastId = $_POST["fast_id"] ?? null;

        if (!$fastId) {
            http_response_code(400);
            echo json_encode([
                "status" => "error",
                "message" => "Fast ID is required"
            ]);
            return;
        }

        $userId = $_SESSION["user"]["id"];


        $userLiked = $this->fastLikeModel->getLikeByUserAndFast($userId, $fastId);

        if(count($userLiked) > 0) {
            $this->fastLikeModel->removeLike($userId, $fastId);
            $liked = false;
        } else {
            $this->fastLikeModel->addLike($userId, $fastId);
            $liked = true;
        }

        ob_clean();
        echo json_encode([
            "status" => "success",
            "message" => "Like added successfully",
            "liked" => $liked,
            "likes" => $this->fastLikeModel->countLikes($fastId)
        ]);
    }
}
