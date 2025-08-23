<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\CategoryModel;
use Src\Infra\Model\VideoModel;

require_once __DIR__ . '/../application/core/controller.php';

class CategoriesViewController extends Controller {
    private CategoryModel $categoryModel;
    private VideoModel $videoModel;

    public function index() {
        if(!isset($_GET["category"]) ) {
            return $this->view("/home/categories/index", [
                "error" => "Category not found"
            ]);
        }


        $this->categoryModel = $this->model("category");
        $this->videoModel = $this->model("video");

        $categoryName = $_GET["category"];

        $category = $this->categoryModel->findByName($categoryName);

        // print_r($category);

        if(!$category) {
            return $this->view("/home/categories/index", [
                "error" => "Category not found"
            ]);
        }

        $categoryId = $category["id"];
        $page = $_GET["page"] ?? 1;
        $offset = ($page - 1) * 4;
        $limit = 20;

        $videos = $this->videoModel->getVideosByCategory($categoryId, $offset, $limit);

        $videos = array_map(function ($video) {
            return $video + ["type_card" => "video"];
        }, $videos);

        $this->view("/home/categories/index", [
            "category" => $category["name"] ?? "",
            "videos" => $videos
        ]);
    }
}