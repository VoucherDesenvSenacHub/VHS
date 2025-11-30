<?php

require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/sidebar/index.php";
require_once __DIR__ . "/../../../components/cards/index.php";
require_once __DIR__ . "/../../../components/utils/comments/comentaryComponent.php";
require_once __DIR__ . "/../../../components/starrating/StarRatingComponent.php";
require_once __DIR__ . "/../../../components/shared/shared.php";
require_once __DIR__ . "/../../../../application/utils/formatViews.php";
require_once __DIR__ . "/../../../../application/utils/pagination.php";
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../components/utils/sweetalert.php";

use function Src\Application\Utils\formatViews;
use function Src\Application\Utils\paginate;
use function Src\Application\Utils\showSweetAlert;
use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\Sidebar\SidebarComponent;
use function Src\Views\Components\Cards\viewCards;
use function Src\Views\Components\Utils\Comment;
use function Src\Views\Components\starrating\StarRatingComponent;
use function Src\Views\Components\Shared\sharedComponent;
use function Src\Views\Components\Utils\InputComponent;

$video = $_SESSION["page_data"]["video"];
$releatedVideos = $_SESSION["page_data"]["releated_videos"];
$user_avaliation = $_SESSION["page_data"]["user_avaliation"];
$comments = $_SESSION["page_data"]["comments"];
$nextPageComments = $_SESSION["page_data"]["next_page_comments"];
$totalComments = $_SESSION["page_data"]["total_comments"];
$isFollowing = $_SESSION["page_data"]["is_following"] ?? false;
$video["avatar_url"] = "/VHS/public/uploads/avatars/" . $video["avatar_url"] ?? "/VHS/public/uploads/avatars/default.png";

if ($_SESSION["redirect_data"]["success"] ?? false) {
  echo showSweetAlert($_SESSION["redirect_data"]["success"], "", "success");
  unset($_SESSION["redirect_data"]["success"]);
}

