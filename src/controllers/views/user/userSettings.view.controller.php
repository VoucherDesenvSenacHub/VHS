<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\CategoryModel;
use Src\Infra\Model\UserModel;
use Src\Infra\Model\UsersCategoryModel;

require_once __DIR__ . '/../../../application/core/controller.php';

class UserSettingsViewController extends Controller
{

    private CategoryModel $categoryModel;
    private UserModel $userModel;

    public function index()
    {
        $this->categoryModel = $this->model("category");
        $this->userModel = $this->model("user");

        $usersCategory = $this->categoryModel->getAllCategoriesByUserId($_SESSION["user"]["id"] ?? "");
        $_SESSION["user"]["categories"] = $usersCategory;
        $categories = $this->categoryModel->getAllCategories();
        $userCategories = $this->userModel->getCategoryByUserId($_SESSION["user"]["id"] ?? "");

        $this->view("user/settings/index", [
            "user" => $user[0] ?? null,
            "categories" => $categories ?? null,
            "user_categories" => $userCategories ?? null
        ]);
    }
}
