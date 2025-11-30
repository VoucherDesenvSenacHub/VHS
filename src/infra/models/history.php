<?php

namespace Src\Infra\Model;

require_once __DIR__ . "/../../application/core/model.php";
require_once __DIR__ . '/../../application/core/database.php';

use Src\Application\Core\Model;

class HistoryModel extends Model
{
    public function addToHistory(string $userId, string $videoId)
    {
        // Check if entry exists
        $sqlCheck = "SELECT id, created_at FROM users_history WHERE user_id = :user_id AND video_id = :video_id LIMIT 1";
        $existing = $this->database->query($sqlCheck, [
            ":user_id" => $userId,
            ":video_id" => $videoId
        ]);

        $now = (new \DateTime('now', new \DateTimeZone('UTC')))->format('Y-m-d H:i:s');

        if (!empty($existing)) {
            $lastViewTime = new \DateTime($existing[0]['created_at']);
            $currentTime = new \DateTime($now);
            $interval = $currentTime->diff($lastViewTime);

            // If less than 5 minutes, do nothing (spam protection)
            if ($interval->i < 5 && $interval->h == 0 && $interval->d == 0) {
                return false;
            }

            // Update existing entry timestamp to move it to top
            $sqlUpdate = "UPDATE users_history SET created_at = :created_at WHERE id = :id";
            return $this->database->query($sqlUpdate, [
                ":created_at" => $now,
                ":id" => $existing[0]['id']
            ]);
        }

        // Insert new entry
        $id = uniqid();
        $sqlInsert = "INSERT INTO users_history (id, user_id, video_id, created_at) VALUES (:id, :user_id, :video_id, :created_at)";

        return $this->database->query($sqlInsert, [
            ":id" => $id,
            ":user_id" => $userId,
            ":video_id" => $videoId,
            ":created_at" => $now
        ]);
    }

    public function getHistory(string $userId, int $offset, int $limit, string $type = 'all')
    {
        $videoQuery = "SELECT 
                'video' as type,
                v.id, 
                v.duration,
                v.title, 
                v.thumbnail_url, 
                v.views, 
                v.created_at as video_created_at,
                u.username, 
                u.avatar_url,
                uh.created_at as watched_at,
                v.url
            FROM 
                users_history uh
            INNER JOIN 
                videos v ON uh.video_id = v.id
            INNER JOIN 
                users u ON v.author_id = u.id
            WHERE 
                uh.user_id = :userId AND v.is_deleted = 0";

        $fastQuery = "SELECT 
                'fast' as type,
                f.id, 
                f.duration,
                f.title, 
                f.thumbnail_url, 
                f.views, 
                f.created_at as video_created_at,
                u.username, 
                u.avatar_url,
                uh.created_at as watched_at,
                f.url
            FROM 
                users_history uh
            INNER JOIN 
                fasts f ON uh.video_id = f.id
            INNER JOIN 
                users u ON f.author_id = u.id
            WHERE 
                uh.user_id = :userId AND f.is_deleted = 0";

        if ($type === 'video') {
            $sql = "$videoQuery ORDER BY watched_at DESC LIMIT $offset, $limit";
        } elseif ($type === 'fast') {
            $sql = "$fastQuery ORDER BY watched_at DESC LIMIT $offset, $limit";
        } else {
            $sql = "($videoQuery) UNION ($fastQuery) ORDER BY watched_at DESC LIMIT $offset, $limit";
        }

        return $this->database->query($sql, [":userId" => $userId]);
    }

    public function countHistory(string $userId, string $type = 'all'): int
    {
        if ($type === 'video') {
            $sql = "SELECT COUNT(*) as total FROM users_history uh INNER JOIN videos v ON uh.video_id = v.id WHERE uh.user_id = :userId AND v.is_deleted = 0";
        } elseif ($type === 'fast') {
            $sql = "SELECT COUNT(*) as total FROM users_history uh INNER JOIN fasts f ON uh.video_id = f.id WHERE uh.user_id = :userId AND f.is_deleted = 0";
        } else {
            $sql = "
                SELECT SUM(total) as total_count FROM (
                    (SELECT COUNT(*) as total
                    FROM users_history uh
                    INNER JOIN videos v ON uh.video_id = v.id
                    WHERE uh.user_id = :userId AND v.is_deleted = 0)
                    UNION ALL
                    (SELECT COUNT(*) as total
                    FROM users_history uh
                    INNER JOIN fasts f ON uh.video_id = f.id
                    WHERE uh.user_id = :userId AND f.is_deleted = 0)
                ) as combined_counts
            ";
            $result = $this->database->query($sql, [":userId" => $userId]);
            return (int)($result[0]['total_count'] ?? 0);
        }

        $result = $this->database->query($sql, [":userId" => $userId]);
        return (int)($result[0]['total'] ?? 0);
    }
}
