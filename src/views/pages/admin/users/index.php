<?php
require "../../../components/utils/inputComponent.php";
require "../../../components/gridUsuarios/GridUsuariosComponent.php";
require "../../../components/header/headerComponent.php";
require "../../../components/barra_admin/barra_admin.php";
require "../../../components/filter/filter.php";
require "../../../components/utils/buttonComponent.php";

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
    <script src="../../styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/apexcharts'></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.44.0/dist/apexcharts.css">
</head>
<body class="">

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
            <div class="flex mt-5 gap-2 w-96 mb-4">
                <?php echo ButtonComponent("Usúarios", "studio", "", 10.675, 2.5,"","/VHS/src/views/pages/admin/users"); ?>
                <?php echo ButtonComponent("Denúncias", "studio", "", 10.675, 2.5,"","/VHS/src/views/pages/admin/comments",true); ?>
            </div>
                
            <?= InputComponent("text", "Pesquisar", icon: "/VHS/public/icons/Filter.svg", iconPosition: "left", onClickIcon: "showFilterMenu()", className: "w-full !bg-[#15141A] text-white px-4 py-2 rounded-md border border-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-600") ?>
                    
            <br>
            <?= GridUsuariosComponent(); ?>
                </div>
            
        </div>
    </div>

</body>
</html>
