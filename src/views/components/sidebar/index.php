<?php

    namespace Src\Views\Components\Sidebar;

    function CreateSidebear() {
        return "
            <aside class='sidebar hidden opacity-0 sm:opacity-100 -translate-x-full sm:translate-x-0 bg-black px-4 sm:flex flex-col items-center sticky w-[4rem] sm:w-auto h-screen top-[4.5rem] left-0 select-none transition-all duration-300 z-10'>
            
                <div class='flex flex-col gap-6'>
                    <div class='flex flex-col gap-6 justify-center'>
                        <button class='flex flex-row gap-4 items-center'>
                            <div class='bg-white/5 p-[0.5rem] rounded-2xl'>
                                <img src='/VHS/public/icons/home.svg' class='min-w-[25px]'>
                            </div>
                            
                            <h2 class='hidden sm:flex text-secondary'>Início</h2>
                        </button>
                        
                        <button class='flex flex-row gap-4 items-center'>
                            <div class='bg-white/5 p-[0.5rem] rounded-2xl'>
                                <img src='/VHS/public/icons/fast.svg' class='min-w-[25px]'>
                            </div>
                            
                            <h2 class='hidden sm:flex text-secondary'>Fast</h2>
                        </button>

                        <button class='flex flex-row gap-4 items-center'>
                            <div class='bg-white/5 p-[0.5rem] rounded-2xl'>
                                <img src='/VHS/public/icons/radio.svg' class='min-w-[25px]'>
                            </div>
                            
                            <h2 class='hidden sm:flex text-secondary'>Eventos</h2>
                        </button>

                        <button class='flex flex-row gap-4 items-center'>
                            <div class='bg-white/5 p-[0.5rem] rounded-2xl'>
                                <img src='/VHS/public/icons/youtube.svg' class='min-w-[25px]'>
                            </div>
                            
                            <h2 class='hidden sm:flex text-secondary'>Histórico</h2>
                        </button>
                    </div>

                    <hr class='divider w-full border-gray600 transition-all duration-300 ease-in-out'>

                    <div class='flex flex-col gap-6 justify-center'>
                        <button class='flex flex-row gap-4 items-center'>
                            <div class='bg-white/5 p-[0.5rem] rounded-2xl'>
                                <img src='/VHS/public/icons/cpu.svg' class='min-w-[25px]'>
                            </div>
                            
                            <h2 class='hidden sm:flex text-secondary '>Tecnologia</h2>
                        </button>

                        <button class='flex flex-row gap-4 items-center'>
                            <div class='bg-white/5 p-[0.5rem] rounded-2xl'>
                                <img src='/VHS/public/icons/saude.svg' class='min-w-[25px]'>
                            </div>
                            
                            <h2 class='hidden sm:flex text-secondary'>Saúde</h2>
                        </button>

                        <button class='flex flex-row gap-4 items-center'>
                            <div class='bg-white/5 p-[0.5rem] rounded-2xl'>
                                <img src='/VHS/public/icons/moda.svg' class='min-w-[25px]'>
                            </div>
                            
                            <h2 class='hidden sm:flex text-secondary'>Moda</h2>
                        </button>

                        <button class='flex flex-row gap-4 items-center'>
                            <div class='bg-white/5 p-[0.5rem] rounded-2xl'>
                                <img src='/VHS/public/icons/estetica.svg' class='min-w-[25px]'>
                            </div>
                            
                            <h2 class='hidden sm:flex text-secondary'>Estética</h2>
                        </button>
                    </div>
                </div>

            </aside>

            <script src='./script.js'></script>
        ";
    }

?>