if ($_SESSION["redirect_data"]["errors"] ?? false) {
  echo showSweetAlert($_SESSION["redirect_data"]["errors"], "", "error");
  unset($_SESSION["redirect_data"]["errors"]);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>VHS - <?= htmlspecialchars($video['title']) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="/VHS/src/styles/global.css">
  <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gradient-to-b from-[#20002c] to-black text-white min-h-screen">

  <header class="w-full fixed top-0 z-50 bg-[#20002c]">
    <?= HeaderComponent() ?>
  </header>

  <div class="flex pt-20">

    <div class="hidden md:block">
      <?= SidebarComponent() ?>
    </div>

    <main class="flex-1 p-4 max-w-[1600px] mx-auto w-full">

      <div class="flex flex-col lg:flex-row gap-6">

        <!-- Main Content (Video, Info, Comments) -->
        <div class="w-full lg:flex-[3]">
          <!-- Video Player -->
          <div class="w-full aspect-video bg-black rounded-xl overflow-hidden shadow-2xl mb-4">
            <iframe
              class="w-full h-full"
              src="<?= $video['url'] ?>"
              title="<?= htmlspecialchars($video['title']) ?>"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              referrerpolicy="strict-origin-when-cross-origin"
              allowfullscreen></iframe>
          </div>

          <!-- Title -->
          <h1 class="text-xl md:text-2xl font-bold mb-4"><?= $video["title"] ?></h1>

          <!-- Channel & Actions -->
          <div class="flex flex-col items-start gap-4 mb-6">
            <div class="flex flex-wrap xl:items-center gap-8">
              <a href="/VHS/home/channel?username=<?= $video['username'] ?>" class="flex items-center gap-3 group">
                <img src="<?= $video['avatar_url'] ?>"
                  onerror="this.src='/VHS/public/uploads/avatars/default.png'"
                  class="w-10 h-10 md:w-12 md:h-12 rounded-full object-cover border border-transparent group-hover:border-purple-500 transition-all">
                <div>
                  <p class="font-bold text-sm md:text-base group-hover:text-purple-400 transition-colors">
                    <?= $video["username"] ?>
                  </p>
                  <p class="text-xs text-gray-400">
                    <?= $video["followers"] ?? "0" ?> seguidores
                  </p>
                </div>
              </a>

              <!-- Subscribe Button -->
              <?php if (!isset($_SESSION['user']) || $video['author_id'] != $_SESSION['user']['id']): ?>
                <div id="subscribeContainer" onclick="toggleSubscribe('<?= $video['author_id'] ?>')">
                  <?= ButtonComponent(
                    text: $isFollowing ? 'Inscrito' : 'Inscrever-se',
                    variant: $isFollowing ? 'default' : 'outline',
                    height: 2.5,
                    className: " px-10 text-sm " . ($isFollowing ? "bg-purple-700 hover:bg-purple-800" : "")
                  ) ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto self-end">
              <div class="flex items-center bg-[#1F1F22] rounded-full px-2 py-1">
                <?= StarRatingComponent([
                  "initial_rating" => $user_avaliation,
                ]) ?>
              </div>

              <button class="flex items-center gap-2 bg-[#1F1F22] hover:bg-[#3F3F46] px-4 py-2 rounded-full transition-colors" onclick="toggleTheaterMode()" title="Modo Teatro">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                </svg>
              </button>

              <button class="flex items-center gap-2 bg-[#1F1F22] hover:bg-[#3F3F46] px-4 py-2 rounded-full transition-colors" onclick="openShared(event, '<?= $video['id'] ?>')">
                <img class="w-5 h-5" src="/VHS/public/icons/share.svg" alt="Share">
                <span class="text-sm font-medium">Compartilhar</span>
              </button>

              <?= sharedComponent($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], $video["title"], $video["id"]) ?>
            </div>
          </div>

          <!-- Description Box -->
          <div class="bg-[#1F1F22] p-4 rounded-xl mb-6 hover:bg-[#27272A] transition-colors cursor-pointer group" onclick="this.classList.toggle('line-clamp-none')">
            <div class="flex gap-2 text-sm font-bold mb-2 text-white">
              <span><?= formatViews($video["views"] ?? 0) ?> visualizações</span>
              <span class="text-gray-400">•</span>
              <span class="text-gray-400">#<?= $video["category_name"] ?></span>
            </div>
            <p class="text-sm text-gray-300 whitespace-pre-line leading-relaxed description-text line-clamp-3 group-hover:text-white transition-colors">
              <?= $video["description"] ?>
            </p>
            <button class="text-sm text-gray-400 mt-2 font-medium hover:text-white" onclick="event.stopPropagation(); this.parentElement.querySelector('.description-text').classList.toggle('line-clamp-3'); this.innerText = this.innerText === 'Mostrar mais' ? 'Mostrar menos' : 'Mostrar mais'">Mostrar mais</button>
          </div>

          <!-- Comments Section -->
          <div id="comments" class="w-full">
            <h3 class="text-xl font-bold mb-6"><?= $totalComments ?> Comentários</h3>

            <!-- Comment Form -->
            <div class="flex gap-4">
              <img src="<?= isset($_SESSION['user']['avatar_url']) ? '/VHS/public/uploads/avatars/' . $_SESSION['user']['avatar_url'] : '/VHS/public/uploads/avatars/default.png' ?>"
                class="w-10 h-10 rounded-full object-cover">
              <form action="/VHS/api/v1/comment?videoId=<?= $_GET["id"] ?>" method="post" class="flex-1">
                <div class="border-b border-gray-700 focus-within:border-white transition-colors">
                  <input type="text" name="content" placeholder="Adicione um comentário..." class="w-full bg-transparent p-2 focus:outline-none text-white placeholder-gray-500" autocomplete="off">
                </div>
                <div class="flex justify-end mt-2">
                  <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-full text-sm font-medium transition-colors">Comentar</button>
                </div>
              </form>
            </div>

            <!-- Comments List -->
            <div class="flex flex-col gap-6">
              <?php
              foreach ($comments as $comment) {
                echo Comment($comment["id"], $comment["username"], $comment["content"], $comment["created_at"], $comment["avatar_url"], $comment["creator_like"]);
              }
              ?>
            </div>

            <div class="mt-6">
              <?= paginate($comments, $nextPageComments) ?>
            </div>
          </div>
        </div>

        <!-- Sidebar (Related Videos) -->
        <div class="w-full lg:flex-1 transition-all duration-300" id="related-videos">
          <h3 class="text-lg font-bold mb-4 hidden lg:block">Recomendados</h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4 grid-videos">
            <?= viewCards($releatedVideos, 'videos'); ?>
          </div>
        </div>

      </div>

    </main>
  </div>

  <script src='/VHS/src/views/components/utils/comments/script.js'></script>

  <script>
    function toggleTheaterMode() {
      const mainContainer = document.querySelector('main > div'); // The flex container
      const videoSection = mainContainer.children[0]; // The video/info section
      const sidebarSection = document.getElementById('related-videos');
      const videoPlayerContainer = videoSection.querySelector('.aspect-video');
      const gridVideos = document.querySelector('.grid-videos');

      // Toggle classes for theater mode
      mainContainer.classList.toggle('lg:flex-col');
      mainContainer.classList.toggle('flex-col');
      gridVideos.classList.toggle('lg:grid-cols-3');

      videoSection.classList.toggle('lg:flex-[3]');
      videoSection.classList.toggle('w-full');

      sidebarSection.classList.toggle('lg:flex-1');
      sidebarSection.classList.toggle('w-full');
      sidebarSection.classList.toggle('lg:w-full'); // Ensure full width when stacked

      // Optional: Scroll to top to see full video
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    }

    async function toggleSubscribe(followingId) {
      const container = document.getElementById('subscribeContainer');
      const btn = container.querySelector('button') || container.querySelector('div');
      const isFollowing = btn.innerText.trim() === 'Inscrito';
      const url = isFollowing ? '/VHS/api/v1/json/user/unfollow' : '/VHS/api/v1/json/user/follow';

      try {
        const response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            following_id: followingId
          })
        });

        const data = await response.json();

        if (data.success) {
          if (isFollowing) {
            btn.innerText = 'Inscrever-se';
            btn.classList.remove("bg-purple-700", "hover:bg-purple-800");
            btn.classList.add("border-purple-700", "border", "text-purple-500");
            // Reset classes to outline variant style if needed, or just manual toggle
          } else {
            btn.innerText = 'Inscrito';
            btn.classList.remove("border-purple-700", "border", "text-purple-500");
            btn.classList.add("bg-purple-700", "hover:bg-purple-800");
          }
          // Reload to update UI properly if needed, or just toggle classes
          location.reload();
        } else {
          console.error('Action failed:', data.message);
        }
      } catch (error) {
        console.error('Error:', error);
      }
    }
  </script>
</body>

</html>