<?php
require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/studioSideMenu/studioSideMenuComponent.php";
use function src\views\components\studioSideMenu\StudioSideMenuComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/header/headerComponent.php";
use function src\views\components\header\HeaderComponent;

require $_SERVER['DOCUMENT_ROOT'] . "/VHS/src/views/components/utils/footer.php";
use function src\views\components\Utils\Footer;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Customizar Canal</title>
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Syne:wght@500..800&display=swap" rel="stylesheet" />
</head>
<body class="bg-gradient-to-b from-[#20002c] via-black to-[#20002c] min-h-screen text-white font-[Poppins]">

  <?php echo HeaderComponent(); ?>

  <div class="flex">
    <?php echo StudioSideMenuComponent(); ?>

    <!-- Conteúdo da Página -->
    <main class="flex-1 p-8 md:p-12 ml-10">
      <h1 class="text-2xl font-semibold mb-6">Customizar canal</h1>
      <p class="text-sm text-gray-300 mb-8">Altere o nome, banner, foto de perfil, descrição do seu canal</p>

      <!-- Foto de Perfil -->
      <section class="mb-10 flex gap-5">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
          <label for="imagemUpload" class="relative group cursor-pointer inline-block">
            <!-- Imagem de perfil atual -->
            <img
              src="https://media.istockphoto.com/id/1316134499/pt/foto/a-concept-image-of-a-magnifying-glass-on-blue-background-with-a-word-example-zoom-inside-the.jpg?s=612x612&w=0&k=20&c=raTXPP4qnJy_svR1J6dOYeoonbJOWeezfvGd9mAE5vo="
              alt="Foto de perfil"
              class="w-28 h-28 rounded-xl object-cover group-hover:brightness-75 transition"
            />
            <!-- Ícone de upload -->
            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
              <img src="/VHS/public/icons/Download.svg" alt="Download">
            </div>
            <!-- Input invisível -->
            <input
              type="file"
              name="imagem"
              id="imagemUpload"
              accept="image/*"
              class="hidden"
              required
            />
          </label>
        </form>
        <div class="mt-5">
          <h2 class="text-lg font-medium mb-2">Foto de perfil</h2>
          <p class="text-sm text-gray-300 mb-8">lorem sjdpifpdfpsdoikjdmgpsdkmfpsfpmsdlfsdfdfsdmkfsdkfsm</p>
        </div>
      </section>


      <!-- Banner do canal -->
      <section class="mb-10">
        <h2 class="text-lg font-medium mb-2">Banner do canal</h2>
        <p class="text-sm text-gray-400 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <img src="https://i.imgur.com/UvnbC0y.png" alt="Banner do canal" class="w-full max-w-2xl rounded-md border border-gray-700" />
      </section>

      <!-- Nome do canal -->
      <section class="mb-6">
        <label for="nome" class="block text-sm mb-1">Nome do canal</label>
        <input id="nome" type="text" class="w-full max-w-xl bg-transparent border border-gray-600 text-sm px-4 py-2 rounded-md placeholder-gray-500" placeholder="@Rafael__">
      </section>

      <!-- Descrição -->
      <section class="mb-6">
        <label for="descricao" class="block text-sm mb-1">Descrição</label>
        <textarea id="descricao" rows="5" class="w-full max-w-xl bg-transparent border border-gray-600 text-sm px-4 py-2 rounded-md placeholder-gray-500" placeholder="Escreva algo sobre o canal..."></textarea>
      </section>

      <!-- Tags do canal -->
      <section class="mb-10">
        <label for="tags" class="block text-sm mb-1">Tags do canal</label>
        <input id="tags" type="text" class="w-full max-w-xl bg-transparent border border-gray-600 text-sm px-4 py-2 rounded-md placeholder-gray-500" placeholder="#Tecnologia">
      </section>

      <!-- Botões -->
      <div class="flex gap-4">
        <button class="px-6 py-2 border border-gray-500 text-sm rounded-md hover:bg-gray-700 transition">Cancelar</button>
        <button class="px-6 py-2 bg-[#A347FF] text-white text-sm rounded-md hover:bg-[#922be8] transition">Salvar alterações</button>
      </div>
    </main>
  </div>

  <?php echo Footer(); ?>
</body>
</html>
