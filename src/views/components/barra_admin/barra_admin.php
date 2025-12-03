<?php

namespace Src\Views\Components\barra_admin;

function barra_admin()
{
    $currentUri = $_SERVER['REQUEST_URI'];

    $menu = [
        "home" => [
            [
                "icon" => "/VHS/public/icons/sidebar_admin/chart-column.svg",
                "text" => "Analytics",
                "link" => "/VHS/admin/analytics"
            ],
            [
                "icon" => "/VHS/public/icons/sidebar_admin/users.svg",
                "text" => "Usuários",
                "link" => "/VHS/admin/users"
            ],
            [
                "icon" => "/VHS/public/icons/sidebar_admin/user-round-x.svg",
                "text" => "Denúncias",
                "link" => "/VHS/admin/complaints"
            ],
            [
                "icon" => "/VHS/public/icons/sidebar_admin/layout-grid.svg",
                "text" => "Categorias",
                "link" => "/VHS/admin/categories"
            ],
        ]
    ];

    $htmlHome = "";

    foreach ($menu["home"] as $value) {
        $isActive = strpos($currentUri, $value['link']) !== false;

        $activeClass = $isActive
            ? "bg-purple-600/20 text-white border-r-2 border-purple-500"
            : "text-gray-400 hover:bg-white/5 hover:text-white border-r-2 border-transparent";

        $iconOpacity = $isActive ? "opacity-100" : "opacity-70 group-hover:opacity-100";

        $htmlHome .= <<<HTML
            <li class="mb-2">
                <a href="{$value['link']}" class="group flex items-center gap-4 px-6 py-3.5 transition-all duration-300 {$activeClass}">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <img src="{$value['icon']}" alt="{$value['text']}" class="w-full h-full object-contain transition-opacity {$iconOpacity}">
                    </div>
                    <span class="font-medium text-sm tracking-wide">
                        {$value['text']}
                    </span>
                </a>
            </li>
        HTML;
    }

    return <<<HTML
        <aside id="admin-sidebar" class="flex flex-col w-0 md:w-64 h-screen sticky top-0 border-r border-white/5 bg-gradient-to-b from-[#100018] to-black z-50 overflow-hidden transition-all duration-300">
            <div class="px-6 py-6">
                <h2 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Administrador</h2>
                <div class="h-0.5 w-8 bg-purple-600 rounded-full"></div>
            </div>
            
            <nav class="flex-1 overflow-y-auto custom-scrollbar">
                <ul class="flex flex-col">
                    $htmlHome
                </ul>
            </nav>

            <div class="p-6 border-t border-white/5">
                <a href="/VHS/home" class="flex items-center gap-3 text-gray-400 hover:text-white transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="text-sm font-medium">Voltar para VHS</span>
                </a>
            </div>
            <script src="/VHS/src/views/components/barra_admin/script.js"></script>
        </aside>
    HTML;
}
