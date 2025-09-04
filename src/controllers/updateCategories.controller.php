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

            // Validar se o ID da categoria foi fornecido
            if (!$idCategory) {
                throw new Error("ID da categoria não fornecido.");
            }

            // Verificar se a categoria existe
            $existingCategory = $this->categoryModel->findById($idCategory);
            if (empty($existingCategory)) {
                throw new Error("Categoria não encontrada.");
            }

            // Validar se o campo updateCategory existe e não está vazio
            if (!isset($_POST['updateCategory']) || empty(trim($_POST['updateCategory']))) {
                throw new Error("O nome da categoria é obrigatório.");
            }

            // Atualizar a categoria
            $updated = $this->categoryModel->updateCategories(
                $idCategory,
                trim($_POST['updateCategory'])
            );

            if ($updated) {
                echo "Categoria atualizada com sucesso!";
                return redirect('/VHS/admin/categories');
            } else {
                throw new Error("Falha ao atualizar a categoria.");
            }
        } catch (NestedValidationException | Error $exception) {
            return $this->jsonResponse([
                'success' => false,
                'message' => $exception instanceof Error ? $exception->getMessage() : $exception->getFullMessage()
            ], 400);
        }
    }

    // Método auxiliar para respostas JSON
    protected function jsonResponse(array $data, int $statusCode): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
