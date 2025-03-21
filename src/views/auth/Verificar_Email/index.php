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
    <div class="flex w-100 h-screen bg-background text-white">
        <div class="flex justify-center mr-24">
            <img src="../../../../public/images/Cassete.svg" alt="" class="relative right-[110px] mr-28 w-[1100px]">
        </div>

        <div class="gap-4 flex mt-24 flex-col">    
            <div class="flex mt-20 ml-24 mb-5 justify-center ml-8">
                <img src="../../../../public/logos/Logo.svg" alt="Logo">
            </div>
            <div>
                <h2 class="flex ml-10  text-3xl font-semibold text-secondary justify-center mr-2">Quase Lá</h2>
                <p class="text-gray200 flex ml-3 mb-2 mt-2 justify-center ml-5">Por favor verifique sua caixa de e-mail</p>
            </div>
            <div>
                <img src="../../../../public/images/catGif.gif" alt="" class="flex rounded-lg w-80 justify-center ml-5">
            </div>
            <div class="justify-center ml-5">
                <?= ButtonComponent(text: "Já verifiquei", variant: "default") ?>
            </div>
        </div>
    </div>