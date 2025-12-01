<?php

namespace Src\Application\Controllers;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../application/utils/uploadImages.php';
require_once __DIR__ . '/../../../application/utils/youtube.php';

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;
use Error;

use function Src\Application\Utils\Redirect\redirect;
use function Src\Application\Utils\UploadImages;
use function Src\Application\Utils\YouTube\getYoutubeDurationSeconds;
use function Src\Application\Utils\YouTube\getYoutubeIdFromUrl;

class VideoCreateController extends Controller
{
    public VideoModel $videoModel;

    public function index()
    {
        try {
            $this->videoModel = $this->model("video");

            $user = $_SESSION["user"];

            $user['timezone'] = $_POST['timezone'] ?? 'UTC';

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

            $videoId = getYoutubeIdFromUrl($data['url']);

            if (!$videoId) {
                throw new Error(serialize(["url" => "URL de vídeo inválida!"]));
            }

            $duration = getYoutubeDurationSeconds($videoId, $_ENV['YOUTUBE_API_KEY']);

            if ($duration === null) {
                throw new Error(serialize(["url" => "Não foi possível obter a duração do vídeo!"]));
            }

            $data['duration'] = $duration;

            $this->videoModel->create(
                $data["url"],
                $data["title"],
                $data["description"],
                $data["category_id"],
                $data["author_id"],
                $data["thumbnail_url"],
                $data["duration"]
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
