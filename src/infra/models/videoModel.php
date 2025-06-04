<?php
namespace Src\Infra\Models;

require_once __DIR__ . '/../../infra/db/database.php';
use Database;
use PDO;

class VideoModel {
    private PDO $connection;

    public function __construct() {
        $this->connection = (new Database())->getConnection();
    }

    public function listMostPopularVideo(): array {
        $sql = "SELECT id,url,title ,author_id,views from videos GROUP BY videos.views DESC LIMIT 4";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listMostPopularVideoCategory(string $category_id): array{
        $sql = "SELECT id,url,title ,author_id,views FROM videos where category_id = :category_id ORDER BY videos.views DESC LIMIT 4";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}