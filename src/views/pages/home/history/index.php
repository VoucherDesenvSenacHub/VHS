<?php
$history = $_SESSION["page_data"]["history"] ?? [];

require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/sidebar/SidebarComponent.php";
require_once __DIR__ . "/../../../components/cards/index.php";
require_once __DIR__ . "/../../../components/featuredCard/featuredCardComponent.php";
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";

use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;
use function Src\Views\Components\Cards\viewCards;
use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\InputComponent;
use function Views\Components\FeaturedCard\FeaturedCardComponent;

$type = $_GET["type"] ?? "video";
$filter = isset($_GET['filter']) ? htmlspecialchars($_GET['filter']) : 'videos';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VHS - Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="/VHS/src/styles/global.css">
  <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
  <script src="/VHS/src/views/pages/home/history/script.js" defer></script>
  <style>
    .line-clamp-2 {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
  </style>
</head>
<body>
  <div>
    <?= HeaderComponent() ?>
  </div>

  <div class="flex flex-col md:flex-row w-full">
    <div class="hidden md:block">
      <?= SidebarComponent() ?>
    </div>

    <main class="flex-1 px-4 sm:px-6 py-4 mx-auto">
      <div class="max-w-[1500px] mx-auto">
        <section class="mb-12">
          <h2 class="text-2xl font-bold text-white mb-2">
            <span class="text-purple-400">#</span> Histórico
          </h2>
          <p class="text-gray-400 text-sm mb-6">
            Confira os vídeos que você já assistiu!
          </p>

          <div class="flex gap-2 max-w-96 mb-4">
            <?= ButtonComponent("Vídeos", "studio", "", 10.675, 2.5, 1, "?filter=videos") ?>
            <?= ButtonComponent("Fast", "studio", "", 10.675, 2.5, 1, "?filter=fasts") ?>
            <?= ButtonComponent("Eventos", "studio", "", 10.675, 2.5, 1, "?filter=events") ?>
          </div>

          <div class="relative">
            <ul class="flex flex-col gap-3 bg-gray600 p-2 pr-4 filter-menu absolute z-10 top-16 hidden rounded-xl border border-white/20">
              <li class="text-white font-medium flex text-base gap-2 items-center ml-1 cursor-pointer">
                <img src="/VHS/public/icons/clock.svg" class="w-5 h-5" />
                <p>Mais recentes</p>
              </li>
              <li class="text-white font-medium flex text-base gap-2 items-center ml-1 cursor-pointer">
                <img src="/VHS/public/icons/clock2.svg" class="w-5" />
                <p>Mais antigos</p>
              </li>
            </ul>

            <?= InputComponent("text", "Pesquisar", icon: "/VHS/public/icons/Filter.svg", iconPosition: "left", onClickIcon: "showFilterMenu()") ?>
          </div>

          <br>

          <?php foreach ($history as $date => $items): ?>

            <div class="mb-8">

              <h3 class="text-secondary text-xl font-medium mb-4">

                # <?= $date ?>

              </h3>

              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

                <?= viewCards($items, $filter) ?>

              </div>
              
            </div>

          <?php endforeach; ?>
        </section>
      </div>
    </main>
  </div>
</body>
</html>
