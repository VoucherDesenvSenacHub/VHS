<?php

namespace Src\Infra\Model;

require_once __DIR__ . "/../../application/core/model.php";
require_once __DIR__ . '/../../application/core/database.php';

use Src\Application\Core\Model;

class VideoModel extends Model
{

    public function create(string $url, string $title, string $description = '', string $category_id, string $author_id, string $thumbnail_url)
    {

        $sql = "INSERT INTO videos(id, url, title, description, author_id, category_id, type ,thumbnail_url) VALUES(:id, :url, :title, :description, :author_id, :category_id, :type ,:thumbnail_url)";

        $id = uniqid();

        $stmt = $this->database->query($sql, [
            ":id" => $id,
            ":url" => $url,
            ":title" => $title,
            ":description" => $description,
            ":author_id" => $author_id,
            ":category_id" => $category_id,
            ":type" => "VIDEO",
            ":thumbnail_url" => $thumbnail_url
        ]);

        return $stmt;
    }

    public function update(string $id,string $title, string $description, string $category_id, string $thumbnail_url){
        
        $sql = "UPDATE videos SET title = :tile, description = :description, category_id = :category_id, thumbnail_url = :thumbnail_url WHERE id = :id";

        $stmt = $this->database->query($sql, [
            ":id" => $id,
            ":title" => $title,
            ":description" => $description,
            ":category_id" => $category_id,
            ":thumbnail_url" => $thumbnail_url
        ]);

        return $stmt;
    }

    public function getVideoByTitle(string $query): array
    {
        $sql = "SELECT * FROM videos WHERE type ='VIDEO' and (title LIKE :query)";

        return $this->database->query($sql, ['query' => '%' . $query . '%']);
    }


    public function getFastByTitle(string $query): array
    {
        $sql = "SELECT * FROM videos WHERE type ='FAST' and (title LIKE :query)";

        return $this->database->query($sql, ['query' => '%' . $query . '%']);
    }

    public function getPopularVideos(int $offset = 0, int $limit = 7): array
    {
        $sql = "SELECT videos.id, url, title, description, duration, target_audience, views, type, thumbnail_url, videos.created_at, videos.update_at, username, avatar_url FROM videos INNER JOIN users ON videos.author_id = users.id WHERE type = 'VIDEO' ORDER BY views DESC LIMIT $offset, $limit";

        return $this->database->query($sql);
    }

    public function getVideosByCategory(string $categoryId, int $offset = 0, int $limit = 4): array
    {
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

    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories";

        return $this->database->query($sql);
    }

    public function getAllVideos(){
        $sql = "SELECT * FROM videos WHERE type = 'VIDEO'";

        return $this->database->query($sql);
    }

    public function getVideoByID($id){
        $sql = "SELECT * FROM videos WHERE id = :id";

        return $this->database->query($sql, [":id" => $id]);
    }
}
