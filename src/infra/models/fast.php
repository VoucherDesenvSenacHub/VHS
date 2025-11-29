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

    public function getFasts(int $limit, int $offset): array {
        $sql = "SELECT fasts.*, username, avatar_url FROM fasts INNER JOIN users ON fasts.author_id = users.id ORDER BY fasts.created_at DESC LIMIT $offset, $limit";

        return $this->database->query($sql, []);
    }

    public function addView(string $fastId) {
        $sql = "UPDATE fasts SET views = views + 1 WHERE id = :id";
        $this->database->exec($sql, [":id" => $fastId]);
    }

    public function getFastById(string $id): array {
        $sql = "SELECT fasts.*, username, avatar_url FROM fasts INNER JOIN users ON fasts.author_id = users.id WHERE fasts.id = :id";
        return $this->database->query($sql, [":id" => $id]);
    }
}