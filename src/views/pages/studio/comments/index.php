<?php

require_once __DIR__ . "/../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../components/utils/comments_studio/commentStudioComponent.php";
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/utils/footer.php";

use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function src\views\components\header\HeaderComponent;
use function src\views\components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\CommentStudioComponent;
use function src\views\components\Utils\Footer;
use function Src\Views\Components\Utils\InputComponent;

$comments = $_SESSION["page_data"]["comments"];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VHS Studio - Últimos comentários do vídeo</title>
  <link rel="stylesheet" href="/VHS/src/styles/global.css">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
</head>
<body>

  <?php echo HeaderComponent(); ?>

  <div class="flex">
    <?php echo StudioSideMenuComponent(); ?>

    <div class="flex-1 px-10 py-6">
        <h1 class="text-2xl font-semibold mb-2 text-white">Últimos comentários do vídeo</h1>
        <p class="text-sm text-gray-300 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
    <!-- 
      <div class="flex gap-3 mb-6">
        <?php echo ButtonComponent("Edição", "studio", "", 10.675, 2.5); ?>
        <?php echo ButtonComponent("Comentários", "studio", "", 10.675, 2.5); ?>
        <?php echo ButtonComponent("Analytics", "studio", "", 10.675, 2.5); ?>
      </div> -->

      <?= InputComponent("text", "Pesquisar", icon: "/VHS/public/icons/Filter.svg", iconPosition: "left", onClickIcon: "showFilterMenu()", className: "w-full !bg-[#15141A] text-white px-4 py-2 rounded-md border border-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-600") ?>

      <div class="w-full flex flex-col gap-4">
        <?php
        foreach ($comments as $comment){
          echo CommentStudioComponent(
            name: $comment["name"],
            text: $comment["content"],
            created_at: $comment["created_at"],
            userImg: $comment["avatar_url"],
            thumbnailURL: $comment["thumbnail_url"],
            comment_id: $comment["id"],
            creator_like: $comment["creator_like"]
          );
        };
        ?>
      </div>
    </div>

  </div>
  <?php echo Footer(); ?>
  <script src="/VHS/src/views/components/utils/comments_studio/script.js"></script>
</body>
</html>
