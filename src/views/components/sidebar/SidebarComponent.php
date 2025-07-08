<?php

namespace Src\Views\Components\Sidebar;

function SidebarComponent() {
    $menu = [
        "home" => [
            [
                "icon" => "/VHS/public/icons/Home.svg",
                "text" => "Início",
                "link" => "/VHS/src/views/pages/home"
            ],
            [
                "icon" => "/VHS/public/icons/Fast.svg",
                "text" => "Fast",
                "link" => "/VHS/src/views/pages/home/fast"
            ],
            [
                "icon" => "/VHS/public/icons/radio.svg",
                "text" => "Eventos",
                "link" => "/VHS/utils/Eventos"
            ],
            [
                "icon" => "/VHS/public/icons/youtube.svg",
                "text" => "Histórico",
                "link" => "/VHS/utils/Histórico"
            ]
        ],
        "categories" => [
            "tech" => [
                "icon" => "/VHS/public/icons/cpu.svg",
                "text" => "Tecnologia",
                "link" => "/VHS/src/views/pages/home/categories?category=tecnologia"
            ],
            "health" => [
                "icon" => "/VHS/public/icons/Saude.svg",
                "text" => "Saúde",
                "link" => "/VHS/src/views/pages/home/categories?category=saude"
            ],
            "fashion" => [
                "icon" => "/VHS/public/icons/Moda.svg",
                "text" => "Moda",
                "link" => "/VHS/src/views/pages/home/categories?category=moda"
            ],
            "aesthetics" => [
                "icon" => "/VHS/public/icons/Estetica.svg",
                "text" => "Estética",
                "link" => "/VHS/src/views/pages/home/categories?category=estetica"
            ]
        ]
    ];

    $htmlCategories = "";
    $htmlHome = "";

    foreach ($menu["categories"] as $value) {
        $htmlCategories .= <<<HTML
            <li class="flex items-center gap-4 py-2 rounded-lg transition-colors">
                <a href="{$value['link']}" class="size-8 bg-[#241A2F] p-1.5 rounded-lg icon min-w-8">
                    <img src="{$value['icon']}" alt="{$value['text']}" class="w-full h-full">
                </a>
                <a href="{$value['link']}" class="text-secondary
                    hover:text-gray-300 transition-all menu-text">
                    {$value['text']}
                </a>
            </li>
        HTML;
    }

    foreach ($menu["home"] as $value) {
        $htmlHome .= <<<HTML
            <li class="flex items-center gap-4 py-2 rounded-lg transition-colors">
                <a href="{$value['link']}" class="size-8 bg-[#241A2F] p-1.5 rounded-lg icon min-w-8">
                    <img src="{$value['icon']}" alt="{$value['text']}" class="w-full h-full">
                </a>
                <a href="{$value['link']}" class="text-secondary
                    hover:text-gray-300 transition-all menu-text">
                    {$value['text']}
                </a>
            </li>
        HTML;
    }

    return <<<HTML
        <aside class="ml-8 transition-all">
            <h3 class="mb-4 text-secondary text-sm mt-6 mb-2">HOME</h3>
            <ul class="flex flex-col gap-6">
                $htmlHome
            </ul>
            
            <hr class="my-4 border-zinc-700 separator">

            <h3 class="mb-4 text-secondary text-sm mt-6 mb-2">CATEGORIAS</h3>
            <ul class="flex flex-col gap-6">
                $htmlCategories
            </ul>

            <hr class="my-4 border-zinc-700 separator">
            
            <script src="/VHS/src/views/components/sidebar/script.js"></script>
        </aside>
    HTML;
}
