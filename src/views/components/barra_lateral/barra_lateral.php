<?php 

namespace src\views\components\sidebar;

function SidebarComponent(){
        return '  
            <aside class="w-[9.25rem] ml-[1.87rem] h-screen transition-all duration-500 ease-in-out bg-gray-950/50 backdrop-blur-sm" id="sidebar">
                <h2 class=" pt-[1.18rem] ml-[0.31rem] text-gray-400 text-xs font-poppins">HOME</h2>
                <ul>
                    <li class="menu-item flex items-center text-gray-300 rounded-lg cursor-pointer mt-[1.5rem] transition-transform duration-200">
                        <a href="/VHS/utils/Inicio.php" class="flex items-center w-full p-2">
                            <div class="icon home-icon w-[2rem] h-[2rem] flex items-center justify-center bg-white/5 rounded-[12px] ml-[0.31rem] ">
                                <img src="/VHS/public/icons/Home.svg" alt="Início">
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
                                <img src="/VHS/public/icons/estetica.svg" alt="Estética">
                            </div>
                            <h2 class="menu-text ml-[1rem] text-gray-400 text-sm font-semibold transition-all duration-500 ease-in-out">Estética</h2>
                        </a>
                    </li>
                </ul>
                <hr class="divides w-[8.06rem] mt-[1.81rem] border-gray-800 transition-all duration-300 ease-in-out">
            </aside>
            <script src="script.js"></script>
        ';
    }