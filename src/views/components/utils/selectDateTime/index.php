<?php

namespace Src\Views\Components\Utils;

function selectDateTime(string | null $errorMessage = null) {

    $error = !empty($errorMessage);
    $errorDescription = $errorMessage;
    $border = $error ? "border border-red-500" : "border border-[#666]";

    return <<<HTML
        <style>
            ::-webkit-scrollbar { display: none; }
            .no-scrollbar { scrollbar-width: none; -ms-overflow-style: none; }
        </style>

        <div id="selectDateTimeWrapper" class="flex flex-col gap-2">
            <div class="flex flex-row gap-4">
                <div class="relative w-[60%]">
                    <div id="selectDateContainer" class="bg-transparent flex items-center justify-around $border rounded-md h-[45px] w-full">
                        <input type="text" id="day" placeholder="Dia" readonly class="bg-transparent w-full text-white text-center cursor-pointer outline-none" />
                        <span class="text-zinc-400">/</span>
                        <input type="text" id="month" placeholder="Mês" readonly class="bg-transparent w-full text-white text-center cursor-pointer outline-none" />
                        <span class="text-zinc-400">/</span>
                        <input type="text" id="year" placeholder="Ano" readonly class="bg-transparent w-full text-white text-center cursor-pointer outline-none" />
                    </div>

                    <div id="datePanel" class="hidden absolute top-[110%] left-0 z-10 w-full flex gap-2 bg-[#14001b]/50 backdrop-blur-md border border-[#666] rounded-md p-2">
                        <div class="flex-1 max-h-52 overflow-y-auto no-scrollbar">
                            <div id="dayList" class="grid grid-cols-1 gap-1"></div>
                        </div>

                        <div class="flex-1 max-h-52 overflow-y-auto no-scrollbar">
                            <div id="monthList" class="grid grid-cols-1 gap-1"></div>
                        </div>

                        <div class="flex-1 max-h-52 overflow-y-auto no-scrollbar">
                            <div id="yearList" class="grid grid-cols-1 gap-1"></div>
                        </div>
                    </div>
                </div>

                <div class="relative w-[40%]">
                    <div id="selectTimeContainer" class="flex items-center justify-around $border rounded-md h-[45px] w-full">
                        <input type="text" id="hours" placeholder="00" readonly class="bg-transparent w-full text-white text-center cursor-pointer outline-none" />
                        <span class="text-zinc-400">:</span>
                        <input type="text" id="minutes" placeholder="00" readonly class="bg-transparent w-full text-white text-center cursor-pointer outline-none" />
                    </div>

                    <div id="timePanel"
                        class="hidden absolute top-[110%] left-0 z-10 w-full flex gap-10 bg-[#14001b]/50 backdrop-blur-md border border-[#666] rounded-md p-2">

                        <div class="flex-1 max-h-52 overflow-y-auto no-scrollbar">
                            <div id="hourList" class="grid grid-cols-1 gap-1"></div>
                        </div>

                        <div class="flex-1 max-h-52 overflow-y-auto no-scrollbar">
                            <div id="minuteList" class="grid grid-cols-1 gap-1"></div>
                        </div>
                    </div>
                </div>

                <input type="hidden" id="finalDateTime" name="event_date" />
            </div>

            <p id="selectDateTimeError" class="text-red-500 font-medium <?= $error ? '' : 'hidden' ?>">$errorDescription</p>
        </div>

        <script src="/VHS/src/views/components/utils/selectDateTime/script.js" defer></script>
    HTML;
    
}