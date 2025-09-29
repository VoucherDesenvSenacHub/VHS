<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;


class eventsModel extends Model {


    public function getEventsById(string $id): array {
        $sql = "SELECT * FROM events WHERE id = :id LIMIT 1";
        return $this->database->query($sql, [':id' => $id]);
    }




}

