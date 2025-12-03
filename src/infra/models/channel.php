<?php

namespace Src\Infra\Model;

use Src\Application\Core\Model;

require_once __DIR__ . '/../../application/core/model.php';

class ChannelModel extends Model
{

    public function updateChannel(string $id, string $name, string $username, string $description_channel, string $avatar_url, string $banner_url, string $background_color): bool
    {
        $sql = "UPDATE users
                SET name = :name, avatar_url = :avatar_url, banner_url = :banner_url, username = :username, description_channel = :description_channel, background_color = :background_color 
                WHERE id = :id";
        return $this->database->exec($sql, [
            ":name" => $name,
            ":avatar_url" => $avatar_url,
            ":banner_url" => $banner_url,
            ":username" => $username,
            ":description_channel" => $description_channel,
            ":background_color" => $background_color,
            ":id" => $id
        ]);
    }
}
