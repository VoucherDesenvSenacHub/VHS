<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\FastLikeModel;
use Src\Infra\Model\UserModel;
use Src\Infra\Model\VideoModel;
use Src\Infra\Model\FastModel;
use Src\Infra\Model\UsersFollowersModel;
use Src\Infra\Model\UsersCategoryModel;

use function Src\Application\Utils\Redirect\redirect;

class ChannelController extends Controller
{
    private UserModel $userModel;
    private VideoModel $videoModel;
    private FastModel $fastModel;
    private FastLikeModel $fastLikeModel;
    private UsersFollowersModel $usersFollowersModel;
    private UsersCategoryModel $usersCategoryModel;

    public function index()
    {


        $username = $_GET['username'] ?? "";

        $this->userModel = $this->model("user");
        $this->videoModel = $this->model("video");
        $this->fastModel = $this->model("fast");
        $this->fastLikeModel = $this->model("fastLike");
        $this->usersFollowersModel = $this->model("usersFollowers");
        $this->usersCategoryModel = $this->model("usersCategory");

        $user = $this->userModel->getUserByUsername($username);

        if (empty($user)) {
            redirect("/VHS/404");
            return;
        }

        $user = $user[0];

        $userId = $user['id'];
        $followers = $this->usersFollowersModel->getCountUserFollowers($userId);
        $categories = $this->usersCategoryModel->getCategoriesByUserId($userId);
        $user['followers'] = $followers[0]['COUNT(id)'] ?? 0;
        $user['category'] = $categories[0]['name'] ?? 'Sem categoria';

        $isFollowing = false;
        if (isset($_SESSION['user'])) {
            $isFollowing = $this->usersFollowersModel->isFollowing($_SESSION['user']['id'], $userId);
        }

        $tab = $_GET['tab'] ?? 'videos';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
        if ($page < 0) $page = 0;
        $limit = 12;
        $offset = $page * $limit;

        $content = [];
        $existsNextPage = 0;

        if ($tab === 'fasts') {
            $content = $this->fastModel->getAllFasts($userId, $offset, $limit + 1);
            $content = array_map(function ($fast) {
                $fast["likes"] = $this->fastLikeModel->countLikes($fast['id']);
                return $fast;
            }, $content);
        } elseif ($tab === 'about') {
            $content = [];
        } else {
            $content = $this->videoModel->getAllVideosByUserId($userId, $offset, $limit + 1);
        }

        if (count($content) > $limit) {
            $existsNextPage = 1;
            array_pop($content);
        }

        $this->view('home/channel/index', [
            "user" => $user,
            "content" => $content,
            "tab" => $tab,
            "existsNextPage" => $existsNextPage,
            "page" => $page,
            "isFollowing" => $isFollowing
        ]);
    }
}
