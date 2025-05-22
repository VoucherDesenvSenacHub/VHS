<?php
namespace src\views\components\header;

function isActive($page)
{
    return basename($_SERVER['PHP_SELF']) === $page ? 'bg-[#660BAD] bg-opacity-100 text-white' : '';
}

$menuItems = [
    'Analytics.php' => ['icon' => 'chart.svg', 'label' => 'Analytics', 'class' => 'analytics-icon'],
    'usuarios.php' => ['icon' => 'group.svg', 'label' => 'Usuários', 'class' => 'usuarios-icon'],
];

function barra_admin() {
    global $menuItems;

    echo '<div id="sideMenuContainer">';
    echo '<aside class="w-[9.25rem] ml-[1.87rem] h-screen">';
    echo '<h2 class="pt-[1.18rem] ml-[0.31rem] text-gray-400 text-xs font-poppins">ADMINISTRAÇÃO</h2><ul>';

    foreach ($menuItems as $page => $data) {
        echo '<li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem]">
            <a href="/VHS/src/views/auth/'.$page.'" class="flex items-center w-full p-2">
                <div class="icon w-[2rem] h-[2rem] flex items-center justify-center bg-[#660BAD] '.(isActive($page) ? 'bg-opacity-100' : 'bg-opacity-10').' rounded-[12px] ml-[0.31rem] '.$data['class'].'">
                    <img src="/VHS/public/icons/sidebar_admin/'.$data["icon"].'" alt="'.$data["label"].'" class="'.(isActive($page) ? 'filter invert brightness-0' : '').'">
                </div>
                
                <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold ' .(isActive($page) ? 'text-white' : '').'" style="display: none;" >'.$data["label"].'</h2>

            </a>
        </li>';
    }

    

    echo '</ul></aside></div>';

    echo '<script src="/VHS/src/views/components/barra_admin/barra_admin.js"></script>';
}
?>