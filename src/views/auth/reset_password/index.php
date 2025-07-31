<?php
namespace Src\Views\Components\Utils;

require "../../components/utils/buttonComponent.php";
require "../../components/utils/inputComponent.php";

use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\ButtonComponent;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../../styles/tailwindglobal.js"></script>
</head>
<body>
    <div class="flex min-h-screen bg-background text-white xl:justify-start justify-center">
        <div class="flex justify-center mr-24 xl:mr-24 max-xl:hidden">
            <img src="../../../../public/images/Cassete.svg" alt="" class="relative right-14 mr-28 w-6/16">
        </div>
        <div class="relative xl:min-w-1/2 xl:mx-20 flex items-center justify-center w-full max-w-md xl:max-w-none xl:w-auto px-4 xl:px-0">
            <div class="flex flex-col gap-4">
                <div class="flex items-center flex-col gap-2">
                    <img src="../../../../public/logos/Logo.svg" alt="">
                    <p class="text-4xl font-pop font-semibold title-size text-white">Redefenir Senha</p>
                    <p class="font-pop paragraph-size text-gray-200">Informe o e-mail da sua conta</p>
                </div>
                <div class="flex flex-col gap-4 w-full xl:w-96">
                    <?= InputComponent(placeholder: "Insira seu e-mail", type: "email", label: "E-mail", icon: "../../../../public/icons/Vector.svg", iconPosition: "w-6 h-6 right-3") ?>
                    <?= ButtonComponent("Enviar e-mail", "default", null, 380, 50, null, "/VHS/src/views/auth/new_password/index.php", true) ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>