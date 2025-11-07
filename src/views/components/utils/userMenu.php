<?php

namespace Src\Views\Components\Utils;

function UserMenu(string $avatar_url, string $name, string $email) {

    $items = [
        "settings" => [
            "href" => "/VHS/user/settings",
            "icon" => "/VHS/public/icons/settings.svg",
            "title" => "Minha conta",
            "description" => "Gerencia sua conta"
        ],
        "studio" => [
            "href"=> "/VHS/studio",
            "icon" => "/VHS/public/icons/studio.svg",
            "title"=> "VHS Studio",
            "description"=> "Gerencie seu conteúdo",
        ],
        "admin" => [
            "href" => "/VHS/admin/analytics",
            "icon"=> "/VHS/public/icons/Analytics.svg",
            "title"=> "Dashboard",
            "description"=> "Gerencie seus dados",
        ],
    ];

    $menu = [
        "ADMIN" => ["settings", "studio", "admin"],
        "CREATOR" => ["settings", "studio"],
        "USER" => ["settings"]
    ];

    $role = $_SESSION["user"]["role"];
    
    $menuHTML = "";

    foreach ($items as $key => $value) {
        if(in_array($key, $menu[$role])) {
            $menuHTML .= <<<HTML
                <a href='{$value["href"]}' class='flex gap-4 items-center w-full border-secondary/25 p-4 hover:bg-white/5 transition-all duration-200'>
                    <div class='flex-shrink-0 size-8 rounded-full bg-white/10 overflow-hidden'>
                        <img class='select-none pointer-events-none w-full h-full object-cover' src='{$value["icon"]}' onerror='this.src="/VHS/public/icons/settings.svg"'>
                    </div>
                    
                    <div class='flex flex-col justify-around flex-grow text-start'>
                        <span class='text-base font-semibold text-white'>{$value["title"]}</span>
                        <span class='text-sm text-secondary/50'>{$value["description"]}</span>
                    </div>
                </a>
            HTML;
        }   
    }


    return <<<HTML
        <div id='user-menu' class='hidden overflow-hidden border-secondary/10 fixed w-full sm:w-72 mx-auto flex flex-col h-auto sm:h-max bg-[#1b1b1b] rounded-tr-3xl rounded-tl-3xl sm:rounded-3xl shadow-xl shadow-black/50 transition-all duration-300 sm:duration-200 ease-out translate-y-full sm:translate-y-0 scale-95 bottom-0 sm:top-20 sm:right-5 z-20'>
            <div class='flex gap-4 items-center w-full border-secondary/25 p-4 hover:bg-white/5 transition-all duration-200'>
                <div class='flex-shrink-0 w-12 h-12 rounded-full bg-white/10 overflow-hidden'>
                    <img class='select-none pointer-events-none w-full h-full object-cover' src='/VHS/public/uploads/avatars/{$avatar_url}' onerror='this.src="/VHS/public/uploads/avatars/default.png"'>
                </div>
                
                <div class='flex flex-col justify-around flex-grow text-start'>
                    <h3 class='select-none truncate text-subtitle text-secondary'>$name</h3>
                    <h2 class='select-none truncate text-xs text-secondary/50'>$email</h2>
                </div>
            </div>

            <div class='flex flex-col border-secondary/25 w-full'>
                $menuHTML
            </div>

            <a href='?logout'>
                <button id='button-logout' class='w-full flex p-2 items-center gap-2 hover:bg-white/5 focus:bg-white/10 transition-all duration-200'>
                    <div class='flex-shrink-0 size-12 p-2 flex justify-center items-center'>
                        <img class='select-none pointer-events-none w-full h-full' src='/VHS/public/icons/Logout.svg' onerror='this.style.display="none"'>
                    </div>

                    <div class='flex flex-col text-start '>
                        <p class='select-none truncate text-subtitle text-[#bc3636]'>Sair da conta</p>
                    </div>
                </button>
            </a>
        </div>
    HTML;
}