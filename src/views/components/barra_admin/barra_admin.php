<?php

namespace Src\Views\Components\barra_admin;

function barra_admin()
{
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
        <aside class="ml-8 transition-all w-[10.3rem]">
            <h3 class="mb-4 text-secondary text-sm mt-6 mb-2">ADMINISTRADOR</h3>
            <ul class="flex flex-col gap-6">
                $htmlHome
            </ul>
            <script src="/VHS/src/views/components/barra_admin/script.js"></script>
        </aside>
    HTML;
}
