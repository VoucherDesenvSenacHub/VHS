<?php

namespace Src\Controllers\Views\History;

require_once __DIR__ . "/../../../application/core/controller.php";
require_once __DIR__ . "/../../../infra/models/history.php";
require_once __DIR__ . "/../../../application/utils/redirect.php";

use Src\Application\Core\Controller;
use Src\Infra\Model\FastLikeModel;
use Src\Infra\Model\HistoryModel;

use function Src\Application\Utils\Redirect\redirect;

class HistoryViewController extends Controller
{
    private HistoryModel $historyModel;
    private FastLikeModel $fastLikeModel;


    public function index()
    {
        $this->historyModel = $this->model("history");
        $this->fastLikeModel = $this->model("fastLike");

        $user = $_SESSION['user'] ?? null;

        if (!$user) {
            return redirect("/login");
        }

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $tab = isset($_GET['tab']) ? $_GET['tab'] : 'all'; // all, video, fast
        $limit = 12;
        $offset = ($page - 1) * $limit;


        $history = $this->historyModel->getHistory($user['id'], $offset, $limit, $tab);

        foreach ($history as $key => $value) {
            if ($value['type'] === 'fast') {
                $history[$key]['likes'] = $this->fastLikeModel->countLikes($value['id']);
            }
        }

        $totalVideos = $this->historyModel->countHistory($user['id'], $tab);
        $totalPages = ceil($totalVideos / $limit);

        $this->view('home/history/index', [
            'history' => $history,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'total_items' => $totalVideos
            ],
            'active_tab' => $tab
        ]);
    }
}
