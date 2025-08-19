<?php

namespace Src\Application\Controllers;

use Error;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;

use Src\Infra\Model\CreateCategoriesModel;
use Src\Infra\Models\CreateCategoriesModel as ModelsCreateCategoriesModel;

require_once __DIR__ . '/../application/core/controller.php';
require_once __DIR__ . '/../application/utils/verifyRecaptcha.php';

class CategoriesController extends Controller {
    private ModelsCreateCategoriesModel $createCategoriesModel;

    public function index() {
        try {
            $this->createCategoriesModel = $this->model("createCategories");

            $create = $this->createCategoriesModel->createCategories($_POST["nameCategory"]);
            if($create) {
                echo "Categoria criada com sucesso!";
            } else {
                throw new Error("- Erro ao criar categoria");
            }
            
        } catch (NestedValidationException | Error  $exception) {
            if($exception instanceof Error) {
                echo $exception->getMessage();
            } else {
                echo $exception->getFullMessage();
            }

        }
        
    }
}