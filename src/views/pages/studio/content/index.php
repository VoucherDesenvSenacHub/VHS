<?php

require_once __DIR__ . "/../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/cards/index.php";
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";

use function src\views\components\Utils\ButtonComponent;
use function Src\Views\Components\Cards\viewCards;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function Src\Views\Components\Utils\InputComponent;

$videos = $_SESSION["page_data"]["videos"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS Studio - Conteúdo do canal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
</head>

<body class="w-full bg-[#0C0118]">
    <?php echo HeaderComponent(); ?>
    <div class="flex">
        <div class="max-xl:hidden mr-4">
            <?php
            echo StudioSideMenuComponent();
            ?>
        </div>
        <div class="max-w-[1500px] mx-auto">
            <div>
                <h1 class="font-semibold text-title text-white">Conteúdo do canal</h1>
                <p class="text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pellentesque elit nisl,</p>
            </div>
            <div class="flex gap-4 w-96 my-4">
                <?php
                    echo ButtonComponent("Videos", "studio", "", 10.675, 2.5,"",'/VHS/content/video');
                    echo ButtonComponent("Fast", "studio", "", 10.675, 2.5,"","/VHS/content/fast");
                    echo ButtonComponent("Eventos", "studio", "", 10.675, 2.5,"","/VHS/content/event");
                ?>
            </div>  

            <?= InputComponent("text", "Pesquisar", icon: "/VHS/public/icons/Filter.svg", iconPosition: "left", onClickIcon: "showFilterMenu()") ?>

            <div id="filter" class="absolute left-[16.5rem] z-10 hidden flex flex-col bg-gray-900 rounded-lg p-2 max-w-32 border-[0.5px] border-gray-500">
                <div class="flex">
                    <img src="/VHS/public/icons/time-svgrepo-com.svg" alt="" class="size-6 rotate-[-110deg]">
                    <p class="text-[13px] flex items-center text-gray-200">Mais recentes</p>
                </div>
                <div class="flex flex-row">
                    <img src="/VHS/public/icons/time-svgrepo-com.svg" class="size-6" alt="">
                    <p class="text-[13px] flex items-center text-gray-200">Mais antigos</p>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-5">
                <?php
                    echo viewCards($videos, 'mychannel');
                ?>
            </div>
        </div>
    </div>

</body>

</html>