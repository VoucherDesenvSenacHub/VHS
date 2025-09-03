<?php

namespace Src\Application\Controllers;

require_once __DIR__ . '/../application/core/controller.php';
require_once __DIR__ . '/../application/utils/uploadArchives.php';

use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Rules\NotEmpty;
use Respect\Validation\Validator as v;

use function Src\Application\Utils\Redirect\redirect;
use function Src\Application\Utils\UploadArchives;

class VideoController extends Controller{
    
    public VideoModel $videoModel;

    public function index()
    {
        try {
            $this->videoModel = $this->model("video");

            $imgPath = UploadArchives('thumbnail');

            $author_id = $_SESSION["user"]["id"];

            $data = array_merge($_POST, [
                "thumbnail_url" => $imgPath,
                "author_id" => $author_id
            ]);

            $schema = v::key('url', v::stringType())->notEmpty()
                ->key('title', v::stringType())->notEmpty()
                ->key('description', v::stringType())->notEmpty()
                ->key('author_id', v::stringType())->notEmpty()
                ->key('category_id', v::stringType())->notEmpty()
                ->key('thumbnail_url', v::stringType())->notEmpty();

            $schema->assert($data);

            $this->videoModel->create(
                $data["url"],
                $data["title"],
                $data["description"],
                $data["category_id"],
                $data["author_id"],
                $data["thumbnail_url"]
            );

            redirect("/VHS/create/video",[
                "success" => true
            ]);
        } catch (NestedValidationException $exception) {
            echo $exception->getFullMessage();
        }
    }


    public function GetAllVideos(){
        try {
            
            $this->videoModel = $this->model("video");

            $this->videoModel->getVideos();

            

        } catch (\Throwable $exception) {
           
        }
    }
}
