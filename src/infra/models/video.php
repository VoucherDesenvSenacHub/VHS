<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;


class VideoModel extends Model {

    public function incrementViewCount($videoId) {
        $sql = "UPDATE videos SET views = views + 1 WHERE id = :video_id";
        return $this->database->query($sql, ["video_id" => $videoId]);
    }

    public function getVideoByTitle(string $query): array {
        $sql = "SELECT * FROM videos WHERE type ='VIDEO' and (title LIKE :query)";

        return $this->database->query($sql, ['query' => '%' . $query . '%']);
    }


    public function getFastByTitle(string $query): array {

        
        $sql = "SELECT * FROM videos WHERE type ='FAST' and (title LIKE :query)";

        return $this->database->query($sql, ['query' => '%' . $query . '%']);
    }
  
    public function getPopularVideos(int $offset = 0, int $limit = 7): array {
        $sql = "SELECT videos.id, url, title, description, duration, views, thumbnail_url, videos.created_at, videos.update_at, username, avatar_url FROM videos INNER JOIN users ON videos.author_id = users.id ORDER BY views DESC LIMIT $offset, $limit";

    return $this->database->query($sql);
    }

    public function getVideosByCategory(string $categoryId, int $offset = 0, int $limit = 4): array {
        $sql = "SELECT videos.id, url, title, description, duration, views, thumbnail_url, videos.created_at, videos.update_at, username, avatar_url FROM videos INNER JOIN users ON videos.author_id = users.id WHERE videos.category_id = :category_id ORDER BY created_at ASC LIMIT $offset, $limit";

        return $this->database->query($sql, [":category_id" => $categoryId]);
    }

    public function getVideoById(string $id): array {
        $sql = "SELECT videos.*, users.username, users.subscribers,  users.avatar_url, categories.name as category_name FROM videos
        JOIN users ON users.id = videos.author_id
        JOIN categories ON categories.id = videos.category_id
        WHERE videos.id = :id";

        return $this->database->query($sql, [":id" => $id]);
    }
    // public function GetAllVideos($filter){
    //     switch ($filter) {
    //         case 'videos':
    //             $result = $this->getVideoByTitle();
    //             return $result;
    //             break;
    //         case "fast":
    //             $result = $this->getFastByTitle();
    //             return $result;
    //             break;
    //         default:
    //             # code...
    //             break;
    //     }
    // }
}

