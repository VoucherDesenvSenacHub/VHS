<?php

require_once __DIR__ . "/../../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../../components/utils/comments_studio/commentStudioComponent.php";
require_once __DIR__ . "/../../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../../components/utils/footer.php";

use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function src\views\components\header\HeaderComponent;
use function src\views\components\Utils\ButtonComponent;
use function src\views\components\Utils\Footer;
use function Src\Views\Components\Utils\CommentStudioComponent;
use function Src\Views\Components\Utils\InputComponent;

$video = $_SESSION["page_data"]["video"][0];
$id = $video["id"];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Comentários do Vídeo</title>
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="/VHS/src/styles/global.css">
  <script src="/VHS/src/styles/tailwindglobal.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
</head>

<body class="text-white font-[Poppins]">

  <?php echo HeaderComponent(); ?>

  <div class="flex">
    <?php echo StudioSideMenuComponent(); ?>
    <div class="flex max-w-[1500px] w-full m-auto">
      <div class="flex-1 py-6">
        <h1 class="text-title font-semibold mb-2">Comentários do vídeo</h1>
        <p class="text-sm text-gray-300 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>

        <div class="flex gap-3 mb-6 w-[28rem]">
          <?php
          echo ButtonComponent(text: "Edição", variant: "studio", width: 10.675, height: 2.5, link: "/VHS/studio/content/video/edit?id=$id");
          echo ButtonComponent(text: "Comentários", variant: "studio", width: 10.675, height: 2.5, link: "/VHS/studio/content/video/comment?id=$id");
          echo ButtonComponent(text: "Analytics", variant: "studio", width: 10.675, height: 2.5, link: "/VHS/studio/content/video/analytic?id=$id");
          ?>
        </div>

        <?= InputComponent("text", "Pesquisar", icon: "/VHS/public/icons/Filter.svg", iconPosition: "left", onClickIcon: "showFilterMenu()", className: "w-full !bg-[#15141A] text-white px-4 py-2 rounded-md border border-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-600") ?>

        <div class="mt-4 w-full flex flex-col gap-4">
          <?php
          for ($i = 0; $i < 8; $i++) {
            echo CommentStudioComponent("Richard Stallman", "Adorei seu projeto Freitas! Você é foda! Uma pena da sua equipe!", "", "https://media.wired.com/photos/5d815ffe46103c0009de8d56/16:9/w_2400,h_1350,c_limit/science_stallman_473688628.jpg", isVideoComments: true);
          }
          ?>
        </div>
      </div>
      <div class="w-[700px] p-4 pt-36 pl-20">
        <div class="p-4 rounded-xl shadow-md ">
          <img src="<?= $video["thumbnail_url"] ?>" alt="Next.js 15" class="rounded-md mb-3 w-120 h-70" />
          <p class="text-sm text-white font-semibold"><?= $video["title"] ?></p>
          <p class="text-sm mt-1 text-gray-400 w-120"><?= $video["description"] ?></p>
        </div>
      </div>
    </div>

  </div>
  <?php echo Footer(); ?>
</body>

</html>