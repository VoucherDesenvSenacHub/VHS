<?php 

    namespace src\views\components\header;
    function HeaderComponent(){

        echo '
        <header id="Header" class="flex items-center justify-between p-5 shadow-md">
        <!-- Botão e Logo -->
        <div class="flex items-center gap-4">
          <button id="Menu" class="p-2 rounded-lg">
              <img src="../../../../public/header/Menu.svg" alt="">
          </button>
          <img src="../../../../public/logos/Logo.svg" alt="Logo" class="h-8">
        </div>
      
        <!-- Lupa e Foto de perfil -->
        <div class="flex items-center gap-4">
          <button id="Lupa" class="p-1 rounded-lg">
              <img src="../../../../public/icons/lupa.svg" alt="" class="">
          </button>
          <div><img src="../../../../public/icons/Rectangle.svg" alt=""></div>
          <img src="../../../../public/images/Avatar.svg" alt="Foto de perfil" class="h-8 w-8 rounded-full p-41">
        </div>
      </header>
      <script src="./script.js"></script>
        ';
    }