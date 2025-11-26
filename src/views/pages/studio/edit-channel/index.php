<?php
require_once __DIR__ . '/../../../components/studioSideMenu/studioSideMenuComponent.php';
require_once __DIR__ . '/../../../components/header/headerComponent.php';
require_once __DIR__ . '/../../../components/utils/footer.php';
require_once __DIR__ . '/../../../components/utils/inputComponent.php';
require_once __DIR__ . '/../../../components/utils/buttonComponent.php';
require_once __DIR__ . '/../../../components/utils/sweetalert.php';

use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\Footer;
use function Src\Views\Components\Header\HeaderComponent;
use function Src\Views\Components\StudioSideMenu\StudioSideMenuComponent;
use function Src\Application\Utils\showSweetAlert;

$user = $_SESSION["user"] ?? [];
$avatar_url = !empty($user['avatar_url']) ? $user['avatar_url'] : 'default.png';
$banner_url = !empty($user['banner_url']) ?? $user['banner_url'];
$errors = $_SESSION['redirect_data']['errors'] ?? [];
$success = $_SESSION["redirect_data"]["success"] ?? null;
$fields = $_SESSION['redirect_data']['fields'] ?? [];
unset($_SESSION['redirect_data']);

if (!empty($errors) && is_array($errors)) {
  foreach ($errors as $error) {
    if (str_contains(strtolower($error), 'username')) {
      $usernameError = $error;
    } else {
      $genericError = $error;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Customizar canal</title>
  <link rel="stylesheet" href="/VHS/src/styles/global.css">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=stylesheet" />

</head>
<body>

<body>
  <?php echo HeaderComponent(); ?>

  <div class="flex">
    <?php echo StudioSideMenuComponent(); ?>

    <main class="flex flex-col max-w-[1500px] mx-auto px-6 pt-[1.18rem] ">
      <h1 class="text-2xl font-semibold mb-0.5rem text-white">Customizar canal</h1>
      <p class="text-sm text-gray-300 mb-8">Altere o nome, banner, foto de perfil, descrição do seu canal</p>

      <section class="mb-10 flex flex-col lg:flex-row gap-5">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
          <label for="imagemUpload" class="relative group cursor-pointer inline-block w-45 h-45">
            <img
              src="/VHS/public/uploads/avatars/{$avatar_url}" onerror='this.src="/VHS/public/uploads/avatars/default.png"'
              alt="Foto de perfil"
              class="w-45 h-45 rounded-full object-cover group-hover:brightness-75 transition"
            />
            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
              <img src="/VHS/public/icons/Download.svg" alt="Download">
            </div>
            <input type="file" name="avatar" id="imagemUploadProfile" accept="image/*" class="hidden" />
          </label>
        </form>
        <div class="mt-5">
          <h2 class="text-lg font-medium mb-0.5rem text-white">Foto de perfil</h2>
          <p class="text-sm text-gray-300 mb-8">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis, voluptas dicta! Doloremque nemo neque voluptates, officia commodi recusandae adipisci beatae, inventore quod itaque iure quam aliquid deleniti facere optio accusantium.</p>
        </div>
      </section>


      <section class="mb-10">
        <h2 class="text-xl font-medium mb-0.5rem text-white">Banner do canal</h2>
        <p class="text-sm text-gray-400 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
          <label for="imagemUpload" class="relative group cursor-pointer inline-block w-full">
            <img src="" class="h-50 w-full rounded-md border border-gray-700" />
            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
              <img src="/VHS/public/icons/Download.svg" alt="Download">
            </div>
            <input type="file" name="banner" id="imagemUploadBanner" accept="image/*" class="hidden" />
          </label>
        </form>
      </section>

    <form action="" class="flex flex-col">
    <section class="mb-6">
        <label for="nome" class="block text-sm mb-1 text-white">Nome do canal</label>
        <input id="nome" type="text" class="w-full bg-transparent border border-gray-600 text-sm px-4 py-2 rounded-md placeholder-gray-500" placeholder="@Rafael__">
      </section>

      <section class="mb-6">
        <label for="descricao" class="block text-sm mb-1 text-white">Descrição</label>
        <textarea id="descricao" rows="5" class="w-full bg-transparent border border-gray-600 text-sm px-4 py-2 rounded-md placeholder-gray-500" placeholder="Escreva algo sobre o canal..."></textarea>
      </section>

      <section class="mb-10">
        <label for="tags" class="block text-sm mb-1 text-white">Tags do canal</label>
        <input id="tags" type="text" class="w-full bg-transparent border border-gray-600 text-sm px-4 py-2 rounded-md placeholder-gray-500" placeholder="#Tecnologia">
      </section>

      <div class="flex gap-5 self-start">
        <button class="px-4 sm:px-6 md:px-8 lg:px-[9.1rem] py-3 bg-[#A347FF] text-white text-xs sm:text-sm rounded-md hover:bg-[#922be8] transition">
          Salvar alterações
        </button>
        <button class="px-4 sm:px-6 md:px-8 lg:px-[10.5rem] py-3 border border-gray-500 text-xs sm:text-sm rounded-md hover:bg-gray-700 transition text-white">
          Cancelar
        </button>
      </div>
    </form>
    </main>
  </div>
  <?php
  if (!empty($errors) && is_array($errors)) {
    $errorMessage = is_array($errors) ? implode(", ", $errors) : $errors;
    echo showSweetAlert($errorMessage, "", "error");
  }
  if (isset($success)) {
    echo showSweetAlert($success, "", "success");
  }
  ?>
  <?php echo Footer(); ?>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const profileInput = document.getElementById('imagemUploadProfile');
      if (profileInput) {
        profileInput.addEventListener('change', (event) => {
          const file = event.target.files[0];
          if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
              document.getElementById('profileImage').src = e.target.result;
            };
            reader.readAsDataURL(file);
          }
        });
      }

      const bannerInput = document.getElementById('imagemUploadBanner');
      if (bannerInput) {
        bannerInput.addEventListener('change', (event) => {
          const file = event.target.files[0];
          if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
              const bannerImage = document.getElementById('bannerImage');
              const placeholderText = document.getElementById('placeholderText');
              bannerImage.src = e.target.result;
              bannerImage.style.display = 'block';
              placeholderText.style.display = 'none';
            };
            reader.readAsDataURL(file);
          }
        });
      }

      const bannerImage = document.getElementById('bannerImage');
      const placeholderText = document.getElementById('placeholderText');
      if (bannerImage && bannerImage.src && bannerImage.src !== window.location.href) {
        bannerImage.style.display = 'block';
        placeholderText.style.display = 'none';
      } else {
        bannerImage.style.display = 'none';
        placeholderText.style.display = 'block';
      }
    });
  </script>
</body>

</html>