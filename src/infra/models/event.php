<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/model.php';
use Src\Application\Core\Model;

class EventModel extends Model {

    public function create (
        string $author_id,
        string $category_id,
        string $url,
        string $thumbnail_url,
        string $title,
        string $description,
        string $event_date
    ) {
        
        $sql = <<<SQL
            INSERT INTO events (
                id, author_id, category_id,
                url, thumbnail_url, title, description, event_date
            ) VALUES (
                :id, :author_id, :category_id,
                :url, :thumbnail_url, :title, :description, :event_date
            )
        SQL;

        return $this->database->exec($sql, [
            ":id"            => uniqid(),
            ":author_id"     => $author_id,
            ":category_id"   => $category_id,
            ":url"           => $url,
            ":thumbnail_url" => $thumbnail_url,
            ":title"         => $title,
            ":description"   => $description,
            ":event_date"    => $event_date
        ]);
    }

    public function read() {
        $sql = <<<SQL
            SELECT
                events.id,
                users.name,
                events.url,
                events.thumbnail_url,
                events.title,
                categories.name as category,
                events.event_date
            FROM events
                INNER JOIN users ON events.author_id = users.id
                INNER JOIN categories ON events.category_id = categories.id
            WHERE events.is_deleted = 0;
        SQL;

        return $this->database->query($sql, []);
    }

    # Outras Consultas

    public function getEventsByTitle(string $query): array {
        $sql = <<<SQL
            SELECT * FROM events WHERE title LIKE :query;
        SQL;

        return $this->database->query($sql, ['query' => '%' . $query . '%']);
    }

}