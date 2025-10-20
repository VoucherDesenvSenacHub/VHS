<?php

namespace Src\Application\Controllers;

require_once __DIR__ . '/../../../application/core/controller.php';

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;
use Respect\Validation\Exceptions\NestedValidationException;

use function Src\Application\Utils\Redirect\redirect;

class VideoDeleteController extends Controller
{
    public VideoModel $videoModel;

    public function index()
    {
        try {
            $this->videoModel = $this->model("video");

            $id = $_POST["id"];

            $this->videoModel->delete($id);

            redirect("/VHS/studio/content/video", [
                "success" => true
            ]);
        } catch (NestedValidationException $exception) {
            echo $exception->getFullMessage();
        }
    }
}
