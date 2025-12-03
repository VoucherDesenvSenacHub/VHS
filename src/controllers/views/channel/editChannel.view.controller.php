<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\CategoryModel;
use Src\Infra\Model\UserModel;

require_once __DIR__ . '/../../../application/core/controller.php';

class EditChannelViewController extends Controller
{
    private CategoryModel $categoryModel;
    private UserModel $userModel;

    public function index()
    {
        $this->categoryModel = $this->model("category");
        $this->userModel = $this->model("user");

        $user = $_SESSION["user"] ?? [];
        $categories = $this->categoryModel->getAllCategories();
        $userCategories = $this->userModel->getCategoryByUserId($user["id"] ?? "");

        $this->view("/studio/edit-channel/index", [
            "user" => $user,
            "categories" => $categories,
            "userCategories" => $userCategories
        ]);
    }
}
