<?php

namespace Src\Infra\Model;

use Src\Application\Core\Model;

require_once __DIR__ . '/../../application/core/model.php';

class ChannelModel extends Model
{

    public function updateChannel(string $id, string $username, string $description_channel, string $avatar_url, string $banner_url, string $tag): bool
    {
        $sql = "UPDATE users
                SET avatar_url = :avatar_url, banner_url = :banner_url, username = :username, description_channel = :description_channel, tag = :tag 
                WHERE id = :id";
        return $this->database->exec($sql, [
            ":avatar_url" => $avatar_url,
            ":banner_url" => $banner_url,
            ":username" => $username,
            ":description_channel" => $description_channel,
            ":tag" => $tag,
            ":id" => $id
        ]);
    }
    public function getCreatorsChannel(string $idVideo): array
    {
        $sql = "SELECT 
                u.avatar_url,
                u.username,
                u.name,
                u.followers,
                u.banner_url,
                u.description_channel
            FROM videos v
            INNER JOIN users u ON u.id = v.author_id
            WHERE v.id = :idVideo
    ";

        return $this->database->query($sql, [":idVideo" => $idVideo]);
    }
}
