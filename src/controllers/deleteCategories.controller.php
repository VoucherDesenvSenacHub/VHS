<?php

namespace Src\Application\Controllers;

use Error;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Model\CategoryModel;
use function Src\Application\Utils\Redirect\redirect;

class DeleteCategoriesController extends Controller
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
            $delete = $this->categoryModel->deleteCategories(
                $idCategory,
            );
            if ($delete) {
                echo "Categoria deletada com sucesso!";
                return redirect('/VHS/admin/categories');
            } else {
                throw new Error("Falha ao deletar a categoria.");
            }
        } catch (NestedValidationException | Error $exception) {
            return $this->jsonResponse([
                'success' => false,
                'message' => $exception instanceof Error ? $exception->getMessage() : $exception->getFullMessage()
            ], 400);
        }
    }

    protected function jsonResponse(array $data, int $statusCode): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
