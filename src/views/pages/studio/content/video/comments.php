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

<body class="w-full min-h-screen bg-gradient-to-b from-[#100018] to-black text-white overflow-x-hidden font-[Poppins]">
  <?= HeaderComponent(); ?>

  <div class="flex flex-col md:flex-row w-full">
    <div class="hidden md:block">
      <?= StudioSideMenuComponent() ?>
    </div>

    <main class="flex-1 p-8 w-full max-w-[1600px] mx-auto">

      <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 mb-8">
        <div>
          <h1 class="text-2xl font-bold text-white">Comentários do vídeo</h1>
          <p class="text-gray-400 mt-1">Gerencie os comentários do seu vídeo</p>
        </div>

        <div class="flex p-1 bg-[#121214] border border-white/5 rounded-xl">
          <a href="/VHS/studio/content/video/edit?id=<?= $id ?>" class="px-6 py-2 rounded-lg text-sm font-medium text-gray-400 shadow-lg transition-all">
            Edição
          </a>
          <a href="/VHS/studio/content/video/comment?id=<?= $id ?>" class="px-6 py-2 rounded-lg text-sm font-medium text-white bg-purple-600 hover:text-white hover:bg-white/5 transition-all">
            Comentários
          </a>
          <a href="/VHS/studio/content/video/analytic?id=<?= $id ?>" class="px-6 py-2 rounded-lg text-sm font-medium text-gray-400 hover:text-white hover:bg-white/5 transition-all">
            Analytics
          </a>
        </div>
      </div>

      <!-- Video Specific Comments Layout -->
      <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        <!-- Left Column (Comments List) -->
        <div class="xl:col-span-2 space-y-6">

          <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 shadow-xl">
            <form method="GET" class="flex items-center justify-between gap-4 mb-6">
              <?php foreach ($_GET as $key => $value): ?>
                <?php if ($key !== "search"): ?>
                  <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value) ?>">
                <?php endif; ?>
              <?php endforeach; ?>

              <div class="relative w-full">
                <?= InputComponent(
                  placeholder: "Pesquisar comentários",
                  type: "text",
                  icon: "/VHS/public/icons/Filter.svg",
                  name: "search",
                  value: $search,
                  iconPosition: "left",
                  onClickIcon: "showFilterMenu()",
                  width: "full"
                ) ?>

                <?php $currentQuery = $_GET; ?>

                <div id="filter" class="absolute right-0 top-full mt-2 z-50 hidden flex flex-col bg-[#2A2A2C] rounded-lg p-2 w-48 gap-2 shadow-xl">
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

            <div class="w-full flex flex-col gap-4">
              <?php
              if (empty($comments)) {
                echo '
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mb-6 animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Nenhum comentário encontrado</h3>
                    <p class="text-gray-400 max-w-md mx-auto">Este vídeo ainda não tem comentários. Seja o primeiro a engajar com seu público!</p>
                </div>';
              } else {
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
              }
              ?>
              <div class="mb-5">
                <?= paginate($comments, $nextPage) ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column (Video Info) -->
        <div class="xl:col-span-1">
          <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 shadow-xl sticky top-24">
            <div class="relative aspect-video rounded-xl overflow-hidden mb-4 group">
              <img src="<?= htmlspecialchars($video["thumbnail_url"] ?? "") ?>" alt="" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
              <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors"></div>
            </div>

            <h3 class="text-xl font-bold text-white mb-2 line-clamp-2"><?= $video["title"] ?? "" ?></h3>

            <div class="flex items-center gap-4 text-sm text-gray-400 mb-4 border-b border-white/5 pb-4">
              <span class="flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <?= $video['views'] ?? 0 ?>
              </span>
              <span class="flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <?= $video['comments'] ?? 0 ?>
              </span>
            </div>

            <div class="space-y-4">
              <div>
                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-1">Descrição</h4>
                <p class="text-sm text-gray-300 leading-relaxed line-clamp-6 hover:line-clamp-none transition-all">
                  <?= $video['description'] ?? "Sem descrição" ?>
                </p>
              </div>
            </div>
          </div>
        </div>

      </div>

    </main>
  </div>
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