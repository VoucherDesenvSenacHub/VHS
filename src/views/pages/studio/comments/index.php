<?php

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/studioSideMenu/studioSideMenuComponent.php";
use function src\views\components\studioSideMenu\StudioSideMenuComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/header/headerComponent.php";
use function src\views\components\header\HeaderComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/buttonComponent.php";
use function src\views\components\Utils\ButtonComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/comments_studio/commentStudioComponent.php";
use function Src\Views\Components\Utils\CommentStudioComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/footer.php";
use function src\views\components\Utils\Footer;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VHS Studio - Últimos comentários do vídeo</title>
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
</head>
<body class="bg-gradient-to-b from-[#20002c] via-black to-[#20002c] min-h-screen text-white font-[Poppins]">

  <?php echo HeaderComponent(); ?>

  <div class="flex">
    <?php echo StudioSideMenuComponent(); ?>

    <div class="flex-1 px-10 py-6">
        <h1 class="text-2xl font-semibold mb-2">Últimos comentários do vídeo</h1>
        <p class="text-sm text-gray-300 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
    <!-- 
      <div class="flex gap-3 mb-6">
        <?php echo ButtonComponent("Edição", "studio", "", "170px", "40px"); ?>
        <?php echo ButtonComponent("Comentários", "studio", "", "170px", "40px"); ?>
        <?php echo ButtonComponent("Analytics", "studio", "", "170px", "40px"); ?>
      </div> -->

      <div class="mb-6 flex gap-3">
        <img class="w-8 h-8 pt-2" src="/VHS/public/icons/Filter.svg" alt="">
        <input type="text" placeholder="Pesquisar" class="w-full bg-[#15141A] text-white px-4 py-2 rounded-md border border-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-600">
      </div>

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
