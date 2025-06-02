<?php
require "./components/header/headerComponent.php";
require "./components/barra_admin/barra_admin.php";
require "./components/utils/inputComponent.php";
 

use function Src\Views\Components\header\HeaderComponent;
use function Src\Views\Components\utils\InputComponent;
use function src\views\components\header\Barra_Admin;
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../styles/tailwindglobal.js"></script>
</head>
<body class="w-full bg-[#0C0118]">
    <?php
        HeaderComponent();
   
    ?>
    <div class="flex">
        <div class="max-xl:hidden mr-4">
            <?php
                Barra_Admin(); ?>
        </div>
        <div class="p-7 w-full">
            <div>
                <p class="font-pop font-semibold text-title text-white">Gerenciamento de usuários</p>
                <p class="text-subtitile font-semibold title-size text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pellentesque elit nisl,</p>
            </div>
            <div class="flex h-5 mt-5 gap-5">
                <p class="text-white bg-gray600 rounded-full w-28 h-8 flex items-center justify-center">Usuários</p>
                <p class="text-white bg-gray600 rounded-full w-28 h-8 flex items-center justify-center">Denúncias</p>
            </div>
            <div class="mt-10 flex items-center gap-4 h-16 cavalo">
                <img class="size-7" src="../../public/icons/filter-svgrepo-com.svg" alt="">
                

                    <?php
                echo InputComponent(
                    type: "text",
                    placeholder: "Pesquisar",
                    label_size: "lg",
                    background: "gray-900",
                    width: "96",
                    height: "12"
                );
                ?>
                    
            </div>

            <div class="w-full mt-10 flex flex-col gap-4">
                <div class="flex items-center justify-between max-w-7xl">
                    <div class="flex flex-row gap-4">

                        <img class="size-20 rounded-xl" src="https://yt3.googleusercontent.com/L8Rm0h8FjQ0t9eGytIvaT8oV43v5K0tX6lmTndcbOpPOBoHcgITnuqK-1jUfNY0CTSUSul4ffg=s900-c-k-c0x00ffffff-no-rj" alt="">
                        <div>
                            <p class="text-white">@Rafael</p>
                            <p class="text-gray-400">13131-3131313-131313-31313</p> 
                            <p class="text-gray-400">Criador de conteudo</p>
                        </div>
                    </div>
                    
                    <div class="flex size-6">
                        <img src="../../public/icons/Promover component.svg" alt="">
                        <img src="../../public/icons/user-block-rounded-svgrepo-com.svg" alt="">
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</body>
</html>