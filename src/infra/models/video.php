<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Respect\Validation\Rules\StringType;
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

    public function createFastVideo(string $id, string $url, string $title,  string $author_id, string $category_id, string $duration, string $type, string $thumbnail_url, int $views, string $target_audience) {
        
        $sql = "INSERT INTO videos (id, url, title, author_id, category_id, duration, type, thumbnail_url, views, target_audience) VALUES (:id, :url, :title, :author_id, :category_id, :duration, :type, :thumbnail_url, :views, :target_audience)";

        return $this->database->exec($sql, [
            ":id" => $id,
            ":url" => $url,
            ":title" => $title,
            ":author_id" => $author_id,
            ":category_id" => $category_id,
            ":duration" => $duration,
            ":type" => $type,
            ":thumbnail_url" => $thumbnail_url,
            ":views" => $views,
            ":target_audience" => $target_audience
        ]);
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

