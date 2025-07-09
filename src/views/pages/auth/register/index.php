<?php
namespace Src\Views\Components\Utils;

require "../../../components/utils/buttonComponent.php";
require "../../../components/utils/inputComponent.php";
require "../../../components/checkbox/checkboxComponent.php";

use function App\Views\Components\CheckboxComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\ButtonComponent;
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
                <div class="flex flex-col gap-4 w-full xl:w-96">
                    <?= InputComponent(placeholder: "Insira seu Usuário", type: "text", label: "Usuário", icon: "../../../../public/icons/userRound.svg", iconPosition: "right-3") ?>
                    <?= InputComponent(placeholder: "Insira seu E-mail", type: "email", label: "Email", icon: "../../../../public/icons/mail.svg", iconPosition: "right-3") ?>
                    <?= InputComponent(placeholder: "Insira sua data de nascimento", type: "date", label: "Data de nascimento") ?>
                    <?= CheckboxComponent("Lembrar de mim")?>
                    <div>
                        <?= ButtonComponent("Criar Conta", "default", link: "./register/categories") ?>
                    </div>
                    <div class="flex items-center text-white cursor-default">
                        <div class="flex-grow border-t border-gray-300"></div>
                        <span class="px-3 text-sm font-semibold">OU</span>
                        <div class="flex-grow border-t border-gray-300"></div>
                    </div>
                    <div class="text-black">
                        <?= ButtonComponent("Criar conta pelo Google", "icon", "/VHS/public/images/LogoGoogle.svg") ?>
                    </div>
                    <div class="flex gap-0.5 items-center justify-center">
                        <p class="text-secondary cursor-default">Já possui uma conta?</p>
                        <a class="text-primary underline" href="./login">Entrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>