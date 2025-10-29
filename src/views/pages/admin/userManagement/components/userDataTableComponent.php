<?php

namespace src\views\components\userDataTableComponent;

use DateTime;

require_once __DIR__ . '/../../../../../application/utils/pagination.php';

use function Src\Application\Utils\paginate;

function userDataTableComponent($users)
{
    if (empty($users)) {
        return <<<HTML
            <div class="rounded-lg border border-gray-700 bg-[#1B1B1B] p-6 text-center">
                <p class="text-slate-400">Nenhum usuário encontrado.</p>
            </div>
        HTML;
    }
    $rows = '';
    $pagination = paginate($users);

    foreach ($users as $user) {
        $initials = strtoupper(substr($user['name'], 0, 1) . substr(strrchr($user['name'], ' '), 1, 1));
        $profilePicture = !empty($user['avatar_url']) ? $user['avatar_url'] : null;
        $data_user = $user['created_at'];

        $date = new DateTime($data_user);
        $date = $date->format('d/m/Y H:i:s');

        $role = match ($user['role']) {
            "ADMIN" => "Administrador",
            "USER" => "Usuário",
            "CREATOR" => "Criador"
        };

        $profileHtml = $profilePicture
            ? "<img src=\"/VHS/public/uploads/avatars/{$profilePicture}\" alt=\"Foto de perfil\" class=\"h-full w-full object-cover\" />"
            : "<div class=\"bg-slate-700 text-slate-300 flex items-center justify-center h-full w-full\">{$initials}</div>";

        $statusBadge = match (($user['status'])) {
            1 => "<span class='inline-flex items-center rounded-md px-2 py-1 text-xs font-semibold bg-green-600/20 text-green-300 border border-green-400/40'>
                                Ativo
                             </span>",
            0 => "<span class='inline-flex items-center rounded-md px-2 py-1 text-xs font-semibold bg-gray-600/20 text-gray-300 border border-gray-400/40'>
                                Inativo
                               </span>"
        };

        $rows .= <<<HTML
            <tr class="group transition-colors hover:bg-[#660BAD]/10">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full ring-2 ring-slate-600 flex items-center justify-center overflow-hidden">
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
                    <div>$statusBadge</div>
                </td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-semibold bg-purple-600/20 text-purple-300 border border-purple-400/50">
                        {$role}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-slate-300">Desde {$date}</div>
                </td>
                <td class="px-6 py-4 bg-[#660BAD]/5 border-l border-[#660BAD]/20">
                    <div class="flex items-center justify-center gap-2">
                         <button data-id="{$user['id']}" data-name="{$user['name']}" data-role="{$user['role']}" data-status="{$user['status']}" class="open-edit h-9 w-9 p-1 flex items-center justify-center text-[#660BAD] hover:bg-[#660BAD]/50 hover:border-[#660BAD] hover:text-white transition-all border border-[#660BAD]/60 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                            </svg>
                        </button>
                        <button data-id="{$user['id']}" data-name="{$user['name']}" class="open-delete h-9 w-9 p-1 flex items-center justify-center text-[#660BAD] hover:bg-red-500/30 hover:border-red-500/40 hover:text-red-500 transition-all border border-[#660BAD]/60 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                            </svg>
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
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Perfil</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Membro desde</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-white bg-[#660BAD] border-l border-[#660BAD]/30">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        {$rows}
                    </tbody>
                </table>
            </div>
        </div>

        {$pagination}

        <div id="deleteModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-[#1B1B1B] border border-gray-700 rounded-lg p-6 w-full max-w-sm">
                <h2 class="text-lg font-bold text-white text-center">Confirmar Exclusão</h2>
                <p class="text-sm text-slate-400 text-center mt-4">
                    Tem certeza que deseja excluir o usuário <span id="deleteUserName" class="font-semibold text-white"></span>?
                </p>
                <div class="mt-4 flex justify-between gap-2">
                    <button id="closeDeleteModal" class="transition-colors px-4 py-2 rounded-md w-full border border-gray-600 text-gray-300 hover:bg-gray-700">
                        Cancelar
                    </button>
                    <form class="w-full" action="/VHS/api/v1/user/delete" method="POST">
                        <input type="hidden" name="user_id" id="deleteUserId">
                        <button type="submit" class="transition-colors px-4 py-2 rounded-md w-full bg-red-600 text-white hover:bg-red-700">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
        <div id="editModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-[#1B1B1B] border border-gray-700 rounded-lg p-6 w-full max-w-md">
                <h2 class="text-lg font-bold text-white text-center">Editar usuário</h2>
                <form action="/VHS/api/v1/user/update" method="POST" class="mt-4 space-y-4">
                    <input type="hidden" name="user_id" id="editUserId">
                    <div>
                        <label for="editName" class="block text-sm text-slate-300 mb-1">Nome</label>
                        <input 
                            type="text" 
                            name="name" id="editName" 
                            class="w-full rounded-md border border-gray-600 bg-gray-800 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#660BAD]" 
                            required
                        >
                    </div>
                    <div>
                        <label for="editRole" class="block text-sm text-slate-300 mb-1">Perfil</label>
                        <select 
                            name="role" 
                            id="editRole" 
                            class="w-full rounded-md border border-gray-600 bg-gray-800 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#660BAD]" 
                            required
                        >
                            <option value="ADMIN">Admin</option>
                            <option value="USER">Usuário</option>
                            <option value="CREATOR">Criador</option>
                        </select>
                    </div>
                    <div>
                        <label for="editStatus" class="block text-sm text-slate-300 mb-1">Status</label>
                        <select 
                            name="status" 
                            id="editStatus" 
                            class="w-full rounded-md border border-gray-600 bg-gray-800 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#660BAD]" 
                            required
                        >
                            <option value=1>Ativo</option>
                            <option value=0>Inativo</option>
                        </select>
                    </div>
                    <div class="mt-6 flex justify-between gap-2">
                        <button type="button" id="closeEditModal" class="transition-colors w-full px-4 py-2 rounded-md border border-gray-600 text-gray-300 hover:bg-gray-700">
                            Cancelar
                        </button>
                        <button type="submit" class="transition-colors w-full px-4 py-2 rounded-md bg-[#660BAD] text-white hover:bg-[#53088A]">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <script src="/VHS/src/views/pages/admin/userManagement/components/script.js"></script>
    HTML;
}
