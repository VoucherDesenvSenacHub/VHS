<?php

namespace Src\Application\Controllers;

use Error;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Model\UserHistoryModel;
use Src\Infra\Model\VideoModel;

require_once __DIR__ . '/../application/core/controller.php';

class UserHistoryController extends Controller {
    private UserHistoryModel $userHistoryModel;
    private VideoModel $videoModel;

    public function __construct() {
        $this->userHistoryModel = $this->model("user_history");
        $this->videoModel = $this->model("video");
    }

  
    public function index() {
        try {
            session_start();

            $userId = $_SESSION['user_id'] ?? null;
            if (!$userId) {
                throw new Error("Usuário não logado.");
            }

            $history = $this->userHistoryModel->getHIstoryByUserId($userId);
            $history = $this->attachVideoDetails($history);

            $this->view("history/index", ["history" => $history]);

        } catch (NestedValidationException | Error $exception) {
            $errors = $exception instanceof NestedValidationException 
                ? $exception->getMessages() 
                : [$exception->getMessage()];

            $this->view("history/index", ["errors" => $errors]);
        }
    }


    private function attachVideoDetails(array $history): array {
        return array_map(function($item) {
            $video = $this->videoModel->getVideoById($item["video_id"]);
            return $item + [
                "video_title" => $video["title"] ?? "Vídeo não encontrado",
                "thumbnail" => $video["thumbnail"] ?? "",
                "type_card" => "history"
            ];
        }, $history);
    }
}
