<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\FastModel;

class AddViewFastController extends Controller
{
    private FastModel $fastModel;

    public function index()
    {
        $this->fastModel = $this->model("fast");

        $fastId = $_POST["fast_id"] ?? null;

        if (!$fastId) {
            http_response_code(400);
            echo json_encode([
                "status" => "error",
                "message" => "Fast ID is required"
            ]);
            return;
        }

        $this->fastModel->addView($fastId);

        ob_clean();
        echo json_encode([
            "status" => "success",
            "message" => "View added successfully"
        ]);
    }
}
