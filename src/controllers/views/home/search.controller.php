<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;
use Src\Infra\Model\UserModel;

use Src\Infra\Model\UsersFollowersModel;
use Src\Infra\Model\UsersCategoryModel;
use Src\Infra\Model\FastModel;
use Src\Infra\Model\FastLikeModel;

class SearchController extends Controller
{
    private VideoModel $videoModel;
    private FastModel $fastModel;
    private UserModel $userModel;
    private FastLikeModel $fastLikeModel;

    private UsersFollowersModel $usersFollowersModel;
    private UsersCategoryModel $usersCategoryModel;

    public function index()
    {
        $this->videoModel = $this->model("video");
        $this->fastModel = $this->model("fast");
        $this->fastLikeModel = $this->model("fastLike");
        $this->userModel = $this->model("user");

        $this->usersFollowersModel = $this->model("usersFollowers");
        $this->usersCategoryModel = $this->model("usersCategory");

        $query = $_GET['q'] ?? '';
        $filter = $_GET['filter'] ?? 'video';

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
        if ($page < 0) $page = 0;
        $limit = 12;
        $offset = $page * $limit;

        $data = [];

        switch ($filter) {
            case 'video':
                $data = $this->videoModel->getVideoByTitle($query, $offset, $limit + 1);
                break;
            case 'fast':
                $data = $this->fastModel->getFastByTitle($query, $offset, $limit + 1);
                foreach ($data as $key => $value) {
                    $data[$key]["likes"] = $this->fastLikeModel->countLikes($value['id']);
                }
                break;
            case 'channels':
                $data = $this->userModel->getCreatorByUsername($query, $offset, $limit + 1);
                foreach ($data as $key => $value) {
                    $followers = $this->usersFollowersModel->getCountUserFollowers($value['id']);
                    $categories = $this->usersCategoryModel->getCategoriesByUserId($value['id']);

                    $data[$key]['followers'] = $followers[0]['COUNT(id)'] ?? 0;
                    $data[$key]['category'] = $categories[0]['name'] ?? 'Sem categoria';
                }
                break;

            default:
                $data = $this->videoModel->getVideoByTitle($query, $offset, $limit + 1);
                break;
        }

        $existsNextPage = 0;
        if (count($data) > $limit) {
            $existsNextPage = 1;
            array_pop($data);
        }

        $this->view('home/search/index', [
            "data" => $data,
            "filter" => $filter,
            "query" => $query,
            "existsNextPage" => $existsNextPage
        ]);
    }
}
