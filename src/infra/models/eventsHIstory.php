<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;

class EventsHistoryModel extends Model {
    public function create(string $user_id, string $events_id): string {
        $sql = "INSERT INTO events_history (id, user_id, events_id) VALUES (:id, :user_id, :events_id)";

        $id = uniqid(more_entropy: true);

        $stmt = $this->database->exec($sql, [
            ":id" => $id,
            ":user_id" => $user_id,   
            ":events_id" => $events_id,

        ]);

        return $id;
    }

    public function getEventsHistoryByUserId(string $user_id): array {
        $sql = "SELECT uh.*
                FROM events_history uh
                INNER JOIN (
                    SELECT events_id, MAX(created_at) AS last_view
                    FROM events_history
                    WHERE user_id = :user_id
                    GROUP BY events_id
                ) latest 
                ON uh.events_id = latest.events_id 
                AND uh.created_at = latest.last_view
                WHERE uh.user_id = :user_id
                ORDER BY uh.created_at DESC";
        
        return $this->database->query($sql, [":user_id" => $user_id]);
    }
    
    
   
}