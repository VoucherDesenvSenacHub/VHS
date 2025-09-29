<?php
require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/studioSideMenu/studioSideMenuComponent.php";

use function Src\Views\Components\StudioSideMenu\StudioSideMenuComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/header/headerComponent.php";

use function Src\Views\Components\Header\HeaderComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/footer.php";

use function Src\Views\Components\Utils\Footer;

// Importando o ButtonComponent
require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/buttonComponent.php";

use function Src\Views\Components\Utils\ButtonComponent;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Customizar canal</title>
  <link rel="stylesheet" href="/VHS/src/styles/global.css">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
  <style>
    input,
    textarea {
      color: #ffffff;
    }
  </style>
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center font-[Poppins]">
  <?php echo HeaderComponent(); ?>
  <div class="flex">
    <?php echo StudioSideMenuComponent(); ?>
    <main class="flex flex-col gap-4 max-w-[1500px] mx-auto">
      <text class="text-3xl font-bold text-white cursor-default">Customizar canal</text>
      <form id="canalForm" action="#" method="POST" onsubmit="return false;">
        <section class="mb-10 flex flex-col lg:flex-row gap-5">
          <form action="upload.php" method="POST" enctype="multipart/form-data">
            <label for="imagemUploadProfile" class="relative group cursor-pointer inline-block w-45 h-45">
              <img
                id="profileImage"
                src="https://media.istockphoto.com/id/1316134499/pt/foto/a-concept-image-of-a-magnifying-glass-on-blue-background-with-a-word-example-zoom-inside-the.jpg?s=612x612&w=0&k=20&c=raTXPP4qnJy_svR1J6dOYeoonbJOWeezfvGd9mAE5vo="
                alt="Foto de perfil"
                class="w-45 h-45 rounded-xl object-cover group-hover:brightness-75 transition" />
              <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                <img src="/VHS/public/icons/Download.svg" alt="Download">
              </div>
              <input
                type="file"
                name="imagem"
                id="imagemUploadProfile"
                accept="image/*"
                class="hidden"
                required />
            </label>
          </form>
          <div class="mt-5">
            <h2 class="text-2xl font-bold text-white cursor-default">Foto de perfil</h2>
            <p class="text-sm text-gray-300 mb-8">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis, voluptas dicta! Doloremque nemo neque voluptates, officia commodi recusandae adipisci beatae, inventore quod itaque iure quam aliquid deleniti facere optio accusantium.</p>
          </div>
        </section>
        <section class="mb-10">
          <h2 class="text-2xl text-base text-white cursor-default mb-2">Banner do canal</h2>
          <form action="upload.php" method="POST" enctype="multipart/form-data">
            <label for="imagemUploadBanner" class="relative group cursor-pointer overflow-hidden w-full">
              <img
                id="bannerImage"
                src=""
                class="h-50 w-full object-cover transition duration-700 rounded-md border border-gray-700" />
              <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                <img src="/VHS/public/icons/Download.svg" alt="Download">
              </div>
              <input
                type="file"
                name="imagem"
                id="imagemUploadBanner"
                accept="image/*"
                class="hidden"
                required />
            </label>
          </form>
        </section>

        <div class="flex flex-col">
          <section class="mb-6">
            <label for="nome" class="text-2xl text-base text-white cursor-default mb-2">Nome do canal</label>
            <input id="nome" type="text" class="w-full bg-transparent border border-gray-600 text-sm px-4 py-2 rounded-md placeholder-gray-500" placeholder="@Rafael__">
            <p id="nome-error" class="text-red-500 text-sm mt-1 hidden">Campo obrigatório. Máximo 24 caracteres.</p>
          </section>

          <section class="mb-6">
            <label for="descricao" class="text-2xl text-base text-white cursor-default mb-2">Descrição</label>
            <textarea id="descricao" rows="5" class="w-full bg-transparent border border-gray-600 text-sm px-4 py-2 rounded-md placeholder-gray-500" placeholder="Escreva algo sobre o canal..."></textarea>
            <p id="descricao-error" class="text-red-500 text-sm mt-1 hidden">Campo obrigatório. Máximo 24 caracteres.</p>
          </section>

          <section class="mb-10">
            <label for="tags" class="text-2xl text-base text-white cursor-default mb-3">Tags do canal</label>
            <input id="tags" type="text" class="w-full bg-transparent border border-gray-600 text-sm px-4 py-2 rounded-md placeholder-gray-500" placeholder="#Tecnologia">
            <p id="tags-error" class="text-red-500 text-sm mt-1 hidden">Campo obrigatório. Máximo 24 caracteres.</p>
          </section>

          <div class="flex gap-5 flex-col lg:flex-row self-end">
            <?php
            echo ButtonComponent(
              text: "Cancelar",
              variant: "outline",
              id: "cancelar-btn",
              className: "px-4 sm:px-6 md:px-8 lg:px-[10.5rem] py-3 hover:bg-gray-700 transition",
              type: "button"
            );

            echo ButtonComponent(
              text: "Salvar alterações",
              variant: "default",
              id: "salvar-btn",
              className: "px-4 sm:px-6 md:px-8 lg:px-[9.1rem] py-3 hover:bg-purple-900 transition",
              type: "submit",
              isActive: true
            );
            ?>
          </div>
        </div>
      </form>
    </main>
  </div>

  <?php echo Footer(); ?>

  <script>
    // Profile image upload handler
    document.getElementById('imagemUploadProfile').addEventListener('change', function(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('profileImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    });

    // Banner image upload handler
    document.getElementById('imagemUploadBanner').addEventListener('change', function(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('bannerImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    });

    function showNotification(title, subtitle) {
      const existing = document.getElementById("copy-notification");
      if (existing) existing.remove();

      document.body.insertAdjacentHTML("beforeend", `
<div id="copy-notification" class="overflow-hidden fixed flex bottom-0 right-0 mb-4 mr-4 min-w-20 min-h-10 bg-[#202024] rounded-xl items-center p-4 gap-4 border-b-4 border-[#660BAD] translate-y-5 opacity-0 transition-all duration-300">
  <div class="w-12 h-12 bg-[#303746] rounded-full flex items-center justify-center p-2" style="box-shadow: 0 0 15px 0 #660BAD;">
    <svg width="100%" height="100%" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="10" cy="10" r="9" fill="#660BAD"/>
      <path d="M5 10L8 13L15 6" stroke="#303746" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  </div>
  <div class="flex flex-col text-white">
    <h1 class="title text-xl">${title}</h1>
    <span class="subtitle text-gray-500 text-base">${subtitle}</span>
  </div>
</div>
      `);

      const notification = document.getElementById("copy-notification");
      requestAnimationFrame(() => {
        notification.classList.remove("opacity-0", "translate-y-5");
        notification.classList.add("opacity-100", "translate-y-0");
      });

      setTimeout(() => {
        notification.classList.remove("opacity-100", "translate-y-0");
        notification.classList.add("opacity-0", "translate-y-5");
        setTimeout(() => notification.remove(), 300);
      }, 2000);
    }

    document.getElementById("salvar-btn").addEventListener("click", function(event) {
      event.preventDefault();

      const nome = document.getElementById("nome");
      const descricao = document.getElementById("descricao");
      const tags = document.getElementById("tags");

      const nomeError = document.getElementById("nome-error");
      const descricaoError = document.getElementById("descricao-error");
      const tagsError = document.getElementById("tags-error");

      let isValid = true;
      const maxChars = 24;

      function validarCampo(campo, errorElement) {
        if (campo.value.trim() === "") {
          errorElement.classList.remove("hidden");
          return false;
        } else if (campo.value.trim().length > maxChars) {
          errorElement.classList.remove("hidden");
          return false;
        } else {
          errorElement.classList.add("hidden");
          return true;
        }
      }

      isValid &= validarCampo(nome, nomeError);
      isValid &= validarCampo(descricao, descricaoError);
      isValid &= validarCampo(tags, tagsError);

      if (isValid) {
        showNotification("Alterações salvas!", "Suas alterações foram salvas com sucesso.");
      }
    });
  </script>
</body>

</html>