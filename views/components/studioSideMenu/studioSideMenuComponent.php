<?php
namespace src\views\components\header;

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

    echo '<div id="sideMenuContainer">';
    echo '<aside class="w-[9.25rem] ml-[1.87rem] h-screen" style="display: none;">';
    echo '<h2 class="pt-[1.18rem] ml-[0.31rem] text-gray-400 text-xs font-poppins">VHS STUDIO</h2><ul>';

    foreach ($menuItems as $page => $data) {
        echo '<li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem]">
            <a href="../utils/'.$page.'" class="flex items-center w-full p-2">
                <div class="icon w-[2rem] h-[2rem] flex items-center justify-center bg-[#660BAD] '.(isActive($page) ? 'bg-opacity-100' : 'bg-opacity-10').' rounded-[12px] ml-[0.31rem] '.$data['class'].'">
                    <img src="../../../public/icons/sidebar_studio/'.$data["icon"].'" alt="'.$data["label"].'" class="'.(isActive($page) ? 'filter invert brightness-0' : '').'">
                </div>
                <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold '.(isActive($page) ? 'text-white' : '').'">'.$data["label"].'</h2>
            </a>
        </li>';
    }

    

    echo '</ul></aside></div>';

    echo '<script src="./studioSideMenu/studioSideMenuScript.js"></script>';
}
?>