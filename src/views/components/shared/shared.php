<?php

    function sharedComponent() {
        echo '
            <div class="hidden modal absolute flex inset-0 bg-black/25 items-center justify-center">
                <div class="flex flex-col bg-[#1B1B1B] w-auto h-64 rounded-2xl p-6 justify-between shadow-xl">
                    <div class="w-full flex flex-row justify-between items-center">
                        <h2 class="text-white text-xl">Compartilhar</h2>
            
                        <button onclick="closePopup()" class="flex justify-center items-center w-7 text-purple-400 hover:text-purple-600">
                            <img src="../../../../public/icons/botaoFechar.svg" class="w-full h-full">
                        </button>
                    </div>

                    <div class="flex justify-between">
                        <button id="telegram" class="flex items-center justify-center w-12 h-12 bg-white/5 rounded-xl overflow-hidden">
                            <img src="../../../../public/icons/telegram.svg" class="w-full h-full">
                        </button>

                        <button id="facebook" class="flex items-center justify-center w-12 h-12 bg-white/5 rounded-xl overflow-hidden">
                            <img src="../../../../public/icons/facebook.svg" class="w-full h-full">
                        </button>

                        <button id="whatsapp" class="flex items-center justify-center w-12 h-12 bg-white/5 rounded-xl overflow-hidden">
                            <img src="../../../../public/icons/whats.svg" class="w-full h-full">
                        </button>

                        <button id="instagram" class="flex items-center justify-center w-12 h-12 bg-white/5 rounded-xl overflow-hidden">
                            <img src="../../../../public/icons/insta.svg" class="w-full h-full">
                        </button>
                        
                        <button id="twitter" class="flex items-center justify-center w-12 h-12 bg-white/5 rounded-xl overflow-hidden">
                            <img src="../../../../public/icons/twitter.svg" class="w-full h-full">
                        </button>
                    </div>

                    <div class="flex flex-row justify-between gap-3">
                        <input type="text" value="https://youtube.com/@freitasdev" class="focus:outline-none text-gray-500 text-sm p-2 w-72 border-[1px] border-[#666666] bg-transparent rounded-[10px]">
                        <button class="bg-[#6C00C0] p-3 px-7 rounded-[10px] text-white onclick="copyLink()">Copiar</button>
                    </div>
                </div>
            </div>
        ';
    }
?>