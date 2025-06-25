<?php
namespace src\views\components\header;

function Barra_Admin() {
    return '
    <aside class="w-44 ml-2 transition-all duration-500 ease-in-out top-20 sticky z-10 h-full" id="sidebar">
        <h2 class="w-[11rem] pt-[1.18rem] ml-[0.5rem] text-gray-400 text-xs font-poppins">ADMINISTRAÇÃO</h2>
        <ul>
            <li class="menu-item flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem] transition-transform duration-200">
                <a href="/VHS/src/views/analytics.php" class="flex items-center w-full p-2">
                    <div class="analytics-icon icon w-[2rem] h-[2rem] flex items-center justify-center rounded-[12px] ml-[0.31rem]">
                        <img src="/VHS/public/icons/sidebar_admin/chart.svg" alt="Analytics">
                    </div>
                    <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Analytics</h2>
                </a>
            </li>
            <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                <a href="/VHS/src/views/usuarios.php" class="flex items-center w-full p-2">
                    <div class="usuarios-icon icon w-[2rem] h-[2rem] flex items-center justify-center rounded-[12px] ml-[0.31rem]">
                        <img src="/VHS/public/icons/sidebar_admin/group.svg" alt="Usuários">
                    </div>
                    <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Usuários</h2>
                </a>
            </li>
        </ul>
    </aside>
    <script src="/VHS/src/views/components/barra_admin/barra.js"></script>
    ';
}
?>