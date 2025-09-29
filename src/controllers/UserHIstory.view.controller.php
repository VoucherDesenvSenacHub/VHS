<?php

namespace Src\Application\Controllers;

use Error;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Model\UserHistoryModel;
use Src\Infra\Model\UserModel;
use Src\Infra\Model\VideoModel;
use Src\Infra\Model\EventsHistoryModel;
use Src\Infra\Model\eventsModel;

require_once __DIR__ . '/../application/core/controller.php';

class UserHistoryController extends Controller
{
    private UserHistoryModel $userHistoryModel;
    private VideoModel $videoModel;
    private UserModel $userModel;
    private EventsHistoryModel $EventsHistoryModel;
    private eventsModel $eventsModel;

    public function __construct()
    {
        $this->userHistoryModel = $this->model("userHistory");
        $this->videoModel = $this->model("video");
        $this->userModel  = $this->model("user");
        $this->EventsHistoryModel  = $this->model("eventsHistory");
        $this->eventsModel  = $this->model("events");
    }

    public function index()
    {
        try {
            $userId = $_SESSION['user']['id'] ?? null;

            if (!$userId) {
                throw new Error("Usuário não logado.");
            }

            $filter = $_GET["filter"] ?? "videos";
            $results = [];

            switch ($filter) {
                case 'videos':
                    $history = $this->userHistoryModel->getHistoryByUserId($userId);
                
                    $results = array_map(function($item) {
                        $videoData = $this->videoModel->getVideoById($item["video_id"]);
                        $video = $videoData[0] ?? [];
                    
                        if (($video["type"] ?? "") !== "VIDEO") {
                            return null;
                        }
                    
                        $authorData = $this->userModel->getUserById($video["author_id"] ?? '');
                        $author = $authorData[0] ?? [];
                
                        return array_merge($item, [ 
                            "duration"    => $video["duration"] ?? "",
                            "title"       => $video["title"] ?? "",
                            "thumbnail"   => $video["thumbnail_url"] ?? "",
                            "description" => $video["description"] ?? "",
                            "type_card"   => strtolower($video["type"] ?? "video"),
                            "views"       => $video["views"] ?? 0,
                            "url"         => $video["url"] ?? "",
                            "avatar_url"  => $author["avatar_url"] ?? "",
                            "username"    => $author["username"] ?? "",
                            "video_created_at" => $video["created_at"] ?? ""
                        ]);
                    }, $history);
                    
                    $results = array_filter($results);
                    break;
                
                case 'fasts':
                    $history = $this->userHistoryModel->getHistoryByUserId($userId);

                    $results = array_map(function($item) {
                        $videoData = $this->videoModel->getFastById($item["video_id"]);
                        $video = $videoData[0] ?? []; 
                    
                        if (($video["type"] ?? "") !== "FAST") {
                            return null;
                        }
                    
                        $authorData = $this->userModel->getUserById($video["author_id"] ?? '');
                        $author = $authorData[0] ?? [];
                    
                        return [
                            "duration"    => $video["duration"] ?? "",
                            "title"       => $video["title"] ?? "",
                            "thumbnail"   => $video["thumbnail_url"] ?? "",
                            "description" => $video["description"] ?? "",
                            "type_card"   => strtolower($video["type"] ?? "video"),
                            "views"       => $video["views"] ?? 0,
                            "url"         => $video["url"] ?? "",
                            "avatar_url"  => $author["avatar_url"] ?? "",
                            "username"    => $author["username"] ?? "",
                            "video_created_at" => $video["created_at"] ?? "",
                            "likes" => $video["likes"] ?? 00
                        ];
                    }, $history);
                    
                    $results = array_filter($results);
                    break;

                case 'events':
                    $history = $this->EventsHistoryModel->getEventsHistoryByUserId($userId);
                    
                    $results = array_map(function($item) {
                        $eventData = $this->eventsModel->getEventsById($item["events_id"]);
                        $event = $eventData[0] ?? [];
                    
                        $authorData = $this->userModel->getUserById($event["user_id"] ?? '');
                        $author = $authorData[0] ?? [];
                    
                        return [
                            "title"        => $event["title"] ?? "",
                            "thumbnail"    => $event["thumbnail_url"] ?? "",
                            "description"  => $event["description"] ?? "",
                            "type_card"    => "events", 
                            "views"        => $event["views"] ?? 0,
                            "created_at"   => $event["created_at"] ?? "",
                            "event_date"   => $event["planned_events"] ?? "",
                            "url"          => $event["url"] ?? "",
                            "avatar_url"   => $author["avatar_url"] ?? "",
                            "username"     => $author["username"] ?? ""
                        ];
                    }, $history);
                    
                    $results = array_filter($results);
                    break;

                default:
                    $results = [];
                    break;
            }

 
            $resultsforday = $this->groupHistoryByDate($results);

    
            uksort($resultsforday, function ($a, $b) {
                $timeA = \DateTime::createFromFormat("d/m/Y", $a)->getTimestamp();
                $timeB = \DateTime::createFromFormat("d/m/Y", $b)->getTimestamp();
                return $timeB <=> $timeA; 
            });
            

            $this->view("home/history/index", [
                "history" => $resultsforday,
                "filter"  => $filter
            ]);

        } catch (NestedValidationException | Error $exception) {
            $errors = $exception instanceof NestedValidationException
                ? $exception->getMessages()
                : [$exception->getMessage()];

            $this->view("home/history/index", ["errors" => $errors]);
        }
    }


    private function groupHistoryByDate(array $history): array
    {
        $grouped = [];
    
        foreach ($history as $item) {
            $date = date("d/m/Y", strtotime($item["created_at"] ?? "now")); 
            $grouped[$date][] = $item;
        }
    
        return $grouped;
    }
    
}
