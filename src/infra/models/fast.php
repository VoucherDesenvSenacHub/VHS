<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;


class FastModel extends Model {

    public function createFastVideo(string $id, string $title,  string $author_id, string $category_id, string $duration, int $views) {
        
        $sql = "INSERT INTO videos (id, title, author_id, category_id, duration,  views) VALUES (:id, :title, :author_id, :category_id, :duration, :views)";

        return $this->database->exec($sql, [
            ":id" => $id,
            ":title" => $title,
            ":author_id" => $author_id,
            ":category_id" => $category_id,
            ":duration" => $duration,
            ":views" => $views,
        ]);
    }

    public function getFastByTitle(string $query): array {
        $sql = "SELECT * FROM videos WHERE type ='FAST' and (title LIKE :query)";

        return $this->database->query($sql, ['query' => '%' . $query . '%']);
    }
}