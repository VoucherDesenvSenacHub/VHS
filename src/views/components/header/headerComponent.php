<?php

    namespace Src\Views\Components\Header;

    require_once __DIR__ . '/../utils/barComponent.php';
    use function Src\Views\Components\Utils\BarComponent;

    require_once __DIR__ . '/../utils/userMenu.php';
    use function Src\Views\Components\Utils\UserMenu;

    function HeaderComponent() {
        $BarComponent = BarComponent();
        echo UserMenu();

        return "
            <header id='header' class='bg-gradient-to-b from-black/75 to-black/0 flex items-center justify-between p-5 sticky top-0 select-none z-20'>  
                <div class='flex items-center gap-6'>
                    $BarComponent
                    <img src='/VHS/public/logos/Logo.svg' alt='Logo' class='h-8'>
                </div>

                <div class='flex items-center gap-4'>
                    <button id='search' class='p-1 rounded-lg'>
                        <img src='/VHS/public/icons/lupa.svg' alt=''>
                    </button>

                    <div>
                        <img src='/VHS/public/icons/Rectangle.svg' alt=''>
                    </div>
                    
                    <img id='open-user-menu' src='/VHS/public/images/avatar.svg' class='cursor-pointer h-8 w-8 rounded-full'>
                </div>
            </header>

            <script src='/VHS/src/views/components/header/headerScript.js'></script>
        ";
    }

?>
