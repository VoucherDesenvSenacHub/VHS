<?php

    /*
        require_once __DIR__ . "/index.php";
        use function Src\Views\Components\Sidebar\CreateSidebar;

        <?= HeaderComponent(); ?>
        <?= CreateSidebar(); ?>
    */

    namespace Src\Views\Components\Sidebar;

    $pages = isset($_GET['page']) ? $_GET['page'] : 'inicio';

    $menu = [
        'inicio' => 'Inicio',
        'fast' => 'Fast',
        'eventos' => 'Eventos',
        'historico' => 'Histórico',
    ];

    $categories = [
        'tecnologia' => 'Tecnologia',
        'saude' => 'Saúde',
        'moda' => 'Moda',
        'estetica' => 'Estética',
    ];

    function CreateSidebar(
        
        $titleMenu = "MENU",
        $iconHome = "/VHS/public/icons/home.svg", $titleHome = "Início",
        $iconFast = "/VHS/public/icons/fast.svg", $titleFast = "Fast",
        $iconEvents = "/VHS/public/icons/radio.svg", $titleEvents = "Eventos",
        $iconHistory = "/VHS/public/icons/youtube.svg", $titleHistory = "Histórico",
        
        $titleCategory = "CATEGORIAS",
        $iconTech = "/VHS/public/icons/cpu.svg", $titleTech = "Tecnologia",
        $iconHealth = "/VHS/public/icons/saude.svg", $titleHealth = "Saúde",
        $iconFashion = "/VHS/public/icons/moda.svg", $titleFashion = "Moda",
        $iconAesthetic = "/VHS/public/icons/estetica.svg", $titleAesthetic = "Estética"

    ) {

        return "
            <aside class='sidebar hidden opacity-0 sm:opacity-100 -translate-x-full sm:translate-x-0 px-4 sm:flex sticky flex-col items-center w-[4.5rem] sm:w-auto h-full top-[4.5rem] left-0 select-none transition-all duration-300 z-10'>
            
                <div class='flex flex-col gap-6'>
                    <div class='flex flex-col gap-6 justify-center'>
                        <h2 class='hidden menu-titles text-secondary/50 text-caption'>$titleMenu</h2>

                        <a class='option flex flex-row gap-4 items-center cursor-pointer'>
                            <div class='bg-white/5 hover:bg-white/10 p-[0.5rem] rounded-xl'>
                                <img src='$iconHome' class='w-[20px] sm:w-[25px] 3xl:w-[30px] min-w-[20px] max-w-[30px]'>
                            </div>
                            
                            <h2 class='menu-titles hidden text-white/75 text-paragraph'>
                                $titleHome
                            </h2>
                        </a>

                        
                        <a href='/VHS/menu?page=$key' class='option flex flex-row gap-4 items-center cursor-pointer'>
                            <div class='bg-white/5 p-[0.5rem] rounded-xl'>
                                <img src='$iconFast' class='w-[20px] sm:w-[25px] 3xl:w-[30px] min-w-[20px] max-w-[30px]'>
                            </div>
                            
                            <h2 class='menu-titles hidden text-white/75 text-paragraph transition-opacity duration-300 ease-in-out'>$titleFast</h2>
                        </a>

                        <a class='option flex flex-row gap-4 items-center cursor-pointer'>
                            <div class='bg-white/5 p-[0.5rem] rounded-xl'>
                                <img src='$iconEvents' class='w-[20px] sm:w-[25px] 3xl:w-[30px] min-w-[20px] max-w-[30px]''>
                            </div>
                            
                            <h2 class='menu-titles hidden text-white/75 text-paragraph transition-opacity duration-300 ease-in-out'>$titleEvents</h2>
                        </a>

                        <a class='option flex flex-row gap-4 items-center cursor-pointer'>
                            <div class='bg-white/5 p-[0.5rem] rounded-xl'>
                                <img src='$iconHistory' class='w-[20px] sm:w-[25px] 3xl:w-[30px] min-w-[20px] max-w-[30px]'>
                            </div>
                            
                            <h2 class='menu-titles hidden text-white/75 text-paragraph transition-opacity duration-300 ease-in-out'>$titleHistory</h2>
                        </a>
                    </div>

                    <hr class='divider w-full border-secondary/10 transition-all duration-300 ease-in-out'>
                    <h2 class='menu-titles hidden text-secondary/50 text-caption'>$titleCategory</h2>

                    <div class='flex flex-col gap-6 justify-center'>
                        <a class='option flex flex-row gap-4 items-center cursor-pointer'>
                            <div class='bg-white/5 p-[0.5rem] rounded-xl'>
                                <img src='$iconTech' class='w-[20px] sm:w-[25px] 3xl:w-[30px] min-w-[20px] max-w-[30px]'>
                            </div>
                            
                            <h2 class='menu-titles hidden text-white/75 text-paragraph transition-opacity duration-300 ease-in-out'>$titleTech</h2>
                        </a>

                        <a class='option flex flex-row gap-4 items-center cursor-pointer'>
                            <div class='bg-white/5 p-[0.5rem] rounded-xl'>
                                <img src='$iconHealth' class='w-[20px] sm:w-[25px] 3xl:w-[30px] min-w-[20px] max-w-[30px]'>
                            </div>
                            
                            <h2 class='menu-titles hidden text-white/75 text-paragraph transition-opacity duration-300 ease-in-out'>$titleHealth</h2>
                        </a>

                        <a class='option flex flex-row gap-4 items-center cursor-pointer'>
                            <div class='bg-white/5 p-[0.5rem] rounded-xl hover:bg-white/10 transition-all duration-200 fade-in'>
                                <img src='$iconFashion' class='w-[20px] sm:w-[25px] 3xl:w-[30px] min-w-[20px] max-w-[30px]'>
                            </div>
                            
                            <h2 class='menu-titles hidden text-white/75 text-paragraph transition-opacity duration-300 ease-in-out'>$titleFashion</h2>
                        </a>

                        <a class='option flex flex-row gap-4 items-center cursor-pointer'>
                            <div class='bg-white/5 p-[0.5rem] rounded-xl hover:bg-white/10 transition-all duration-200 fade-in'>
                                <img src='$iconAesthetic' class='w-[20px] sm:w-[25px] 3xl:w-[30px] min-w-[20px] max-w-[30px]'>
                            </div>
                            
                            <h2 class='menu-titles hidden text-white/75 text-paragraph transition-opacity duration-300 ease-in-out'>$titleAesthetic</h2>
                        </a>
                    </div>
                </div>

            </aside>

            <script src='/VHS/src/views/components/sidebar/script.js'></script>
        ";
    }

    // Sidebar Component v2.0
?>