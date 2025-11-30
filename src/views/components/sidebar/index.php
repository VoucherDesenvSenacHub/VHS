<?php

namespace Src\Views\Components\Sidebar;

require_once __DIR__ . '/../../../infra/models/category.php';

use Src\Infra\Model\CategoryModel;

function SidebarComponent()
{
    $categoriesFromDb = [];

    try {
        $categoryModel = new CategoryModel();


        $categoriesFromDb = $categoryModel->getAllCategories();
    } catch (\Exception $e) {

        $categoriesFromDb = [];
    }


    $formatedcategories = [];

    foreach ($categoriesFromDb as $category) {

        $text = is_array($category) ? ($category['name'] ?? 'Sem Nome') : $category;

        $formatedcategories[] = [
            "text" => $text,
            "link" => "/VHS/home/categories?category=" . urlencode($text)
        ];
    };


    $currentPath = $_SERVER['REQUEST_URI'];

    $menu = [
        "home" => [
            [
                "icon" => "/VHS/public/icons/home.svg",
                "text" => "Início",
                "link" => "/VHS/home",
                "active" => $currentPath === '/VHS/home' || $currentPath === '/VHS/home/'
            ],
            [
                "icon" => "/VHS/public/icons/fast.svg",
                "text" => "Fast",
                "link" => "/VHS/home/fasts",
                "active" => strpos($currentPath, '/home/fasts') !== false
            ],
            [
                "icon" => "/VHS/public/icons/youtube.svg",
                "text" => "Histórico",
                "link" => "/VHS/home/history",
                "active" => strpos($currentPath, '/home/history') !== false
            ]
        ],
        "categories" => $formatedcategories
    ];

    $htmlHome = "";
    foreach ($menu["home"] as $value) {
        $activeClass = $value['active']
            ? 'bg-purple-600/20 text-white border-r-2 border-purple-500'
            : 'text-gray-400 hover:bg-white/5 hover:text-white border-r-2 border-transparent';

        $iconOpacity = $value['active'] ? 'opacity-100' : 'opacity-70 group-hover:opacity-100';

        $htmlHome .= <<<HTML
            <li class="mb-2">
                <a href="{$value['link']}" class="group flex items-center gap-4 px-6 py-3.5 transition-all duration-300 {$activeClass}">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <img src="{$value['icon']}" class="w-full h-full object-contain transition-opacity {$iconOpacity}">
                    </div>
                    <span class="font-medium text-sm tracking-wide">{$value['text']}</span>
                </a>
            </li>
        HTML;
    }

    $htmlCategories = "";
    foreach ($menu["categories"] as $value) {
        $isActive = strpos($currentPath, 'category=' . urlencode($value['text'])) !== false;
        $activeClass = $isActive
            ? 'text-purple-400 font-medium'
            : 'text-gray-400 hover:text-white';

        $htmlCategories .= <<<HTML
            <li class="mb-1">
                <a href="{$value['link']}" class="block px-6 py-2 text-sm transition-colors {$activeClass}">
                    {$value['text']}
                </a>
            </li>
        HTML;
    }

    return <<<HTML
        <aside id="main-sidebar" class="hidden md:flex flex-col w-64 h-[calc(100vh-5rem)] sticky top-20 border-r border-white/5 bg-[#0C0118]/50 backdrop-blur-sm transition-all duration-300">
            <div class="px-6 py-6">
                <h2 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Menu Principal</h2>
                <div class="h-0.5 w-8 bg-purple-600 rounded-full"></div>
            </div>
            
            <nav class="flex-1 overflow-y-auto custom-scrollbar">
                <ul class="flex flex-col mb-6">
                    $htmlHome
                </ul>

                <div class="px-6 mb-2">
                    <button onclick="CategoriesON(event)" class="flex items-center gap-3 group w-full text-left">
                        <div class="w-6 h-6 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-white/10 transition-colors">
                            <img src="/VHS/public/icons/GridOff.svg" class="w-4 h-4 opacity-70 group-hover:opacity-100 transition-opacity">
                        </div>
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-widest group-hover:text-gray-300 transition-colors">Categorias</span>
                    </button>
                </div>

                <div id="categories-wrapper" class="grid grid-rows-[0fr] transition-[grid-template-rows] duration-300 ease-in-out overflow-hidden">
                    <ul id="categories-list" class="flex flex-col min-h-0 border-l border-white/5 ml-9 my-2">
                        $htmlCategories
                    </ul>
                </div>
            </nav>
            <script src="/VHS/src/views/components/sidebar/script.js"></script>
        </aside>
    HTML;
}
