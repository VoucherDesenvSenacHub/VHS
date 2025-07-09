<?php

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/studioSideMenu/studioSideMenuComponent.php";
use function src\views\components\studioSideMenu\StudioSideMenuComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/header/headerComponent.php";
use function src\views\components\header\HeaderComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/buttonComponent.php";
use function src\views\components\Utils\ButtonComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/comments_studio/commentStudioComponent.php";
use function Src\Views\Components\Utils\CommentStudioComponent;
require_once "../../../components/utils/inputComponent.php";

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/footer.php";
use function src\views\components\Utils\Footer;
use function Src\Views\Components\Utils\InputComponent;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VHS Studio - Últimos comentários do vídeo</title>
  <link rel="stylesheet" href="/VHS/src/styles/global.css">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
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
        for ($i = 0; $i < 8; $i++) {
          echo CommentStudioComponent(
            "Celestino",
            "Muito emocionante! Eu sei! Não teria coragem de entrar nessas casas como você kkk Tudo sobre o Next.js 15, nova arquitetura de pasta!",
            "há 5 dias",
            null,
            "https://i.ibb.co/v6xs3ZB6/CUUJVx-Nyw4c-HD-5.jpg"
          );
        }
        ?>
      </div>
    </div>

  </div>
  <?php echo Footer(); ?>
</body>
</html>
