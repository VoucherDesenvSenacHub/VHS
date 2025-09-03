<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\CategoryModel;
use Src\Infra\Model\UserCategoriesModel;
use Src\Infra\Model\UserModel;
use Src\Infra\Model\UsersCategory;
use Src\Infra\Model\UsersCategoryModel;

require_once __DIR__ . '/../application/core/controller.php';

class UserSettingsViewController extends Controller {

    private UsersCategoryModel $usersCategoryModel;
    private CategoryModel $categoryModel;

    public function index() {
        $this->usersCategoryModel = $this->model("usersCategory");
        $this->categoryModel = $this->model("category");

        $usersCategory = $this->usersCategoryModel->getCategoriesByUserId($_SESSION["user"]["id"] ?? "");
        $_SESSION["user"]["categories"] = $usersCategory;
        $categories = $this->categoryModel->getAllCategories();

        $this->view("user/settings/index", [
            "user" => $_SESSION["user"] ?? null,
            "categories" => $categories ?? null
        ]);
    }
}