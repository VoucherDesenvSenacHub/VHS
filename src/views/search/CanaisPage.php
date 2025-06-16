<?php
require "../components/utils/Title_and_buttons.php";
require "../components/header/headerComponent.php";
require "../components/cards/channelCard.php";
require "../components/sidebar/barra_lateral.php";

use function src\views\components\sidebar\SidebarComponent;
use function src\views\components\Cards\createChannelCard;
use function src\views\components\header\HeaderComponent;
use function src\views\components\utils\Title_and_buttons;

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


];

$botoes = [
    ['texto' => 'Vídeos', 'link' => './VideosPage.php'],
    ['texto' => 'Fast', 'link' => './FeastPage.php'],
    ['texto' => 'Eventos', 'link' => './EventosPage.php'],
    ['texto' => 'Canais', 'link' => './CanaisPage.php']
];

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canais</title>
    <link rel="icon" href="../public/img/logo.svg">
    <!-- Incluindo o Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white">
    <div>
        <?= HeaderComponent() ?>
    </div>

    <div class="flex flex-col md:flex-row w-full">

        <div class="hidden md:block">
            <?= SidebarComponent() ?>
        </div>
        <main class="-mt-14">


            <div class="ml-8 px-4 sm:px-6 py-8 !mx-auto max-w-[95rem]">
                <?= Title_and_buttons("Canais", "loren", $botoes) ?>
                <div class="flex flex-wrap gap-12">
                    <div class="space-y-6">
                        <?php
                        foreach ($videos as $video) {
                            echo '<div class="flex items-center space-x-6">';
                            echo '<img src="' . htmlspecialchars($video['avatar_url'], ENT_QUOTES, 'UTF-8') . '" alt="Avatar" class="w-16 h-16 rounded-md object-cover border-2 border-purple-500">';
                            echo '<div class="flex-1">';
                            echo '<a href="' . htmlspecialchars($video['url'], ENT_QUOTES, 'UTF-8') . '" target="_blank" class="text-purple-400 text-lg font-semibold hover:text-purple-300">' . htmlspecialchars($video['username'], ENT_QUOTES, 'UTF-8') . '</a>';
                            echo '<p class="text-gray-400 text-sm">' . htmlspecialchars($video['description'], ENT_QUOTES, 'UTF-8') . '</p>';
                            echo '<p class="text-gray-500 text-xs">' . number_format($video['views'], 0, ',', '.') . ' seguidores</p>';
                            echo '</div>';
                            echo '</div>';
                        }

                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>