<?php

namespace Src\Application\Controllers;

use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Models\VideoModel;

use Respect\Validation\Validator as v;

require_once __DIR__ . '/../application/core/controller.php';

class SearchVideoController extends Controller
{
    public VideoModel $VideoModel;


    public function index()
    {
        try {


            $this->VideoModel = $this->model("video");

            $schema = v::key('query', v::stringType()->length(1, 255));
            $filter = $_GET["filter"] ?? "video";

            if ($schema->validate($_GET)) {
                $results = [];
                switch ($filter) {
                    case 'video':
                        $results = $this->VideoModel->getVideoByTitle($_GET["query"]);
                        // $this->view("home/search/index", ["videos" => $results]);
                        break;

                    case 'fast':
                        $results = $this->VideoModel->getFastByTitle($_GET["query"]);
                        // $this->view("home/search/index", ["fast" => $results]);
                        break;

                    default:

                        break;
                }

                $results = array_map(function ($item) {
                    return [
                        "url" => $item["url"],
                        "type_card" => strtolower($item["type"]),
                        "description" => $item["description"], 
                        "duration" => $item["duration"],
                        "title" => $item["title"],
                        "thumbnail_url" => $item["thumbnail_url"],
                        "views" => $item["views"],
                        "created_at" => $item["created_at"]
                    ];
                }, $results);



                return $this->view("home/search/index", ["dados" => $results]);
            }

            $this->view("home/search/index", ["error" => [
                "q" => "Not found Query"
            ]]);
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
