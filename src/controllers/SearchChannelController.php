<?php

namespace Src\Application\Controllers;

use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Model\UserModel;

use Respect\Validation\Validator as v;

require_once __DIR__ . '/../application/core/controller.php';

class SearchChannelController extends Controller {
    public UserModel $UserModel;


    public function index() {
        try {

            $this->UserModel = $this->model("User");

            $schema = v::key('query', v::stringType()->length(1, 255));
            $schema->assert($_GET);

            $query = $_GET['query'];

            $results = $this->UserModel->getCreatorByName($query);

            var_dump($results);

        } catch (NestedValidationException $exception) {
            echo $exception->getFullMessage();
        }
        
    }
}