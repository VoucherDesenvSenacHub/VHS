<?php

namespace Src\Application\Controllers;
require_once __DIR__ . '/../application/utils/redirect.php';

use function Src\Application\Utils\Redirect\redirect;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Models\CommentModel;
use Respect\Validation\Validator as v;

require_once __DIR__ . '/../application/core/controller.php';

class CommentController extends Controller {
    public CommentModel $commentModel;

    public function index() {
        try {
            $this->commentModel = $this->model("Comment");

            
            $schema = 
            v::key('content', v::stringType()->length(1, null))
             ->key('user_id', v::stringType()->length(1, 23))
             ->key('video_id', v::stringType()->length(1, 23));

            $schema->assert($_POST);

           
            $comment  = $this->commentModel->create(
                $_POST['content'],
                $_POST['user_id'],
                $_POST['video_id']
            );

            if ($comment){
                return redirect("/VHS/src/views/pages/home/video/index.php");
            }

            // echo json_encode(["status" => "success"]);
        } catch (NestedValidationException $exception) {
            http_response_code(400);
            echo json_encode([
                "status" => "error",
                "message" => $exception->getFullMessage()
            ]);
        }
    }
}