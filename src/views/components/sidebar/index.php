<?php

    /*
        require_once __DIR__ . "/index.php";
        use function Src\Views\Components\Sidebar\CreateSidebar;

        <?= HeaderComponent(); ?>
        <?= CreateSidebar(); ?>
    */

    namespace Src\Views\Components\Sidebar;

    function CreateSidebear(

        $titleMenu = "MENU",
        $iconHome = "/VHS/public/icons/home.svg", $titleHome = "Início",
        $iconFast = "/VHS/public/icons/fast.svg", $titleFast = "Fast",
        $iconEvents = "/VHS/public/icons/radio.svg", $titleEvents = "Eventos",
        $iconHistory = "/VHS/public/icons/youtube.svg", $titleHistory = "Histórico",

        $titleCategory = "CATEGORIA",
        $iconTech = "/VHS/public/icons/cpu.svg", $titleTech = "Tecnologia",
        $iconHealth = "/VHS/public/icons/saude.svg", $titleHealth = "Saúde",
        $iconFashion = "/VHS/public/icons/moda.svg", $titleFashion = "Moda",
        $iconAesthetic = "/VHS/public/icons/estetica.svg", $titleAesthetic = "Estética"
        
    ) {

        return "
            <aside class='sidebar hidden opacity-0 sm:opacity-100 -translate-x-full sm:translate-x-0 px-4 sm:flex flex-col items-center sticky w-[4rem] sm:w-auto h-screen top-[4.5rem] left-0 select-none transition-all duration-300 z-10'>
            
                <div class='flex flex-col gap-6'>
                    <div class='flex flex-col gap-6 justify-center'>
                        <h2 class='hidden 2xl:flex text-white text-caption'>$titleMenu</h2>

                        <button class='flex flex-row gap-4 items-center'>
                            <div class='bg-white/5 p-[0.5rem] rounded-xl'>
                                <img src='$iconHome' class='w-[20px] min-w-[20px] max-w-[30px]'>
                            </div>
                            
                            <h2 class='hidden sm:flex text-secondary/50 text-paragraph'>$titleHome</h2>
                        </button>
                        
                        <button class='flex flex-row gap-4 items-center'>
                            <div class='bg-white/5 p-[0.5rem] rounded-xl'>
                                <img src='$iconFast' class='w-[20px] min-w-[20px] max-w-[30px]'>
                            </div>
                            
                            <h2 class='hidden sm:flex text-secondary/50 text-paragraph'>$titleFast</h2>
                        </button>

                        <button class='flex flex-row gap-4 items-center'>
                            <div class='bg-white/5 p-[0.5rem] rounded-xl'>
                                <img src='$iconEvents' class='w-[20px] min-w-[20px] max-w-[30px]'>
                            </div>
                            
                            <h2 class='hidden sm:flex text-secondary/50 text-paragraph'>$titleEvents</h2>
                        </button>

                        <button class='flex flex-row gap-4 items-center'>
                            <div class='bg-white/5 p-[0.5rem] rounded-xl'>
                                <img src='$iconHistory' class='w-[20px] min-w-[20px] max-w-[30px]'>
                            </div>
                            
                            <h2 class='hidden sm:flex text-secondary/50 text-paragraph'>$titleHistory</h2>
                        </button>
                    </div>

                    <hr class='divider w-full border-secondary/5 transition-all duration-300 ease-in-out'>
                    <h2 class='hidden 2xl:flex text-white text-caption'>$titleCategory</h2>

                    <div class='flex flex-col gap-6 justify-center'>
                        <button class='flex flex-row gap-4 items-center'>
                            <div class='bg-white/5 p-[0.5rem] rounded-xl'>
                                <img src='$iconTech' class='w-[20px] min-w-[20px] max-w-[30px]'>
                            </div>
                            
                            <h2 class='hidden sm:flex text-secondary/50 text-paragraph'>$titleTech</h2>
                        </button>

                        <button class='flex flex-row gap-4 items-center'>
                            <div class='bg-white/5 p-[0.5rem] rounded-xl'>
                                <img src='$iconHealth' class='w-[20px] min-w-[20px] max-w-[30px]'>
                            </div>
                            
                            <h2 class='hidden sm:flex text-secondary/50 text-paragraph'>$titleHealth</h2>
                        </button>

                        <button class='flex flex-row gap-4 items-center'>
                            <div class='bg-white/5 p-[0.5rem] rounded-xl hover:bg-white/10 transition-all duration-200 fade-in'>
                                <img src='$iconFashion' class='w-[20px] min-w-[20px] max-w-[30px]'>
                            </div>
                            
                            <h2 class='hidden sm:flex text-secondary/50 text-paragraph'>$titleFashion</h2>
                        </button>

                        <button class='flex flex-row gap-4 items-center'>
                            <div class='bg-white/5 p-[0.5rem] rounded-xl hover:bg-white/10 transition-all duration-200 fade-in'>
                                <img src='$iconAesthetic' class='w-[20px] min-w-[20px] max-w-[30px]'>
                            </div>
                            
                            <h2 class='hidden sm:flex text-secondary/50 text-paragraph'>$titleAesthetic</h2>
                        </button>
                    </div>
                </div>

            </aside>

            <script src='./script.js'></script>
        ";
    }

    // Sidebar Component v2.0
?>