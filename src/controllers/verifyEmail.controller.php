<?php

use Src\Infra\Models\UserModel;

class VerifyEmailController {
    public function handle() {
        try {
            if(!isset($_GET["user_id"])) {
                http_response_code(400);
                return [
                    "success" => false,
                    "errors" => [
                        "error" => true,
                        "missing_fields" => [
                            "error_code" => 1,
                            "message" => "Campos obrigatórios não preenchidos"
                        ]
                    ]
                ];
            }

            $user_id = $_GET["user_id"];

            $userModel = new UserModel();

            $user = $userModel->findById($user_id);

            if(!$user) {
                http_response_code(400);
                return [
                    "success" => false,
                    "errors" => [
                        "error" => true,
                        "user" => [
                            "error_code" => 1,
                            "message" => "Usuário não encontrado"
                        ]
                    ]
                ];
            }

            if($user["verified_email"]) {
                http_response_code(400);
                return [
                    "success" => false,
                    "errors" => [
                        "error" => true,
                        "email" => [
                            "error_code" => 1,
                            "message" => "Email já verificado"
                        ]
                    ]
                ];
            }

            $res = $userModel->updateEmailVerified($user_id);

            if(!$res) {
                http_response_code(500);
                return [
                    "success" => false,
                    "errors" => [
                        "error" => true,
                        "email" => [
                            "error_code" => 1,
                            "message" => "Erro ao verificar email"
                        ]
                    ]
                ];
            }

            return [
                "success" => true
            ];

        } catch (\Throwable $th) {
            http_response_code(500);
            return [
                "success" => false,
                "errors" => [
                    "error" => true,
                    "message" => "Erro interno no servidor"
                ]
            ];
        }
    }
}