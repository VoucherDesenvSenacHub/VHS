<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;

class UsersFollowersModel extends Model {
    public function get_count_user_followers($user_id) {
        $sql = "SELECT COUNT(id) FROM users_followers WHERE user_id = :user_id";
        return $this->database->query($sql, [":user_id"=> $user_id]);
    }
}