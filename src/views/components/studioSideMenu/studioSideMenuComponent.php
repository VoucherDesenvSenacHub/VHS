<?php
namespace src\views\components\studioSideMenu;

function isActive($page)
{
    return basename($_SERVER['PHP_SELF']) === $page ? 'bg-[#660BAD] bg-opacity-100 text-white' : '';
}

$menuItems = [
    'Analytics.php' => ['icon' => 'Analytics.svg', 'label' => 'Analytics', 'class' => 'analytics-icon'],
    'Conteúdo.php' => ['icon' => 'Conteúdo.svg', 'label' => 'Conteúdo', 'class' => 'conteudo-icon'],
    'Customizar.php' => ['icon' => 'Customizar.svg', 'label' => 'Customizar', 'class' => 'customizar-icon'],
    'Comentários.php' => ['icon' => 'Comentários.svg', 'label' => 'Comentários', 'class' => 'comentarios-icon'],
    'Criar.php' => ['icon' => 'Criar.svg', 'label' => 'Criar', 'class' => 'criar-icon'],
];

function StudioSideMenuComponent() {
    global $menuItems;

    echo '<div id="sideMenuContainer" style="width: calc(9.25rem + 1.87rem); top: 4rem; left: 0; height: calc(100vh - 4rem);">';
    echo '<aside id="sidebar" class="w-[10.25rem] ml-[1.87rem] h-full transition-all duration-300" style="display: block;">';
    echo '<h2 class="pt-[1.18rem] ml-[0.31rem] mr-5 text-gray-400 text-xs font-poppins">VHS STUDIO</h2><ul>';

    foreach ($menuItems as $page => $data) {
        echo '<li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem]">
            <a href="../studio/'.$page.'" class="flex items-center w-full p-2">
                <div class="icon w-[2rem] h-[2rem] flex items-center justify-center bg-[#660BAD] '.(isActive($page) ? 'bg-opacity-100' : 'bg-opacity-10').' rounded-[12px] ml-[0.31rem] '.$data['class'].'">
                    <img src="/VHS/public/icons/sidebar_studio/'.$data["icon"].'" alt="'.$data["label"].'" class="'.(isActive($page) ? 'filter invert brightness-0' : '').'">
                </div>
                <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold '.(isActive($page) ? 'text-white' : '').'">'.$data["label"].'</h2>
            </a>
        </li>';
    }

    echo '</ul></aside></div>';

    echo '<script src="\VHS\src\views\components\studioSideMenu\studioSideMenuScript.js"></script>';
}

?>