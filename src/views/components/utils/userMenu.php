<?php

namespace Src\Views\Components\Utils;

function UserMenu(string $avatar_url, string $name, string $email)
{

    $items = [
        "settings" => [
            "href" => "/VHS/user/settings",
            "icon" => "/VHS/public/icons/settings.svg",
            "title" => "Minha conta",
            "description" => "Gerencie seu perfil e preferências"
        ],
        "studio" => [
            "href" => "/VHS/studio/analytics",
            "icon" => "/VHS/public/icons/studio.svg",
            "title" => "VHS Studio",
            "description" => "Crie e gerencie seu conteúdo",
        ],
        "admin" => [
            "href" => "/VHS/admin/analytics",
            "icon" => "/VHS/public/icons/Analytics.svg",
            "title" => "Painel Admin",
            "description" => "Administração do sistema",
        ],
    ];

    $menu = [
        "ADMIN" => ["settings", "studio", "admin"],
        "CREATOR" => ["settings", "studio"],
        "USER" => ["settings"]
    ];

    $role = $_SESSION["user"]["role"] ?? 'USER';

    $menuHTML = "";

    foreach ($items as $key => $value) {
        if (in_array($key, $menu[$role] ?? [])) {
            $menuHTML .= <<<HTML
                <a href='{$value["href"]}' class='group flex gap-4 items-center w-full p-3 rounded-xl hover:bg-white/10 transition-all duration-200 border border-transparent hover:border-white/5'>
                    <div class='flex-shrink-0 w-10 h-10 rounded-full bg-white/5 flex items-center justify-center group-hover:bg-purple-500/20 transition-colors'>
                        <img class='w-5 h-5 object-contain opacity-70 group-hover:opacity-100 transition-opacity' src='{$value["icon"]}' onerror='this.src="/VHS/public/icons/settings.svg"'>
                    </div>
                    
                    <div class='flex flex-col justify-center flex-grow text-start'>
                        <span class='text-sm font-medium text-gray-200 group-hover:text-white transition-colors'>{$value["title"]}</span>
                        <span class='text-xs text-gray-500 group-hover:text-gray-400 transition-colors'>{$value["description"]}</span>
                    </div>
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600 group-hover:text-gray-300 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            HTML;
        }
    }


    return <<<HTML
        <div id='user-menu' class='hidden fixed w-full sm:w-80 mx-auto flex flex-col h-auto max-h-[26.5rem] bg-[#121214]/95 backdrop-blur-xl border border-white/10 rounded-t-3xl sm:rounded-2xl shadow-2xl shadow-black/80 transition-all duration-300 ease-out transform translate-y-full sm:translate-y-0 opacity-0 scale-95 bottom-0 sm:top-20 sm:right-6 z-50 overflow-hidden'>
            
            <!-- Header do Menu -->
            <div class='relative p-5 border-b border-white/5 bg-gradient-to-r from-purple-900/20 to-transparent'>
                <div class='flex items-center gap-4'>
                    <div class='relative flex-shrink-0 w-14 h-14 rounded-full p-[2px] bg-gradient-to-tr from-purple-500 to-pink-500'>
                        <img class='w-full h-full rounded-full object-cover border-2 border-[#121214]' src='/VHS/public/uploads/avatars/{$avatar_url}' onerror='this.src="/VHS/public/uploads/avatars/default.png"'>
                    </div>
                    
                    <div class='flex flex-col justify-center overflow-hidden'>
                        <h3 class='truncate text-base font-bold text-white'>$name</h3>
                        <h2 class='truncate text-xs text-gray-400'>$email</h2>
                        <span class='mt-1 inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-white/10 text-gray-300 w-fit'>
                            {$role}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Lista de Opções -->
            <div class='flex flex-col p-2 gap-1 overflow-y-auto custom-scrollbar'>
                $menuHTML
            </div>

            <!-- Footer / Logout -->
            <div class='p-2 mt-1 border-t border-white/5 bg-white/[0.02]'>
                <a href='?logout' class='group flex items-center gap-3 w-full p-3 rounded-xl hover:bg-red-500/10 transition-all duration-200 border border-transparent hover:border-red-500/20'>
                    <div class='flex-shrink-0 w-10 h-10 rounded-full bg-white/5 flex items-center justify-center group-hover:bg-red-500/20 transition-colors'>
                        <img class='w-5 h-5 object-contain opacity-70 group-hover:opacity-100 transition-opacity' src='/VHS/public/icons/Logout.svg'>
                    </div>

                    <div class='flex flex-col text-start'>
                        <span class='text-sm font-medium text-gray-300 group-hover:text-red-400 transition-colors'>Sair da conta</span>
                    </div>
                </a>
            </div>
        </div>
    HTML;
}
