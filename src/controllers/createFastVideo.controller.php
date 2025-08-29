<?php

namespace Src\Application\Controllers;

use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Model\FastModel;
use Respect\Validation\Validator as v;

require_once __DIR__ . '/../application/core/controller.php';
require_once __DIR__ . '/../application/utils/redirect.php';

use function Src\Application\Utils\Redirect\redirect;

class CreateFastVideoController extends Controller {
    public FastModel $FastModel;
    public function index() {
        try{
            $this->FastModel = $this->model("video");

            $schema = v::key(
                'title',v::stringType()->length(3, 64)->setTemplate( 'O titulo tem que ter entre 3 a 32 caracteres')
            )->key(
                'author_id', v::stringType()->length(23, 23)->setTemplate('tem que ser um id de usuário')
            )->key(
                'category_id', v::stringType()->length(23, 23)->setTemplate('tem que ser um id de categoria')
            )->key(
              'duration', v::StringVal()->setTemplate('duração é obrigatoria')
            )->key(
                'views', v::intVal()->setTemplate('tem que ser um numero')
            );
            
            $schema->assert($_POST);

            $id = uniqid().uniqid();

            $this->FastModel->createFastVideo($id,  $_POST["title"], $_POST["author_id"], $_POST["category_id"], $_POST["duration"],  $_POST["views"]);
            
        }
        catch (NestedValidationException $e) {
            $errors = $e->getMessages();
            print_r($errors);
        }
    }
}
