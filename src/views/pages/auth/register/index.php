<?php

namespace Src\Views\Components\Utils;
session_start();

require "../../../components/utils/buttonComponent.php";
require "../../../components/utils/inputComponent.php";
require "../../../components/checkbox/checkboxComponent.php";
require_once __DIR__ . '/../../../../../vendor/autoload.php';
require_once __DIR__ . '/../../../../application/utils/redirect.php';

use function App\Views\Components\CheckboxComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\ButtonComponent;
use Respect\Validation\Validator as v;
use \Respect\Validation\Exceptions\NestedValidationException;

$errors = [];

$schema = 
v::key(
    'username',
    v::stringType()->length(3, 60)
)->key(
    "email",
    v::email()
)->key(
    "date_birthday",
    v::stringType()->date()
);

try {
    $schema->assert($_POST);
    redirect("./password", $_POST);
} catch (NestedValidationException $th) {
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $errorsDescription = [
            "username" => [
                1 => "Preencha o campo de usuário!",
                2 => "O nome de usuário já existe!"
            ],
            "email" => [
                1 => "Preencha o campo de senha!",
                2 => "O email já existe!",
            ],
            "date_birthday" => [
                1 => "Preencha uma data válida!"
            ]
        ];

        $errors = $th->getMessages();
        foreach($errors as $error => $errorDescription) {
            $errors[$error] = $errorsDescription[$error][1];
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
</head>
<body>
    <div class="flex min-h-screen text-white xl:justify-start justify-center max-w-[1920px] mx-auto">
        <div class="flex justify-center mr-24 xl:mr-24 max-xl:hidden">
            <img src="/VHS/public/images/Cassete.svg" alt="" class="relative right-14 mr-28 w-6/16">
        </div>
        <div class="relative xl:min-w-1/2 xl:mx-20 flex items-center justify-center w-full max-w-md xl:max-w-none xl:w-auto px-4 xl:px-0">
            <div class="flex flex-col gap-4">
                <div class="flex items-center flex-col gap-2">
                    <img src="/VHS/public/logos/Logo.svg" alt="">
                    <h2 class="text-3xl font-semibold title-size text-white max-xl:text-2xl">Criar sua conta</h2>
                    <p class="text-secondary">Informe seus dados para criar sua conta</p>
                </div>
                <form class="flex flex-col gap-4 w-full xl:w-96" method="POST">
                    <?= InputComponent(placeholder: "Insira seu Usuário", type: "text", label: "Usuário", icon: "/VHS/public/icons/userRound.svg", iconPosition: "right-3", name: "username", error: isset($errors["username"]), errorDescription: isset($errors["username"]) ? $errors["username"] : "") ?>
                    <?= InputComponent(placeholder: "Insira seu E-mail", type: "email", label: "Email", icon: "/VHS/public/icons/mail.svg", iconPosition: "right-3", name: "email", error: isset($errors["email"]), errorDescription: isset($errors["email"]) ? $errors["email"] : "") ?>
                    <?= InputComponent(placeholder: "Insira sua data de nascimento", type: "date", label: "Data de nascimento", name: "date_birthday", error: isset($errors["date_birthday"]), errorDescription: isset($errors["date_birthday"]) ? $errors["date_birthday"] : "") ?>
                    <?= CheckboxComponent("Lembrar de mim")?>
                    <div>
                        <?= ButtonComponent("Criar Conta", "default") ?>
                    </div>
                    <div class="flex items-center text-white cursor-default">
                        <div class="flex-grow border-t border-gray-300"></div>
                        <span class="px-3 text-sm font-semibold">OU</span>
                        <div class="flex-grow border-t border-gray-300"></div>
                    </div>
                    <div>
                        <?= ButtonComponent("Criar conta pelo Google", "icon", "/VHS/public/images/LogoGoogle.svg") ?>
                    </div>
                    <div class="flex gap-0.5 items-center justify-center">
                        <p class="text-secondary cursor-default">Já possui uma conta?</p>
                        <a class="text-primary underline" href="/VHS/src/views/pages/auth/login">Entrar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>