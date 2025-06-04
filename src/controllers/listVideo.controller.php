<?php

namespace Src\Application\Controllers;

use Src\Infra\Models\VideoModel;
require_once __DIR__ . '/../infra/models/videoModel.php';

class ListVideoController {
    public function handle() {
        $model = new VideoModel();
        try{
            $listVideos = $model->listMostPopularVideo();
            if (empty($listVideos)){
                http_response_code(400);
                return[
                    "success" => false,
                    "errors" => [
                        "error" => true,
                        "missing_fields" => [
                            "error_code" => 1,
                            "message" => "Lista vazia, videos não encontrados"
                            ]
                            ]
                        ];    
                    }
            return $listVideos; 

        }catch(\Throwable $th){
            http_response_code(500);
            return[
                "success" => false,
                "errors" => [
                    "error" => true,
                    "message" => "Erro interno no servidor"
                    ]
                ];
            }
        }
}