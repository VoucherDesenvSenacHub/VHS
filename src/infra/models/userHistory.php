<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;

class UserHistoryModel extends Model
{
    public function create(string $user_id, string $video_id, string $type = 'VIDEO'): string
    {
        $sql = "INSERT INTO users_history (id, user_id, video_id, type) 
                VALUES (:id, :user_id, :video_id, :type)";

        $id = uniqid('', true);

        $this->database->exec($sql, [
            ":id" => $id,
            ":user_id" => $user_id,
            ":video_id" => $video_id,
            ":type" => strtoupper($type)
        ]);

        return $id;
    }


    public function getHistoryByUserId(string $user_id, string $type = 'VIDEO'): array
{
    $sql = "SELECT uh.*
            FROM users_history uh
            INNER JOIN (
                SELECT video_id,
                       DATE(created_at) AS view_date,
                       MAX(created_at) AS last_view
                FROM users_history
                WHERE user_id = :user_id AND type = :type
                GROUP BY video_id, DATE(created_at)
            ) latest
            ON uh.video_id = latest.video_id
            AND DATE(uh.created_at) = latest.view_date
            AND uh.created_at = latest.last_view
            WHERE uh.user_id = :user_id AND uh.type = :type
            ORDER BY uh.created_at DESC";

    return $this->database->query($sql, [
        ":user_id" => $user_id,
        ":type" => strtoupper($type)
    ]);
}

}
