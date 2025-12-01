<?php

namespace Src\Views\Components\Utils;

function uploadThumbnails(bool $error = false, $errorDescription = null) {

    $border = $error ? "border border-red-500" : "border border-[#666]";

    return <<<HTML
        <div class="flex flex-col relative gap-1">
            <div class="w-full h-[100px] rounded-lg flex items-center justify-center relative overflow-hidden $border">
                <label for="dropzone-file" class="flex flex-row items-center cursor-pointer hover:bg-white/10 transition-all duration-200 px-6 py-2 w-full h-full gap-6">
                    <svg class="w-10 h-10 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>

                    <div class="flex flex-col">
                        <p class="text-paragraph text-gray-400 font-semibold">Clique para subir</p>
                        <p class="text-paragraph text-[#666]">JPG, PNG, JPEG</p>
                    </div>
                </label>

                <div id="fileInfo" class="absolute right-3 hidden flex items-center gap-4 bg-black/25 px-2 pl-4 py-2 rounded-lg">
                    <span id="fileName" class="text-sm text-white"></span>

                    <button id="previewBtn" type="button" class="p-2 hover:bg-white/20 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1.5 12s4-7.5 10.5-7.5S22.5 12 22.5 12s-4 7.5-10.5 7.5S1.5 12 1.5 12z" />
                            <circle cx="12" cy="12" r="3" stroke-width="2" />
                        </svg>
                    </button>
                </div>

                <input id="dropzone-file" type="file" class="hidden" accept="image/png,image/jpg,image/jpeg" name="thumbnail_url" />
            </div>

            <span class="text-red-500 font-medium">$errorDescription</span>

            <div id="previewModal" class="fixed inset-0 bg-black/80 flex items-center justify-center z-[999] hidden">
                <div class="relative w-[70%] max-w-2xl aspect-video">
                    <img id="modalImage" class="object-cover w-full h-full rounded-lg shadow-xl">
                    <button id="closeModal" type="button" class="absolute top-3 right-3 bg-black/50 p-2 rounded-full hover:bg-black/70">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>

        <script src="/VHS/src/views/components/utils/uploadThumbnails/script.js" defer></script>
    HTML;

}