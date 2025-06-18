<?php

namespace Src\Application\Controllers;

use Src\Infra\Models\VideoModel;
require_once __DIR__ . '/../infra/models/videoModel.php';

class ListVideoCategoryController {
    public function handle() {
        $model = new VideoModel();
        try {
            if (!isset($_GET["category_id"])){
                http_response_code(400);
                return[
                    "success" => false,
                    "errors" => [
                        "error" => true,
                        "missing_fields" => [
                            "error_code" => 1,
                            "message" => "id da categoria não encontrado"
                        ]
                    ]
                ];
    
            }

            $category_id = $_GET["category_id"];
            $listVideoCategory = $model->listMostPopularVideoCategory($category_id);

            if (empty($listVideoCategory)){
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

            return $listVideoCategory;
            
        }
        catch (\Throwable $th) {
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

