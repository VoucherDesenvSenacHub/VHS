<?php

namespace Src\Application\Controllers;

require_once __DIR__ . "/../../../infra/models/event.php";
require_once __DIR__ . "/../../../application/core/controller.php";
require_once __DIR__ . '/../../../application/utils/uploadImages.php';

use Error;
use Src\Infra\Model\EventModel;
use Src\Application\Core\Controller;
use function Src\Application\Utils\uploadImages;
use function Src\Application\Utils\Redirect\redirect;

use Respect\Validation\Validator as V;
use Respect\Validation\Exceptions\NestedValidationException;

class CreateEventController extends Controller {

    private EventModel $eventModel;

    public function __construct() {
        $this->eventModel = new EventModel();
    }

    public function index() {
        try {
            $this->eventModel = $this->model("event");
            $user = $_SESSION["user"];

            $imgPath = UploadImages("thumbnail_url", $user["name"]);

            $data = array_merge($_POST, [
                "thumbnail_url" => $imgPath,
                "author_id" => $user["id"]
            ]);

            $schema =
               V::key('author_id',     v::stringType()->notEmpty()->setTemplate("Erro interno: usuário inválido"))
                ->key('category_id',   v::stringType()->notEmpty()->setTemplate('Escolher uma categoria é necessário'))
                ->key('thumbnail_url', v::stringType()->notEmpty()->setTemplate('Enviar uma thumbnail é necessário'))
                ->key('event_date',    v::stringType()->notEmpty()->setTemplate('Escolher uma data é necessário'))
                ->key('url',           v::stringType()->notEmpty()->length(25, 250)->setTemplate('O link é inválido'))
                ->key('title',         v::stringType()->notEmpty()->length(3, 60)->setTemplate('O título é inválido'))
                ->key('description',   v::stringType()->notEmpty()->length(4, 500)->setTemplate('A descrição é inválida'));

            $schema->assert($data);
            $errors = [];

            if (empty($data["thumbnail_url"])) {
                $errors["thumbnail"] = "Thumbnail não enviada!";
            } if (count($errors) > 0) {
                throw new Error(serialize($errors));
            }
            
            $this->eventModel->create(
                $data["author_id"],
                $data["category_id"],
                $data["url"],
                $data["thumbnail_url"],
                $data["title"],
                $data["description"],  
                $data["event_date"]
            );

            redirect("/VHS/studio/create/event", [
                "success" => true
            ]);
            
        } catch (NestedValidationException | Error $exception) {
            if ($exception instanceof Error) {
                return redirect("/VHS/studio/create/event", [
                    "errors" => unserialize($exception->getMessage()),
                    "fields" => $_POST
                ]);
            }

            redirect("/VHS/studio/create/event", [
                "errors" => $exception->getMessages(),
                "fields" => $_POST
            ]);
        }
    }
}