<?php

use function Src\Views\Components\Utils\InputComponent;

use function Src\Views\Components\header\HeaderComponent;

use function src\views\components\studioSideMenu\StudioSideMenuComponent;

use function src\Views\Components\Utils\ButtonComponent;

use function src\Views\Components\Utils\Footer;

use function src\Views\Components\CardFast;


require "../components/utils/inputComponent.php";

require "../components/header/HeaderComponent.php";

require "../components/studioSideMenu/studioSideMenuComponent.php";

require "../components/CardFastComponent/cardFast.php";

require "../components/utils/buttonComponent.php";

require "../components/utils/footer.php";
 
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../styles/tailwindglobal.js"></script>
    <title>Fast Content</title>
</head>
<body class=" w-full bg-background">

<?php echo HeaderComponent(); ?>
    <div class="flex">
        <div class="max-xl:hidden mr-4">
            <?php
            echo StudioSideMenuComponent();
            ?>
        </div>
        <div class=" max-w-[1440px] mx-auto w-full">
            <div>
                <p class="font-pop font-semibold text-title text-white">Conteúdo do canal</p>
                <p class="text-subtitile font-semibold title-size text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pellentesque elit nisl,</p>
            </div>
            <div class="flex h-5 mt-5 gap-5">
                <?php
                echo ButtonComponent("Videos", "studio", "", "170px", "40px","",'./videosConteudo.php');
                echo ButtonComponent("Fast", "studio", "", "170px", "40px","","");
                echo ButtonComponent("Eventos", "studio", "", "170px", "40px","","./conteudo_Eventos.php");
                ?>
            </div>  
            <div class="mt-10 flex items-center gap-4 h-16 cavalo">
                <button id="btn_filter" onclick="filter(event)">
                    <img class="size-7" src="/VHS/public/icons/filter.svg" alt="">
                </button>
                <div class="w-full">
                    <?=InputComponent("text","Pesquisar");?>
                </div>
            </div>
            <div id="filter" class="absolute left-[16.5rem] z-10 hidden flex flex-col bg-gray-900 rounded-lg p-2 max-w-32 border-[0.5px] border-gray-500">
                <div class="flex">
                    <img src="../../../public/icons/time-svgrepo-com.svg" alt="" class="size-6 rotate-[-110deg]">
                    <p class="text-[13px] flex items-center text-gray-200">Mais recentes</p>
                </div>
                <div class="flex flex-row">
                    <img src="../../../public/icons/time-svgrepo-com.svg" class="size-6" alt="">
                    <p class="text-[13px] flex items-center text-gray-200">Mais antigos</p>
                </div>
            </div>
            <div class="colocaraqui mt-10 flex w-full gap-14  flex-wrap  justify-start ">
                <?php
                    echo CardFast([
                            'thumbnail_url' => '/VHS/public/images/imgCardtst.jpg',
                            'titulo' => 'espero vocês lá',
                            'likes' => '50K',
                            'views' => '540K'
                            ]);       
                    echo CardFast([
                            'thumbnail_url' => '/VHS/public/images/imgCardtst.jpg',
                            'titulo' => 'espero vocês lá',
                            'likes' => '50K',
                            'views' => '540K'
                            ]);       
                    echo CardFast([
                            'thumbnail_url' => '/VHS/public/images/imgCardtst.jpg',
                            'titulo' => 'espero vocês lá',
                            'likes' => '50K',
                            'views' => '540K'
                            ]);       
                    echo CardFast([
                            'thumbnail_url' => '/VHS/public/images/imgCardtst.jpg',
                            'titulo' => 'espero vocês lá',
                            'likes' => '50K',
                            'views' => '540K'
                            ]);       
                    echo CardFast([
                            'thumbnail_url' => '/VHS/public/images/imgCardtst.jpg',
                            'titulo' => 'espero vocês lá',
                            'likes' => '50K',
                            'views' => '540K'
                            ]);       
                    echo CardFast([
                            'thumbnail_url' => '/VHS/public/images/imgCardtst.jpg',
                            'titulo' => 'espero vocês lá',
                            'likes' => '50K',
                            'views' => '540K'
                            ]);       
                    echo CardFast([
                            'thumbnail_url' => '/VHS/public/images/imgCardtst.jpg',
                            'titulo' => 'espero vocês lá',
                            'likes' => '50K',
                            'views' => '540K'
                            ]);       
                ?>
            </div>
        </div>
    </div>

    <div class="mt-60">

        <?= Footer()?>

    </div>


</body>
</html>
