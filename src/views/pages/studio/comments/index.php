<?php

require_once __DIR__ . "/../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../components/utils/comments_studio/commentStudioComponent.php";
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/utils/footer.php";
require_once __DIR__ . "/../../../../application/utils/pagination.php";
require_once __DIR__ . "/../../../components/filter/filter.php";

use function Src\Application\Utils\paginate;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function src\views\components\header\HeaderComponent;
use function src\views\components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\CommentStudioComponent;
use function src\views\components\Utils\Footer;
use function Src\Views\Components\Utils\InputComponent;
use function src\views\components\filter\Filter;

$comments = $_SESSION["page_data"]["comments"];
$nextPage = $_SESSION["page_data"]["next_page"];

$title = 'Últimos comentários do video';
if (isset($_GET["ordering"])) $title = 'Primeiros comentários do video';
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

  <div class="flex ">
    <div class="hidden md:block">
            <?= StudioSideMenuComponent() ?>
        </div>

    <div class="flex flex-col gap-4 max-w-[1500px] mx-auto w-full px-6 pt-[1.18rem]">
      <div class="flex-col gap-4">
          <h1 class="text-2xl font-semibold text-white"><?=$title?></h1>
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

      <div class="w-full flex flex-col gap-4">
        <?php
        foreach ($comments as $comment) {
          echo CommentStudioComponent(
            name: $comment["name"],
            text: $comment["content"],
            created_at: $comment["created_at"],
            userImg: $comment["avatar_url"],
            thumbnailURL: $comment["thumbnail_url"],
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

  </div>
  <?php echo Footer(); ?>
  <script src="/VHS/src/views/components/utils/comments_studio/script.js"></script>
</body>

</html>