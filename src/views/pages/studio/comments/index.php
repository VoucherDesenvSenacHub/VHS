<?php

require_once __DIR__ . "/../../../components/studioSideMenu/studioSideMenuComponent.php";
require_once __DIR__ . "/../../../components/header/headerComponent.php";
require_once __DIR__ . "/../../../components/utils/buttonComponent.php";
require_once __DIR__ . "/../../../components/utils/comments_studio/commentStudioComponent.php";
require_once __DIR__ . "/../../../components/utils/inputComponent.php";
require_once __DIR__ . "/../../../components/utils/footer.php";

use function src\views\components\studioSideMenu\StudioSideMenuComponent;
use function src\views\components\header\HeaderComponent;
use function src\views\components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\CommentStudioComponent;
use function src\views\components\Utils\Footer;
use function Src\Views\Components\Utils\InputComponent;

$comments = $_SESSION["page_data"]["comments"];
print_r($_SESSION["redirect_data"]);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VHS Studio - Últimos comentários do vídeo</title>
  <link rel="stylesheet" href="/VHS/src/styles/global.css">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
</head>
<body>

  <?php echo HeaderComponent(); ?>

  <div class="flex">
    <?php echo StudioSideMenuComponent(); ?>

    <div class="flex-1 px-10 py-6">
        <h1 class="text-2xl font-semibold mb-2 text-white">Últimos comentários do vídeo</h1>
        <p class="text-sm text-gray-300 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit nisl,</p>
    <!-- 
      <div class="flex gap-3 mb-6">
        <?php echo ButtonComponent("Edição", "studio", "", 10.675, 2.5); ?>
        <?php echo ButtonComponent("Comentários", "studio", "", 10.675, 2.5); ?>
        <?php echo ButtonComponent("Analytics", "studio", "", 10.675, 2.5); ?>
      </div> -->

      <?= InputComponent("text", "Pesquisar", icon: "/VHS/public/icons/Filter.svg", iconPosition: "left", onClickIcon: "showFilterMenu()", className: "w-full !bg-[#15141A] text-white px-4 py-2 rounded-md border border-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-600") ?>

      <div class="w-full flex flex-col gap-4">
        <?php
        foreach ($comments as $comment){
          echo CommentStudioComponent(
            name: $comment["name"],
            text: $comment["content"],
            created_at: $comment["created_at"],
            userImg: $comment["avatar_url"],
            thumbnailURL: $comment["thumbnail_url"],
            comment_id: $comment["id"],
            creator_like: $comment["creator_like"]
          );
        };
        ?>
      </div>
    </div>

  </div>
  <?php echo Footer(); ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    const formData = new FormData()

    async function likeComment(event, $comment_id, $like){
      formData.append('comment_id', $comment_id);
      formData.append('like', $like)
      
      const res = await fetch('/VHS/api/v1/studio/comments/creator-like', {
        method: 'POST',
        body: formData,
        withCredentials: 'include'
      });

      if (!res.ok){
        Swal.fire({
                toast: true,
                icon: 'error', 
                title: 'Erro',
                text: 'Erro Interno do Servidor',
                position: 'bottom-end', 
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                customClass: {
                    popup: 'swal-custom',
                    title: 'swal-title',
                    htmlContainer: 'swal-text',
                    icon: 'swal-icon'
                }
            });
        return;
      }

      if(event.target.getAttribute("like") === "1"){
        event.target.setAttribute("like", "0");
        event.target.src = '/VHS/public/icons/comments/favorite-comment.svg';

        Swal.fire({
                toast: true,
                icon: 'success', 
                title: 'Foi Retirado o Amei do Comentário',
                position: 'bottom-end', 
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                customClass: {
                    popup: 'swal-custom',
                    title: 'swal-title',
                    htmlContainer: 'swal-text',
                    icon: 'swal-icon'
                }
            });

        return;
      }

      Swal.fire({
                toast: true,
                icon: 'success', 
                title: 'Foi Adicionado um Amei ao Comentário',
                position: 'bottom-end', 
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                customClass: {
                    popup: 'swal-custom',
                    title: 'swal-title',
                    htmlContainer: 'swal-text',
                    icon: 'swal-icon'
                }
            });

      event.target.setAttribute("like", "1");
      event.target.src = '/VHS/public/icons/comments/favorite-comment-filled.svg';
    }

  </script>

    <style>
        .swal-custom {
            background: #1E1E1E !important;
            color: #fff !important;
            border-radius: 12px !important;
            padding: 15px 20px !important;
            box-shadow: 0 4px 10px rgba(0,0,0,0.4) !important;
            font-family: 'Inter', sans-serif !important;
            border-bottom: 3px solid;
            border-image: linear-gradient(to right, #20c997, #20c997) 1 !important;
        }
        .swal-title {
            font-size: 16px !important;
            font-weight: 600 !important;
            color: #fff !important;
        }
        .swal-text {
            font-size: 14px !important;
            margin-top: 4px !important;
            color: #bbb !important;
        }
        .swal-icon {
            border-radius: 50% !important;
            background: dc3545 !important;
            color: #fff !important;
        }
    </style>
</body>
</html>
