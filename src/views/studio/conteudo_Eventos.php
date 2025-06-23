<?php
require "../components/sidebar/barra_lateral.php";
require "../components/header/headerComponent.php";
require_once "../components/cards/index.php";
require_once "../components/studioSideMenu/studioSideMenuComponent.php";
require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/buttonComponent.php";

use function src\views\components\Utils\ButtonComponent;
use function Src\Views\Components\Cards\renderCards;
use function Src\Views\Components\header\HeaderComponent;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;

$videos = [
    [
        "url" => "https://youtube.com/@freitasdev",
        "type_card" => "Evento",
        "description" => "Gratuito",
        "duration" => 360,
        "title" => "Como aprender programação do zero e se tornar um excelente desenvolvedor full stack",
        "username" => "Canal Dev",
        "thumbnail_url" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
        "avatar_url" => "https://cdn.awsli.com.br/10/10790/produto/292478529/fix-copo-bola-foto-1-7hxddc8b9q.jpg",
        "account_type" => "verified",
        "views" => 1250000,
        "created_at" => "2024-03-10 15:00:00"
    ],
    [
        "url" => "https://youtube.com/@techworld",
        "type_card" => "Tutorial",
        "description" => "Pago",
        "duration" => 600,
        "title" => "Construindo uma API REST com Node.js e Express",
        "username" => "Tech World",
        "thumbnail_url" => "https://img.youtube.com/vi/xyz123/maxresdefault.jpg",
        "avatar_url" => "https://example.com/avatar/techworld.jpg",
        "account_type" => "verified",
        "views" => 850000,
        "created_at" => "2024-05-15 10:30:00"
    ],
    [
        "url" => "https://youtube.com/@codeacademy",
        "type_card" => "Curso",
        "description" => "Gratuito",
        "duration" => 1200,
        "title" => "Introdução ao Machine Learning com Python",
        "username" => "Code Academy",
        "thumbnail_url" => "https://img.youtube.com/vi/abc456/maxresdefault.jpg",
        "avatar_url" => "https://example.com/avatar/codeacademy.jpg",
        "account_type" => "padrão",
        "views" => 230000,
        "created_at" => "2024-01-20 14:00:00"
    ],
    [
        "url" => "https://youtube.com/@devtutoriais",
        "type_card" => "Webinar",
        "description" => "Gratuito",
        "duration" => 900,
        "title" => "Desenvolvimento de Aplicativos Mobile com Flutter",
        "username" => "Dev Tutoriais",
        "thumbnail_url" => "https://img.youtube.com/vi/def789/maxresdefault.jpg",
        "avatar_url" => "https://example.com/avatar/devtutoriais.jpg",
        "account_type" => "verified",
        "views" => 450000,
        "created_at" => "2024-06-01 09:00:00"
    ],
    [
        "url" => "https://youtube.com/@programacaofacil",
        "type_card" => "Tutorial",
        "description" => "Gratuito",
        "duration" => 240,
        "title" => "Aprenda HTML e CSS em 4 horas",
        "username" => "Programação Fácil",
        "thumbnail_url" => "https://img.youtube.com/vi/ghi012/maxresdefault.jpg",
        "avatar_url" => "https://example.com/avatar/programacaofacil.jpg",
        "account_type" => "padrão",
        "views" => 320000,
        "created_at" => "2024-04-25 16:45:00"
    ],
    [
        "url" => "https://youtube.com/@codinglife",
        "type_card" => "Evento",
        "description" => "Pago",
        "duration" => 1800,
        "title" => "Workshop de DevOps com Docker e Kubernetes",
        "username" => "Coding Life",
        "thumbnail_url" => "https://img.youtube.com/vi/jkl345/maxresdefault.jpg",
        "avatar_url" => "https://example.com/avatar/codinglife.jpg",
        "account_type" => "verified",
        "views" => 670000,
        "created_at" => "2023-12-10 11:00:00"
    ],
    [
        "url" => "https://youtube.com/@techtalks",
        "type_card" => "Palestra",
        "description" => "Gratuito",
        "duration" => 720,
        "title" => "O Futuro da Inteligência Artificial em 2025",
        "username" => "Tech Talks",
        "thumbnail_url" => "https://img.youtube.com/vi/mno678/maxresdefault.jpg",
        "avatar_url" => "https://example.com/avatar/techtalks.jpg",
        "account_type" => "verified",
        "views" => 980000,
        "created_at" => "2024-02-15 13:20:00"
    ],
    [
        "url" => "https://youtube.com/@webdevpro",
        "type_card" => "Tutorial",
        "description" => "Gratuito",
        "duration" => 480,
        "title" => "Construindo um Blog com React e Firebase",
        "username" => "Web Dev Pro",
        "thumbnail_url" => "https://img.youtube.com/vi/pqr901/maxresdefault.jpg",
        "avatar_url" => "https://example.com/avatar/webdevpro.jpg",
        "account_type" => "padrão",
        "views" => 150000,
        "created_at" => "2024-05-30 08:15:00"
    ],
    [
        "url" => "https://youtube.com/@learncode",
        "type_card" => "Curso",
        "description" => "Pago",
        "duration" => 1500,
        "title" => "Dominando Bancos de Dados com SQL e NoSQL",
        "username" => "Learn Code",
        "thumbnail_url" => "https://img.youtube.com/vi/stu234/maxresdefault.jpg",
        "avatar_url" => "https://example.com/avatar/learncode.jpg",
        "account_type" => "verified",
        "views" => 500000,
        "created_at" => "2023-11-05 17:30:00"
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
    <?php echo HeaderComponent(); ?>
    <div class="flex">
        <div class="max-xl:hidden mr-4">
            <?php
            echo StudioSideMenuComponent();
            ?>
        </div>
        <div class="p-7 ml-5 max-w-[1440px] w-full">
            <div>
                <p class="font-pop font-semibold text-title text-white">Gerenciamento de usuários</p>
                <p class="text-subtitile font-semibold title-size text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pellentesque elit nisl,</p>
            </div>
            <div class="flex h-5 mt-5 gap-5">
                <?php
                echo ButtonComponent("Videos", "studio", "", "170px", "40px");
                echo ButtonComponent("Fast", "studio", "", "170px", "40px");
                echo ButtonComponent("Eventos", "studio", "", "170px", "40px");
                ?>
            </div>
            <div class="mt-10 flex items-center gap-4 h-16 cavalo">
                <button id="btn_filter" onclick="filter(event)">
                    <img class="size-7" src="/VHS/public/icons/filter-svgrepo-com.svg" alt="">
                </button>
                <input type="text" placeholder="Pesquisar" class="pl-2 rounded-lg bg-transparent text-white w-full h-12 border-[0.5px] border-gray-500">
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
            <div class="colocaraqui mt-10 flex w-full gap-3 sm:gap-[2.15rem] flex-wrap  justify-start ">
                <?php
                foreach ($videos as $video) {
                    echo renderCards($cards, 'channel');
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>