<?php
namespace src\infra\models;

require_once __DIR__ . '/../../infra/db/database.php';
use Database;
use PDO;

class FastModel {
    private PDO $connection;

    public function __construct() {
        $this->connection = (new Database())->getConnection();
    }

    public function create(string $id, string $url, string $title, string $description, string $author_id, string $category_id, int $duration, string $target_audience, int $views, string $type, string $thumbnail_url): bool {
        $sql = "INSERT INTO videos (id, url, title, author_id, category_id, description, duration, target_audience, views, type, thumbnail_url) VALUES (:id, :url, :title, :author_id, :category_id, :description, :duration, :target_audience, :views, :type, :thumbnail_url)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":url", $url);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description); 
        $stmt->bindParam(":author_id", $author_id); 
        $stmt->bindParam(":category_id", $category_id); 
        $stmt->bindParam(":duration", $duration);
        $stmt->bindParam(":target_audience", $target_audience);
        $stmt->bindParam(":views", $views);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":thumbnail_url", $thumbnail_url);

        
        return $stmt->execute();
    }

}
