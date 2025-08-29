<?php

namespace Src\Application\Controllers;

use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;
use Src\Infra\Model\FastModel;

use Respect\Validation\Validator as v;

require_once __DIR__ . '/../application/core/controller.php';

class SearchVideoController extends Controller
{
    public VideoModel $VideoModel;
    public FastModel $FastModel;

    public function index()
    {
        try {
            $this->VideoModel = $this->model("video");
            $this->FastModel = $this->model("fast");

            $schema = v::key('q', v::stringType()->length(1, 255));
            $filter = $_GET["filter"] ?? "";

            if ($schema->validate($_GET)) {

                switch ($filter) {
                    case 'video':
                        $results = $this->VideoModel->getVideoByTitle($_GET["q"]);
                        $this->view("home/search/index", ["videos" => $results]);
                        break;

                    case 'fast':
                        $results = $this->FastModel->getFastByTitle($_GET["q"]);
                        $this->view("home/search/index", ["fast" => $results]);
                        break;

                    default:
                        # code...
                        break;
                }

                return;
            }

            // $this->view("home/search/index", ["error" => [
            //     "q" => "Not found Query"
            // ]]);
        } catch (NestedValidationException $exception) {
            echo $exception->getFullMessage();
        }
    }


    public function GetAllVideos()
    {
        try {
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
