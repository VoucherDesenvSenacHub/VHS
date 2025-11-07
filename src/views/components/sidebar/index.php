<?php

namespace Src\Views\Components\Sidebar;

function SidebarComponent() {
    $menu = [
        "home" => [
            [
                "icon" => "/VHS/public/icons/home.svg",
                "text" => "Início",
                "link" => "/VHS/src/views/pages/home"
            ],
            [
                "icon" => "/VHS/public/icons/fast.svg",
                "text" => "Fast",
                "link" => "/VHS/src/views/pages/home/fast"
            ],
            [
                "icon" => "/VHS/public/icons/radio.svg",
                "text" => "Eventos",
                "link" => "/VHS/src/views/pages/home/events"
            ],
            [
                "icon" => "/VHS/public/icons/youtube.svg",
                "text" => "Histórico",
                "link" => "/VHS/src/views/pages/home/history"
            ]
        ],

        "categories" => [
            "tech" => [
                "icon" => "/VHS/public/icons/cpu.svg",
                "text" => "Tecnologia",
                "link" => "/VHS/src/views/pages/home/categories?category=tecnologia"
            ],
            "health" => [
                "icon" => "/VHS/public/icons/saude.svg",
                "text" => "Saúde",
                "link" => "/VHS/src/views/pages/home/categories?category=saude"
            ],
            "fashion" => [
                "icon" => "/VHS/public/icons/moda.svg",
                "text" => "Moda",
                "link" => "/VHS/src/views/pages/home/categories?category=moda"
            ],
            "aesthetics" => [
                "icon" => "/VHS/public/icons/estetica.svg",
                "text" => "Estética",
                "link" => "/VHS/src/views/pages/home/categories?category=estetica"
            ]
        ]
    ];

    $htmlCategories = "";
    $htmlHome = "";

    foreach ($menu["categories"] as $value) {
        $htmlCategories .= <<<HTML
            <li class="flex items-center gap-4 transition-colors">
                <a href="{$value['link']}" class="size-8 bg-[#241A2F] p-1 rounded-lg icon min-w-8">
                    <img src="{$value['icon']}" class="w-full h-full">
                </a>

                <a href="{$value['link']}" class="text-secondary/75 hover:text-secondary transition-all menu-text">
                    {$value['text']}
                </a>
            </li>
        HTML;
    }

    foreach ($menu["home"] as $value) {
        $htmlHome .= <<<HTML
            <li class="flex items-center gap-4 transition-colors">
                <a href="{$value['link']}" class="size-8 bg-[#241A2F] p-1 rounded-lg icon min-w-8">
                    <img src="{$value['icon']}" class="w-full h-full">
                </a>

                <a href="{$value['link']}" class="text-secondary/75 hover:text-secondary transition-all menu-text">
                    {$value['text']}
                </a>
            </li>
        HTML;
    }

    return <<<HTML
        <aside class="h-[91vh] w-64 top-16 sticky p-7 transition-all border-r border-secondary/10">
            <h3 class="title text-secondary text-sm">HOME</h3>
            <ul class="flex flex-col gap-9 mt-5">
                $htmlHome
            </ul>
            <hr class="my-6 border-b-1 border-secondary/10 separator">
            <h3 class="title text-secondary text-sm my-6">CATEGORIAS</h3>
            <ul class="flex flex-col gap-9">
                $htmlCategories
            </ul>
            <script src="/VHS/src/views/components/sidebar/script.js"></script>
        </aside>
    HTML;
    
}