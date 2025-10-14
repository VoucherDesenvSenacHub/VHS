<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\AvaliationModel;

require_once __DIR__ . '/../application/core/controller.php';

class VideoAvaliationController extends Controller {
    private AvaliationModel $avaliationModel;

    public function index() {
        $this->avaliationModel = $this->model('avaliation');

    
        // if (!isset($_POST["stars"]) || !isset) {
        //     echo json_encode([
        //         "error" => true,
        //         "message" => "Corpo inválido!"
        //     ]);
        // }

        #$this->avaliationModel->addAvaliation();
    }
}