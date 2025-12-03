<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\FastModel;
use Src\Infra\Model\HistoryModel;

class AddViewFastController extends Controller
{
    private FastModel $fastModel;
    private HistoryModel $historyModel;

    public function index()
    {
        $this->fastModel = $this->model("fast");
        $this->historyModel = $this->model("history");

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

        if (isset($_SESSION['user'])) {
            $this->historyModel->addToHistory($_SESSION['user']['id'], $fastId);
        }

        ob_clean();
        echo json_encode([
            "status" => "success",
            "message" => "View added successfully"
        ]);
    }
}
