<?php

namespace Src\Infra\Models;

use Src\Application\Core\Model;

require_once __DIR__ . '/../../application/core/model.php';

class CreateCategoriesModel extends Model {
    public function listCategories( string $id,string $name, string $createDate){
        $category = $this->database->query("SELECT * FROM categories", [
            ":id" => $id,
            ":name" => $name,
            ":createDate" => $createDate
        ]);

        return $category[0];
    }
    public function createCategories(string $name): string {
        $sql = "INSERT INTO categories (id, name) VALUES (:id, :name)";
        $id = uniqid(more_entropy: true);
        return $stmt = $this->database->exec($sql, [
            ":id" => $id,
            ":name" => $name,
        ]);
    }
}