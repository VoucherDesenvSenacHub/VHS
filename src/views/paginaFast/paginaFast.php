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
    <title>Document</title>
</head>
<body class=" w-full bg-background">

<?= HeaderComponent() ?>

   
    <div class="flex">

        <div class="max-xl:hidden">

                <?= StudioSideMenuComponent() ?>

        </div>
        
        <div class="max-w-[1500px] mx-auto">

                    <div class="">
                        <div>
                            <p class="text-title font-pop font-semibold title-size text-white">Conteúdo do canal</p>
                            <p class="text-subtitile font-semibold title-size text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pellentesque elit nisl,</p>
                        </div>

                        <div class="flex h-5 mt-5 gap-5">

                            <?=ButtonComponent("Videos", "studio", "", "108px", "30px"); ?>

                            <?=ButtonComponent("Fast", "studio", "", "108px", "30px"); ?>

                            <?=ButtonComponent("Eventos", "studio", "", "108px", "30px"); ?>

                            
                        </div>
                    </div>

                    <div class="flex items-center mt-7 mb-7">

                            <img class="mt-3"  src="/VHS/public/icons/Filter.svg" alt="Filter">
                            
                        <div class="w-full ml-3">

                            <?= InputComponent(placeholder: "Pesquisar", type: "text")?>
                            
                        </div>

                    </div>

                <div class="flex w-full  justify-center">

                    <div class="max-w-7xl gap-[5.3rem] flex flex-wrap justify-center">
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
    </div>

    <div class="mt-60">

        <?= Footer()?>

    </div>
    <script defer src='/VHS/src/views/components/CardFastComponent/cardFast.js'></script>

</body>
</html>
