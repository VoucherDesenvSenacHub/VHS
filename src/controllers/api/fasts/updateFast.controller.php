<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\FastModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../infra/models/fast.php';

class FastUpdateController extends Controller
{
    public function index()
    {

        $id = $_POST['id'];
        $title = $_POST['title'];

        if (empty($title)) {
            redirect("/VHS/studio/content/fast/edit?id=$id", ["errors" => "O título é obrigatório."]);
            return;
        }

        $fastModel = new FastModel();
        $fastModel->updateFast($id, $title);

        redirect("/VHS/studio/content/fast", ["success" => "Fast atualizado com sucesso!"]);
    }
}
