<?php
require "../components/header/headerComponent.php";
require "../components/barra_admin/barra_admin.php";
require "../components/utils/inputComponent.php";
require "../components/utils/cardDenunciationComponent.php";
require "../components/utils/coment_admin/comentAdmin.component.php";
require_once "../components/utils/buttonComponent.php";
require_once "../components/filter/filter.php";

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
    </head>
    <body class="w-full bg-[#0C0118]">
    
    <?php echo HeaderComponent();?>
    <div class="flex">
        <div class="max-xl:hidden ">
            <?php echo Barra_Admin(); ?>
        </div>
        <div class="max-w-[1500px] mx-auto w-full">
            <div>
                <p class="font-pop font-semibold text-title text-white">Gerenciamento de usuários</p>
                <p class="text-subtitile font-semibold title-size text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pellentesque elit nisl,</p>
            </div>
            <div class="flex mt-5 gap-5">
                <?php echo ButtonComponent("Usúarios", "studio", "", 170, 40,"","../adm/user_management/index.php"); ?>
                <?php echo ButtonComponent("Denúncias", "studio", "", 170, 40,"","",true); ?>
            </div>
            <div class="mt-5 mb-5 flex items-center gap-4 ">
            <div class="relative z-20">
                <?= Filter() ?> 
            </div>
                <div class="w-full">
                    <?= InputComponent(placeholder: "Pesquisar", type: "text") ?>
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
            <div class="colocaraqui  flex flex-col gap-4">
            
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