<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;


class VideoModel extends Model {

    public function getVideoByTitle(string $query): array {
        $sql = "SELECT * FROM videos WHERE type ='VIDEO' and (title LIKE :query)";

        return $this->database->query($sql, ['query' => '%' . $query . '%']);
    }


    public function getFastByTitle(string $query): array {

        
        $sql = "SELECT * FROM videos WHERE type ='FAST' and (title LIKE :query)";

        return $this->database->query($sql, ['query' => '%' . $query . '%']);
    }
  
    public function getPopularVideos(int $offset = 0, int $limit = 7): array {
        $sql = "SELECT videos.id, url, title, description, duration, target_audience, views, type, thumbnail_url, videos.created_at, videos.update_at, username, avatar_url FROM videos INNER JOIN users ON videos.author_id = users.id WHERE type = 'VIDEO' ORDER BY views DESC LIMIT $offset, $limit";

        return $this->database->query($sql);
    }

    public function getVideosByCategory(string $categoryId, int $offset = 0, int $limit = 4): array {
        $sql = "SELECT videos.id, url, title, description, duration, target_audience, views, type, thumbnail_url, videos.created_at, videos.update_at, username, avatar_url FROM videos INNER JOIN users ON videos.author_id = users.id WHERE type = 'VIDEO' AND category_id = :category_id ORDER BY created_at ASC LIMIT $offset, $limit";

        return $this->database->query($sql, [":category_id" => $categoryId]);
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

