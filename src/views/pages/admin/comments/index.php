<?php
require "../../../components/header/headerComponent.php";
require "../../../components/barra_admin/barra_admin.php";
require "../../../components/utils/inputComponent.php";
require "../../../components/utils/cardDenunciationComponent.php";
require "../../../components/utils/coment_admin/comentAdmin.component.php";
require_once "../../../components/utils/buttonComponent.php";
require_once "../../../components/filter/filter.php";

use function Src\Views\components\filter\Filter;
use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\barra_admin\Barra_Admin;
use function Src\Views\Components\Utils\Comment;
use function Src\Views\Components\Utils\InputComponent;

$commets_lista = [
    [   
        "name" => "Rafael",
        "text" => "cara muuit legal odio todos vsz seus caras chtos",
        "thumbnail_url" => "https://www.uai.com.br/uainoticias/wp-content/uploads/2025/04/Ornitorrinco_1744132096128.jpg","há 2 dias","https://www.uai.com.br/uainoticias/wp-content/uploads/2025/04/Ornitorrinco_1744132096128.jpg",
        "created_at" => "há 2 dias",
        "user_img" => "https://www.uai.com.br/uainoticias/wp-content/uploads/2025/04/Ornitorrinco_1744132096128.jpg","há 2 dias","https://www.uai.com.br/uainoticias/wp-content/uploads/2025/04/Ornitorrinco_1744132096128.jpg"
    ],
    [
        "name" => "CAVALO",
        "text" => "cCAVALO CAVALO VACALO LAVALO CAVALO",
        "thumbnail_url" => "https://www.uai.com.br/uainoticias/wp-content/uploads/2025/04/Ornitorrinco_1744132096128.jpg","há 2 dias","https://www.uai.com.br/uainoticias/wp-content/uploads/2025/04/Ornitorrinco_1744132096128.jpg",
        "created_at" => "há 200 dias",
        "user_img" => "https://pm1.aminoapps.com/7041/8504e31011da6a7ea6973a12ab60b7b423d1f8f7r1-800-1000v2_00.jpg"
    ],
    [
        "name" => "Bruno",
        "text" => "Muito interessante, parabéns!",
        "thumbnail_url" => "https://www.uai.com.br/uainoticias/wp-content/uploads/2025/04/Ornitorrinco_1744132096128.jpg",
        "created_at" => "há 3 dias",
        "user_img" => "https://styles.redditmedia.com/t5_2s2lo/styles/communityIcon_vfzhs4a90gue1.png"
    ]
];



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>user management</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="../../styles/tailwindglobal.js"></script>
        <link rel="stylesheet" href="/VHS/src/styles/global.css">
        <script src="/VHS/src/styles/tailwindglobal.js"></script>
        <script src='https://cdn.jsdelivr.net/npm/apexcharts'></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.44.0/dist/apexcharts.css">
    </head>
    <body class="w-full bg-[#0C0118]">
    
    <?php echo HeaderComponent();?>
    <div class="flex">
        <div class="max-xl:hidden ">
            <?php echo Barra_Admin(); ?>
        </div>
        <div class="max-w-[1500px] mx-auto w-full">
            <div>
                <h1 class="font-pop font-semibold text-title text-white">Gerenciamento de usuários</h1>
                <p class="text-subtitile font-semibold title-size text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pellentesque elit nisl,</p>
            </div>
            <div class="flex mt-5 gap-2 w-96 mb-4">
                <?php echo ButtonComponent("Usúarios", "studio", "", 10.675, 2.5,"","/VHS/src/views/pages/admin/users"); ?>
                <?php echo ButtonComponent("Denúncias", "studio", "", 10.675, 2.5,"","/VHS/src/views/pages/admin/comments",true); ?>
            </div>
            <?= InputComponent("text", "Pesquisar", icon: "/VHS/public/icons/Filter.svg", iconPosition: "left", onClickIcon: "showFilterMenu()", className: "w-full !bg-[#15141A] text-white px-4 py-2 rounded-md border border-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-600") ?>
            <div class="mt-5 mb-5 flex items-center gap-4 ">

            <div class="w-full flex flex-col gap-4">
            
                <?php
                foreach($commets_lista as $commet) {
                    echo Comment(
                        $commet["name"],
                        $commet["text"],
                        $commet["thumbnail_url"],
                        $commet["created_at"],
                        $commet["user_img"]
                    );
                }
                ?>
            </div>
        </div>
    </div>

</body>
</html>