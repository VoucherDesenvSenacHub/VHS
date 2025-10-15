<?php

namespace Src\Infra\Model;

use Src\Application\Core\Model;

class AvaliationModel extends Model {
    public function getAvaliation(string $videoId, string $userId) {
        $sql = <<<SQL
            SELECT * FROM videos_avaliations WHERE user_id = :user_id AND video_id = :video_id
        SQL;

        return $this->database->query($sql, [
            ":user_id" => $userId,
            ":video_id" => $videoId,
        ]);
    }

    public function addAvaliation(int $stars, string $videoId, string $userId) {
        $sql = <<<SQL
            INSERT INTO videos_avaliations(id, stars, user_id, video_id) VALUE (:id, :stars, :user_id, :video_id)
        SQL;

        return $this->database->query($sql, [
            ":id" => uniqid(more_entropy: true),
            ":stars"=> $stars,
            ":video_id"=> $videoId,
            ":user_id"=> $userId,
        ]);
    }

    public function updateAvaliation(int $stars, string $videoId, string $userId) {
        $sql = <<<SQL
            UPDATE videos_avaliations SET stars = :stars WHERE video_id = :video_id AND user_id = :user_id
        SQL;

        return $this->database->query($sql, [
            ":video_id" => $videoId,
            ":user_id" => $userId,
            ":stars"=> $stars,
        ]);
    }
}