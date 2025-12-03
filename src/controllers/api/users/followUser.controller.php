<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\UsersFollowersModel;

class FollowUserController extends Controller
{
    private UsersFollowersModel $usersFollowersModel;

    public function index()
    {
        ob_clean();
        $this->usersFollowersModel = $this->model("usersFollowers");

        $input = json_decode(file_get_contents('php://input'), true);
        $followingId = $input['following_id'] ?? null;
        $followerId = $_SESSION['user']['id'] ?? null;

        if (!$followingId || !$followerId) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
            return;
        }

        if ($this->usersFollowersModel->isFollowing($followerId, $followingId)) {
            echo json_encode(['success' => false, 'message' => 'Already following']);
            return;
        }

        $success = $this->usersFollowersModel->follow($followerId, $followingId);

        echo json_encode(['success' => $success]);
    }
}
