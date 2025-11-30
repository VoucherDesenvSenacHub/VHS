<?php

use function Src\Views\Components\Header\HeaderComponent;

require_once __DIR__ . '/../../../components/studioSideMenu/studioSideMenuComponent.php';
require_once __DIR__ . '/../../../components/header/headerComponent.php';
require_once __DIR__ . '/../../../components/utils/footer.php';
require_once __DIR__ . '/../../../components/utils/inputComponent.php';
require_once __DIR__ . '/../../../components/utils/buttonComponent.php';
require_once __DIR__ . '/../../../components/utils/sweetalert.php';

use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Views\Components\Utils\Footer;
use function Src\Views\Components\StudioSideMenu\StudioSideMenuComponent;
use function Src\Application\Utils\showSweetAlert;

$user = $_SESSION["user"] ?? [];
$avatar_url = !empty($user['avatar_url']) ? $user['avatar_url'] : 'default.png';
$banner_url = !empty($user['banner_url']) ? $user['banner_url'] : null;
$errors = $_SESSION['redirect_data']['errors'] ?? [];
$success = $_SESSION["redirect_data"]["success"] ?? null;
unset($_SESSION['redirect_data']);

$userCategories = $data['userCategories'] ?? [];
$firstCategory = !empty($userCategories) ? $userCategories[0]['name'] : 'Sem Categoria';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VHS Studio - Customizar Canal</title>
  <link rel="stylesheet" href="/VHS/src/styles/global.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="/VHS/src/styles/tailwindglobal.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=stylesheet" />
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#100018] to-black text-white overflow-x-hidden">
  <?= HeaderComponent(); ?>

  <div class="flex min-h-screen">
    <?= StudioSideMenuComponent(); ?>

    <main class="flex-1 p-6 lg:p-10 overflow-hidden max-w-[1600px] mx-auto">
      <div class="mb-8">
        <h1 class="text-2xl font-bold text-white">Customizar canal</h1>
        <p class="text-gray-400 mt-1">Gerencie a identidade visual do seu canal e veja como ele aparece para os espectadores.</p>
      </div>

      <div class="flex flex-col xl:flex-row gap-10">

        <!-- Left Column: Editor Form -->
        <div class="w-full xl:w-1/2 flex flex-col gap-8 transition-all duration-300" id="editorColumn">
          <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold">Editar Informações</h2>
            <!-- Mobile/Desktop Toggle -->
            <label class="inline-flex items-center cursor-pointer">
              <input type="checkbox" id="previewToggle" class="sr-only peer" checked>
              <div class="relative w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-800 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
              <span class="ms-3 text-sm font-medium text-gray-300">Live Preview</span>
            </label>
          </div>

          <form action="/VHS/api/v1/channel/edit" method="POST" enctype="multipart/form-data" id="editForm" class="flex flex-col gap-6">

            <!-- Images Section -->
            <div class="bg-[#121214] p-6 rounded-2xl border border-white/5 shadow-xl">
              <h2 class="text-lg font-semibold mb-4 text-gray-200">Imagens</h2>

              <div class="flex flex-col gap-6">
                <!-- Avatar Upload -->
                <div class="flex items-center gap-4">
                  <div class="relative group cursor-pointer w-20 h-20 shrink-0">
                    <img id="editorAvatarPreview"
                      src="/VHS/public/uploads/avatars/<?= $avatar_url ?>"
                      onerror="this.src='/VHS/public/uploads/avatars/default.png'"
                      class="w-full h-full rounded-full object-cover border-2 border-white/10 group-hover:border-purple-500 transition-colors">
                    <div class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity" onclick="document.getElementById('avatarInput').click()">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>
                    </div>
                  </div>
                  <div class="flex flex-col">
                    <span class="font-medium text-gray-200">Foto de Perfil</span>
                    <span class="text-xs text-gray-400 mb-2">Recomendado: 800x800px (PNG, JPG)</span>
                    <button type="button" onclick="document.getElementById('avatarInput').click()" class="text-purple-400 text-sm hover:text-purple-300 self-start transition-colors">Alterar foto</button>
                    <input type="file" name="avatar" id="avatarInput" accept="image/*" class="hidden">
                  </div>
                </div>

                <!-- Banner Upload -->
                <div class="flex flex-col gap-2">
                  <span class="font-medium text-gray-200">Banner do Canal</span>
                  <div class="relative group cursor-pointer w-full h-56 rounded-xl overflow-hidden bg-[#050505] border border-white/10 hover:border-purple-500/50 transition-colors">
                    <img id="editorBannerPreview"
                      src="<?= $banner_url ? '/VHS/public/uploads/banners/' . $banner_url : '' ?>"
                      class="<?= $banner_url ? 'block' : 'hidden' ?> w-full h-full object-cover">

                    <div class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity" onclick="document.getElementById('bannerInput').click()">
                      <span class="text-white font-medium flex items-center gap-2 bg-black/50 px-4 py-2 rounded-lg backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Enviar Banner
                      </span>
                    </div>

                    <?php if (!$banner_url): ?>
                      <div class="absolute inset-0 flex items-center justify-center pointer-events-none group-hover:opacity-0 transition-opacity">
                        <span class="text-gray-500 text-sm">Nenhum banner selecionado</span>
                      </div>
                    <?php endif; ?>
                  </div>
                  <span class="text-xs text-gray-400">Recomendado: 2048x1152px (PNG, JPG)</span>
                  <input type="file" name="banner" id="bannerInput" accept="image/*" class="hidden">
                </div>
              </div>
            </div>

            <!-- Theme Section -->
            <div class="bg-[#121214] p-6 rounded-2xl border border-white/5 shadow-xl">
              <h2 class="text-lg font-semibold mb-4 text-gray-200">Tema</h2>
              <div class="flex flex-col gap-2">
                <label for="colorInput" class="font-medium text-gray-300">Cor Predominante</label>
                <div class="flex items-center gap-4">
                  <div class="relative overflow-hidden w-20 h-10 rounded-lg border border-white/10">
                    <input type="color" name="background_color" id="colorInput" value="<?= $user['background_color'] ?? '#050505' ?>" class="absolute -top-2 -left-2 w-24 h-24 cursor-pointer p-0 border-0">
                  </div>
                  <span class="text-sm text-gray-400">Escolha a cor de fundo do seu canal</span>
                </div>
              </div>
            </div>

            <!-- Basic Info Section -->
            <div class="bg-[#121214] p-6 rounded-2xl border border-white/5 shadow-xl flex flex-col gap-6">
              <h2 class="text-lg font-semibold text-gray-200">Informações Básicas</h2>

              <?= InputComponent(
                placeholder: "Nome do seu canal",
                name: "name",
                type: "text",
                label: "Nome do Canal",
                value: $user["name"],
                attributes: [
                  "id" => "nameInput"
                ]
              ) ?>

              <?= InputComponent(
                placeholder: "@seu_usuario",
                name: "username",
                type: "text",
                label: "Identificador (Handle)",
                value: $user["username"],
                attributes: [
                  "id" => "usernameInput"
                ]
              ) ?>

              <div class="flex flex-col gap-2">
                <label class="text-sm font-medium text-gray-300">Descrição</label>
                <textarea name="description" id="descriptionInput" rows="4"
                  class="w-full bg-[#050505] border border-white/10 rounded-xl p-4 text-sm text-white focus:border-purple-500 focus:outline-none transition-colors placeholder-gray-500 resize-none"
                  placeholder="Conte aos espectadores sobre o seu canal..."><?= $user['description'] ?? '' ?></textarea>
              </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4 pt-4">
              <?= ButtonComponent("Salvar Alterações", "default", null, className: "w-full md:w-auto px-8") ?>
              <?= ButtonComponent("Cancelar", "outline", null, className: "w-1/4 md:w-auto px-8") ?>
            </div>
          </form>
        </div>

        <!-- Right Column: Live Preview -->
        <div class="w-full xl:w-1/2 transition-all duration-300" id="previewColumn">
          <div class="sticky top-24">
            <div class="flex items-center justify-between mb-4">
              <h2 class="text-lg font-semibold flex items-center gap-2 text-white">
                <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                Live Preview
              </h2>
              <span class="text-xs text-gray-500 uppercase tracking-wider font-medium">Visualização Pública</span>
            </div>

            <div id="previewContainer" class="rounded-2xl overflow-hidden border border-white/10 shadow-2xl transition-colors duration-300" style="background-color: <?= $user['background_color'] ?? '#050505' ?>;">

              <div class="relative">
                <div class="h-32 md:h-48 bg-[#121214] relative overflow-hidden">
                  <img id="previewBanner"
                    src="<?= $banner_url ? '/VHS/public/uploads/banners/' . $banner_url : '' ?>"
                    class="<?= $banner_url ? 'block' : 'hidden' ?> w-full h-full object-cover absolute inset-0">
                </div>

                <div class="px-8 pb-8">
                  <div class="flex flex-col sm:flex-row items-start sm:items-end gap-6 -mt-16 relative z-10">
                    <img id="previewAvatar"
                      src="/VHS/public/uploads/avatars/<?= $avatar_url ?>"
                      onerror="this.src='/VHS/public/uploads/avatars/default.png'"
                      class="w-32 h-32 rounded-full border-4 border-[#050505] bg-[#050505] object-cover shadow-lg">

                    <div class="flex-1 mb-2">
                      <h1 id="previewName" class="text-3xl font-bold leading-tight text-white"><?= htmlspecialchars($user['name']) ?></h1>
                      <p class="text-gray-400 text-sm mt-1">@<span id="previewUsername"><?= htmlspecialchars($user['username']) ?></span></p>
                      <div class="flex items-center gap-3 mt-3 text-xs text-gray-300">
                        <span>0 seguidores</span> <!-- Static for preview -->
                        <span class="bg-white/10 px-2 py-0.5 rounded"><?= $firstCategory ?></span>
                      </div>
                    </div>

                    <button class="bg-white text-black px-6 py-2 rounded-full font-bold text-sm hover:bg-gray-200 transition-colors pointer-events-none opacity-80 mb-2 shadow-lg">
                      Inscrever-se
                    </button>
                  </div>

                  <!-- Preview Description -->
                  <div class="mt-6 text-sm text-gray-300 line-clamp-3 leading-relaxed" id="previewDescription">
                    <?= !empty($user['description']) ? nl2br(htmlspecialchars($user['description'])) : 'Sem descrição.' ?>
                  </div>

                  <!-- Preview Tabs -->
                  <div class="flex gap-8 mt-8 border-b border-white/10">
                    <div class="pb-3 border-b-2 border-white text-white font-medium text-sm">Vídeos</div>
                    <div class="pb-3 border-b-2 border-transparent text-gray-500 font-medium text-sm">Fasts</div>
                    <div class="pb-3 border-b-2 border-transparent text-gray-500 font-medium text-sm">Sobre</div>
                  </div>

                  <!-- Preview Content Placeholder -->
                  <div class="grid grid-cols-3 gap-4 mt-6 opacity-30 pointer-events-none">
                    <div class="aspect-video bg-gray-800 rounded-xl"></div>
                    <div class="aspect-video bg-gray-800 rounded-xl"></div>
                    <div class="aspect-video bg-gray-800 rounded-xl"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <?php
  if (!empty($errors) && is_array($errors)) {
    $errorMessage = implode(", ", $errors);
    echo showSweetAlert($errorMessage, "", "error");
  }
  if (isset($success)) {
    echo showSweetAlert($success, "", "success");
  }
  ?>

  <script>
    // Toggle Logic
    const previewToggle = document.getElementById('previewToggle');
    const editorColumn = document.getElementById('editorColumn');
    const previewColumn = document.getElementById('previewColumn');

    if (previewToggle) {
      previewToggle.addEventListener('change', (e) => {
        if (e.target.checked) {
          previewColumn.classList.remove('hidden');
          editorColumn.classList.remove('w-full');
          editorColumn.classList.add('xl:w-1/2');
        } else {
          previewColumn.classList.add('hidden');
          editorColumn.classList.remove('xl:w-1/2');
          editorColumn.classList.add('w-full');
        }
      });
    }


    // Live Preview Logic
    const nameInput = document.getElementById('nameInput');
    const usernameInput = document.getElementById('usernameInput');
    const descriptionInput = document.getElementById('descriptionInput');
    const colorInput = document.getElementById('colorInput');

    const previewName = document.getElementById('previewName');
    const previewUsername = document.getElementById('previewUsername');
    const previewDescription = document.getElementById('previewDescription');
    const previewContainer = document.getElementById('previewContainer');

    if (nameInput) nameInput.addEventListener('input', (e) => previewName.textContent = e.target.value || 'Nome do Canal');
    if (usernameInput) usernameInput.addEventListener('input', (e) => previewUsername.textContent = e.target.value || 'usuario');
    if (descriptionInput) descriptionInput.addEventListener('input', (e) => previewDescription.textContent = e.target.value || 'Sem descrição.');
    if (colorInput) colorInput.addEventListener('input', (e) => previewContainer.style.backgroundColor = e.target.value);

    // Image Previews
    function setupImagePreview(inputId, previewIds) {
      const input = document.getElementById(inputId);
      if (!input) return;

      input.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            previewIds.forEach(id => {
              const img = document.getElementById(id);
              if (img) {
                img.src = e.target.result;
                img.classList.remove('hidden');
                img.classList.add('block');
              }
            });
          }
          reader.readAsDataURL(file);
        }
      });
    }

    setupImagePreview('avatarInput', ['editorAvatarPreview', 'previewAvatar']);
    setupImagePreview('bannerInput', ['editorBannerPreview', 'previewBanner']);
  </script>
</body>

</html>