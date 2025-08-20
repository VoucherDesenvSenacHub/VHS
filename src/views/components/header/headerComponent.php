<?php
    namespace Src\Views\Components\Header;

    require_once __DIR__ . '/../utils/barComponent.php';
    use function Src\Views\Components\Utils\BarComponent;

    require_once __DIR__ . '/../utils/userMenu.php';
    use function Src\Views\Components\Utils\UserMenu;

    function HeaderComponent() {
        $user = $_SESSION["user"] ?? null;
        $user_avatar = htmlspecialchars(!empty($user['avatar_url']) ? $user['avatar_url'] : '/VHS/public/icons/user.svg', ENT_QUOTES, 'UTF-8');

        $BarComponent = BarComponent();
        echo UserMenu($user_avatar, $user['username'] ?? null, $user['email'] ?? null);

        return <<<HTML
            <header id='header' class='bg-gradient-to-b from-[#000000] to-[#20002c] w-full h-18 flex items-center justify-between p-6 sticky top-0 z-20'>  
                <div class='flex items-center gap-6'>
                    $BarComponent
                    <a href="/VHS/src/views/pages/home">
                        <img src='/VHS/public/logos/Logo.svg' class='w-auto h-8 pointer-events-none select-none'>
                    </a>
                </div>

                <div class='flex items-center gap-4'>
                    <div class='flex flex-warp relative'>
                        <button id='search' class='p-2 rounded-full transition-all duration-200 hover:bg-white/10'>
                            <img src='/VHS/public/icons/lupa.svg' class='h-4 pointer-events-none'>
                        </button>
                        <div id='search-bar' class='absolute hidden right-14 bg-black/90 rounded-lg w-64 shadow-lg transform translate-x-full opacity-0 transition-all duration-300 ease-in-out'>
                            <form action="/VHS/src/views/pages/home/search?term=&filter=video" method="GET">
                                <input 
                                    type='text' 
                                    name='q' 
                                    placeholder='Search...' 
                                    class='w-full bg-white/10 text-white placeholder-white/50 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-white/20 transition-all duration-200'
                                >
                            </form>
                        </div>
                    </div>

                    <img src='/VHS/public/icons/Rectangle.svg'>
                    
                    <button id='open-user-menu' class='overflow-hidden rounded-full'>
                        <img src="$user_avatar" class='h-8 w-8 pointer-events-none'>
                    </button>
                </div>
            </header>

            <script src='/VHS/src/views/components/header/headerScript.js'></script>
        HTML;
    }
?>