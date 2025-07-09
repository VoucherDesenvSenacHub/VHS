<?php
require "../../components/utils/inputComponent.php";
require "../../components/gridUsuarios/gridUsuariosComponent.php";
require "../../components/header/HeaderComponent.php";
require "../../components/barra_admin/barra_admin.php";
require "../../components/filter/filter.php";
require "../../components/utils/buttonComponent.php";

use function Src\Views\Components\GridUsuarios\GridUsuariosComponent;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\barra_admin\barra_admin;
use function src\views\components\utils\InputComponent;
use function src\views\components\filter\Filter;
use function Src\Views\Components\Utils\ButtonComponent;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>user management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
</head>
<body class="w-full bg-background text-white">

    <?= HeaderComponent() ?>

    <div class="flex w-full">
        <div>
            <?= barra_admin() ?>
        </div>

        <div class=" max-w-[1500px] mx-auto w-full">
            <div>
                <p class="text-title font-pop font-semibold title-size text-white">Gerenciamento de usuários</p>
                <p class="text-subtitile font-semibold title-size text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pellentesque elit nisl,</p>
            </div>
            <div class="flex mt-5 gap-5">
                <?php echo ButtonComponent("Usúarios", "studio", "", 10.675, 2.5,"","",true); ?>
                <?php echo ButtonComponent("Denúncias", "studio", "", 10.675, 2.5,"","../gerenciamento_usuario/denuncia_page.php"); ?>
            </div>
            
                
                <div class="w-full">

                    <div class="flex gap-4 mt-5 mb-5 items-center">
                        <div class=" relative z-20">
                            <?= Filter() ?>
                        </div>
                        <div class="w-full ">
                            
                            <?= InputComponent(placeholder: "Pesquisar", type: "text") ?>

                        </div>
                    </div>
                    
                    <?= GridUsuariosComponent(); ?>
                </div>
            
        </div>
    </div>

</body>
</html>
