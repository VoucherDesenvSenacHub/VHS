<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;


class eventsModel extends Model {

    public function getEventsByTitle(string $query): array {
        $sql = "SELECT * FROM events WHERE title LIKE :query";

        return $this->database->query($sql, ['query' => '%' . $query . '%']);
    }


}

