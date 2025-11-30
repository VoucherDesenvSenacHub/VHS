<?php

require_once __DIR__ . "/../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/utils/comments_studio/commentStudioComponent.php";
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/filter/filter.php";

use function Src\Application\Utils\paginate;
use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function src\views\components\header\HeaderComponent;
use function Src\Views\Components\Utils\CommentStudioComponent;
use function Src\Views\Components\Utils\InputComponent;
use function src\views\components\filter\Filter;

$comments = $_SESSION["page_data"]["comments"];
$search = $_GET['content'] ?? "";

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
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#100018] to-black text-white overflow-x-hidden">
  <?= HeaderComponent(); ?>

  <div class="flex min-h-screen">
    <?= StudioSideMenuComponent(); ?>

    <main class="flex-1 p-8 w-full max-w-[1600px] mx-auto">

      <div class="mb-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
          <h1 class="text-2xl font-bold text-white">Comentários</h1>
          <p class="text-gray-400 mt-1">Gerencie os comentários do seu canal</p>
        </div>
      </div>

      <div class="flex flex-col md:flex-row gap-4 mb-8 items-center">
        <div class="w-full md:w-96">
          <form method="GET" class="w-full">
            <?= InputComponent(
              placeholder: "Pesquisar comentários...",
              type: "text",
              name: "content",
              value: $search,
              icon: "/VHS/public/icons/Filter.svg",
              iconPosition: "left"
            ) ?>
          </form>
        </div>

        <div class="flex items-center gap-2 text-sm text-gray-400 ml-auto">
          <span>Filtrar por:</span>
          <?= Filter() ?>
        </div>
      </div>

      <div class="space-y-4">
        <?php if (empty($comments)): ?>
          <div class="flex flex-col items-center justify-center py-20 text-center bg-[#121214] border border-white/5 rounded-2xl">
            <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-white mb-1">Nenhum comentário encontrado</h3>
            <p class="text-gray-400 text-sm">Seus vídeos ainda não receberam comentários ou sua busca não retornou resultados.</p>
          </div>
        <?php else: ?>
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
        <?php endif; ?>
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
  </script>
</body>

</html>