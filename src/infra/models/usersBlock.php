<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;

class UsersBlockModel extends Model {

    public function userBlockedUser(string $userId, string $userBlockedId){
        $sql = "INSERT INTO users_block (id, user_id, user_blocked_id) VALUES (:id, :userId, :userBlockedId)";
        $id = uniqid(more_entropy: true);
        
        return $this->database->exec($sql, [":id" => $id, "userId" => $userId, "userBlockedId" => $userBlockedId]);
    }
}