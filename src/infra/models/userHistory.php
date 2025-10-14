<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;

class UserHistoryModel extends Model {
    public function create(string $user_id, string $video_id): string {
        $sql = "INSERT INTO users_history (id, user_id, video_id) VALUES (:id, :user_id, :video_id)";

        $id = uniqid(more_entropy: true);

        $stmt = $this->database->exec($sql, [
            ":id" => $id,
            ":user_id" => $user_id,   
            ":video_id" => $video_id,

        ]);

        return $id;
    }

    public function getHistoryByUserId(string $user_id): array {
        $sql = "SELECT uh.*
                FROM users_history uh
                INNER JOIN (
                    SELECT video_id, MAX(history_created_at) AS last_view
                    FROM users_history
                    WHERE user_id = :user_id
                    GROUP BY video_id
                ) latest 
                ON uh.video_id = latest.video_id 
                AND uh.history_created_at = latest.last_view
                WHERE uh.user_id = :user_id
                ORDER BY uh.history_created_at DESC";
    
        return $this->database->query($sql, [":user_id" => $user_id]);
    }
    
   
}