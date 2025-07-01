<?php
require "../components/header/headerComponent.php";
require "../components/sidebar/barra_lateral.php";
require "../components/cards/videoCard.php";

use function Src\Views\Components\Cards\createVideoCard;
use function src\views\components\Sidebar\SidebarComponent;
use function src\views\components\header\HeaderComponent;

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
    <title>Histórico</title>
    <link rel="icon" href="../public/img/logo.svg">
    <!-- Incluindo o Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center text-white">

    <div>
        <?= HeaderComponent() ?>
    </div>

    <main class="flex flex-col md:flex-row ">
        <div class="block">
            <?= SidebarComponent() ?>
        </div>
        <div class="w-full mr-8">
            <div class="flex-1 p-4 ml-8">
                <h1 class="text-xl sm:text-2xl font-bold">Histórico</h1>
                <p class="text-gray-400 mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>

            <div class="mb-4 sm:mb-6 flex items-center max-w-sm sm:max-w-md md:max-w-full ml-12">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="mr-2 md:w-8 md:h-8">
                    <path
                        d="M15.8346 2.5H4.16797C2.98946 2.5 2.4002 2.5 2.03409 2.8435C1.66797 3.187 1.66797 3.73985 1.66797 4.84555V5.4204C1.66797 6.28527 1.66797 6.7177 1.8843 7.07618C2.10064 7.43466 2.49586 7.65715 3.28632 8.10212L5.71384 9.46865C6.24419 9.7672 6.50936 9.91648 6.69923 10.0813C7.09462 10.4246 7.33803 10.8279 7.44834 11.3226C7.5013 11.5602 7.5013 11.8382 7.5013 12.3941L7.5013 14.6187C7.5013 15.3766 7.5013 15.7556 7.71124 16.0511C7.92118 16.3465 8.29404 16.4923 9.03976 16.7838C10.6053 17.3958 11.3881 17.7018 11.9447 17.3537C12.5013 17.0055 12.5013 16.2099 12.5013 14.6187V12.3941C12.5013 11.8382 12.5013 11.5602 12.5543 11.3226C12.6646 10.8279 12.908 10.4246 13.3034 10.0813C13.4932 9.91648 13.7584 9.7672 14.2888 9.46865L16.7163 8.10212C17.5067 7.65715 17.902 7.43466 18.1183 7.07618C18.3346 6.7177 18.3346 6.28527 18.3346 5.4204V4.84555C18.3346 3.73985 18.3346 3.187 17.9685 2.8435C17.6024 2.5 17.0131 2.5 15.8346 2.5Z"
                        stroke="#C4C4C4" stroke-width="1.5" />
                </svg>
                <input type="text" placeholder="Pesquisar"
                    class="w-[100%] p-2 rounded-lg bg-gray-800/20 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 md:p-3 md:text-lg">
            </div>
            <div class="ml-[57px]">
                <p class="text-gray-300 text-xl text-bold">#01/01/2000</p>
            </div>
            <div class="flex flex-wrap gap-16 ml-24 mt-8">
                <?php foreach ($videos as $video): ?>
                    <?= createVideoCard($video) ?>

                <?php endforeach; ?>
            </div>
        </div>
    </main>
</body>

</html>



