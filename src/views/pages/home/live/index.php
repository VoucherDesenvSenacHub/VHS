<?php 

require "../../../components/header/headerComponent.php";
require "../../../components/sidebar/SidebarComponent.php";
require "../../../components/cards/index.php";
require "../../../components/starrating/StarRatingComponent.php";
require "../../../components/shared/shared.php";

use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;
use function Src\Views\Components\Cards\renderCards;
use function Src\Views\Components\starrating\StarRatingComponent;
use function Src\Views\Components\Shared\sharedComponent;

$link = 'https://www.youtube.com/embed/Qjk-cSW-jk4?si=D_1dC9a8td9k1VnJ';
$title = 'Entendendo Back-End para Iniciantes em Programação (Parte 1) | Série "Começando aos 40';
$subtitle = 'Este é o 5o episódio da série "Começando aos 40". Você deve assistir os episódios anteriores da série pra entender onde estamos e recomendo assistir os 2 vídeos da série "Sua Linguagem Não É Especial". No episódio de hoje vou começar a introduzir os conceitos básicos para o que chamamos de "back-end", que na prática é a própria introdução à programação.';

$cards = [
    [
        "type_card" => "event",
        "title" => "Como aprender programação do zero e se tornar um excelente desenvolvedor full stack",
        "duration" => "🔥",
        "username" => "Rafael Germinari",
        "thumbnail_url" => "https://t.ctcdn.com.br/69rFkwz-cdviPGZn2p_l6rJH0UA=/1200x675/smart/i533291.png",
        "avatar_url" => "https://senachub.ms.senac.br/hubinnovation/uploads/fotos/6706850e20f59.jpg",
        "views" => "53m",
        "created_at" => "há 3 dias",
        "url" => "#",
        "description" => "Gratuito",
        "maked_for" => "09/08 17:15"
    ],
];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>VHS - Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="/VHS/src/styles/global.css">
  <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
</head>
<body class="bg-gradient-to-b from-[#20002c] to-black text-white">

  <header class="w-full">
    <?= HeaderComponent() ?>
  </header>

  <div class="flex">

    <aside class="w-[240px]">
      <?= SidebarComponent() ?>
    </aside>

    <main class="flex-1 p-4">

     <div class="max-w-[1500px] mx-auto w-full">
        <div class="rounded-lg">
          <iframe
            class="w-[1500px] h-[400px] md:h-[573px] rounded-lg"
            src="<?= $link ?>"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen
          ></iframe>
        </div>
        <div class="flex gap-[23rem]">
            <div class="w-[1000px]">
                <h2 class="mt-4 text-xl font-semibold"><?= $title ?></h2>
                <p class="mt-2 text-sm text-gray-300 whitespace-pre-line"><?= $subtitle ?></p>
            </div>
            <div class="mt-5 flex flex-col">
              <div class="flex">
                  <img class="w-6 h-6 mr-3 cursor-pointer" src="/VHS/public/icons/Share.svg" alt="ShareButton" onclick="openShared()" name="send">
                  <?= sharedComponent('https://www.youtube.com/watch?v=Qjk-cSW-jk4','Sla')?>
                  <?= StarRatingComponent() ?>
              </div>
              <p class="mt-2 ml-[7.7rem] text-xs text-red-500 whitespace-pre-line">AO VIVO</p>
            </div>
        </div>
        <div class="flex items-center mt-10 gap-3">
          <img src="https://yt3.googleusercontent.com/ytc/AIdro_l9jtAcERHIts0q6LsUtmAGPzQ8p8FzKGAoYRJ1N3Wz3Hs0=s160-c-k-c0x00ffffff-no-rj" alt="Autor" class="w-[67px] h-[68px] rounded-xl">
          <div>
            <p class="text-sm font-bold">Fabio Akita</p>
            <p class="text-xs text-gray-400">260 mil seguidores</p>
            <button class="bg-gray-900 text-gray-300 font-bold py-1 px-2 rounded-full hover:bg-gray-800 text-[10px] mt-1">#Tecnologia</button>
          </div>
        </div>
      </div>
      <div class="flex flex-col lg:flex-row gap-6 mt-8 max-w-[1500px] mx-auto w-full">

        <div class="w-full lg:flex-[2] rounded-lg">
          <div class="flex flex-col">
            <h3 class="text-2xl font-semibold"># Eventos que irão acontecer🔥</h3>
            <p class="mb-5 text-sm text-gray-300 whitespace-pre-line">Confira os vídeos mais populares da nossa plataforma VHS</p>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <?php for ($i = 0; $i < 4; $i++) {
              renderCards($cards, 'event');
            } ?>
          </div>
        </div>
      </div>

    </main>
  </div>
</body>
</html>




