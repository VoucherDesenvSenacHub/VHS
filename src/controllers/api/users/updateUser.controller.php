<?php

namespace Src\Application\Controllers;

use DateTime;
use Src\Application\Core\Controller;
use Src\Infra\Model\CategoryModel;
use Src\Infra\Model\UserModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';

class UpdateUserController extends Controller
{
    private UserModel $userModel;
    private CategoryModel $categoryModel;

    public function index()
    {
        $this->userModel = $this->model("user");
        $this->categoryModel = $this->model("category");

        $userCategories = $_SESSION["page_data"]["categories"] ?? [];

        $errors = [];

        if (isset($_POST["username"]) && $_POST["username"] !== $_SESSION["user"]["username"]) {
            $user = $this->userModel->getUserByUsername($_POST["username"]);
            if ($user) {
                $errors["username"] = "Nome de usuário já existe";
            }
        }

        if (isset($_POST["email"]) && $_POST["email"] !== $_SESSION["user"]["email"]) {
            $user = $this->userModel->getUserByEmail($_POST["email"]);
            if ($user) {
                $errors["email"] = "Email já existe";
            }
        }


        if (isset($_POST["categories"])) {
            $categories = explode(",", $_POST["categories"][0]);
            $this->categoryModel->removeAllCategoriesFromUser($_SESSION["user"]["id"] ?? "");
            array_splice($categories, count($categories) - 1, 1);

            foreach ($categories as $category) {
                $categoryExists = $this->categoryModel->findByName($category);
                $this->categoryModel->addCategoryInUser($categoryExists["id"], $_SESSION["user"]["id"] ?? "");
            }
        }

        if (isset($_POST["name"]) && strlen($_POST["name"]) < 3) {
            $errors["name"] = "Nome deve ter no mínimo 3 caracteres";
        }

        if (!empty($_POST["new_password"]) || !empty($_POST["password"])) {
            if (isset($_POST["new_password"]) && isset($_POST["password"]) && (strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 32)) {
                $errors["new_password"] = "Senha deve ter entre 8 e 32 caracteres";
            }

            if (!password_verify($_POST["password"], $_SESSION["user"]["password"] ?? "")) {
                $errors["password"] = "Senha atual incorreta";
            }

            if (password_verify($_POST["new_password"], $_SESSION["user"]["password"] ?? "")) {
                $errors["new_password"] = "Senha nova deve ser diferente da atual";
            }
        }

        $imageTypes = ["image/png", "image/jpg", "image/jpeg"];
        $uploaded = false;

        $avatarUrl = "";

        if (isset($_FILES["avatar"]) && $_FILES["avatar"]["tmp_name"]) {
            $fileName = time() . "_" . ($_SESSION["user"]["id"] ?? "default") . ".png";
            $uploadFile = __DIR__ . "/../../../../public/uploads/avatars/" . $fileName;
            $avatarUrl = $fileName;

            if ($_FILES["avatar"]["size"] > 6 * 1024 * 1024) {
                $errors["avatar"] = "Arquivo muito grande. Tamanho máximo: 6MB";
            }

            if (!in_array($_FILES["avatar"]["type"], $imageTypes)) {
                $errors["avatar"] = "Tipo de arquivo inválido. Tipos permitidos: PNG, JPG, JPEG";
            }

            $uploaded = move_uploaded_file($_FILES["avatar"]["tmp_name"], $uploadFile);
        }

        if (isset($_POST["delete_avatar"])) {
            $uploadFile = __DIR__ . "/../../../../public/uploads/avatars/" . ($_SESSION["user"]["id"] ?? "default") . ".png";
            if (file_exists($uploadFile)) {
                unlink($uploadFile);
            }
            $uploaded = true;
        }

        if (count($errors) > 0) {
            return redirect("/VHS/user/settings", ["errors" => $errors]);
        }

        $this->userModel->updateUser(
            $_SESSION["user"]["id"] ?? "",
            $_POST["name"] ?? $_SESSION["user"]["name"],
            $_POST["email"] ?? $_SESSION["user"]["email"],
            $_POST["username"] ?? $_SESSION["user"]["username"],
            $_POST["new_password"] ?? null,
            $uploaded ? $avatarUrl : ($_SESSION["user"]["avatar_url"] ?? null)
        );


        redirect("/VHS/user/settings", ["success" => true]);
    }
}
