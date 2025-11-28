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
use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\InputComponent;

$video = $_SESSION["page_data"]["video"];
$releatedVideos = $_SESSION["page_data"]["releated_videos"];
$user_avaliation = $_SESSION["page_data"]["user_avaliation"];
$comments = $_SESSION["page_data"]["comments"];
$nextPageComments = $_SESSION["page_data"]["next_page_comments"];
$totalComments = $_SESSION["page_data"]["total_comments"];


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
  <title>VHS - Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="/VHS/src/styles/global.css">
  <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gradient-to-b from-[#20002c] to-black text-white">
  <header class="w-full">
    <?= HeaderComponent() ?>
  </header>
  <div class="flex">
    <?= SidebarComponent() ?>
    <main class="flex-1 p-4 max-w-[1500px] m-auto">
      <div class="w-full">
        <div class="rounded-lg">
          <iframe
            class="w-full md:h-[40rem] rounded-lg"
            src="<?= $video['url'] ?>"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen></iframe>
        </div>
        <div class="flex gap-[23rem]">
          <div class="">
            <h2 class="mt-4 text-xl font-semibold"><?= $video["title"] ?></h2>
            <p class="mt-2 text-sm text-gray-300 whitespace-pre-line"><?= $video["description"] ?></p>
            <p class="mt-4"><?= formatViews($video["views"] ?? 0) ?> Visualizações</p>
          </div>
          <div class="mt-5 flex">
            <img class="w-6 h-6 mr-3 cursor-pointer" src="/VHS/public/icons/share.svg" alt="ShareButton" onclick="openShared()" name="send">
            <?= sharedComponent($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], $video["title"]) ?>
            <?= StarRatingComponent([
              "initial_rating" => $user_avaliation,
            ]) ?>
          </div>
        </div>
        <a href="/VHS/home/channel?id=<?= $video["id"] ?>" class="flex items-center mt-10 gap-3">
          <img src="<?= $video['avatar_url'] ?? "/VHS/public/uploads/avatars/default.png" ?>" class="size-16 rounded-xl">
          <div>
            <p class="text-sm font-bold">
              <?= $video["username"] ?>
            </p>
            <p class="text-xs text-gray-400">
              <?= $video["followers"] ?? "0 seguidores" ?>
            </p>
            <button class="bg-gray-900 text-gray-300 font-bold py-1 px-2 rounded-full hover:bg-gray-800 text-[10px] mt-1">
              #<?= $video["category_name"] ?>
            </button>
          </div>
        </a>
      </div>
      <div class="flex flex-col lg:flex-row gap-6 mt-8">
        <div class="w-full lg:flex-[2] rounded-lg">
          <h3 class="text-lg font-semibold mb-4">Recomendados</h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?= viewCards($releatedVideos, 'videos'); ?>
          </div>
        </div>
        <div id="comments" class="relative max-w-lg w-full lg:flex-1 bg-[#1B1B1B] p-4 rounded-lg mt-10 flex flex-col justify-between">
          <div class="h-[90%]">
            <h3 class="text-xl font-semibold mb-4"><?= $totalComments ?> Comentários</h3>
            <?php
            foreach ($comments as $comment) {
              echo Comment($comment["id"], $comment["username"], $comment["content"], $comment["created_at"], $comment["avatar_url"], $comment["creator_like"]);
            }
            ?>
          </div>
          <div>
            <form action="/VHS/api/v1/comment?videoId=<?= $_GET["id"] ?>" method="post">
              <?= InputComponent(type: "text", placeholder: "Comentar...", name: "content") ?>
            </form>
            <?= paginate($comments, $nextPageComments ) ?>
          </div>
        </div>
      </div>
    </main>
  </div>
</body>

</html>