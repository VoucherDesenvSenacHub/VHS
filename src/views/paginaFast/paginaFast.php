<?php

use function Src\Views\Components\Utils\InputComponent;

use function Src\Views\Components\header\HeaderComponent;

use function src\views\components\studioSideMenu\StudioSideMenuComponent;

use function src\Views\Components\Utils\ButtonComponent;
use function src\Views\Components\Utils\Footer;


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

            <div class="p-7">

                    <div class="ml-14">
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

                    <div class="flex items-center m-7">

                            <img class="mt-3"  src="/VHS/public/icons/Filter.svg" alt="Filter">
                            
                        <div class="w-full ml-3">

                            <?= InputComponent(placeholder: "Pesquisar", type: "text")?>
                            
                        </div>

                    </div>

                <div class="flex flex-wrap  gap-14  justify-center">

                        
                    <?= CardFast() ?>

                    <?= CardFast() ?>

                    <?= CardFast() ?>

                    <?= CardFast() ?>

                    <?= CardFast() ?>

                    <?= CardFast() ?>

                    <?= CardFast() ?>

                    <?= CardFast() ?>





                </div>

                
            </div>
    </div>

    <div class="mt-60">

        <?= Footer()?>

    </div>

</body>
</html>
 

 