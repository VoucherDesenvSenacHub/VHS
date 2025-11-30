<?php

require_once __DIR__ . "/../../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../../components/utils/comments_studio/commentStudioComponent.php";
require_once __DIR__ . "/../../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../../components/utils/footer.php";
require_once __DIR__ . "/../../../../../application/utils/pagination.php";

use function Src\Application\Utils\paginate;
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
$search = $_SESSION["page_data"]["search"] ?? '';
$sort = $_SESSION["page_data"]["sort"] ?? 'desc';

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
  <div>
    <?= HeaderComponent(); ?>
  </div>

  <div class="flex">
    <div class="max-lg:hidden">
      <?= StudioSideMenuComponent() ?>
    </div>

    <div class="flex max-w-[1500px] w-full m-auto p-4 md:p-0 md:px-3 ">
      <div class="flex-1 py-6">
        <div class="flex flex-col">
          <h1 class="font-semibold xl:text-title text-2xl text-white text-center md:text-start">Comentários do vídeo</h1>
          <div class="mt-4 flex gap-3 w-full flex-col md:gap-2 md:w-96 md:flex-row">
            <?php
            echo ButtonComponent(text: "Edição", variant: "studio", className: "sm:w-full md:w-[10.675rem] lg:h-[2.5rem]", link: "/VHS/studio/content/video/edit?id=$id");
            echo ButtonComponent(text: "Comentários", variant: "studio", className: "sm:w-full md:w-[10.675rem] lg:h-[2.5rem]", link: "/VHS/studio/content/video/comment?id=$id");
            echo ButtonComponent(text: "Analytics", variant: "studio", className: "sm:w-full md:w-[10.675rem] lg:h-[2.5rem]", link: "/VHS/studio/content/video/analytic?id=$id");
            ?>
          </div>
        </div>

        <form method="GET" class="flex items-center justify-center gap-4 mt-4">
          <?php foreach ($_GET as $key => $value): ?>
            <?php if ($key !== "search"): ?>
              <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value) ?>">
            <?php endif; ?>
          <?php endforeach; ?>

          <div class="relative w-full cursor-pointer">
            <?= InputComponent(
              placeholder: "Pesquisar",
              type: "text",
              icon: "/VHS/public/icons/Filter.svg",
              name: "search",
              value: $search,
              iconPosition: "left",
              onClickIcon: "showFilterMenu()"
            ) ?>

            <?php $currentQuery = $_GET; ?>

            <div id="filter" class="absolute right-0 top-full mt-2 z-10 hidden flex flex-col bg-[#2A2A2C] rounded-lg p-2 w-48 gap-2 shadow-xl">
              <a href="?<?= http_build_query(array_merge($currentQuery, ['sort' => 'desc'])) ?>"
                class="flex items-center gap-2 p-1 rounded hover:bg-white/5 transition-colors cursor-pointer group">

                <img src="/VHS/public/icons/time-svgrepo-com.svg"
                  alt=""
                  class="size-5 rotate-[-110deg] opacity-50 group-hover:opacity-100 transition-opacity <?= $sort === 'desc' ? 'opacity-100' : '' ?>">

                <p class="text-[13px] font-poppins text-gray-200 <?= $sort === 'desc' ? 'text-white font-medium' : '' ?>">
                  Mais recentes
                </p>
              </a>

              <a href="?<?= http_build_query(array_merge($currentQuery, ['sort' => 'asc'])) ?>"
                class="flex items-center gap-2 p-1 rounded hover:bg-white/5 transition-colors cursor-pointer group">

                <img src="/VHS/public/icons/time-svgrepo-com.svg"
                  class="size-5 opacity-50 group-hover:opacity-100 transition-opacity <?= $sort === 'asc' ? 'opacity-100' : '' ?>"
                  alt="">

                <p class="text-[13px] font-poppins text-gray-200 <?= $sort === 'asc' ? 'text-white font-medium' : '' ?>">
                  Mais antigos
                </p>
              </a>
            </div>
          </div>
        </form>

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
      <div class="w-[700px] p-4 pt-36 pl-20 max-xl:hidden">
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
  <script defer>
    const input = document.querySelector("input[name='search']");
    let timeout = null;

    input.addEventListener("input", () => {
      clearTimeout(timeout);

      timeout = setTimeout(() => {
        input.form.submit();
      }, 1500);
    });

    function showFilterMenu() {
      const filter = document.getElementById('filter');
      filter.classList.toggle('hidden');
    }
  </script>
</body>

</html>