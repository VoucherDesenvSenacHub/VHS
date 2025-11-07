<?php

namespace Src\Application\Controllers;


require_once __DIR__ . "/../../../application/core/controller.php";

use Src\Application\Core\Controller;
use Src\Infra\Model\UsersFollowersModel;
use Src\Infra\Model\VideoModel;

class StudioAnalyticsViewController extends Controller {
    private UsersFollowersModel $usersFollowersModel;
    private VideoModel $videoModel;
    public function index() {
        $this->usersFollowersModel = $this->model('usersFollowers');
        $this->videoModel = $this->model('video');
        $user_id = $_SESSION['user']['id'];
        $count_followers = $this->usersFollowersModel->get_count_user_followers($user_id);
        $views = $this->videoModel->getAllViewsByUserId($user_id);
        $this->view("studio/index",['count_followers' => $count_followers, 'all_views' => $views[0]['views'], 'average_views' => $views[0]['average']]);   
    }
}