<?php
require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/studioSideMenu/studioSideMenuComponent.php";
use function src\views\components\studioSideMenu\StudioSideMenuComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/header/headerComponent.php";
use function src\views\components\header\HeaderComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/buttonComponent.php";
use function src\views\components\Utils\ButtonComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/comments_studio/commentStudioComponent.php";

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/inputComponent.php";

use function src\views\components\Utils\Comment_Studio;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/footer.php";
use function src\views\components\Utils\Footer;
use function Src\Views\Components\Utils\CommentStudioComponent;
use function Src\Views\Components\Utils\Comment;
use function Src\Views\Components\Utils\InputComponent;

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
            echo ButtonComponent("Edição", "studio", "", 10.675, 2.5,"",'/VHS/src/views/pages/studio/content/video');
            echo ButtonComponent("Comentários", "studio", "", 10.675, 2.5,"","/VHS/src/views/pages/studio/content/video/comments.php");
            echo ButtonComponent("Analytics", "studio", "", 10.675, 2.5,"","/VHS/src/views/pages/studio/content/video/analytics.php");
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
        <img src="https://imagedelivery.net/lLmNeOP7HXG0OqaG97wimw/cluqyx1rl0000l5ds3f0vkfer/79b4e6f2-a6c2-42fe-b705-69475f630ed1.png/public" alt="Next.js 15" class="rounded-md mb-3 w-120 h-70" />
        <p class="text-sm text-white font-semibold">Tudo sobre o Next.js 15, nova arquitetura de pasta!</p>
        <p class="text-sm mt-1 text-gray-400"># 💅✨📦💅</p>
      </div>
    </div>
    </div>

  </div>
  <?php echo Footer(); ?>
</body>
</html>
