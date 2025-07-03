<?php

    namespace Src\Views\Components\Utils;

    /*
        Como usar:

        require_once __DIR__ . "/VHS/src/views/components/header/headerComponent.php";
        use function Src\Views\Components\Header\HeaderComponent;

        <link rel="stylesheet" href="/VHS/src/styles/global.css">
        <script type="module" src="/VHS/src/styles/tailwindglobal.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>

        <?= HeaderComponent(); ?>
    */

    function UserMenu (
        string $avatar_url = "/VHS/public/images/ProfilePhoto.png",
        string $username = "Guilherme Fretes Nascimento",
        string $email = "eu@freitasdev"
    ) {
        return "
            <div id='user-menu' class='hidden fixed w-full sm:w-72 mx-auto flex flex-col h-auto sm:h-max bg-[#1b1b1b] rounded-tr-3xl rounded-tl-3xl sm:rounded-3xl overflow-hidden shadow-md shadow-black/50 transition-all duration-300 sm:duration-200 ease-out translate-y-full sm:translate-y-0 scale-95 bottom-0 sm:top-20 sm:right-5'>
                <div class='flex gap-3 items-center w-full border-b border-gray300 p-4 hover:bg-white/5 transition-all duration-200'>
                    <div class='flex-shrink-0 w-12 h-12 3xl:w-14 3xl:h-14 rounded-full bg-white/10 overflow-hidden'>
                        <img class='select-none pointer-events-none w-full h-full object-cover' src='$avatar_url' onerror='this.style.display=\"none\"'>
                    </div>
            
                    <div class='flex gap-1 flex-col justify-around flex-grow overflow-hidden text-start'>
                        <h3 class='select-none truncate text-paragraph 3xl:text-subtitle text-secondary'>$username</h3>
                        <h2 class='select-none truncate text-caption 3xl:text-paragraph text-gray200'>$email</h2>
                    </div>
                </div>
                
                <div class='flex flex-col border-b border-gray300'>
                    <button id='button-myaccount' class='flex p-1 sm:p-2 items-center gap-2 hover:bg-white/5 focus:bg-white/10 transition-all duration-200'>
                        <div class='flex-shrink-0 w-12 h-12 3xl:w-14 3xl:h-14 p-3 flex justify-center items-center'>
                            <img class='select-none pointer-events-none w-full h-full' src='/VHS/public/icons/settings.svg' onerror='this.style.display=\"none\"'>
                        </div>
            
                        <div class='flex flex-col text-start pr-4 overflow-hidden'>
                            <h2 class='select-none truncate text-paragraph 3xl:text-subtitle text-secondary'>Minha conta</h2>
                            <p class='select-none truncate hidden sm:flex sm:text-caption 3xl:text-paragraph text-gray300'>Gerencie dados e preferências</p>
                        </div>
                    </button>
            
                    <button id='button-vhs-studio' class='flex p-1 sm:p-2 items-center gap-2 hover:bg-white/5 focus:bg-white/10 transition-all duration-200'>
                        <div class='flex-shrink-0 w-12 h-12 3xl:w-14 3xl:h-14 p-3 flex justify-center items-center'>
                            <img class='select-none pointer-events-none w-full h-full' src='/VHS/public/icons/studio.svg' onerror='this.style.display=\"none\"'>
                        </div>
            
                        <div class='flex flex-col text-start pr-4 overflow-hidden'>
                            <h2 class='select-none truncate text-paragraph 3xl:text-subtitle text-secondary'>VHS Studio</h2>
                            <p class='select-none truncate hidden sm:flex sm:text-caption 3xl:text-paragraph text-gray300'>Gerencie o seu canal</p>
                        </div>
                    </button>

                    <button id='button-dashboard' class='flex p-1 sm:p-2 items-center gap-2 hover:bg-white/5 focus:bg-white/10 transition-all duration-200'>
                        <div class='flex-shrink-0 w-12 h-12 3xl:w-14 3xl:h-14 p-3 flex justify-center items-center'>
                            <img class='select-none pointer-events-none w-full h-full' src='/VHS/public/icons/dashboard.svg' onerror='this.style.display=\"none\"'>
                        </div>
            
                        <div class='flex flex-col text-start pr-4 overflow-hidden'>
                            <h2 class='select-none truncate text-paragraph 3xl:text-subtitle text-secondary'>Dashboard</h2>
                            <p class='select-none truncate hidden sm:flex sm:text-caption 3xl:text-paragraph text-gray300'>Gerencie seu usuário e mais</p>
                        </div>
                    </button>
                </div>
            
                <button id='button-logout' class='flex p-1 sm:p-2 items-center gap-2 hover:bg-white/5 focus:bg-white/10 transition-all duration-200'>
                    <div class='flex-shrink-0 w-12 h-12 3xl:w-14 3xl:h-14 p-3 flex justify-center items-center'>
                        <img class='select-none pointer-events-none w-full h-full' src='/VHS/public/icons/logout.svg' onerror='this.style.display=\"none\"'>
                    </div>
            
                    <div class='flex flex-col pr-4 overflow-hidden'>
                        <h2 class='select-none truncate 3xl:text-paragraph 3xl:text-subtitle text-[#bc3636]'>Sair da conta</h2>
                    </div>
                </button>
            </div>
        ";
    }

?>