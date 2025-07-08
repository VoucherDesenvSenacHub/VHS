<?php
require "../../../components/utils/inputComponent.php";
require "../../../components/utils/buttonComponent.php";

use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\ButtonComponent;

$step = $_GET["step"] ?? 1;

if ($step === "1") {
    $render = InputComponent(placeholder: "Seu e-mail", type: "email");
} else {
    $render = 
    InputComponent(placeholder: "Insira sua senha nova", type: "password", label: "Senha", icon: "../../../../public/icons/eyeOff.svg", iconPosition: "w-6 h-6 right-3") .
    InputComponent(placeholder: "Confirme nova senha", type: "password", label: "Confirme sua senha", icon: "../../../../public/icons/eyeOff.svg", iconPosition: "w-6 h-6 right-3");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - Redefinir senha</title>
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
                    <h2 class="text-3xl font-semibold title-size text-white max-xl:text-2xl">Redefenir senha</h2>
                    <p class="text-secondary text-center">
                        <?= $step == 1 ? "Insira o e-mail da sua conta" : "Insira sua nova senha da sua conta" ?>
                    </p>
                </div>
                <div class="flex flex-col gap-4 w-full xl:w-96">
                    <?= $render ?>
                    <?= ButtonComponent($step == 1 ? "Enviar e-mail" : "Redefinir", "default", className: " mt-4", link: $step == "1" ? "?step=2" : "../home"); ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>