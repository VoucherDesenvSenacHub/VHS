<?php

namespace Src\Infra\Model;

require_once __DIR__ . '/../../application/core/database.php';
require_once __DIR__ . '/../../application/core/model.php';

use Src\Application\Core\Model;

class UsersFollowersModel extends Model
{
    public function getCountUserFollowers($userId)
    {
        $sql = "SELECT COUNT(id) FROM users_followers WHERE user_id = :user_id";
        return $this->database->query($sql, [":user_id" => $userId]);
    }

    public function isFollowing(string $followerId, string $followingId): bool
    {
        $sql = "SELECT id FROM users_followers WHERE user_follower_id = :follower_id AND user_id = :following_id";
        $result = $this->database->query($sql, [
            ":follower_id" => $followerId,
            ":following_id" => $followingId
        ]);
        return !empty($result);
    }

    public function follow(string $followerId, string $followingId): bool
    {
        $id = uniqid();
        $sql = "INSERT INTO users_followers (id, user_follower_id, user_id) VALUES (:id, :follower_id, :following_id)";
        return $this->database->exec($sql, [
            ":id" => $id,
            ":follower_id" => $followerId,
            ":following_id" => $followingId
        ]);
    }

    public function unfollow(string $followerId, string $followingId): bool
    {
        $sql = "DELETE FROM users_followers WHERE user_follower_id = :follower_id AND user_id = :following_id";
        return $this->database->exec($sql, [
            ":follower_id" => $followerId,
            ":following_id" => $followingId
        ]);
    }
}
