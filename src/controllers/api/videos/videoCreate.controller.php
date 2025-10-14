<?php

namespace Src\Application\Controllers;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../application/utils/uploadImages.php';

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;
use Error;

use function Src\Application\Utils\Redirect\redirect;
use function Src\Application\Utils\UploadImages;

class VideoController extends Controller
{

    public VideoModel $videoModel;

    public function index()
    {
        try {
            $this->videoModel = $this->model("video");

            $user = $_SESSION["user"];

            $imgPath = UploadImages("thumbnail", $user["name"]);

            $data = array_merge($_POST, [
                "thumbnail_url" => $imgPath,
                "author_id" => $user["id"]
            ]);

            // Validações
            $schema = v::key('url', v::stringType()->notEmpty()->setTemplate("URL é obrigatória!"))
                ->key('title', v::stringType()->length(3, 60)->setTemplate("Título é obrigatório!"))
                ->key('description', v::stringType())
                ->key('author_id', v::stringType()->setTemplate("Autor inválido!"))
                ->key('category_id', v::stringType()->notEmpty()->setTemplate("Categoria é obrigatória!"))
                ->key('thumbnail_url', v::stringType()->setTemplate("Thumbnail é obrigatório!"));

            $schema->assert($data);

            $errors = [];

            if (empty($data["thumbnail_url"])) {
                $errors["thumbnail"] = "Thumbnail não enviada!";
            }

            if (count($errors) > 0) {
                throw new Error(serialize($errors));
            }

            // Se passou, cria o vídeo
            $this->videoModel->create(
                $data["url"],
                $data["title"],
                $data["description"],
                $data["category_id"],
                $data["author_id"],
                $data["thumbnail_url"]
            );

            redirect("/VHS/studio/create/video", [
                "success" => true
            ]);
        } catch (NestedValidationException | Error $exception) {
            if ($exception instanceof Error) {
                return redirect("/VHS/create/video", [
                    "errors" => unserialize($exception->getMessage()),
                    "fields" => $_POST
                ]);
            }

            redirect("/VHS/studio/create/video", [
                "errors" => $exception->getMessages(),
                "fields" => $_POST
            ]);
        }
    }
}
