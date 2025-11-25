<?php

namespace Src\Application\Controllers;


require_once __DIR__ . "/../../../application/core/controller.php";

use Src\Application\Core\Controller;
use Src\Infra\Model\CommentModel;
use Src\Infra\Model\UsersFollowersModel;
use Src\Infra\Model\VideoModel;

class StudioAnalyticsViewController extends Controller {
    private UsersFollowersModel $usersFollowersModel;
    private VideoModel $videoModel;
    private CommentModel $commentModel;
    public function index() {
        $this->usersFollowersModel = $this->model('usersFollowers');
        $this->videoModel = $this->model('video');
        $this->commentModel = $this->model('comment');
        $user_id = $_SESSION['user']['id'];
        $count_followers = $this->usersFollowersModel->getCountUserFollowers($user_id);
        $views = $this->videoModel->getAllViewsByUserId($user_id);
        $videos_avaliations_avg = $this->videoModel->getAverageAvailableVideosByUserId($user_id);
        $last_comments = $this->commentModel->getStudioComments(0, 12, $user_id, '', 'DESC');
        $last_comments = array_slice($last_comments, 0, 12);
        $last_videos = $this->videoModel->getLastVideosByUserId($user_id, 0, 7);
        $views_weekly = $this->videoModel->getViewsCountByWeekDay($user_id);
        $this->view("studio/index",['count_followers' => $count_followers, 'all_views' => $views[0]['views'], 'average_views' => $views[0]['average'], 'average_avaliations' => $videos_avaliations_avg[0]['average'], 'last_comments' => $last_comments, 'last_videos' => $last_videos, 'views_weekly' => $views_weekly]);   
    }
}