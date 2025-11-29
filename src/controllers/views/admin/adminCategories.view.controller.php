<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;

require_once __DIR__ . '/../../../application/core/controller.php';

class AdminCategoriesViewController extends Controller
{
    public function index()
    {
        $model = $this->model("category");
        $page = $_GET["page"] ?? 0;
        $page = $page > 0 ? $page * 7 : $page;

        $limit = 7;

        $listCategories = $model->getCategories($page, $limit + 1);
        $listCategories = array_slice($listCategories, 0, $limit + 1);

        $nextPageCategories = 0;

        if (count($listCategories) > $limit) {
            $nextPageCategories = 1;
        } 
        
        $this->view("/admin/categories/index", ["list" => $listCategories, "next_page_categories" => $nextPageCategories]);
    }
}
