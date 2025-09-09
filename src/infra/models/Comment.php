<?php

namespace Src\Infra\Models;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;

class CommentModel extends Model {

    public function create(string $content, string $user_id, string $video_id): bool {
        $sql = "INSERT INTO comments (id, content, user_id, video_id) 
                VALUES (:id, :content, :user_id, :video_id)";

        $id = uniqid();

        $stmt = $this->database->exec($sql, [
            ":id" => $id,
            ":content" => $content,
            ":user_id" => $user_id,
            ":video_id" => $video_id
        ]);

        return $stmt;
    }
    public function getCommentsByVideoId(int $video_id) {
        $sql = "SELECT c.content, c.update_at, c.created_at, u.name, u.avatar_url, c.user_id, c.id
                FROM comments c
                JOIN users u ON c.user_id = u.id
                WHERE c.video_id = :video_id
                ORDER BY c.created_at DESC";

        $stmt =  $this->database->query($sql, ['video_id' => $video_id]);

        return $stmt;
    }

    public function delete(string $id): bool {
        $sql = "DELETE FROM comments 
                WHERE id = :id" 
                ;

        $stmt = $this->database->exec($sql,[":id" => $id]);

        return $stmt;
    }

    public function edit(string $id, string $content): bool {
        $sql = "UPDATE comments SET content = :content, update_at = NOW()
            WHERE id = :id";
    
    $stmt = $this->database->exec($sql, [":id" => $id,
        ":content" => $content
    ]);
    
        return $stmt; 
    }
    
    
}
