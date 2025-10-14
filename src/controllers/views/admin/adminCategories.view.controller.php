<?php

namespace Src\Application\Controllers;

require_once __DIR__ . "/../../../application/core/controller.php";

use Src\Application\Core\Controller;

class AdminCategoriesViewController extends Controller {
    public function index() {
        $this->view("admin/categories/index");   
    }
}