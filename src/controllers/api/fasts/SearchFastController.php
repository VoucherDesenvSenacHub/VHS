<?php

namespace Src\Application\Controllers;

use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Model\FastModel;

use Respect\Validation\Validator as v;

require_once __DIR__ . '/../../../application/core/controller.php';

class SearchFastController extends Controller {
    public FastModel $FastModel;


    public function index() {
        try {

            $this->FastModel = $this->model("fast");

            $schema = v::key('q', v::stringType()->length(1, 255));
            
            
            if($schema->validate($_GET)) {
                $results = $this->FastModel->getFastByTitle($_GET["q"]);
                $this->view("home/search/index", ["fast" => $results]);
                return;
            }

            $this->view("home/search/index", ["error" => [
                "q" => "Not found Query"
            ]]);

        } catch (NestedValidationException $exception) {
            echo $exception->getFullMessage();
        }
        
    }
}