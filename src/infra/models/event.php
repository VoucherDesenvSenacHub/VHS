<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;

class EventModel extends Model
{

    public function getAllEvents(): array
    {
        $sql = <<<SQL
            SELECT
                users.name,
                events.url,
                events.title,
                categories.name as category,
                events.event_date,
                events.thumbnail_url
            FROM events
                INNER JOIN users
                ON events.author_id = users.id
                INNER JOIN categories
                ON events.category_id = categories.id;
        SQL;

        return $this->database->query($sql, []);
    }

    public function getEventByTitle(string $query, int $offset = 0, int $limit = 8): array
    {
        $sql = <<<SQL
            SELECT
                users.name,
                events.url,
                events.title,
                categories.name as category,
                events.event_date,
                events.thumbnail_url
            FROM events
                INNER JOIN users
                ON events.author_id = users.id
                INNER JOIN categories
                ON events.category_id = categories.id
            WHERE events.title LIKE :query
            LIMIT $offset, $limit
        SQL;

        return $this->database->query($sql, ['query' => '%' . $query . '%']);
    }
}
