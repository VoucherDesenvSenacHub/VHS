<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\FastModel;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../infra/models/fast.php';

class StudioUpdateFastViewController extends Controller
{
    public FastModel $fastModel;

    public function index()
    {
        $this->fastModel = $this->model("fast");

        $id =  $_GET["id"] ?? null;

        $fast = $this->fastModel->getFastById($id);

        $this->view("/studio/content/fast/edit/index", [
            "fast" => $fast
        ]);
    }
}
