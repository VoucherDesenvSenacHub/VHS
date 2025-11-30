<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\UsersFollowersModel;

class UnfollowUserController extends Controller
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

        $success = $this->usersFollowersModel->unfollow($followerId, $followingId);

        echo json_encode(['success' => $success]);
    }
}
