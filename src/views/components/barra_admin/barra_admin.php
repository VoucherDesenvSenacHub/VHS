<?php

namespace Src\Views\Components\barra_admin;

function barra_admin() {
    $menu = [
        "admin" => [
            [
                "icon" => "/VHS/public/icons/sidebar_admin/chart-column.svg",
                "text" => "Analytics",
                "link" => "/VHS/admin/analytics",
                "id"   => "analytics-btn"
            ],
            [
                "icon" => "/VHS/public/icons/sidebar_admin/users.svg",
                "text" => "Usuários",
                "link" => "/VHS/admin/users",
                "id"   => "usuarios-btn"
            ],
            [
                "icon" => "/VHS/public/icons/sidebar_admin/layout-grid.svg",
                "text" => "Categorias",
                "link" => "/VHS/admin/categories",
                "id"   => "categorias-btn"
            ]
        ]
    ];

    $htmlAdmin = "";

    foreach ($menu["admin"] as $value) {
        $htmlAdmin .= <<<HTML
            <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-4 transition-transform duration-200">
                <a href="{$value['link']}" class="flex items-center w-full gap-2 p-2">
                    <button id="{$value['id']}" class="icon p-2 flex items-center justify-center bg-white/5 rounded-lg ml-[0.31rem]">
                        <img class="w-6 h-6" src="{$value['icon']}" alt="{$value['text']}">
                    </button>
                    <h2 class="menu-text text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">{$value['text']}</h2>
                </a>
            </li>
        HTML;
    }

    return <<<HTML
        <aside class="sticky top-24 w-[9.25rem] ml-[1.87rem] transition-all duration-500 ease-in-out" id="sidebar">
            <h2 class="pt-[1.18rem] ml-[0.31rem] text-gray-400 text-xs font-poppins">ADMINISTRAÇÃO</h2>
            <ul class="space-y-4">
                $htmlAdmin
            </ul>
        </aside>

        <script src="/VHS/src/views/components/barra_admin/script.js"></script>
    HTML;
}
?>