<?php

namespace Src\Infra\Models;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;

class CommentModel extends Model {

    public function create(string $content, string $user_id, string $video_id): bool {
        $sql = "INSERT INTO comments (id, content, user_id, video_id) 
                VALUES (:id, :content, :user_id, :video_id)";

        $id = uniqid(); // mesmo estilo do UserModel

        $stmt = $this->database->query($sql, [
            ":id" => $id,
            ":content" => $content,
            ":user_id" => $user_id,
            ":video_id" => $video_id
        ]);

        return $stmt;
    }

    public function getByVideoId(string $video_id): array {
        $sql = "SELECT 
                    c.id, c.content, c.created_at,
                    u.name, u.username, u.avatar_url 
                FROM comments c
                JOIN users u ON c.user_id = u.id
                WHERE c.video_id = :video_id
                ORDER BY c.created_at DESC";

        $stmt = $this->database->query($sql, [
            ":video_id" => $video_id
        ]);

        return $stmt->fetchAll();
    }
}
