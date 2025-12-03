<?php

namespace Src\Views\Components\Modal;

require_once __DIR__ . '/../utils/buttonComponent.php';

use function Src\Views\Components\Utils\ButtonComponent;

function RemoveVideoComponent(string $title, string $description, string $id, string $action = "/VHS/api/v1/video/delete")
{
    return <<<HTML
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <!-- Backdrop with blur -->
            <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="this.parentElement.classList.add('hidden')"></div>
            
            <!-- Modal Content -->
            <div class="relative bg-[#121214] border border-white/10 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all scale-100">
                <!-- Header with Icon -->
                <div class="p-6 pb-0 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-red-500/10 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-white mb-2">$title</h2>
                    <p class="text-gray-400 text-sm leading-relaxed">$description</p>
                </div>

                <!-- Actions -->
                <div class="p-6 mt-2">
                    <form action="$action" method="post" class="flex gap-3">
                        <input type="hidden" name="id" value="$id">
                        
                        <button type="button" 
                            onclick="this.closest('.modal_remove_video').classList.add('hidden')"
                            class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium text-gray-300 hover:text-white border border-white/10 hover:bg-white/5 transition-all duration-200">
                            Cancelar
                        </button>
                        
                        <button type="submit" 
                            class="flex-1 px-4 py-2.5 rounded-xl text-sm font-medium text-white bg-red-600 hover:bg-red-700 shadow-lg shadow-red-500/20 transition-all duration-200">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
        </div>
    HTML;
}
