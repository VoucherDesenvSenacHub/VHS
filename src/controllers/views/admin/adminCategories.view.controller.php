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

        $listCategories = $model->getAllCategories($page, 7);
        $users = array_slice($listCategories, 0, 7);
        $this->view("/admin/categories/index", ["list" => $listCategories]);
    }
}
