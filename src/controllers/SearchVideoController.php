<?php

namespace Src\Application\Controllers;

use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Model\VideoModel;
use Src\Infra\Model\eventsModel;
use Src\Infra\Model\UserModel;

use Respect\Validation\Validator as v;

require_once __DIR__ . '/../application/core/controller.php';

class SearchVideoController extends Controller
{
    public VideoModel $VideoModel;

    public UserModel $userModel;

    public eventsModel $eventsModel;
    


    public function index()
    {
        try {


            $this->VideoModel = $this->model("video");

            $this->eventsModel = $this->model("events");

            $this->userModel = $this->model("user");

            
            $schema = v::key('query', v::stringType()->length(1, 255));
            $filter = $_GET["filter"] ?? "video";

 
            if ($schema->validate($_GET)) {

                $results = [];

                switch ($filter) {

                    case 'video':

                        $results = $this->VideoModel->getVideoByTitle($_GET["query"]);

                        $results = array_map(function ($item) {

                            return [

                                "url" => $item["url"] ?? null,

                                "type_card" => isset($item["type"]) ? strtolower($item["type"]) : '',

                                "description" => $item["description"] ?? '',

                                "duration" => $item["duration"] ?? '',
                                
                                "title" => $item["title"] ?? '',

                                "thumbnail_url" => $item["thumbnail_url"] ?? '',

                                "views" => $item["views"] ?? 0,

                                "created_at" => $item["created_at"] ?? '',
                            ];
                        }, $results);

                        break;
            
                    case 'fast':

                        $results = $this->VideoModel->getFastByTitle($_GET["query"]);
                      
                        $results = array_map(function ($item) {

                            return [

                                "url" => $item["url"] ?? null,

                                "type_card" => isset($item["type"]) ? strtolower($item["type"]) : '',

                                "description" => $item["description"] ?? '',

                                "duration" => $item["duration"] ?? '',

                                "title" => $item["title"] ?? '',

                                "thumbnail_url" => $item["thumbnail_url"] ?? '',

                                "views" => $item["views"] ?? 0,

                                "created_at" => $item["created_at"] ?? '',  
                            ];
                        }, $results);

                        break;
            
                    case 'event':

                        $results = $this->eventsModel->geteventsByTitle($_GET["query"]);

                        $results = array_map(function($event){

                            return $event + ["type_card" => "event"];

                        }, $results);

                        break;
            
                    case 'channels':

                        $results = $this->userModel->getCreatorByUsername($_GET["query"]);

                        
                        $results = array_map(function($item){

                            return [

                                "name" => $item["username"],

                                "avatar_url" => $item["avatar_url"] ,

                                "category" => $item["category"] ?? 'Sem categoria',

                                "followers" => $item["followers"] ?? 0,
                            ];

                        }, $results);

                        break;
            
                    default:
                        $results = [];
                }
            
                return $this->view("home/search/index", ["dados" => $results]);
            }
            
            if (empty($_GET['query'])) {

                header("Location: /VHS/src/application/routes/route.php/home"); 

                exit;
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
