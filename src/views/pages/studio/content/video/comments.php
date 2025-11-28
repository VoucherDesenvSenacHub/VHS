<?php

require_once __DIR__ . "/../../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../../components/utils/comments_studio/commentStudioComponent.php";
require_once __DIR__ . "/../../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../../components/utils/footer.php";
require_once __DIR__ . "/../../../../components/filter/filter.php";
require_once __DIR__ . "/../../../../../application/utils/pagination.php";

use function Src\Application\Utils\paginate;
use function src\views\components\filter\Filter;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function src\views\components\header\HeaderComponent;
use function src\views\components\Utils\ButtonComponent;
use function src\views\components\Utils\Footer;
use function Src\Views\Components\Utils\CommentStudioComponent;
use function Src\Views\Components\Utils\InputComponent;

$video = $_SESSION["page_data"]["video"][0];
$id = $video["id"];

$comments = $_SESSION["page_data"]["comments"];
$nextPage = $_SESSION["page_data"]["next_page"];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VHS Studio - Comentários do Vídeo</title>
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="/VHS/src/styles/tailwindglobal.js"></script>
  <link rel="stylesheet" href="/VHS/src/styles/global.css">
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

        <div class="flex items-center justify-center gap-4">
          <div class="h-full pt-6">
            <?= Filter() ?>
          </div>
          <div class="w-full">
            <form method="GET">
              <?= InputComponent(
                placeholder: "Pesquisar",
                type: "text",
                name: "content",
                value: $_GET['content'] ?? ""
              ) ?>
            </form>
          </div>
        </div>

        <div class="mt-4 w-full flex flex-col gap-4">
          <?php
          foreach ($comments as $comment) {
            echo CommentStudioComponent(
              name: $comment["name"],
              text: $comment["content"],
              isVideoComments: true,
              created_at: $comment["created_at"],
              userImg: $comment["avatar_url"],
              comment_id: $comment["id"],
              creator_like: $comment["creator_like"],
              user_blocked_id: $comment["user_id"]
            );
          };
          ?>
          <div class="mb-5">
            <?= paginate($comments, $nextPage) ?>
          </div>
        </div>
      </div>
      <div class="w-[700px] p-4 pt-36 pl-20">
        <div class="p-4 rounded-xl shadow-md w-120 text-justify">
          <img src="<?= $video["thumbnail_url"] ?>" alt="Next.js 15" class="rounded-md mb-3 w-full h-70" />
          <p class="text-sm text-white font-semibold w-full"><?= $video["title"] ?></p>
          <p class="text-sm mt-1 text-gray-400 w-full"><?= $video["description"] ?></p>
        </div>
      </div>
    </div>

  </div>
  <?php echo Footer(); ?>
  <script src="/VHS/src/views/components/utils/comments_studio/script.js"></script>
</body>

</html>