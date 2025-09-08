<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;

class UsersCategoryModel extends Model {
    public function getCategoriesByUserId(string $userId) {
        $sql = "SELECT *, users_category.id as users_category_id FROM users_category INNER JOIN categories ON users_category.category_id = categories.id WHERE user_id = :user_id";
        return $this->database->query($sql, [":user_id" => $userId]);
    }
}