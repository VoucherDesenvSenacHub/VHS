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

require_once __DIR__ . '/../application/core/controller.php';

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
            if (!$userId)
                throw new Error("Usuário não logado.");

            $filter = $_GET["filter"] ?? "videos";
            $page = isset($_GET["page"]) ? max(1, intval($_GET["page"])) : 1;
            $limit = 8; 
            $offset = ($page - 1) * $limit;

            $history = $this->getHistoryByFilter($userId, $filter);

            usort($history, function ($a, $b) {
                return strtotime($b["created_at"] ?? "now") <=> strtotime($a["created_at"] ?? "now");
            });

            $totalItems = count($history);
            $totalPages = ceil($totalItems / $limit);

      
            $paginatedHistory = array_slice($history, $offset, $limit);

            $resultsByDate = $this->groupHistoryByDate($paginatedHistory);

            uksort($resultsByDate, function ($a, $b) {
                $timeA = \DateTime::createFromFormat("d/m/Y", $a)->getTimestamp();
                $timeB = \DateTime::createFromFormat("d/m/Y", $b)->getTimestamp();
                return $timeB <=> $timeA;
            });

            $this->view("home/history/index", [
                "history" => $resultsByDate,
                "filter" => $filter,
                "page" => $page,
                "total_pages" => $totalPages,
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
                return $this->mapVideoHistory($this->userHistoryModel->getHistoryByUserId($userId), "VIDEO");
            case 'fasts':
                return $this->mapVideoHistory($this->userHistoryModel->getHistoryByUserId($userId), "FAST");
            case 'events':
                return $this->mapEventsHistory($this->eventsHistoryModel->getEventsHistoryByUserId($userId));
            default:
                return [];
        }
    }

    private function mapVideoHistory(array $history, string $type): array
    {
        $results = [];
        foreach ($history as $item) {
            $videoData = $this->videoModel->getVideoById($item["video_id"]);
            $video = $videoData[0] ?? null;
            if (!$video || ($video["type"] ?? "") !== $type)
                continue;

            $author = $this->getAuthor($video["author_id"] ?? null);
            $results[] = array_merge($item, [
                "created_at" => $video["created_at"] ?? "",
                "duration" => $video["duration"] ?? "",
                "title" => $video["title"] ?? "",
                "thumbnail" => $video["thumbnail_url"] ?? "",
                "description" => $video["description"] ?? "",
                "type_card" => strtolower($video["type"] ?? "video"),
                "views" => $video["views"] ?? 0,
                "url" => $video["url"] ?? "",
                "avatar_url" => $author["avatar_url"] ?? "",
                "username" => $author["username"] ?? "",
                "video_created_at" => $video["created_at"] ?? "",
            ]);
        }
        return $results;
    }

    private function mapEventsHistory(array $history): array
    {
        $results = [];
        foreach ($history as $item) {
            $eventData = $this->eventsModel->getEventsById($item["events_id"]);
            $event = $eventData[0] ?? null;
            if (!$event)
                continue;

            $author = $this->getAuthor($event["user_id"] ?? null);
            $results[] = [
                "created_at" => $event["created_at"] ?? "",
                "title" => $event["title"] ?? "",
                "thumbnail" => $event["thumbnail_url"] ?? "",
                "description" => $event["description"] ?? "",
                "type_card" => "events",
                "views" => $event["views"] ?? 0,
                "event_date" => $event["planned_events"] ?? "",
                "url" => $event["url"] ?? "",
                "avatar_url" => $author["avatar_url"] ?? "",
                "username" => $author["username"] ?? ""
            ];
        }
        return $results;
    }

    private function getAuthor(?string $authorId): array
    {
        if (!$authorId)
            return [];

        $authorData = $this->userModel->getUserById($authorId);
        return $authorData[0] ?? [];
    }

    private function groupHistoryByDate(array $history): array
    {
        $grouped = [];
        foreach ($history as $item) {
            $date = date("d/m/Y", strtotime($item["history_created_at"] ?? $item["created_at"] ?? "now"));
            $grouped[$date][] = $item;
        }
        return $grouped;
    }
}
