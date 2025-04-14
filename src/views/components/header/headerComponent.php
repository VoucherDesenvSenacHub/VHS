<?php 

namespace src\views\components\header;

require_once __DIR__ . '/../utils/barComponent.php';
require_once __DIR__ . '/../Sidebar/sidebarComponent.php';

use function src\views\components\Sidebar\SidebarComponent;
use function src\views\components\utils\BarComponent;

function HeaderComponent(){
    $bar = BarComponent(); 

    echo "
    <script src='https://cdn.tailwindcss.com'></script>
    <header id='header' class='flex items-center justify-between p-5 shadow-md'>  
        <div class='flex items-center gap-4'>
          $bar 
          <img src='../../../../public/logos/Logo.svg' alt='Logo' class='h-8'>
        </div>
      

        <div class='flex items-center gap-4'>
          <button id='search' class='p-1 rounded-lg'>
              <img src='../../../../public/icons/lupa.svg' alt='' class=''>
          </button>
          <div><img src='../../../../public/icons/Rectangle.svg' alt=''></div>
          <img src='../../../../public/images/Avatar.svg' alt='Foto de perfil' class='h-8 w-8 rounded-full p-41'>
        </div>
      </header>
      <script src='./script.js'></script>
    ";
}

HeaderComponent();
SidebarComponent();

