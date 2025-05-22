<?php
namespace Src\Application\Controllers;

use Src\Infra\Models\FastModel;

require_once __DIR__ . '/../infra/models/fastModel.php'; 
class CreateFastController {
    public function handle() {
        try {
            if (!isset($_POST["url"]) || !isset($_POST["title"]) || !isset($_POST["thumbnail_url"]) || !isset($_POST["description"]) || !isset($_POST["duration"]) || !isset($_POST["target_audience"]) || !isset($_POST["type"])) {
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
            $title = $_POST["title"];
            $thumbnail_url = $_POST["thumbnail_url"];
            $description = $_POST["description"];
            $duration = intval($_POST["duration"]);
            $target_audience = $_POST["target_audience"];
            $type = $_POST["type"];
            $id = 1;
            $author_id = 1;
            $category_id = 1;
            $views = 0;


            $errors = [
                "error" => false,
                "url" => ["error_code" => 0, "message" => ""],
                "thumbnail_url" => ["error_code" => 0, "message" => ""],
                "title" => ["error_code" => 0, "message" => ""],
                "description" => ["error_code" => 0, "message" => ""],
                "duration" => ["error_code" => 0, "message" => ""],
                "target_audience" => ["error_code" => 0, "message" => ""],
                "type" => ["error_code" => 0, "message" => ""]
            ];

            if (filter_var($url, FILTER_VALIDATE_URL) === false) {
                $errors["error"] = true;
                $errors["url"]["error_code"] = 1;
                $errors["url"]["message"] = "A URL é inválida ou está ausente.";
            }

            if (filter_var($thumbnail_url, FILTER_VALIDATE_URL) === false) {
                $errors["error"] = true;
                $errors["thumbnail_url"]["error_code"] = 1;
                $errors["thumbnail_url"]["message"] = "A URL da miniatura é inválida ou está ausente.";
            }

            if (trim($title) === '') {
                $errors["error"] = true;
                $errors["title"]["error_code"] = 1;
                $errors["title"]["message"] = "O título é obrigatório.";
            } elseif (strlen($title) < 3) {
                $errors["error"] = true;
                $errors["title"]["error_code"] = 2;
                $errors["title"]["message"] = "O título deve ter no mínimo 3 caracteres.";
            } elseif (strlen($title) > 255) {
                $errors["error"] = true;
                $errors["title"]["error_code"] = 3;
                $errors["title"]["message"] = "O título deve ter no máximo 255 caracteres.";
            }

            if (strlen($description) > 255) {
                $errors["error"] = true;
                $errors["description"]["error_code"] = 2;
                $errors["description"]["message"] = "A descrição deve ter no máximo 255 caracteres.";
            }

            if (!is_numeric($duration) || $duration <= 0) {
                $errors["error"] = true;
             $errors["duration"]["error_code"] = 1;
                $errors["duration"]["message"] = "A duração deve ser um número válido e maior que zero.";
            }

            if (trim($target_audience) === '') {
                $errors["error"] = true;
                $errors["target_audience"]["error_code"] = 1;
                $errors["target_audience"]["message"] = "O público-alvo é obrigatório.";
            }

            if (trim($type) === '') {
                $errors["error"] = true;
                $errors["type"]["error_code"] = 1;
                $errors["type"]["message"] = "O tipo é obrigatório.";
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
                $id,
                $url,
                $title,
                $description,
                $author_id,
                $category_id,
                $duration,
                $target_audience,
                $views,
                $type,
                $thumbnail_url
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