<?php

namespace Src\Application\Controllers;

use Error;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;

use Src\Infra\Model\CommentModel;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../application/utils/verifyRecaptcha.php';

use Respect\Validation\Validator as v;
use Src\Infra\Model\VideoModel;

class CreateCommentController extends Controller {
    private CommentModel $commentModel;
    
    private VideoModel $videoModel;


    public function index() {
        try {
            $this->commentModel = $this->model('comment');
            $this->videoModel = $this->model('video');

            $schema = v::key('content', v::stringType()->length(min: 1, max:200));

            if(!isset($_GET["videoId"])) {
                return redirect("/VHS/404");
            }

            $videoId = $_GET["videoId"];
            
            if (!$schema->validate($_POST)) {
                return redirect("/VHS/home/video?id=$videoId");
            }

            $videoExists = $this->videoModel->getVideoById($videoId);

            if(empty($videoExists)) {
                return redirect("/VHS/404");
            }

            $this->commentModel->createComment(
                $_POST["content"],
                 $videoId,
                $_SESSION["user"]["id"]
            );

            return redirect("/VHS/home/video?id=$videoId#comments");

        } catch (Error $exception) {
            print_r($exception);

            // if($exception instanceof Error) {
            //     return redirect("/VHS/500");
            // }
        }
    }
}