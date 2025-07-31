<?php
require "../../components/utils/inputComponent.php";
require "../../components/utils/buttonComponent.php";

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
                    <p class="text-4xl font-pop font-semibold title-size text-white">Quase lá</p>
                    <p class="font-pop paragraph-size text-gray-200">Por favor verifique sua caixa de e-mail</p>
                </div>
                <div class="flex flex-col items-center w-96 max-w-96 xl:max-w-none">
                <img src="../../../../public/images/catGif.gif" alt="" class="rounded-lg ">
                <div class="mt-4">
                    <?= ButtonComponent("Já verifiquei", "default", null, 380, 50, null, "/VHS/src/views/pages/home/index.php", true) ?>
                </div>
            </div>

            </div>
        </div>
    </div>
</body>
</html>