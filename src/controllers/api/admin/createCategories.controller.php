<?php

namespace Src\Application\Controllers;

use Error;
use Src\Application\Core\Controller;
use Src\Infra\Model\CategoryModel;
use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';

class CreateCategoriesController extends Controller
{
    public CategoryModel $CategoryModel;

    public function index()
    {
        try {
            $this->CategoryModel = $this->model("category");

            if (isset($_SESSION["redirect_data"]["fields"])) {
                $_POST = array_merge($_POST, $_SESSION["redirect_data"]["fields"]);
            }

            if (!isset($_POST["nameCategory"])) {
                throw new Error(serialize(["nameCategory" => "Nome da categoria é obrigatório"]));
            }

            if (strlen($_POST["nameCategory"]) < 3) {
                throw new Error(serialize(["nameCategory" => "Nome deve ter no mínimo 3 caracteres"]));
            }

            if (strlen($_POST["nameCategory"]) > 24) {
                throw new Error(serialize(["nameCategory" => "Nome deve ter no máximo 24 caracteres"]));
            }

            $categoryExists = $this->CategoryModel->findByName($_POST["nameCategory"]);
            if (!empty($categoryExists)) {
                throw new Error(serialize(["nameCategory" => "Essa categoria já existe!"]));
            }

            $create = $this->CategoryModel->createCategory($_POST["nameCategory"]);
            if (!$create) {
                throw new Error(serialize(["nameCategory" => "Erro ao criar categoria"]));
            }

            return redirect("/VHS/admin/categories", ["success" => "Categoria criada com sucesso"]);
        } catch (Error $exception) {
            $message = $exception->getMessage();
            $errors = unserialize($message) ?: ["nameCategory" => $message];

            return redirect("/VHS/admin/categories", [
                "errors" => $errors,
                "fields" => $_POST
            ]);
        }
    }
}
