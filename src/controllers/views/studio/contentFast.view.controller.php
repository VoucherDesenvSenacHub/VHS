<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\FastModel;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../infra/models/fast.php';

class StudioContentFastViewController extends Controller
{
    public FastModel $fastModel;

    public function index()
    {
        $this->fastModel = new FastModel();

        $author_id = $_SESSION["user"]["id"];

        $page = $_GET["page"] ?? 0;

        if (!is_numeric($page) || $page < 0) {
            $page = 0;
        }

        $search = $_GET["search"] ?? null;
        $sort = $_GET["sort"] ?? 'desc';

        $limit = 8;
        $offset = $page * $limit;

        $fasts = $this->fastModel->getAllFasts($author_id, $offset, $limit + 1, $search, $sort);

        $nextPage = 0;

        if (count($fasts) > $limit) {
            array_pop($fasts);
            $nextPage = 1;
        }

        $this->view("/studio/content/fast", [
            "fasts" => $fasts,
            "next_page" => $nextPage,
            "search" => $search,
            "sort" => $sort
        ]);
    }
}
