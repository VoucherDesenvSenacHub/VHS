<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\ChannelModel;
use Src\Infra\Model\VideoModel;

require_once __DIR__ . '/../../../application/core/controller.php';

class ChannelViewController extends Controller
{
    private ChannelModel $channelModel;
    private VideoModel $videoModel;

    public function index()
    {
        $this->channelModel = $this->model("channel");
        $this->videoModel = $this->model("video");
        $page = $_GET["page"] ?? 0;

        if (!is_numeric($page) || $page < 0) {
            $page = 0;
        }


        $limit = 8;
        $offset = $page * $limit;
        $videos = $this->videoModel->getAllVideos($_GET['id'], $offset, $limit + 1);

        $nextPage = 0;

        if (count($videos) > $limit) {
            array_pop($videos);
            $nextPage = 1;
        }

        $creator = $this->channelModel->getCreatorsChannel($_GET['id'] ?? "");

        if (empty($creator)) {
            return $this->view("/home/channel/index", [
                "channel" => [],
                "error" => "Criador não encontrado para este vídeo"
            ]);
        }

        $creator = $creator[0];

        return $this->view("/home/channel/index", [
            "channel" => $creator,
            "videos" => $videos,
            "next_page" => $nextPage,
        ]);
    }
}
