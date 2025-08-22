<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\UserModel;
use Src\Infra\Model\CategoryModel;
use Src\Infra\Model\VideoModel;

require_once __DIR__ . '/../application/core/controller.php';

class HomeController extends Controller {
    private VideoModel $videoModel;
    private UserModel $userModel;
    private CategoryModel $categoryModel;

    public function index() {
        $this->videoModel = $this->model("video");
        $this->userModel = $this->model("user");
        $this->categoryModel = $this->model("category");

        $categories = $this->categoryModel->getAllCategories();
        
        $categories = array_map(
            function ($category) {
                $category["videos"] = array_map(function ($video) {
                    return $video + ["type_card" => "video"];
                }, $this->videoModel->getVideosByCategory($category["id"]));
                return $category;
            },
            $categories
        );
        
        $popularVideos = $this->videoModel->getPopularVideos();
        $featuredVideos = array_slice($popularVideos, 0, 3);
        $popularVideos = array_slice($popularVideos, 3);
        
        $this->view('home/index', [
            "categories" => $categories,
            "popular_videos" => $popularVideos,
            "featured_videos" => $featuredVideos,
        ]);
    }
}