<?php
namespace src\views\components\barra_admin;

function Barra_Admin(){
        return '  
            <aside class="sticky top-24 w-[9.25rem] ml-[1.87rem] transition-all duration-500 ease-in-out" id="sidebar">
                <h2 class=" pt-[1.18rem] ml-[0.31rem] text-gray-400 text-xs font-poppins">ADMINISTRAÇÃO</h2>
                <ul>
                    <li class="menu-item flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem] transition-transform duration-200">
                        <a href="/VHS/utils/Inicio.php" class="flex items-center w-full p-2">
                            <div class="icon Analytics-icon w-[2rem] h-[2rem] flex items-center justify-center bg-white/5 rounded-[12px] ml-[0.31rem] ">
                                <img src="/VHS/public/icons/sidebar_admin/chart.svg" alt="Analytics">
                            </div>
                            <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Analytics</h2>
                        </a>
                    </li>
        
                    <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                        <a href="/VHS/src/views/auth/user_management/index.php" class="flex items-center w-full p-2">
                            <div class="icon Usuarios-icon w-[2rem] h-[2rem] flex items-center justify-center bg-white/5 rounded-[12px] ml-[0.31rem]">
                                <img src="/VHS/public/icons/sidebar_admin/group.svg" alt="Usuarios">
                            </div>
                            <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Usuários</h2>
                        </a>
                    </li>
                </ul>
        

            <script src="/VHS/src/views/components/barra_admin/barra.js"></script>
        ';
    }
?>

            <script src="/VHS/src/views/components/barra_admin/barra.js"></script>
        ';
    }