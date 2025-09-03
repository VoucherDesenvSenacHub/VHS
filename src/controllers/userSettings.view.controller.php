<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\CategoryModel;
use Src\Infra\Model\UsersCategoryModel;

require_once __DIR__ . '/../application/core/controller.php';

class UserSettingsViewController extends Controller {

    private CategoryModel $categoryModel;

    public function index() {
        $this->categoryModel = $this->model("category");

        $usersCategory = $this->categoryModel->getAllCategoriesByUserId($_SESSION["user"]["id"] ?? "");
        $_SESSION["user"]["categories"] = $usersCategory;
        $categories = $this->categoryModel->getAllCategories();

        $this->view("user/settings/index", [
            "user" => $_SESSION["user"] ?? null,
            "categories" => $categories ?? null
        ]);
    }
}