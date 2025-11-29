<?php

namespace Src\Application\Controllers;

require_once __DIR__ . '/../../../application/core/controller.php';

use Src\Application\Core\Controller;
use Src\Infra\Model\FastModel;
use Respect\Validation\Exceptions\NestedValidationException;

use function Src\Application\Utils\Redirect\redirect;

class DeleteFastController extends Controller
{
    public FastModel $fastModel;

    public function index()
    {
        try {
            $this->fastModel = $this->model("fast");

            $id = $_POST["id"];

            $this->fastModel->delete($id);

            redirect("/VHS/studio/content/fast", [
                "success_delete" => true
            ]);
        } catch (NestedValidationException $exception) {
            echo $exception->getFullMessage();
        }
    }
}
