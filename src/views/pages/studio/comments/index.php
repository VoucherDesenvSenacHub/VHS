<?php

require_once __DIR__ . "/../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/utils/comments_studio/commentStudioComponent.php";
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/filter/filter.php";
require_once __DIR__ . "/../../../../application/utils/pagination.php";

use function Src\Application\Utils\paginate;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function src\views\components\header\HeaderComponent;
use function Src\Views\Components\Utils\CommentStudioComponent;
use function Src\Views\Components\Utils\InputComponent;
use function src\views\components\filter\Filter;

$comments = $_SESSION["page_data"]["comments"];
$nextPage = $_SESSION["page_data"]["next_page"];
$search = $_GET['content'] ?? "";
$sort = $_GET['sort'] ?? "desc";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VHS Studio - Comentários</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="/VHS/src/styles/tailwindglobal.js"></script>
  <link rel="stylesheet" href="/VHS/src/styles/global.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#100018] to-black text-white overflow-x-hidden font-[Poppins]">
  <?= HeaderComponent(); ?>

  <div class="flex flex-col md:flex-row w-full">
    <div>
      <?= StudioSideMenuComponent() ?>
    </div>

    <main class="flex-1 p-4 md:p-8 w-full max-w-[1600px] mx-auto">

      <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
        <div>
          <h1 class="text-2xl font-bold text-white">Comentários do Canal</h1>
          <p class="text-gray-400 mt-1">Gerencie todos os comentários dos seus vídeos em um só lugar</p>
        </div>
      </div>

      <div class="bg-[#121214] border border-white/5 rounded-2xl p-6 shadow-xl">

        <div class="flex flex-col md:flex-row gap-4 mb-8 items-center justify-between">
          <div class="w-full">
            <form method="GET" class="w-full relative">
              <div class="relative w-full">
                <?= InputComponent(
                  placeholder: "Pesquisar comentários...",
                  type: "text",
                  name: "content",
                  value: $search,
                  icon: "/VHS/public/icons/Filter.svg",
                  iconPosition: "right",
                  onClickIcon: "showFilterMenu()",
                  width: "full"
                ) ?>

                <?= Filter($search, $sort) ?>

                <?php $currentQuery = $_GET; ?>

                <div id="filter" class="absolute right-0 top-full mt-2 z-50 hidden flex flex-col bg-[#2A2A2C] rounded-lg p-2 w-48 gap-2 shadow-xl border border-white/5">
                  <a href="?<?= http_build_query(array_merge($currentQuery, ['sort' => 'desc'])) ?>"
                    class="flex items-center gap-2 p-2 rounded hover:bg-white/5 transition-colors cursor-pointer group">

                    <img src="/VHS/public/icons/time-svgrepo-com.svg"
                      alt=""
                      class="size-5 rotate-[-110deg] opacity-50 group-hover:opacity-100 transition-opacity">

                    <p class="text-[13px] font-poppins text-gray-200 group-hover:text-white font-medium transition-colors">
                      Mais recentes
                    </p>
                  </a>

                  <a href="?<?= http_build_query(array_merge($currentQuery, ['sort' => 'asc'])) ?>"
                    class="flex items-center gap-2 p-2 rounded hover:bg-white/5 transition-colors cursor-pointer group">

                    <img src="/VHS/public/icons/time-svgrepo-com.svg"
                      class="size-5 opacity-50 group-hover:opacity-100 transition-opacity"
                      alt="">

                    <p class="text-[13px] font-poppins text-gray-200 group-hover:text-white font-medium transition-colors">
                      Mais antigos
                    </p>
                  </a>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="space-y-4">
          <?php if (empty($comments)): ?>
            <div class="flex flex-col items-center justify-center py-20 text-center">
              <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mb-6 animate-pulse">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
              </div>
              <h3 class="text-xl font-bold text-white mb-2">Nenhum comentário encontrado</h3>
              <p class="text-gray-400 max-w-md mx-auto">Parece que seus vídeos ainda não receberam comentários ou sua busca não retornou resultados. Continue criando conteúdo incrível!</p>
            </div>
          <?php else: ?>
            <div class="flex flex-col gap-4">
              <?php foreach ($comments as $comment): ?>
                <?= CommentStudioComponent(
                  name: $comment["name"],
                  text: $comment["content"],
                  created_at: $comment["created_at"],
                  userImg: $comment["avatar_url"],
                  thumbnailURL: $comment["thumbnail_url"],
                  comment_id: $comment["id"],
                  creator_like: $comment["creator_like"],
                  user_blocked_id: $comment["user_id"]
                ) ?>
              <?php endforeach; ?>
            </div>
            <div class="mb-5">
              <?= paginate($comments, $nextPage) ?>
            </div>
          <?php endif; ?>
        </div>
      </div>

    </main>
  </div>

  <script src="/VHS/src/views/components/utils/comments_studio/script.js"></script>
  <script defer>
    const input = document.querySelector("input[name='content']");
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