<?php

namespace Src\Application\Controllers;

use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;
use Respect\Validation\Validator as v;

require_once __DIR__ . '/../application/core/controller.php';
require_once __DIR__ . '/../application/utils/redirect.php';

use function Src\Application\Utils\Redirect\redirect;

class CreateFastVideoController extends Controller {
    public VideoModel $VideoModel;
    public function index() {
        try{
            $this->VideoModel = $this->model("video");

            $schema = v::key(
                'url',
                v::url()->setTemplate('Tem que ser uma url válida!')
            )->key(
                'title',v::stringType()->length(3, 64)->setTemplate( 'O titulo tem que ter entre 3 a 32 caracteres')
            )->key(
                'author_id', v::stringType()->length(23, 23)->setTemplate('tem que ser um id de usuário')
            )->key(
                'category_id', v::stringType()->length(23, 23)->setTemplate('tem que ser um id de categoria')
            )->key(
              'duration', v::StringVal()->setTemplate('duração é obrigatoria')
            )->key(
                'type', v::stringType()->in('FAST')->setTemplate('tem que ser um video do tipo fast')
            )->key(
                'thumbnail_url', v::url()->setTemplate('tem que ser uma url valida')
            )->key(
                'views', v::intVal()->setTemplate('tem que ser um numero')
            )->key(
                'target_audience', v::stringType()->setTemplate('coloque um publico alvo')
            );
            
            $schema->assert($_POST);

            $id = uniqid().uniqid();

            $this->VideoModel->createFastVideo($id, $_POST["url"], $_POST["title"], $_POST["author_id"], $_POST["category_id"], $_POST["duration"], $_POST["type"], $_POST["thumbnail_url"], $_POST["views"], $_POST["target_audience"]);
            
        }
        catch (NestedValidationException $e) {
            $errors = $e->getMessages();
            print_r($errors);
        }
    }
}
