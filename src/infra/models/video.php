<?php

namespace Src\Infra\Models;

require __DIR__ . "../application/core/model.php";

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

}