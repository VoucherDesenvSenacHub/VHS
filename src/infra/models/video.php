<?php

namespace Src\Infra\Model;

require_once __DIR__ . "/../../application/core/model.php";
require_once __DIR__ . '/../../application/core/database.php';

use Src\Application\Core\Model;

class VideoModel extends Model{

    public function create(string $url, string $title, string $description = '', string $category_id, string $thumbnail_url) {
        
        $sql = "INSERT INTO videos(id, url, title, description, author_id, category_id, type ,thumbnail_url) VALUES(:id, :url, :title, :description, :author_id, :category_id, :type ,:thumbnail_url)";
        
        $id = uniqid();

        $stmt = $this->database->query($sql, [
            ":id" => $id,
            ":url" => $url,
            ":title" => $title,
            ":description" => $description,
            ":author_id" => "usr_001",
            ":category_id" => $category_id,
            ":type" => "VIDEO",
            ":thumbnail_url" => $thumbnail_url
        ]);
        
        return $stmt;
    }

    public function getVideoByTitle(string $query): array {
        $sql = "SELECT * FROM videos WHERE type ='VIDEO' and (title LIKE :query)";

        return $this->database->query($sql, ['query' => '%' . $query . '%']);
    }


    public function getFastByTitle(string $query): array {

        
        $sql = "SELECT * FROM videos WHERE type ='FAST' and (title LIKE :query)";

        return $this->database->query($sql, ['query' => '%' . $query . '%']);
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