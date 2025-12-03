<?php

namespace Src\Views\Components\Header;

require_once __DIR__ . '/../utils/barComponent.php';
require_once __DIR__ . '/../utils/userMenu.php';

use function Src\Views\Components\Utils\BarComponent;
use function Src\Views\Components\Utils\UserMenu;

function HeaderComponent()
{
    $BarComponent = BarComponent();
    $user = $_SESSION["user"] ?? null;

    $avatar_url = $user['avatar_url'] ?? '';
    $UserMenu = UserMenu($avatar_url, $user['name'] ?? 'Você', $user['email'] ?? '');

    return <<<HTML
        <header id='header' class='backdrop-blur-lg border-b border-secondary/10 w-full h-20 flex items-center justify-between px-6 sticky top-0 z-20'>  
            <div class='flex items-center gap-6'>
                $BarComponent
                <a href="/VHS/home">
                    <img src='/VHS/public/logos/logo.svg' class='w-auto h-8 pointer-events-none select-none'>
                </a>
            </div>

            <div class='flex items-center gap-4'>
                <div class='flex flex-warp relative md:block hidden'>
                    <button id='search' class='p-2 rounded-full transition-all duration-200 hover:bg-white/10 active:bg-transparent'>
                        <img src='/VHS/public/icons/lupa.svg' class='w-5 h-5 pointer-events-none'>
                    </button>

                    <div id='search-bar' class='absolute top-0 right-14 rounded-lg shadow-lg overflow-hidden w-0 opacity-0 transition-all duration-300 ease-in-out md:block hidden'>
                        <form action="/VHS/home/search" method="GET">
                            <input 
                                type='text' 
                                name='q' 
                                placeholder='Pesquisar...' 
                                class='w-64 bg-white/10 text-white placeholder-white/50 rounded-md py-2 px-3 focus:outline-none transition-all duration-200'
                            >
                        </form>
                    </div>
                    <style>
                        #header.search #search-bar {
                            width: 16rem;
                            opacity: 1;
                        }
                    </style>
                </div>

                <img src='/VHS/public/icons/rectangle.svg'>
                
                <button id='open-user-menu' class='overflow-hidden rounded-full'>
                    <img src="/VHS/public/uploads/avatars/{$avatar_url}" onerror='this.src="/VHS/public/uploads/avatars/default.png"' class='h-9 w-9 pointer-events-none'>
                </button>
            </div>
        </header>

        $UserMenu
        <script src='/VHS/src/views/components/header/headerScript.js'></script>
    HTML;
}
