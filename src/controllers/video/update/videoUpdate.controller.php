<?php

namespace Src\Application\Controllers;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../application/utils/uploadArchives.php';

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

use function Src\Application\Utils\Redirect\redirect;
use function Src\Application\Utils\UploadImages;

class VideoUpdateController extends Controller
{

    public VideoModel $videoModel;

    public function index()
    {
        try {
            $this->videoModel = $this->model("video");

            $id = $_POST["id"];

            $video = $this->videoModel->getVideoByID($id);
            $user = $_SESSION["user"];

            if ($video["author_id"] != $user["id"]) {
                 redirect("/VHS/content/video", [
                     "success" => false
                 ]);
                 return;
            }

            $imgPath = UploadImages('thumbnail', $user["name"]);
            if ($imgPath === null) {
                $imgPath = $_POST['old_thumbnail'] ?? $video["thumbnail_url"];
            }

            $data = array_merge($_POST, [
                "thumbnail_url" => $imgPath,
                "id" => $id
            ]);

            $schema = v::key('title', v::stringType())->notEmpty()
                ->key('description', v::stringType())->notEmpty()
                ->key('category_id', v::stringType())->notEmpty()
                ->key('thumbnail_url', v::optional(v::stringType()->notEmpty()));

            $schema->assert($data);

            $this->videoModel->update(
                $data["id"],
                $data["title"],
                $data["description"],
                $data["category_id"],
                $data["thumbnail_url"]
            );

            redirect("/VHS/content/video", [
                "success" => true
            ]);
        } catch (NestedValidationException $exception) {
            echo $exception->getFullMessage();
        }
    }
}
