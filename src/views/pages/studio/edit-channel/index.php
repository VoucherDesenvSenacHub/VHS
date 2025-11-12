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
$banner_url = !empty($user['banner_url']) ? $user['banner_url'] : '';
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
  <?php echo HeaderComponent(); ?>
  <div class="flex flex-col lg:flex-row">
    <div class="max-xl:hidden">
      <?php echo StudioSideMenuComponent(); ?>
    </div>
    <main class="flex-1 px-10 py-6">
      <text class="text-xl lg:text-3xl font-bold text-white cursor-default text-center lg:text-left">
        Customizar canal
      </text>
      <form action="/VHS/src/application/routes/route.php/api/v1/channel/edit" method="POST" enctype="multipart/form-data">
        <section class="mb-10 mt-6 flex flex-col lg:flex-row gap-4">
          <label for="imagemUploadProfile" class="border border-gray-600 rounded-xl relative group cursor-pointer inline-block w-36 h-36 mx-auto lg:mx-0 overflow-hidden">
            <img id="profileImage" src="/VHS/public/uploads/avatars/<?= $avatar_url ?>" alt="Foto de perfil" class="absolute inset-0 w-full h-full rounded-xl object-cover group-hover:brightness-75 transition" />
            <div class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-70 transition-opacity">
              <img src="/VHS/public/icons/Download.svg" alt="Download" class="w-5 h-5">
            </div>
            <input type="file" name="avatar" id="imagemUploadProfile" accept="image/*" class="hidden" />
          </label>

          <div class="mt-5 text-center lg:text-left">
            <h2 class="text-lg lg:text-2xl font-bold text-white cursor-default">Foto de perfil</h2>
            <p class="text-sm lg:text-base text-gray-300 mb-8">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, voluptas dicta! Doloremque nemo neque voluptates, officia commodi recusandae.
            </p>
          </div>
        </section>
        <div class="space-y-2">
          <h2 class="font-medium text-lg text-white cursor-default">Banner do canal</h2>
          <label
            for="imagemUploadBanner"
            class="relative group rounded-xl overflow-hidden bg-white/5 border border-white/10 hover:border-white/20 transition-colors cursor-pointer block">
            <div class="aspect-[6/1] flex items-center justify-center bg-gradient-to-br from-white/5 to-white/10">
              <img id="bannerImage" src="<?= $banner_url ? '/VHS/public/uploads/banner/' . $banner_url : '' ?>" alt="Banner do canal" class="absolute inset-0 w-full h-full object-cover <?= !$banner_url ? 'hidden' : '' ?>" onerror="this.style.display='none'; document.getElementById('placeholderText').style.display='block';" />
              <span class="text-6xl font-bold text-white/20" id="placeholderText" style="display: <?= $banner_url ? 'none' : 'block' ?>">VHS</span>
            </div>
            <div
              class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-70 transition-opacity">
              <div class="text-center text-gray-300">
                <img class="text-3xl mx-auto mb-2" src="/VHS/public/icons/Download.svg" alt="Download">
                <p class="text-sm font-medium">Clique para alterar o banner</p>
              </div>
            </div>
            <input type="file" name="banner" id="imagemUploadBanner" accept="image/*" class="hidden" />
          </label>
        </div>
        <div class="flex flex-col">
          <section class="mb-6 mt-6">
            <?php
            echo InputComponent(
              type: "text",
              placeholder: "@Rafael__",
              name: "username",
              label: "Nome do canal",
              label_size: "lg",
              width: "full",
              height: "[35px] lg:[45px]",
              value: $user["username"],
              error: isset($errors["username"]),
              errorDescription: isset($errors["username"]) ? $errors["username"] : ""
            );
            ?>
          </section>
          <div class="flex flex-col gap-2">
            <label class="font-lg font-medium text-white cursor-default">Descrição do canal</label>
            <textarea
              name="description_channel"
              placeholder="Escreva algo sobre o canal."
              class="w-full h-32 px-4 py-3 outline outline-1 outline-[#666666] rounded-md placeholder-[#666666] text-zinc-200 rounded-lg text-gray-300 focus:outline-none focus:ring-2 focus:ring-[#666666] resize-none"><?= $user["description_channel"] ?? "" ?></textarea>
          </div>
          </section>
          <section class="mb-10 mt-4">
            <?php
            echo InputComponent(
              type: "text",
              placeholder: "#Tecnologia",
              name: "tag",
              label: "Tags do canal",
              label_size: "lg",
              width: "full",
              height: "[35px] lg:[45px]",
              value: $user["tag"] ?? ""
            );
            ?>
          </section>
          <div class="flex items-center justify-between w-full w-[30rem] gap-4 self-end">
            <?= ButtonComponent("Cancelar", "outline", null, type: "button"); ?>
            <?= ButtonComponent("Salvar alterações", "default", null, type: "submit"); ?>
          </div>
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