<?php 

namespace src\views\components\header;

require_once __DIR__ . '/../utils/barComponent.php';
use function src\views\components\utils\BarComponent;

function HeaderComponent(){
    $bar = BarComponent(); 

    return "
    <script src='https://cdn.tailwindcss.com'></script>
    <header id='header' class='flex items-center justify-between p-5 shadow-md'>  
        <div class='flex items-center gap-4'>
          $bar
          <img src='/VHS/public/logos/Logo.svg' alt='Logo' class='h-8'>
        </div>
        <div class='flex items-center gap-4'>
          <button id='search' class='p-1 rounded-lg'>
              <img src='/VHS/public/icons/lupa.svg' alt='' class=''>
          </button>
          <div><img src='/VHS/public/icons/Rectangle.svg' alt=''></div>
          <img src='/VHS/public/images/Avatar.svg' alt='Foto de perfil' class='size-8 rounded-full'>
        </div>
      </header>
      <script src='/VHS/script.js'></script>
    ";
}
?>