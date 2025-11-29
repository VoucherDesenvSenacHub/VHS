<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;


class FastModel extends Model {

    public function createFastVideo(string $id, string $title,  string $author_id, string $duration, int $views, string $thumbnail_url, string $url): bool {
        
        $sql = "INSERT INTO fasts (id, title, author_id, duration,  views, thumbnail_url, url) VALUES (:id, :title, :author_id, :duration, :views, :thumbnail_url, :url)";

        return $this->database->exec($sql, [
            ":id" => $id,
            ":title" => $title,
            ":author_id" => $author_id,
            ":duration" => $duration,
            ":views" => $views,
            ":thumbnail_url" => $thumbnail_url,
            ":url" => $url
        ]);
    }

    public function getFastByTitle(string $query): array {
        $sql = "SELECT * FROM videos WHERE type ='FAST' and (title LIKE :query)";

        return $this->database->query($sql, ['query' => '%' . $query . '%']);
    }

    public function getAllFasts(string $author_id, int $offset = 0, int $limit = 8): array
    {
        $sql = "SELECT 
            f.*, 
            COUNT(DISTINCT c.id) AS comments
        FROM 
            fasts f
        LEFT JOIN 
            comments c ON c.video_id = f.id AND c.is_deleted = 0
        WHERE 
            f.is_deleted = 0 AND author_id = :author_id
        GROUP BY 
            f.id
        ORDER BY 
            f.created_at DESC
        LIMIT $offset, $limit
    ";

        return $this->database->query($sql, [":author_id" => $author_id]);
    }

    public function countFasts(string $author_id): int
    {
        $sql = "SELECT COUNT(*) as total FROM fasts WHERE is_deleted = 0 AND author_id = :author_id";
        $stmt = $this->database->query($sql, [":author_id" => $author_id]);
        return (int)$stmt[0]['total'];
    }

    public function delete($id)
    {
        $sql = "UPDATE fasts SET is_deleted = 1 WHERE id = :id";

        return $this->database->query($sql, [":id" => $id]);
    }
}