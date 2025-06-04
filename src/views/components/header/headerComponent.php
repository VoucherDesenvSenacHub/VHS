<?php 

    namespace src\views\components\header;
    function HeaderComponent(){

        echo '
        <div id="header" class="flex items-center fixed h-16 w-full justify-end p-5">
          <div class="flex items-center gap-4">
            <button id="search" class="p-1 rounded-lg">
                <img src="/VHS/public/icons/lupa.svg" alt="" class="">
            </button>
            <div class="">
              <img src="/VHS/public/images/Avatar.svg" alt="Foto de perfil" class="h-8 w-8 rounded-full">
            
            </div>
          </div>
        </div>
        <script src="/VHS/src/views/components/header/headerScript.js"></script>
        ';
    }