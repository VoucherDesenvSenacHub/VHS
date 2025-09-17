<?php

namespace src\views\components\userDataTableComponent;

function copyNotify()
{
    return <<<HTML
        <div id="copy-notification" class="fixed bottom-4 right-4 bg-gray-800 text-white p-4 rounded-md shadow-lg hidden opacity-0 translate-y-5 transition-all duration-300">
            <div class="title font-bold"></div>
            <div class="subtitle text-sm"></div>
        </div>
    HTML;
}

function userDataTableComponent($users)
{
    $rows = '';

    foreach ($users as $user) {
        $initials = strtoupper(substr($user['name'], 0, 1) . substr(strrchr($user['name'], ' '), 1, 1));

        $roleClass = $user['role'] === 'ADMIN'
            ? 'bg-blue-600/20 text-blue-physics'
            : 'users';

        $profilePicture = !empty($user['avatar_url']) ? $user['avatar_url'] : null;

        $openModalId = "openModal-{$user['id']}";
        $openDeleteModalId = "openDeleteModal-{$user['id']}";

        $profileHtml = $profilePicture
            ? "<img src=\"/VHS/public/uploads/avatars/{$profilePicture}\" alt=\"Foto de perfil\" class=\"h-full w-full object-cover\" />"
            : "<div class=\"bg-slate-700 text-slate-300 flex items-center justify-center h-full w-full\">{$initials}</div>";

        $rows .= <<<HTML
            <tr class="group transition-colors hover:bg-[#660BAD]/10">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full ring-2 ring-slate-600 transition-all group-hover:ring-slate-500 flex items-center justify-center overflow-hidden">
                            {$profileHtml}
                        </div>
                        <div>
                            <div class="font-semibold text-white">{$user['name']}</div>
                            <div class="text-sm text-slate-400">@{$user['username']}</div>
                            <div class="text-xs text-slate-500 font-mono">{$user['id']}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-semibold {$roleClass} bg-purple-600/20 text-purple-300 border border-purple-400/50">
                        {$user['role']}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-slate-300">Desde {$user['created_at']}</div>
                </td>
                <td class="px-6 py-4 bg-[#660BAD]/5 border-l border-[#660BAD]/20">
                    <div class="flex items-center justify-center gap-2">
                        <button id="{$openModalId}" class="h-8 w-8 p-0 flex items-center justify-center text-[#660BAD] hover:bg-[#660BAD] hover:text-white transition-all border border-[#660BAD]/40 rounded">
                            <img src="/VHS/public/icons/comments_studio/ellipsis-vertical.svg" alt="Editar" class="h-4 w-4" />
                        </button>
                        <button id="{$openDeleteModalId}" class="h-8 w-8 p-0 flex items-center justify-center text-[#660BAD] hover:bg-[#660BAD] hover:text-white transition-all border border-[#660BAD]/40 rounded">
                            <img src="/VHS/public/icons/comments_studio/trash.svg" alt="Excluir" class="h-4 w-4" />
                        </button>
                    </div>
                </td>
            </tr>
        HTML;
    }

    return <<<HTML
        <script src="https://cdn.tailwindcss.com"></script>
        <div class="overflow-hidden rounded-lg border border-gray-700 bg-[#1B1B1B] backdrop-blur-sm">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-700 bg-gray-800/80">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Usuário</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Perfil</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Membro desde</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-white bg-[#660BAD]/50 border-l border-[#660BAD]/30">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        {$rows}
                    </tbody>
                </table>
            </div>
        </div>
    HTML;
}
