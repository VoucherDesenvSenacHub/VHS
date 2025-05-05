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
    <title>user management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../../styles/tailwindglobal.js"></script>
</head>
<body class="h-screen w-screen bg-background">
    <div class="">
        <div>
            <p class="text-title font-pop font-semibold title-size text-white">Gerenciamento de usuários</p>
            <p class="text-subtitile font-semibold title-size text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pellentesque elit nisl,</p>
        </div>
        <div class="flex h-5 mt-5 gap-5">
            <p class="rounded-full w-30 p-3 bg-gray600 flex justify-center items-center text-white">Usuários</p>
            <p class="rounded-full w-30 p-3 bg-gray600 flex justify-center items-center text-white">Denúncias</p>
        </div>
        <div class="mt-5 flex gap-4">
        <img src="../../../../public/icons/Filter.svg" alt="">
        <div class="w-screen p-4">
            <?= InputComponent(placeholder: "Pesquisar", type: "text")?>
        </div>
        </div>
        
    </div>
</body>
</html>