<?php

namespace Src\Application\Controllers;

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

            // Validação dos dados recebidos
            $schema = 
            v::key('content', v::stringType()->length(1, null))
             ->key('user_id', v::stringType()->length(1, 23))
             ->key('video_id', v::stringType()->length(1, 23));

            $schema->assert($_POST);

            // Inserção no banco
            $this->commentModel->create(
                $_POST['content'],
                $_POST['user_id'],
                $_POST['video_id']
            );

            // Retornar algo para o front (JSON por exemplo)
            echo json_encode(["status" => "success"]);
        } catch (NestedValidationException $exception) {
            http_response_code(400);
            echo json_encode([
                "status" => "error",
                "message" => $exception->getFullMessage()
            ]);
        }
    }
}