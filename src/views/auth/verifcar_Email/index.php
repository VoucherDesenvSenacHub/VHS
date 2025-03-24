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
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../../styles/tailwindglobal.js"></script>
</head>

<body>
    <div class="flex h-screen bg-background text-white">
        <div class="flex justify-center mr-24">
            <img src="../../../../public/images/Cassete.svg" alt="" class="relative right-14 mr-28 w-6/16">
        </div>

        <div class="relative mx-20 w-1/2 flex items-center justify-center shadow-[-10px_0_30px_10px_rgba(255, 255, 255, 1)]">
            <div class="flex flex-col gap-4">
                <div class="flex items-center flex-col gap-2">
                    <img src="../../../../public/logos/Logo.svg" alt="">
                    <p class="text-4xl font-pop font-semibold title-size text-white">Quase lá</p>
                    <p class="font-pop paragraph-size text-gray-200">Por Favor Aguarde</p>
                </div>
                <div class="w-80 bg-gray-700 rounded-full h-6 overflow-hidden ml-5">
                    <div id="progress-bar" class="h-full bg-red-500 transition-all duration-500 ease-in-out text-center text-white flex items-center justify-center">0%</div>
                </div>
                <div class="justify-center ml-5 mt-4">
                    <button id="verify-button" class="px-6 py-2 text-white font-bold rounded bg-red-500" disabled>Carregando...</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let progress = 0;
        const progressBar = document.getElementById("progress-bar");
        const verifyButton = document.getElementById("verify-button");

        function updateProgress() {
            if (progress < 100) {
                progress += 10;
                progressBar.style.width = progress + "%";
                progressBar.textContent = progress + "%";
                setTimeout(updateProgress, 500);
            } else {
                progressBar.classList.replace("bg-red-500", "bg-purple-500");
                verifyButton.classList.replace("bg-red-500", "bg-purple-500");
                verifyButton.textContent = "Já verifiquei";
                verifyButton.disabled = false;
            }
        }

        updateProgress();
    </script>
</body>

</html>