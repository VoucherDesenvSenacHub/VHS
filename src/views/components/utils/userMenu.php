<?php

namespace Src\Views\Components\Utils;

function UserMenu(string $avatar_url, string $name, string $email) {
    return <<<HTML
        <div id='user-menu' class='hidden overflow-hidden border-2 border-secondary/10 fixed w-full sm:w-72 mx-auto flex flex-col h-auto sm:h-max bg-[#1b1b1b] rounded-tr-3xl rounded-tl-3xl sm:rounded-3xl shadow-xl shadow-black/50 transition-all duration-300 sm:duration-200 ease-out translate-y-full sm:translate-y-0 scale-95 bottom-0 sm:top-20 sm:right-5 z-20'>
            <div class='flex gap-4 items-center w-full border-b border-secondary/25 p-4 hover:bg-white/5 transition-all duration-200'>
                <div class='flex-shrink-0 w-12 h-12 rounded-full bg-white/10 overflow-hidden'>
                    <img class='select-none pointer-events-none w-full h-full object-cover' src='$avatar_url' onerror='this.src="/VHS/public/uploads/avatars/default.png"'>
                </div>
                
                <div class='flex flex-col justify-around flex-grow text-start'>
                    <h3 class='select-none truncate text-subtitle text-secondary'>$name</h3>
                    <h2 class='select-none truncate text-paragraph text-secondary/50'>$email</h2>
                </div>
            </div>

            <div class='flex flex-col border-b border-secondary/25 w-full'>
                <a href='/VHS/user/settings'>
                    <button id='button-myaccount' class='w-full flex p-2 items-center gap-2 hover:bg-white/5 focus:bg-white/10 transition-all duration-200'>
                        <div class='flex-shrink-0 w-12 h-12 p-2 flex justify-center items-center'>
                            <img class='select-none pointer-events-none w-full h-full' src='/VHS/public/icons/Settings.svg' onerror='this.style.display="none"'>
                        </div>
                        
                        <div class='flex flex-col text-start'>
                            <h2 class='select-none truncate text-subtitle text-secondary'>Minha conta</h2>
                            <p class='select-none truncate hidden sm:flex text-paragraph text-secondary/50'>Gerencie sua conta</p>
                        </div>
                    </button>
                </a>

                <a href='/VHS/studio'>
                    <button id='button-vhs-studio' class='w-full flex p-2 items-center gap-2 hover:bg-white/5 focus:bg-white/10 transition-all duration-200'>
                        <div class='flex-shrink-0 w-12 h-12 p-2 flex justify-center items-center'>
                            <img class='select-none pointer-events-none w-full h-full' src='/VHS/public/icons/Studio.svg' onerror='this.style.display="none"'>
                        </div>
                        
                        <div class='flex flex-col text-start'>
                            <h2 class='select-none truncate text-subtitle text-secondary'>VHS Studio</h2>
                            <p class='select-none truncate hidden sm:flex text-paragraph text-secondary/50'>Gerencie seu conteúdo</p>
                        </div>
                    </button>
                </a>

            <a href='/VHS/admin/analytics'>
                    <button id='button-dashboard' class='flex p-1 sm:p-2 items-center gap-2 hover:bg-white/5 focus:bg-white/10 transition-all duration-200'>
                         <div class='flex-shrink-0 w-12 h-12 3xl:w-14 3xl:h-14 p-3 flex justify-center items-center'>
                            <img class='select-none pointer-events-none w-full h-full' src='/VHS/public/icons/dashboard.svg' onerror='this.style.display="none"'>
                        </div>
                            
                        <div class='flex flex-col text-start '>
                            <h2 class='select-none truncate text-subtitle text-secondary'>Dashboard</h2>
                            <p class='select-none truncate hidden sm:flex text-paragraph text-secondary/50'>Gerencie seus dados</p>
                        </div>
                    </button>
                </a>
            </div>

            <a href='?logout'>
                <button id='button-logout' class='w-full flex p-2 items-center gap-2 hover:bg-white/5 focus:bg-white/10 transition-all duration-200'>
                    <div class='flex-shrink-0 w-12 h-12 p-2 flex justify-center items-center'>
                        <img class='select-none pointer-events-none w-full h-full' src='/VHS/public/icons/Logout.svg' onerror='this.style.display="none"'>
                    </div>

                    <div class='flex flex-col text-start '>
                        <h2 class='select-none truncate text-subtitle text-[#bc3636]'>Sair da conta</h2>
                    </div>
                </button>
            </a>
        </div>
    HTML;
}