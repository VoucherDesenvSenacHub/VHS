<?php

require_once __DIR__ . "/../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/cards/index.php";
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../../application/utils/pagination.php";

use function Src\Application\Utils\paginate;
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
    <?- HeaderComponent(); ?>
    <div class="flex">
        <div class="max-xl:hidden mr-4">
            <?= StudioSideMenuComponent(); ?>
        </div>
        <div class="w-[1400px] md:p-0 p-4 mx-auto">
            <div>
                <h1 class="font-semibold md:text-title text-xl text-white">Conteúdo do canal</h1>
                <p class="text-gray-300 md:text-paragraph text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pellentesque elit nisl,</p>
            </div>
            <div class="flex gap-4 w-96 my-4">
                <?php
                echo ButtonComponent(text: "Videos", variant: "studio", width: 10.675, height: 2.5, link: "/VHS/studio/content/video");
                echo ButtonComponent(text: "Fast", variant: "studio", width: 10.675, height: 2.5, link: "/VHS/studio/content/fast");
                echo ButtonComponent(text: "Eventos", variant: "studio", width: 10.675,  height: 2.5, link: "/VHS/studio/content/event");
                ?>
            </div>

            <?= InputComponent(type: "text", placeholder: "Pesquisar", icon: "/VHS/public/icons/Filter.svg", iconPosition: "left", onClickIcon: "showFilterMenu()") ?>

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
            <div class="grid grid-cols-1  sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-5">
                <?= viewCards($videos, 'mychannel'); ?>
            </div>
            <?= paginate($videos, 8) ?>
        </div>
    </div>
    <script src="/VHS/src/views/components/cards/script.js" defer></script>
</body>

</html>