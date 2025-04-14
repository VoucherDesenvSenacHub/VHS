<?php
namespace Src\Application\Controllers;

use Src\Infra\Models\FastModel;

require_once __DIR__ . '/../infra/models/fastModel.php';

class CreateFastController {
    public function handle() {
        try {
            if (!isset($_POST["url"]) || !isset($_POST["thumbnail_url"]) || !isset($_POST["title"]) || !isset($_POST["description"]) || !isset($_POST["duration"]) || !isset($_POST["target_audience"]) || !isset($_POST["type_fast"])) {
                header("Content-Type: application/json", true);
                http_response_code(400);
                echo json_encode([
                    "success" => false,
                    "errors" => [
                        "error" => true,
                        "missing_fields" => [
                            "error_code" => 1,
                            "message" => "Campos obrigatórios não preenchidos"
                        ]
                    ]
                ]);
                return;
            }

            $url = $_POST["url"];
            $thumbnail_url = $_POST["thumbnail_url"];
            $title = $_POST["title"];
            $description = $_POST["description"];
            $duration = (int)$_POST["duration"];
            $target_audience = $_POST["target_audience"];
            $type_fast = $_POST["type_fast"];
            $id_user = 1;
            $category_id = 1;

            $errors = [
                "error" => false,
                "url" => ["error_code" => 0, "message" => ""],
                "thumbnail_url" => ["error_code" => 0, "message" => ""],
                "title" => ["error_code" => 0, "message" => ""],
                "description" => ["error_code" => 0, "message" => ""],
                "duration" => ["error_code" => 0, "message" => ""],
                "target_audience" => ["error_code" => 0, "message" => ""],
                "type_fast" => ["error_code" => 0, "message" => ""]
            ];

            if (strlen($title) < 3) {
                $errors["error"] = true;
                $errors["title"]["error_code"] = 1;
                $errors["title"]["message"] = "O título deve ter no mínimo 3 caracteres";
            }

            if (strlen($title) > 255) {
                $errors["error"] = true;
                $errors["title"]["error_code"] = 1;
                $errors["title"]["message"] = "O título deve ter no máximo 255 caracteres";
            }

            if (strlen($description) > 255) {
                $errors["error"] = true;
                $errors["description"]["error_code"] = 1;
                $errors["description"]["message"] = "A descrição deve ter no máximo 255 caracteres";
            }

            if (!is_numeric($_POST["duration"]) || $duration <= 0) {
                $errors["error"] = true;
                $errors["duration"]["error_code"] = 1;
                $errors["duration"]["message"] = "A duração deve ser um número válido e maior que zero";
            }

            if ($errors["error"]) {
                header("Content-Type: application/json", true);
                http_response_code(400);
                echo json_encode([
                    "success" => false,
                    "errors" => $errors
                ]);
                return; 
            }

            $fastModel = new FastModel();
            $fastModel->create(
                $id_user,
                $url,
                $thumbnail_url,
                $title,
                $description,
                $duration,
                $target_audience,
                $category_id,
                $type_fast
            );

            header("Content-Type: application/json", true);
            echo json_encode([
                "success" => true,
                "message" => "Conteúdo criado com sucesso!"
            ]);

        } catch (\Throwable $th) {
            http_response_code(500);
            header("Content-Type: application/json", true);
            echo json_encode([
                "success" => false,
                "errors" => [
                    "error" => true,
                    "message" => "Não foi possível processar a solicitação no momento"
                ]
            ]);
        }
    }
}