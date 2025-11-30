<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\CategoryModel;

require_once __DIR__ . '/../../../application/core/controller.php';

class AdminCategoriesViewController extends Controller
{

    public CategoryModel $categoryModel;

    public function index()
    {
        $this->categoryModel = $this->model("category");

        $page = $_GET["page"] ?? 0;
        $page = $page > 0 ? $page * 7 : $page;

        $limit = 7;

        $search = $_GET["search"] ?? "";
        $sort = $_GET["sort"] ?? 'desc';

        $listCategories = $this->categoryModel->getCategories($page, $limit + 1, $search, $sort);
        $listCategories = array_slice($listCategories, 0, $limit + 1);

        $nextPageCategories = 0;

        if (count($listCategories) > $limit) {
            $nextPageCategories = 1;
        }

        $this->view("/admin/categories/index", [
            "list" => $listCategories, 
            "next_page_categories" => $nextPageCategories,
            "search" => $search,
            "sort" => $sort
        ]);
    }
}
