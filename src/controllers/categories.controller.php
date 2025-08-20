<?php

namespace Src\Application\Controllers;

use Error;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;

use Src\Infra\Model\CategoryModel;
use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../application/core/controller.php';
require_once __DIR__ . '/../application/utils/verifyRecaptcha.php';

class CategoriesController extends Controller
{
    public CategoryModel $CategoryModel;


    public function index()
    {
        try {
            $this->CategoryModel = $this->model("category");

            $create = $this->CategoryModel->createCategories($_POST["nameCategory"]);
            if ($create) {
                echo "Categoria criada com sucesso!";
                return redirect("http://localhost/VHS/src/application/routes/route.php/admin/categories");
            } else {
                throw new Error("- Erro ao criar categoria");
            }
        } catch (NestedValidationException | Error  $exception) {
            if ($exception instanceof Error) {
                echo $exception->getMessage();
            } else {
                echo $exception->getFullMessage();
            }
        }
    }
}
