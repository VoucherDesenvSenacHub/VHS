<?php

namespace Src\Infra\Models;

use Src\Application\Core\Model;

require_once __DIR__ . '/../../application/core/model.php';

class CategoryModel extends Model {
    public function findByName(string $name){
        $category = $this->database->query("SELECT * FROM categories WHERE name = :name", [
            ":name" => $name
        ]);

        return $category[0];
    }
}