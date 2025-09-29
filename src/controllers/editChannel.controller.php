<?php

namespace Src\Application\Controllers;

use Error;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Model\ChannelModel;
use function Src\Application\Utils\Redirect\redirect;

class EditChannelController extends Controller
{
    protected ChannelModel $channelModel;

    public function index()
    {
        try {
            $this->channelModel = $this->model("channel");

            $idChannel   = $_POST['channelId'] ?? null;
            $channelName = $_POST['updateChannel'] ?? null;
            $description = $_POST['description'] ?? null;
            $avatarUrl   = $_POST['avatar_url'] ?? null;
            $bannerUrl   = $_POST['banner_url'] ?? null;
            $tags        = $_POST['tags'] ?? null;

            if (!$idChannel) {
                throw new Error("ID do canal não fornecido.");
            }

            $existingChannel = $this->channelModel->findById($idChannel);
            if (!$existingChannel) {
                throw new Error("Canal não encontrado.");
            }

            if (empty(trim($channelName))) {
                throw new Error("O nome do canal é obrigatório.");
            }

            $updated = $this->channelModel->updateChannel(
                $idChannel,
                trim($channelName),
                trim($description),
                trim($avatarUrl),
                trim($bannerUrl),
                trim($tags)
            );

            if ($updated) {
                return redirect('/VHS/admin/channels');
            } else {
                throw new Error("Falha ao atualizar o canal.");
            }
        } catch (NestedValidationException | Error $exception) {
            return $this->jsonResponse([
                'success' => false,
                'message' => $exception instanceof Error 
                    ? $exception->getMessage() 
                    : $exception->getFullMessage()
            ], 400);
        }
    }

    protected function jsonResponse(array $data, int $statusCode): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
