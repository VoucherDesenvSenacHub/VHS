<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\ChannelModel;

require_once __DIR__ . '/../../../application/core/controller.php';

class ChannelViewController extends Controller
{
    private ChannelModel $channelModel;

    public function index()
    {
        $this->channelModel = $this->model("channel");

        $creator = $this->channelModel->getCreatorsChannel($_GET['id'] ?? "");

        if (empty($creator)) {
            return $this->view("/home/channel/index", [
                "channel" => [],
                "error" => "Criador não encontrado para este vídeo"
            ]);
        }

        $creator = $creator[0];

        return $this->view("/home/channel/index", [
            "channel" => $creator
        ]);
    }
}
