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
            $idCategory = $_GET["update"];
            if ($idCategory) {
                $existingCategory = $this->categoryModel->findById($idCategory);
                if (empty($existingCategory)) {
                    throw new Error("Categoria não encontrada.");
                }
                $updated = $this->categoryModel->updateCategories(
                    $idCategory,
                    trim($_POST['updateCategory'])
                );
                if ($updated) {
                    return $this->jsonResponse([
                        'success' => true,
                        'message' => 'Categoria atualizada com sucesso.',
                        redirect('/VHS/src/application/routes/route.php/admin/categories')
                    ], 200);
                } else {
                    throw new Error("Falha ao atualizar a categoria.");
                }
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
