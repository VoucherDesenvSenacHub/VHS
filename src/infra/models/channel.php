<?php

namespace Src\Infra\Model;

use Src\Application\Core\Model;

require_once __DIR__ . '/../../application/core/model.php';

class ChannelModel extends Model
{
    protected string $table = "channels";

    public function findById(string $id): ?array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $result = $this->database->fetch($sql, [":id" => $id]);
        return $result ?: null;
    }

    public function updateChannel(string $id, string $name, string $description, string $avatar_url, string $banner_url, string $tags): bool
    {
        $sql = "UPDATE {$this->table} 
                SET name = :name, description = :description, avatar_url = :avatar_url, banner_url = :banner_url, tags = :tags 
                WHERE id = :id";
        return $this->database->exec($sql, [
            ":name" => $name,
            ":description" => $description,
            ":avatar_url" => $avatar_url,
            ":banner_url" => $banner_url,
            ":tags" => $tags,
            ":id" => $id
        ]);
    }
}
