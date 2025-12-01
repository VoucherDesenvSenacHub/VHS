<?php

namespace Src\Views\Components\Utils;

function Comment(string $name, string $text, string $thumbnail_url, string $created_at = null, string $userImg = null, string $reportId, string $commentId, string $reported_user_id, $name_admin): string
{
    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    $thumbnail_url = htmlspecialchars($thumbnail_url, ENT_QUOTES, 'UTF-8');
    $created_at = $created_at ? htmlspecialchars($created_at, ENT_QUOTES, 'UTF-8') : null;

    $createdAtTag = $created_at
        ? "<span class='text-xs text-gray-500'>• {$created_at}</span>"
        : "";

    return <<<HTML
        <div class="w-full p-4 rounded-xl bg-white/[0.02] border border-white/5 hover:bg-white/[0.04] transition-colors group">
            <div class="flex gap-4">
                <!-- User Avatar -->
                <div class='flex-shrink-0 w-12 h-12 rounded-full bg-white/10 overflow-hidden ring-2 ring-white/5'>
                    <img class='select-none pointer-events-none w-full h-full object-cover' src='/VHS/public/uploads/avatars/{$userImg}' onerror='this.src="/VHS/public/uploads/avatars/default.png"'>
                </div>

                <!-- Content -->
                <div class="flex flex-col flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <p class="text-base text-white font-semibold truncate">{$name}</p>
                        {$createdAtTag}
                    </div>

                    <div class="text-sm text-gray-300 leading-relaxed break-words mb-3">
                        <p>{$text}</p>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-wrap items-center gap-2 mt-auto">
                        <button
                            class="open-remove flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-medium text-green-400 bg-green-400/10 hover:bg-green-400/20 border border-green-400/20 transition-all"
                            data-report-id="{$reportId}"
                            data-name-admin="{$name_admin}"
                            title="Manter Comentário (Remover Denúncia)">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Manter
                        </button>

                        <button 
                            class="open-delete flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-medium text-red-400 bg-red-400/10 hover:bg-red-400/20 border border-red-400/20 transition-all"
                            data-report-id="{$reportId}"
                            data-comment-id="{$commentId}" 
                            data-name="{$name}"
                            title="Excluir Comentário">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Excluir
                        </button>

                        <button
                            class="open-block flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-medium text-gray-400 bg-white/5 hover:bg-white/10 border border-white/10 hover:text-white transition-all"
                            data-reported-user-id="{$reported_user_id}"
                            data-reported-user-name="{$name}"
                            title="Bloquear Usuário">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                            Inativar
                        </button>
                    </div>
                </div>

                <!-- Thumbnail -->
                <div class="hidden sm:block flex-shrink-0">
                    <img class="h-24 w-40 object-cover rounded-lg border border-white/10 shadow-lg" src="{$thumbnail_url}" alt="Thumbnail do vídeo">
                </div>
            </div>
        </div>
    HTML;
}
