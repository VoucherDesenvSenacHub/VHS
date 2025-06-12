<?php
namespace src\views\components\studioSideMenu;

function StudioSideMenuComponent(){
    return '  
        <aside class="w-[9.5rem] ml-[1.87rem] h-screen transition-all duration-500 ease-in-out backdrop-blur-sm" id="sidebar">
            <h2 class="w-[9.5rem] pt-[1.18rem] ml-[0.5rem] text-gray-400 text-xs font-poppins">VHS STUDIO</h2>
            <ul>
                <li class="menu-item flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem] transition-transform duration-200">
                    <a href="/VHS/utils/Inicio.php" class="flex items-center w-full p-2">
                        <div class="icon home-icon w-[2rem] h-[2rem] flex items-center justify-center bg-white/5 rounded-[12px] ml-[0.31rem] ">
                            <img src="/VHS/public/icons/sidebar_studio/Analytics.svg" alt="Analytics">
                        </div>
                        <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Analytics</h2>
                    </a>
                </li>
    
                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                    <a href="/VHS/utils/Fast.php" class="flex items-center w-full p-2">
                        <div class="icon fast-icon w-[2rem] h-[2rem] flex items-center justify-center bg-white/5 rounded-[12px] ml-[0.31rem]">
                            <img src="/VHS/public/icons/sidebar_studio/Conteúdo.svg" alt="Conteúdo">
                        </div>
                        <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Conteúdo</h2>
                    </a>
                </li>
    
                <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                    <a href="/VHS/utils/Eventos.php" class="flex items-center w-full p-2">
                        <div class="icon eventos-icon w-[2rem] h-[2rem] flex items-center justify-center bg-white/5 rounded-[12px] ml-[0.31rem]">
                            <img src="/VHS/public/icons/sidebar_studio/Customizar.svg" alt="Customizar">
                        </div>
                        <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Customizar</h2>
                    </a>
                </li>
    
                    <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                    <a href="/VHS/utils/Histórico.php" class="flex items-center w-full p-2">
                        <div class="icon historico-icon w-[2rem] h-[2rem] flex items-center justify-center bg-white/5 rounded-[12px] ml-[0.31rem]">
                            <img src="/VHS/public/icons/sidebar_studio/Criar.svg" alt="Criar">
                        </div>
                        <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Histórico</h2>
                    </a>
                </li>
            </ul>
        </aside>
        <script src="\VHS\src\views\components\studioSideMenu\studioSideMenuScript.js"></script>
    ';
}
?>
