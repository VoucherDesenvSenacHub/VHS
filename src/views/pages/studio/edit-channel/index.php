<?php
require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/studioSideMenu/studioSideMenuComponent.php";

use function Src\Views\Components\StudioSideMenu\StudioSideMenuComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/header/headerComponent.php";

use function Src\Views\Components\Header\HeaderComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/footer.php";

use function Src\Views\Components\Utils\Footer;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/buttonComponent.php";

use function Src\Views\Components\Utils\ButtonComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/inputComponent.php";

use function Src\Views\Components\Utils\InputComponent;

$user = $_SESSION["user"];
$user["username"] = $user["username"] ?? "Usuário";
$user["profile_picture"] = $user["profile_picture"] ?? "/VHS/public/images/foto-sem-perfil.jpg"; // Set default profile picture
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
  <style>
    input,
    textarea {
      color: #ffffff;
    }

    /* 🔹 Header fixo no topo */
    header {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 50;
    }

    /* 🔹 Espaçamento para o conteúdo não ficar por baixo do header */
    main {
      margin-top: 100px;
    }
  </style>
</head>

<body class="w-full min-h-screen bg-gradient-to-b from-[#20002c] to-[#000000] bg-no-repeat bg-cover bg-center font-[Poppins]">

  <!-- 🔹 Header fixo -->
  <?php echo HeaderComponent(); ?>

  <div class="flex mt-24">
    <?php echo StudioSideMenuComponent(); ?>

    <main class="flex flex-col gap-4 max-w-[1500px] mx-auto px-6">
      <h1 class="text-3xl font-bold text-white cursor-default">Customizar canal</h1>

      <!-- Form principal -->
      <form id="canalForm" action="#" method="POST" onsubmit="return false;">

        <!-- Foto de perfil -->
        <section class="mb-10 flex flex-col lg:flex-row gap-5">
          <label for="imagemUploadProfile" class="border border-gray-600 rounded-md relative group cursor-pointer inline-block w-45 h-45">
            <img
              id="profileImage"
              src="<?php echo htmlspecialchars($user["profile_picture"]); ?>"
              alt="Foto de perfil"
              class="w-45 h-45 rounded-xl object-cover group-hover:brightness-75 transition" />
            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
              <img src="/VHS/public/icons/Download.svg" alt="Download">
            </div>
            <input
              type="file"
              name="imagemProfile"
              id="imagemUploadProfile"
              accept="image/*"
              class="hidden"
              required />
          </label>
          <div class="mt-5">
            <h2 class="text-2xl font-bold text-white cursor-default">Foto de perfil</h2>
            <p class="text-sm text-gray-300 mb-8">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, voluptas dicta! Doloremque nemo neque voluptates, officia commodi recusandae.</p>
          </div>
        </section>

        <!-- Banner -->
        <section class="mb-10">
          <h2 class="text-2xl text-base text-white cursor-default mb-2">Banner do canal</h2>
          <label for="imagemUploadBanner" class="relative group cursor-pointer overflow-hidden w-full">
            <img
              id="bannerImage"
              src=""
              class="h-50 w-full object-cover transition duration-700 rounded-md border border-gray-600" />
            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
              <img src="/VHS/public/icons/Download.svg" alt="Download">
            </div>
            <input
              type="file"
              name="imagemBanner"
              id="imagemUploadBanner"
              accept="image/*"
              class="hidden"
              required />
          </label>
        </section>

        <!-- Campos -->
        <div class="flex flex-col">
          <section class="mb-6">
            <?php
            echo InputComponent(
              type: "text",
              placeholder: "@Rafael__",
              name: "nome",
              label: "Nome do canal",
              label_size: "2xl",
              width: "full",
              height: "[45px]",
              value: $user["username"]
            );
            ?>
          </section>

          <section class="mb-6">
            <?php
            echo InputComponent(
              type: "textarea",
              placeholder: "Escreva algo sobre o canal...",
              name: "descricao",
              label: "Descrição",
              label_size: "2xl",
              width: "full",
              height: "auto",
              className: "min-h-[120px]"
            );
            ?>
          </section>

          <section class="mb-10">
            <?php
            echo InputComponent(
              type: "text",
              placeholder: "#Tecnologia",
              name: "tags",
              label: "Tags do canal",
              label_size: "2xl",
              width: "full",
              height: "[45px]"
            );
            ?>
          </section>

          <!-- Botões -->
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
    // Preview imagem perfil
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

    // Preview imagem banner
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

    // Notificação estilizada
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

    // Ação do botão "Salvar alterações"
    document.getElementById("salvar-btn").addEventListener("click", function(event) {
      event.preventDefault();
      showNotification("Alterações salvas!", "Suas alterações foram salvas com sucesso.");
    });
  </script>
</body>

</html>