<?php

namespace Src\Application\Controllers;

use function Src\Application\Utils\verifyRecaptcha;

class SignUpController {
    public function handle() {

        if(!isset($_POST["email"]) || !isset($_POST["name"]) || !isset($_POST["age"]) || !isset($_POST["password"]) || !isset($_POST["password_confirmation"]) || !isset($_POST["token_recaptcha"])) {
            http_response_code(400);
           
            return;
        }
        
        $email = $_POST["email"];
        $name = $_POST["name"];
        $age = $_POST["age"];
        $password = $_POST["password"];
        $password_confirmation = $_POST["password_confirmation"];
        $token_recaptcha = $_POST["token_recaptcha"];

    
        $res = verifyRecaptcha($token_recaptcha);

        if(!$res) {
            http_response_code(400);
            return [
                "success" => false,
                "errors" => [
                    "error" => true,
                    "recaptcha" => [
                        "error_code" => 1,
                        "message" => "Recaptcha inválido"
                    ]
                ]
            ];
        }



        $errors = [
            "error" => false,
            "email" => [
                "error_code" => 0,
                "message" => ""
            ],
            "name" => [
                "error_code" => 0,
                "message" => ""
            ],
            "age" => [
                "error_code" => 0,
                "message" => ""
            ],
            "password" => [
                "error_code" => 0,
                "message" => ""
            ],
            "password_confirmation" => [
                "error_code" => 0,
                "message" => ""
            ]
        ];

        if($password !== $password_confirmation) {
            http_response_code(400);
            
            $errors["error"] = true;
            $errors["password_confirmation"]["error_code"] = 1;
            $errors["password_confirmation"]["message"] = "As senhas não coincidem";
        }

        if(strlen($password) < 6) {
            http_response_code(400);

            $errors["error"] = true;
            $errors["password"]["error_code"] = 1;
            $errors["password"]["message"] = "A senha deve ter no mínimo 6 caracteres";
        }

        if(strlen($password) > 12) {
            http_response_code(400);
           
            $errors["error"] = true;
            $errors["password"]["error_code"] = 1;
            $errors["password"]["message"] = "A senha deve ter no máximo 12 caracteres";
        }

        if(strlen($name) < 3) {
            http_response_code(400);
           
            $errors["error"] = true;
            $errors["name"]["error_code"] = 1;
            $errors["name"]["message"] = "O nome deve ter no mínimo 3 caracteres";
        }

        if(strlen($name) > 255) {
            http_response_code(400);
           
            $errors["error"] = true;
            $errors["name"]["error_code"] = 1;
            $errors["name"]["message"] = "O nome deve ter no máximo 255 caracteres";
        }

        if($errors['error']) {
            return [
                "success" => false,
                "errors" => $errors
            ];
        }

        
    }
}