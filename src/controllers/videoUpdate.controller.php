<?php

namespace Src\Application\Controllers;

require_once __DIR__ . '/../application/core/controller.php';
require_once __DIR__ . '/../application/utils/uploadArchives.php';

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

use function Src\Application\Utils\Redirect\redirect;
use function Src\Application\Utils\UploadArchives;

class VideoUpdateController extends Controller{
    
    public VideoModel $videoModel;

    public function index()
    {
        try {
            $this->videoModel = $this->model("video");

            $id = $_POST["id"];
            
            $author_id = $_SESSION["user"]["id"];

            $video = $this->videoModel->getVideoByID($id);
            

            $schema = v::key('title', v::stringType())->notEmpty()
                ->key('description', v::stringType())->notEmpty()
                ->key('category_id', v::stringType())->notEmpty()
                ->key('thumbnail_url', v::stringType())->notEmpty();

            $schema->assert($id);

            $this->videoModel->update(
                $id,
                $_POST["title"],
                $_POST["description"],
                $_POST["category_id"],
                $_POST["thumbnail_url"]
            ); 

            redirect("/VHS/content/video?id=$id",[
                "success" => true
            ]);
        } catch (NestedValidationException $exception) {
            echo $exception->getFullMessage();
        }
    }
}
