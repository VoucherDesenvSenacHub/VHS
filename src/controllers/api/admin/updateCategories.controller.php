<?php

namespace Src\Application\Controllers;

use Error;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Model\CategoryModel;
use function Src\Application\Utils\Redirect\redirect;

class UpdateCategoriesController extends Controller
{
    protected CategoryModel $categoryModel;

    public function index()
    {
        try {
            $this->categoryModel = $this->model("category");
            $idCategory = $_POST['categoryId'] ?? null;
            if (!$idCategory) {
                throw new Error("ID da categoria não fornecido.");
            }
            $existingCategory = $this->categoryModel->findById($idCategory);
            if (empty($existingCategory)) {
                throw new Error("Categoria não encontrada.");
            }
            if (!isset($_POST['updateCategory']) || empty(trim($_POST['updateCategory']))) {
                throw new Error(serialize(["updateCategory" => "Nome da categoria é obrigatório"]));
            }
            if (strlen($_POST['updateCategory']) < 3) {
                throw new Error(serialize(["updateCategory" => "Nome deve ter no mínimo 3 caracteres"]));
            }
            if (strlen($_POST['updateCategory']) > 24) {
                throw new Error(serialize(["updateCategory" => "Nome deve ter no máximo 24 caracteres"]));
            }
            $categoryExists = $this->categoryModel->findByName($_POST['updateCategory']);
            if (!empty($categoryExists)) {
                throw new Error(serialize(["updateCategory" => "Essa categoria já existe!"]));
            }
            $updated = $this->categoryModel->updateCategory(
                $idCategory,
                trim($_POST['updateCategory'])
            );
            if (!$updated) {
                throw new Error(serialize(["updateCategory" => "Erro ao editar categoria"]));
            }
            return redirect('/VHS/admin/categories', ["success" => "Categoria editada com sucesso!"]);
        } catch (NestedValidationException | Error $exception) {
            if ($exception instanceof Error) {
                return redirect("/vhs/admin/categories", [
                    "errors" => unserialize($exception->getMessage())
                ]);
            }
            return redirect("/vhs/admin/categories", [
                "errors" => $exception->getMessages()
            ]);
        }
    }
}
