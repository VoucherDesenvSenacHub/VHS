<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;

require_once __DIR__ . '/../application/core/controller.php';

class CategoriesViewController extends Controller
{
    public function index()
    {
        $model = $this->model("category");
        $listaCategories = $model->listCategories();
        $this->view("/admin/categories/index", ["lista" => $listaCategories]);
    }
}
