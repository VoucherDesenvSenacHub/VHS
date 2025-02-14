<?php

namespace Src\Application\Controllers;

use Src\Application\Utils\EmailTransporter;
use Src\Infra\Models\UserModel;

use function Src\Application\Utils\verifyRecaptcha;
require_once __DIR__ . '/../application/utils/verifyRecaptcha.php';
require_once __DIR__ . '/../application/utils/emailTransporter.php';
require_once __DIR__ . '/../infra/models/userModel.php';


class SignUpController {
    public function handle() {
        
        try {
            if(!isset($_POST["email"]) || !isset($_POST["name"]) || !isset($_POST["date_birthday"]) || !isset($_POST["password"]) || !isset($_POST["password_confirmation"]) || !isset($_POST["token_recaptcha"])) {
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
            
            $email = $_POST["email"];
            $name = $_POST["name"];
            $date_birthday = $_POST["date_birthday"];
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
                "date_birthday" => [
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
        
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                http_response_code(400);
                
                $errors["error"] = true;
                $errors["email"]["error_code"] = 1;
                $errors["email"]["message"] = "Email inválido";
            }

            if(filter_var($date_birthday, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/\d{4}-\d{2}-\d{2}/"]]) === false) {
                http_response_code(400);
                
                $errors["error"] = true;
                $errors["date_birthday"]["error_code"] = 1;
                $errors["date_birthday"]["message"] = "Data de nascimento inválida";
            }
        
            if($errors['error']) {
                return [
                    "success" => false,
                    "errors" => $errors
                ];
            }
        
        
            $userModel = new UserModel();

            $user = $userModel->findByEmail($email);

            if($user) {
                http_response_code(400);
                return [
                    "success" => false,
                    "errors" => [
                        "error" => true,
                        "email" => [
                            "error_code" => 1,
                            "message" => "Email já cadastrado"
                        ]
                    ]
                ];
            }
        
            $userModel->create($name, $email, password_hash($password, PASSWORD_BCRYPT), $email, $date_birthday);
            
            $emailTransporter = new EmailTransporter();
        
            $file_path = __DIR__ . '/../application/utils/emails/createAccountEmail.html';
        
            $emailHTML = fopen($file_path, "r");
            $emailHTML = fread($emailHTML, filesize($file_path));
            $emailHTML = str_replace("[Nome do Usuário]", $name, $emailHTML);
        
            $emailTransporter->sendEmail($email, $name, "Bem-vindo ao nosso sistema", $emailHTML);
        
            return [
                "success" => true,
                "message" => "Usuário criado com sucesso, verifique seu email para ativar sua conta"
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