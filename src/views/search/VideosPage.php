<?php
require "../components/utils/Title_and_buttons.php";
require "../components/header/headerComponent.php";
require "../components/sidebar/barra_lateral.php";
require "../components/cards/videoCard.php";

use function Src\Views\Components\Cards\createVideoCard;
use function Src\Views\Components\sidebar\SidebarComponent;
use function src\views\components\header\HeaderComponent;
use function src\views\components\utils\Title_and_buttons;

$botoes = [
    ['texto' => 'Vídeos', 'link' => './VideosPage.php'],
    ['texto' => 'Fast', 'link' => './FeastPage.php'],
    ['texto' => 'Eventos', 'link' => './EventosPage.php'],
    ['texto' => 'Canais', 'link' => './CanaisPage.php']
];

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
        "url" => "https://youtube.com/@example1",
        "type_card" => "Tutorial",
        "description" => "Aprenda PHP",
        "duration" => 600,
        "title" => "PHP para Iniciantes: Crie sua primeira aplicação",
        "username" => "Tech Guru",
        "thumbnail_url" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
        "avatar_url" => "https://cdn.awsli.com.br/10/10790/produto/292478529/fix-copo-bola-foto-1-7hxddc8b9q.jpg",
        "account_type" => "verified",
        "views" => 850000,
        "created_at" => "2024-04-15 10:00:00" 
    ],
    [
        "url" => "https://youtube.com/@example2",
        "type_card" => "Evento",
        "description" => "Live Coding",
        "duration" => 1200,
        "title" => "Live: Desenvolvendo um App com JavaScript",
        "username" => "Code Live",
        "thumbnail_url" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
        "avatar_url" => "https://cdn.awsli.com.br/10/10790/produto/292478529/fix-copo-bola-foto-1-7hxddc8b9q.jpg",
        "account_type" => "verified",
        "views" => 320000,
        "created_at" => "2024-05-20 18:00:00" 
    ],
    [
        "url" => "https://youtube.com/@example3",
        "type_card" => "Curso",
        "description" => "CSS Avançado",
        "duration" => 900,
        "title" => "Dominando Tailwind CSS em 2025",
        "username" => "Style Master",
        "thumbnail_url" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
        "avatar_url" => "https://cdn.awsli.com.br/10/10790/produto/292478529/fix-copo-bola-foto-1-7hxddc8b9q.jpg",
        "account_type" => "verified",
        "views" => 500000,
        "created_at" => "2024-06-01 12:00:00" 
    ],
    [
        "url" => "https://youtube.com/@example3",
        "type_card" => "Curso",
        "description" => "CSS Avançado",
        "duration" => 900,
        "title" => "Dominando Tailwind CSS em 2025",
        "username" => "Style Master",
        "thumbnail_url" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
        "avatar_url" => "https://cdn.awsli.com.br/10/10790/produto/292478529/fix-copo-bola-foto-1-7hxddc8b9q.jpg",
        "account_type" => "verified",
        "views" => 500000,
        "created_at" => "2024-06-01 12:00:00" 
    ],
    [
        "url" => "https://youtube.com/@example3",
        "type_card" => "Curso",
        "description" => "CSS Avançado",
        "duration" => 900,
        "title" => "Dominando Tailwind CSS em 2025",
        "username" => "Style Master",
        "thumbnail_url" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
        "avatar_url" => "https://cdn.awsli.com.br/10/10790/produto/292478529/fix-copo-bola-foto-1-7hxddc8b9q.jpg",
        "account_type" => "verified",
        "views" => 500000,
        "created_at" => "2024-06-01 12:00:00" 
    ],
    [
        "url" => "https://youtube.com/@example3",
        "type_card" => "Curso",
        "description" => "CSS Avançado",
        "duration" => 900,
        "title" => "Dominando Tailwind CSS em 2025",
        "username" => "Style Master",
        "thumbnail_url" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
        "avatar_url" => "https://cdn.awsli.com.br/10/10790/produto/292478529/fix-copo-bola-foto-1-7hxddc8b9q.jpg",
        "account_type" => "verified",
        "views" => 500000,
        "created_at" => "2024-06-01 12:00:00" 
    ],
    [
        "url" => "https://youtube.com/@example3",
        "type_card" => "Curso",
        "description" => "CSS Avançado",
        "duration" => 900,
        "title" => "Dominando Tailwind CSS em 2025",
        "username" => "Style Master",
        "thumbnail_url" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
        "avatar_url" => "https://cdn.awsli.com.br/10/10790/produto/292478529/fix-copo-bola-foto-1-7hxddc8b9q.jpg",
        "account_type" => "verified",
        "views" => 500000,
        "created_at" => "2024-06-01 12:00:00" 
    ],
    [
        "url" => "https://youtube.com/@example3",
        "type_card" => "Curso",
        "description" => "CSS Avançado",
        "duration" => 900,
        "title" => "Dominando Tailwind CSS em 2025",
        "username" => "Style Master",
        "thumbnail_url" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
        "avatar_url" => "https://cdn.awsli.com.br/10/10790/produto/292478529/fix-copo-bola-foto-1-7hxddc8b9q.jpg",
        "account_type" => "verified",
        "views" => 500000,
        "created_at" => "2024-06-01 12:00:00" 
    ],
    [
        "url" => "https://youtube.com/@example3",
        "type_card" => "Curso",
        "description" => "CSS Avançado",
        "duration" => 900,
        "title" => "Dominando Tailwind CSS em 2025",
        "username" => "Style Master",
        "thumbnail_url" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
        "avatar_url" => "https://cdn.awsli.com.br/10/10790/produto/292478529/fix-copo-bola-foto-1-7hxddc8b9q.jpg",
        "account_type" => "verified",
        "views" => 500000,
        "created_at" => "2024-06-01 12:00:00" 
    ],
    [
        "url" => "https://youtube.com/@example3",
        "type_card" => "Curso",
        "description" => "CSS Avançado",
        "duration" => 900,
        "title" => "Dominando Tailwind CSS em 2025",
        "username" => "Style Master",
        "thumbnail_url" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
        "avatar_url" => "https://cdn.awsli.com.br/10/10790/produto/292478529/fix-copo-bola-foto-1-7hxddc8b9q.jpg",
        "account_type" => "verified",
        "views" => 500000,
        "created_at" => "2024-06-01 12:00:00" 
    ],
    [
        "url" => "https://youtube.com/@example3",
        "type_card" => "Curso",
        "description" => "CSS Avançado",
        "duration" => 900,
        "title" => "Dominando Tailwind CSS em 2025",
        "username" => "Style Master",
        "thumbnail_url" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
        "avatar_url" => "https://cdn.awsli.com.br/10/10790/produto/292478529/fix-copo-bola-foto-1-7hxddc8b9q.jpg",
        "account_type" => "verified",
        "views" => 500000,
        "created_at" => "2024-06-01 12:00:00" 
    ],
    [
        "url" => "https://youtube.com/@example3",
        "type_card" => "Curso",
        "description" => "CSS Avançado",
        "duration" => 900,
        "title" => "Dominando Tailwind CSS em 2025",
        "username" => "Style Master",
        "thumbnail_url" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
        "avatar_url" => "https://cdn.awsli.com.br/10/10790/produto/292478529/fix-copo-bola-foto-1-7hxddc8b9q.jpg",
        "account_type" => "verified",
        "views" => 500000,
        "created_at" => "2024-06-01 12:00:00" 
    ],
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vídeos</title>
    <link rel="icon" href="../public/img/logo.svg">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white">
    <div class="mb-8">
        <?= HeaderComponent() ?>
    </div>
    
    <div class="ml-8 px-4 sm:px-6 py-8 !mx-auto max-w-[95rem]">
        <?= Title_and_buttons("Videos", "loren", $botoes) ?>
        <div class="flex flex-wrap gap-12">
            <?php foreach ($videos as $video): ?>
                <?= createVideoCard($video) ?>
                <?= createVideoCard($video) ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>