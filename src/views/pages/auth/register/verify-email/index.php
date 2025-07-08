<?php
require "../../../../components/utils/inputComponent.php";
require "../../../../components/utils/buttonComponent.php";

use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\ButtonComponent;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="/VHS/src/views/pages/auth/register/verify-email/script.js" defer></script>
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
                    <h2 class="text-3xl font-semibold text-white max-xl:text-2xl">Quase lá</h2>
                    <p class="text-secondary text-center description">Por favor verifique sua caixa de e-mail</p>
                </div>
                <div class="flex flex-col items-center w-full">
                    <img src="/VHS/public/images/catGif.gif" alt="" class="rounded-lg w-full max-w-md">
                    <?= ButtonComponent(text: "Já verifiquei", variant: "default", link: "#verified", className: " verify-email-button mt-4") ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>