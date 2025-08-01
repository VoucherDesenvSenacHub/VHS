<?php
require "../../../components/sidebar/SidebarComponent.php";
require "../../../components/header/headerComponent.php";
require_once "../../../components/cards/index.php";
require_once "../../../components/utils/inputComponent.php";
require_once "../../../components/studioSideMenu/studioSideMenuComponent.php";
require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/buttonComponent.php";

use function src\views\components\Utils\ButtonComponent;
use function Src\Views\Components\Cards\renderCards;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function Src\Views\Components\Utils\InputComponent;

$videos = [
    [
        "type_card" => "channel",
        "title" => "Como aprender programação do zero e se tornar um excelente desenvolvedor full stack",
        "duration" => "7 min",
        "username" => "Rafael Germinari",
        "thumbnail_url" => "https://marketplace.canva.com/EAEqfS4X0Xw/1/0/1600w/canva-most-attractive-youtube-thumbnail-wK95f3XNRaM.jpg",
        "avatar_url" => "https://senachub.ms.senac.br/hubinnovation/uploads/fotos/6706850e20f59.jpg",
        "created_at" => "há 1 ano",
        "url" => "#",
        "comments" => "12",
        "likes" => "4.5",
        "views" => "540K"
    ],
    [
        "type_card" => "channel",
        "title" => "Como montar cavalos brancos ",
        "duration" => "7 min",
        "username" => "CAVALO bRANCO",
        "thumbnail_url" => "https://img.elo7.com.br/product/main/20706C1/painel-cavalo-branco-frete-gratis-cavalo-branco.jpg",
        "avatar_url" => "https://senachub.ms.senac.br/hubinnovation/uploads/fotos/6706850e20f59.jpg",
        "created_at" => "há 1 ano",
        "url" => "#",
        "comments" => "2000",
        "likes" => "4.5",
        "views" => "9990k"
    ],
    [
        "type_card" => "channel",
        "title" => "Como montar cavalos brancos ",
        "duration" => "7 min",
        "username" => "CAVALO bRANCO",
        "thumbnail_url" => "https://img.elo7.com.br/product/main/20706C1/painel-cavalo-branco-frete-gratis-cavalo-branco.jpg",
        "avatar_url" => "https://senachub.ms.senac.br/hubinnovation/uploads/fotos/6706850e20f59.jpg",
        "created_at" => "há 1 ano",
        "url" => "#",
        "comments" => "12",
        "likes" => "4.5",
        "views" => "540K"
    ],
    [
        "type_card" => "channel",
        "title" => "Como montar cavalos brancos ",
        "duration" => "7 min",
        "username" => "CAVALO bRANCO",
        "thumbnail_url" => "https://img.elo7.com.br/product/main/20706C1/painel-cavalo-branco-frete-gratis-cavalo-branco.jpg",
        "avatar_url" => "https://senachub.ms.senac.br/hubinnovation/uploads/fotos/6706850e20f59.jpg",
        "created_at" => "há 1 ano",
        "url" => "#",
        "comments" => "12",
        "likes" => "4.5",
        "views" => "540K"
    ],
    [
        "type_card" => "channel",
        "title" => "Como montar cavalos brancos ",
        "duration" => "7 min",
        "username" => "CAVALO bRANCO",
        "thumbnail_url" => "https://img.elo7.com.br/product/main/20706C1/painel-cavalo-branco-frete-gratis-cavalo-branco.jpg",
        "avatar_url" => "https://senachub.ms.senac.br/hubinnovation/uploads/fotos/6706850e20f59.jpg",
        "created_at" => "há 1 ano",
        "url" => "#",
        "comments" => "12",
        "likes" => "4.5",
        "views" => "540K"
    ],
    [
        "type_card" => "channel",
        "title" => "Como montar cavalos brancos ",
        "duration" => "7 min",
        "username" => "CAVALO bRANCO",
        "thumbnail_url" => "https://img.elo7.com.br/product/main/20706C1/painel-cavalo-branco-frete-gratis-cavalo-branco.jpg",
        "avatar_url" => "https://senachub.ms.senac.br/hubinnovation/uploads/fotos/6706850e20f59.jpg",
        "created_at" => "há 1 ano",
        "url" => "#",
        "comments" => "12",
        "likes" => "4.5",
        "views" => "540K"
    ],
];

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
                    echo ButtonComponent("Videos", "studio", "", 10.675, 2.5,"",'/VHS/src/views/pages/studio/content');
                    echo ButtonComponent("Fast", "studio", "", 10.675, 2.5,"","/VHS/src/views/pages/studio/content/fast.php");
                    echo ButtonComponent("Eventos", "studio", "", 10.675, 2.5,"","/VHS/src/views/pages/studio/content");
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
                    echo renderCards($videos, 'channel');
                ?>
            </div>
        </div>
    </div>

</body>

</html>