<?php
require "../../components/header/headerComponent.php";
require "../../components/barra_admin/barra_admin.php";
require "../../components/utils/inputComponent.php";
require "../../components/utils/cardDenunciationComponent.php";
require "../../components/utils/coment_admin/comentAdmin.component.php";
require_once "../../components/utils/buttonComponent.php";
require_once "../../components/filter/filter.php";

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
        "thumbnail_url" => "https://www.uai.com.br/uainoticias/wp-content/uploads/2025/04/Ornitorrinco_1744132096128.jpg",
        "há 2 dias",
        "https://www.uai.com.br/uainoticias/wp-content/uploads/2025/04/Ornitorrinco_1744132096128.jpg",
        "created_at" => "há 2 dias",
        "user_img" => "https://www.uai.com.br/uainoticias/wp-content/uploads/2025/04/Ornitorrinco_1744132096128.jpg",
        "há 2 dias",
        "https://www.uai.com.br/uainoticias/wp-content/uploads/2025/04/Ornitorrinco_1744132096128.jpg"
    ],
    [
        "name" => "CAVALO",
        "text" => "cCAVALO CAVALO VACALO LAVALO CAVALO",
        "thumbnail_url" => "https://www.uai.com.br/uainoticias/wp-content/uploads/2025/04/Ornitorrinco_1744132096128.jpg",
        "há 2 dias",
        "https://www.uai.com.br/uainoticias/wp-content/uploads/2025/04/Ornitorrinco_1744132096128.jpg",
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
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white font-[Poppins]">
    <?php echo HeaderComponent(); ?>
    <div class="flex">
        <div class="min-w-[220px] position-fixed">
            <?= barra_admin() ?>
        </div>
        <div class="p-6 pt-8 w-full flex flex-col gap-6">
            <div class="flex flex-col gap-4">
                <div>
                    <text class='text-3xl font-bold text-white cursor-default'>Gerenciamento de Usuários</text>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="flex gap-4">
                        <?php echo ButtonComponent("Usuários", "studio", "", 10.675, 2.5, "", "../userManagement/index.php"); ?>
                        <?php echo ButtonComponent("Denúncias", "studio", "", 10.675, 2.5, "", "../complaintManagement/index.php"); ?>
                    </div>
                    <div class="flex items-center justify-center gap-4">
                        <div class="h-full pt-6">
                            <?= Filter() ?>
                        </div>
                        <div class="w-full">
                            <?= InputComponent(placeholder: "Pesquisar", type: "text") ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="colocaraqui  flex flex-col gap-4">
                <?php
                foreach ($commets_lista as $commet) {
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