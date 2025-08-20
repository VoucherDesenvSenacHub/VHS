<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;

class CreateCategoriesModel extends Model
{
    public function listCategories()
    {
        $category = $this->database->query("SELECT * FROM categories");

        return $category;
    }
    public function createCategories(string $name): bool
    {
        $sql = "INSERT INTO categories (id, name) VALUES (:id, :name)";
        $id = uniqid(more_entropy: true);
        return  $this->database->exec($sql, [":id" => $id, ":name" => $name]);
    }
}
