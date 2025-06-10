<?php
namespace src\views\components\header;

function HeaderComponent() {
    return <<<HTML
    <header id="header" class="flex items-center justify-between p-5 shadow-md top-0 left-0 w-full z-50">
      <div class="flex items-center gap-4">
        <button id="menu" class="p-2 rounded-lg">
          <img src="/VHS/public/icons/header/Menu.svg" alt="Menu" class="w-6 h-6">
        </button>
        <img src="/VHS/public/logos/Logo.svg" alt="Logo" class="h-8 max-w-[120px]">
      </div>
      <div class="flex items-center gap-4">
        <button id="search" class="p-1 rounded-lg">
          <img src="/VHS/public/icons/lupa.svg" alt="Pesquisar" class="w-6 h-6">
        </button>
        <div><img src="/VHS/public/icons/Rectangle.svg" alt="Ícone" class="w-6 h-6"></div>
        <img src="/VHS/public/icons/userRound.svg" alt="Foto de perfil" class="h-8 w-8 rounded-full">
      </div>
    </header>
    <script src="/VHS/src/views/components/header/headerScript.js"></script>
HTML;
}
