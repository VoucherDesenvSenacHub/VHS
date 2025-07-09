<?php
require "../../../components/utils/buttonComponent.php";
require "../../../components/header/headerComponent.php";
require "../../../components/utils/footer.php";
require "../../../components/sidebar/SidebarComponent.php";
require "../../../components/cards/videoCard.php";
require "../../../components/cards/channelCard.php";
require "../../../components/cards/index.php";

use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\sidebar\SidebarComponent;
use function src\views\components\header\HeaderComponent;
use function Src\Views\Components\utils\Footer;
use function Src\Views\Components\Cards\renderCards;

$dados = [
    [
        'texto' => 'pop0x',
        'link1' => 'https://www.microsoft.com/pt-br',
        'link2' => 'https://www.instagram.com/microsoft/',
        'link3' => 'https://www.office.com/',
        'Descrição' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sed lobortis urna. Suspendisse suscipit lorem in accumsan venenatis. Nunc iaculis vitae orci sed consequat. Suspendisse semper dolor urna, et dictum sem egestas egestas. Mauris dapibus aliquet neque, sit amet sodales lectus vehicula ac. Nulla non est quis tortor aliquam mollis eu et sem. Nullam tempus volutpat vestibulum. Nam porttitor fermentum est nec dapibus. Nulla cursus ante purus, at posuere justo venenatis sed. Etiam lacinia quam vitae mauris tincidunt ultricies. Maecenas ipsum dolor, blandit a sem'
    ],
    ['Seguidores' => '4.5k', 'tipo' => 'Parceiro']
];

$videos = [
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
        "type_card" => "video",
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    <title>VHS - Canal</title>
</head>

<body class="">
    <div class="flex flex-col justify-between">
        <header>
            <?= HeaderComponent(); ?>
        </header>

        <div class="flex flex-col md:flex-row w-full">
            <!-- Sidebar -->
            <div class="hidden md:block">
                <?= SidebarComponent(); ?>
            </div>

            <main class="flex flex-col flex-grow px-4 sm:px-8 md:px-12 -mt-8 max-w-[1500px] w-full mx-auto">
                <!-- Banner principal -->
                <div id="Content" class="mt-6 sm:mt-12 w-full">
                    <div class="relative rounded-2xl overflow-hidden">
                        <img src="https://i.imgur.com/Af9Zjam.png" class="w-full h-48 sm:h-64 md:h-72 lg:h-80 object-cover rounded-2xl" alt="Grande">
                    </div>
                    <div class="flex flex-col lg:flex-row w-full justify-between ">

                        <!-- Imagem de perfil sobreposta -->
                            <div class="flex flex-row">
                                <div class="w-24 h-24 sm:w-36 sm:h-36 rounded-3xl border-1 border-white/20 overflow-hidden -mt-20 md:-mt-16 ml-4 sm:ml-6 z-10 relative">
                                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiLFs8LhCWIlGFM1mpCK4Mm5pH8KCj_KGYq8LUlkx6yQJyvb1h-RQ4pnxWRf0kfUvp6FVc0zfvxTkFyQHQ59Q18kU-2bO0f6PaMlkfBCrqs3knp08P7C1dRtJEDm7c7OcPVzvWmpQagXuEf/s1600/600px-SuperMarioRun_icon.png" class=" object-cover h-full" alt="Perfil">
                                </div>
                                <div class="flex flex-col md:flex-row items-start sm:items-center mt-4 sm:mt-6 ml-4 sm:ml-6 gap-4 ">
                                    <div>
                                        <h1 class="text-white font-bold text-2xl"><?= $dados[0]['texto']; ?></h1>
                                        <p class="text-gray-300">
                                            <?= $dados[1]['Seguidores'] ?> Seguidores | <span class="text-white ml-1"><?= $dados[1]['tipo'] ?></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <div class="self-end w-96">
                            <?= ButtonComponent('Seguir', 'outline', null) ?>
                        </div>
                    </div>
                </div>
                <!-- Bio e Links -->
                <div class="flex flex-col lg:flex-row justify-between mt-6 gap-6">
                    <div class="md:w-2/3">
                        <p class="text-gray-300 text-sm sm:text-base">
                            <?= $dados[0]['Descrição'] ?>
                        </p>
                    </div>

                    <table class="text-white text-sm border-separate border-spacing-4 md:border-spacing-6">
                        <tr>
                            <td><img src="/VHS/public/icons/Union.svg" alt=""></td>
                            <td><a class="text-cyan-500 break-all" href="<?= $dados[0]['link1'] ?>"><?= $dados[0]['link1'] ?></a></td>
                        </tr>
                        <tr>
                            <td><img src="/VHS/public/icons/Vector1.svg" alt=""></td>
                            <td><a class="text-cyan-500 break-all" href="<?= $dados[0]['link2'] ?>"><?= $dados[0]['link2'] ?></a></td>
                        </tr>
                        <tr>
                            <td><img src="/VHS/public/icons/World.svg" alt=""></td>
                            <td><a class="text-cyan-500 break-all" href="<?= $dados[0]['link3'] ?>"><?= $dados[0]['link3'] ?></a></td>
                        </tr>
                    </table>
                </div>

                <!-- Grid de vídeos -->
                <div class="mt-10">
                    <h1 class="text-white font-bold text-2xl">Conteúdo do Canal</h1>
                    <p class="text-gray-300 mb-4">Confira os vídeos mais populares da nossa plataforma VHS</p>
                    <section class="mb-12">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                            <?php
                            foreach ($videos as $video) {
                                echo renderCards($cards, 'channels');
                            }
                            ?>


                        </div>

                    </section>
                </div>
            </main>
        </div>

        <footer>
            <?= Footer() ?>
        </footer>
    </div>
</body>

</html>