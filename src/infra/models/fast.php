<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;


class FastModel extends Model
{

    public function createFastVideo(string $id, string $title,  string $author_id, string $duration, int $views, string $thumbnail_url, string $url): bool
    {

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

    public function getFastByTitle(string $query, int $offset = 0, int $limit = 8): array
    {
        $sql = "SELECT * FROM fasts WHERE (title LIKE :query) AND is_deleted = 0 LIMIT $offset, $limit";

        return $this->database->query($sql, ['query' => '%' . $query . '%']);
    }

    public function getFasts(int $offset = 0, int $limit = 8): array
    {
        $sql = "SELECT fasts.*, users.username, users.avatar_url FROM fasts INNER JOIN users ON fasts.author_id = users.id WHERE fasts.is_deleted = 0 ORDER BY fasts.created_at DESC LIMIT $offset, $limit";
        return $this->database->query($sql);
    }

    public function getFastById(string $id): array
    {
        $sql = "SELECT fasts.*, users.username, users.avatar_url FROM fasts INNER JOIN users ON fasts.author_id = users.id WHERE fasts.id = :id AND fasts.is_deleted = 0";

        $result = $this->database->query($sql, [":id" => $id]);

        return $result[0] ?? [];
    }

    public function getAllFasts(string $author_id, int $offset = 0, int $limit = 8, ?string $search = null, string $sort = 'desc'): array
    {
        $orderBy = $sort === 'asc' ? 'ASC' : 'DESC';
        $searchCondition = $search ? "AND f.title LIKE :search" : "";

        $sql = "SELECT 
            f.*, 
            COUNT(DISTINCT c.id) AS comments
        FROM 
            fasts f
        LEFT JOIN 
            comments c ON c.video_id = f.id AND c.is_deleted = 0
        WHERE 
            f.is_deleted = 0 AND author_id = :author_id $searchCondition
        GROUP BY 
            f.id
        ORDER BY 
            f.created_at $orderBy
        LIMIT $offset, $limit
    ";

        $params = [":author_id" => $author_id];

        if ($search) {
            $params[':search'] = '%' . $search . '%';
        }

        return $this->database->query($sql, $params);
    }

    public function countFasts(string $author_id): int
    {
        $sql = "SELECT COUNT(*) as total FROM fasts WHERE is_deleted = 0 AND author_id = :author_id";
        $stmt = $this->database->query($sql, [":author_id" => $author_id]);
        return (int)$stmt[0]['total'];
    }

    public function deleteFast(string $id): bool
    {
        $sql = "UPDATE fasts SET is_deleted = 1 WHERE id = :id";

        return $this->database->exec($sql, [":id" => $id]);
    }

    public function updateFast(string $id, string $title): bool
    {
        $sql = "UPDATE fasts SET title = :title WHERE id = :id";

        return $this->database->exec($sql, [
            ":id" => $id,
            ":title" => $title
        ]);
    }
}
