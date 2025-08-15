<?php

namespace Src\Application\Controllers;

require_once __DIR__ . '/../application/core/controller.php';

use Src\Application\Core\Controller;
use Src\Infra\Models\VideoModel;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;


class VideoController extends Controller {
    
    public VideoModel $videoModel;
    
    public function index(){
        try {
            $this->videoModel = $this->model("video");

            $schema = 
            v::key(
                'url',
                v::stringType()
            )->key(
                'title',
                v::stringType(),
            )->key(
                'description',
                v::stringType()
            )->key(
                'author_id',
                v::stringType()
            )->key(
                'category_id', 
                v::stringType()
            )->key(
                'type',
                v::stringType()
            )->key(
                'thumbnail_url',
                v::stringType()
            );
            
            $schema->assert($_POST);

            $this->videoModel->create($_POST["url"], $_POST["title"], $_POST["description"], $_POST["category_id"], $_POST["thumbnail_url"]);

        } catch (NestedValidationException $exception) {
            echo $exception->getFullMessage();
        }
    }
}