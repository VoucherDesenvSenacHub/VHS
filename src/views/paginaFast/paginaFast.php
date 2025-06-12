<?php
include __DIR__ . '/../components/utils/inputComponent.php';

include __DIR__ . '/../components/studioSideMenu/studioSideMenuComponent.php';

include __DIR__ . '/../components/header/headerComponent.php';


use function Src\Views\Components\Utils\InputComponent;

use function src\views\components\header\StudioSideMenuComponent;
 
use function src\views\components\header\HeaderComponent;
 
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

<?php
HeaderComponent();
?>

   
    <div class="flex ">
            <div class="max-xl:hidden">
                <?php
                StudioSideMenuComponent();
            
                ?>
                </div>
                <div class="p-7 w-full">

                    <div>
                        <p class="text-title font-pop font-semibold title-size text-white">Conteúdo do canal</p>
                        <p class="text-subtitile font-semibold title-size text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pellentesque elit nisl,</p>
                    </div>

                    <div class="flex h-5 mt-5 gap-5">
                        <p class="rounded-full w-30 p-3 bg-gray600 flex justify-center items-center text-white w-24">Usuários</p>
                        <p class="rounded-full w-30 p-3 bg-gray600 flex justify-center items-center text-white w-24">Denúncias</p>
                    </div>

                    <div class="flex items-center">

                        <div class="flex justify-center items-center m-3">
                            <img src="/VHS/public/icons/Filter.svg" alt="Filter">
                        </div>

                        <div class="w-full">

                            <?= InputComponent(placeholder: "Pesquisar", type: "text")?>
                            
                        </div>

                    </div>

                
            </div>
        </div>
</body>
</html>
 

 