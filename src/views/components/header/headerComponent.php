<?php

    namespace Src\Views\Components\Header;

    require_once __DIR__ . '/../utils/barComponent.php';
    use function Src\Views\Components\Utils\BarComponent;

    require_once __DIR__ . '/../utils/userMenu.php';
    use function Src\Views\Components\Utils\UserMenu;

    function HeaderComponent() {
        $BarComponent = BarComponent();
        echo UserMenu();

        return <<<HTML
            <header id='header' class='bg-gradient-to-b from-black/75 to-black/0 w-full h-auto flex items-center justify-between p-6 sticky top-0 z-20'>  
                <div class='flex items-center gap-6'>
                    $BarComponent
                    <a href="/VHS/src/views/pages/home">
                        <img src='/VHS/public/logos/Logo.svg' class='w-auto h-8 pointer-events-none select-none'>
                    </a>
                </div>

                <div class='flex items-center gap-4'>
                    <a href="/VHS/src/views/pages/home/search">
                        <button id='search' class='p-2 rounded-full transition-all duration-200 hover:bg-white/10'>
                            <img src='/VHS/public/icons/lupa.svg' class='h-4 pointer-events-none'>
                        </button>
                    </a>

                    <img src='/VHS/public/icons/Rectangle.svg'>
                    
                    <button id='open-user-menu' class='overflow-hidden rounded-full'>
                        <!-- URL do avatar do usuario --->
                        <img src='/VHS/public/images/Avatar.svg' class='h-8 w-8 pointer-events-none'>
                    </button>
                </div>
            </header>

            <script src='/VHS/src/views/components/header/headerScript.js'></script>
        HTML;
    }
?>