<?php

namespace Src\Application\Controllers;

use Error;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Model\UserHistoryModel;
use Src\Infra\Model\UserModel;
use Src\Infra\Model\VideoModel;
use Src\Infra\Model\EventsHistoryModel;
use Src\Infra\Model\EventsModel;

require_once __DIR__ . '/../../../application/core/controller.php';

class UserHistoryController extends Controller
{
    private UserHistoryModel $userHistoryModel;
    private VideoModel $videoModel;
    private UserModel $userModel;
    private EventsHistoryModel $eventsHistoryModel;
    private EventsModel $eventsModel;

    public function __construct()
    {
        $this->userHistoryModel = $this->model("userHistory");
        $this->videoModel = $this->model("video");
        $this->userModel = $this->model("user");
        $this->eventsHistoryModel = $this->model("eventsHistory");
        $this->eventsModel = $this->model("events");
    }

    public function index()
    {
        try {
            $userId = $_SESSION['user']['id'] ?? null;
            if (!$userId) {
                throw new Error("Usuário não logado.");
            }

            $filter = $_GET["filter"] ?? "videos";
            $filter = strtolower($filter);

            $history = $this->getHistoryByFilter($userId, $filter);


            usort($history, fn($a, $b) =>
                strtotime($b["watched_at"] ?? "now") <=> strtotime($a["watched_at"] ?? "now")
            );

            $resultsByDate = $this->groupHistoryByDate($history);

            uksort($resultsByDate, function ($a, $b) {
                $timeA = \DateTime::createFromFormat("d/m/Y", $a)?->getTimestamp() ?? 0;
                $timeB = \DateTime::createFromFormat("d/m/Y", $b)?->getTimestamp() ?? 0;
                return $timeB <=> $timeA;
            });

            $this->view("home/history/index", [
                "history" => $resultsByDate,
                "filter" => $filter,
            ]);
        } catch (NestedValidationException | Error $exception) {
            $errors = $exception instanceof NestedValidationException
                ? $exception->getMessages()
                : [$exception->getMessage()];

            $this->view("home/history/index", ["errors" => $errors]);
        }
    }

  private function getHistoryByFilter(string $userId, string $filter): array
{
    switch ($filter) {
        case 'videos':
         
            return $this->mapVideoHistory($this->userHistoryModel->getHistoryByUserId($userId, 'VIDEO'));

        case 'fasts':
            
            return $this->mapVideoHistory($this->userHistoryModel->getHistoryByUserId($userId, 'FAST'));

        case 'events':
            
            return $this->mapVideoHistory($this->userHistoryModel->getHistoryByUserId($userId, 'Event'));

        default:
            return [];
    }
}


    /**
     * Mapeia histórico de vídeos e fasts
     */
    private function mapVideoHistory(array $history): array
    {
        $results = [];

        foreach ($history as $item) {
            $videoId = $item["video_id"] ?? null;
            if (!$videoId) continue;

            $videoData = $this->videoModel->getVideoById($videoId);
            $video = $videoData[0] ?? null;

            if (!$video) continue;

            $author = $this->getAuthor($video["author_id"] ?? null);

            $results[] = [
                "watched_at"     => $item["created_at"] ?? "",
                "created_at"     => $video["created_at"] ?? "",
                "duration"       => $video["duration"] ?? "",
                "title"          => $video["title"] ?? "",
                "thumbnail_url"  => $video["thumbnail_url"] ?? "",
                "description"    => $video["description"] ?? "",
                "type_card"      => strtolower($video["type"] ?? "video"),
                "views"          => $video["views"] ?? 0,
                "likes"          => $video["likes"] ?? 0,
                "url"            => $video["url"] ?? "",
                "avatar_url"     => $author["avatar_url"] ?? "",
                "username"       => $author["username"] ?? ""

            ];
        }

        return $results;
    }





    private function getAuthor(?string $authorId): array
    {
        if (!$authorId) return [];
        $authorData = $this->userModel->getUserById($authorId);
        return $authorData[0] ?? [];
    }

    private function groupHistoryByDate(array $history): array
    {
        $grouped = [];

        foreach ($history as $item) {
            $timestamp = strtotime($item["watched_at"] ?? "now");
            $date = date("d/m/Y", $timestamp);
            $grouped[$date][] = $item;
        }

        return $grouped;
    }
}
