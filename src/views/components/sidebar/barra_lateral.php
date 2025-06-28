<?php

    namespace Src\Views\Components\Sidebar;

    function SidebarComponent() {
<<<<<<< Updated upstream
        return '  
            <aside class="w-[9.25rem] ml-[1.87rem] h-screen transition-all duration-500 ease-in-out backdrop-blur-sm" id="sidebar">
                <h2 class="pt-[1.18rem] ml-[0.31rem] text-gray-400 text-xs font-poppins">HOME</h2>
                <ul>
                    <li class="menu-item flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem] transition-transform duration-200">
                        <a href="/VHS/utils/Inicio.php" class="flex items-center w-full p-2">
                            <div class="icon home-icon w-[2rem] h-[2rem] flex items-center justify-center bg-white/5 rounded-[12px] ml-[0.31rem] ">
                                <img src="/VHS/public/icons/Home.svg" alt="Início">
=======
        return "
            <aside class='flex w-[9.25rem] ml-[1.25rem] mr-[1.25rem] transition-all duration-500 ease-in-out top-[4.5rem] sticky z-10 h-full justify-center flex-col select-none' id='sidebar'>

                <h2 id='home-title' class='menu-text p-2 pt-0 text-gray-400 text-xs 2xl:text-sm font-poppins'>MENU</h2>
                
                <ul id='ul-menu' class='flex flex-col gap-[1.5rem] 2xl:gap-[2.5rem] mt-[1rem] 2xl:mt-[1.5rem] justify-center pl-2 pr-2'>
                    <li class='menu-item flex items-center text-gray-300 rounded-lg cursor-pointer transition-transform duration-200'>
                        <a href='#' class='flex items-center w-full'>
                            <div class='icon home-icon w-[2rem] h-[2rem] flex items-center justify-center bg-white/5 rounded-[12px]  '>
                                <img src='/VHS/public/icons/Home.svg' alt='Início'>
>>>>>>> Stashed changes
                            </div>
                            <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Início</h2>
                        </a>
                    </li>
        
                    <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                        <a href="/VHS/utils/Fast.php" class="flex items-center w-full p-2">
                            <div class="icon fast-icon w-[2rem] h-[2rem] flex items-center justify-center bg-white/5 rounded-[12px] ml-[0.31rem]">
                                <img src="/VHS/public/icons/Fast.svg" alt="Fast">
                            </div>
                            <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Fast</h2>
                        </a>
                    </li>
        
                    <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                        <a href="/VHS/utils/Eventos.php" class="flex items-center w-full p-2">
                            <div class="icon eventos-icon w-[2rem] h-[2rem] flex items-center justify-center bg-white/5 rounded-[12px] ml-[0.31rem]">
                                <img src="/VHS/public/icons/radio.svg" alt="Eventos">
                            </div>
                            <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Eventos</h2>
                        </a>
                    </li>
        
                        <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                        <a href="/VHS/utils/Histórico.php" class="flex items-center w-full p-2">
                            <div class="icon historico-icon w-[2rem] h-[2rem] flex items-center justify-center bg-white/5 rounded-[12px] ml-[0.31rem]">
                                <img src="/VHS/public/icons/youtube.svg" alt="Histórico">
                            </div>
                            <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Histórico</h2>
                        </a>
                    </li>
                </ul>
        
                <hr class="divider w-[8.06rem] mt-[1.81rem] border-gray-800 transition-all duration-300 ease-in-out">
        
                <h2 id="categoria-title" class="menu-text pt-[1.18rem] ml-[0.31rem] text-gray-400 text-sm font-poppins">CATEGORIA</h2>
        
                <ul>
                    <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem]">
                        <a href="/VHS/utils/Tecnologia.php" class="flex items-center w-full p-2">
                            <div class="icon tecnologia-icon w-[2rem] h-[2rem] flex items-center justify-center bg-white/5 rounded-[12px] ml-[0.31rem]">
                                <img src="/VHS/public/icons/cpu.svg" alt="Tecnologia">
                            </div>
                            <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Tecnologia</h2>
                        </a>
                    </li>
        
                    <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                        <a href="/VHS/utils/Saúde.php" class="flex items-center w-full p-2">
                            <div class="icon saude-icon w-[2rem] h-[2rem] flex items-center justify-center bg-white/5 rounded-[12px] ml-[0.31rem]">
                                <img src="/VHS/public/icons/Saude.svg" alt="Saúde">
                            </div>
                            <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Saúde</h2>
                        </a>
                    </li>
        
                    <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                        <a href="/VHS/utils/Moda.php" class="flex items-center w-full p-2">
                            <div class="icon moda-icon w-[2rem] h-[2rem] flex items-center justify-center bg-white/5 rounded-[12px] ml-[0.31rem]">
                                <img src="/VHS/public/icons/Moda.svg" alt="Moda">
                            </div>
                            <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Moda</h2>
                        </a>
                    </li>
        
                    <li class="flex items-center text-gray-300 rounded-lg cursor-pointer mt-[2rem]">
                        <a href="/VHS/utils/Estética.php" class="flex items-center w-full p-2">
                            <div class="icon estetica-icon w-[2rem] h-[2rem] flex items-center justify-center bg-white/5 rounded-[12px] ml-[0.31rem]">
                                <img src="/VHS/public/icons/Estetica.svg" alt="Estética">
                            </div>
                            <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Estética</h2>
                        </a>
                    </li>
                </ul>
                <hr class="divides w-[8.06rem] mt-[1.81rem] border-gray-800 transition-all duration-300 ease-in-out">
            </aside>
            <script src="/VHS/src/views/components/sidebar/script.js"></script>
        ';
    }
?>