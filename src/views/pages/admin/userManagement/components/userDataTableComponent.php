<?php

namespace src\views\components\userDataTableComponent;

use DateTime;

require_once __DIR__ . '/../../../../../application/utils/pagination.php';

use function Src\Application\Utils\paginate;

function userDataTableComponent($users, $nextPage)
{
    if (empty($users)) {
        return <<<HTML
            <div class="rounded-2xl border border-white/5 bg-[#121214] p-12 text-center">
                <div class="flex flex-col items-center justify-center gap-4">
                    <div class="p-4 rounded-full bg-white/5">
                        <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-white">Nenhum usuário encontrado</h3>
                        <p class="text-gray-400 mt-1">Tente ajustar seus filtros de busca.</p>
                    </div>
                </div>
            </div>
        HTML;
    }
    $rows = '';
    $pagination = paginate($users, $nextPage);

    foreach ($users as $user) {
        $initials = strtoupper(substr($user['name'], 0, 1) . substr(strrchr($user['name'], ' '), 1, 1));
        $profilePicture = !empty($user['avatar_url']) ? $user['avatar_url'] : null;
        $data_user = $user['created_at'];

        $date = new DateTime($data_user);
        $date = $date->format('d/m/Y');

        $role = match ($user['role']) {
            "ADMIN" => "<span class='inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-purple-500/10 text-purple-400 border border-purple-500/20'>
                            <span class='w-1.5 h-1.5 rounded-full bg-purple-400'></span>
                            Admin
                        </span>",
            "USER" => "<span class='inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20'>
                            <span class='w-1.5 h-1.5 rounded-full bg-blue-400'></span>
                            Usuário
                        </span>",
            "CREATOR" => "<span class='inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-pink-500/10 text-pink-400 border border-pink-500/20'>
                            <span class='w-1.5 h-1.5 rounded-full bg-pink-400'></span>
                            Criador
                        </span>"
        };

        $profileHtml = $profilePicture
            ? "<img src=\"/VHS/public/uploads/avatars/{$profilePicture}\" alt=\"Foto de perfil\" class=\"h-full w-full object-cover\" />"
            : "<div class=\"bg-gradient-to-br from-purple-600 to-blue-600 text-white flex items-center justify-center h-full w-full text-sm font-medium\">{$initials}</div>";

        $statusBadge = match (($user['status'])) {
            1 => "<span class='inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-400 border border-green-500/20'>
                    <span class='w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse'></span>
                    Ativo
                  </span>",
            0 => "<span class='inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-500/10 text-red-400 border border-red-500/20'>
                    <span class='w-1.5 h-1.5 rounded-full bg-red-400'></span>
                    Inativo
                  </span>"
        };

        $rows .= <<<HTML
            <tr class="group border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-4">
                        <div class="h-10 w-10 rounded-full ring-2 ring-white/10 flex items-center justify-center overflow-hidden shadow-lg">
                            {$profileHtml}
                        </div>
                        <div>
                            <div class="font-medium text-white group-hover:text-purple-400 transition-colors">{$user['name']}</div>
                            <div class="text-xs text-gray-500">@{$user['username']}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    {$statusBadge}
                </td>
                <td class="px-6 py-4">
                    {$role}
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-400">{$date}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-all duration-200 transform translate-x-2 group-hover:translate-x-0">
                         <button data-id="{$user['id']}" data-name="{$user['name']}" data-role="{$user['role']}" data-status="{$user['status']}" class="open-edit p-2 text-gray-400 hover:text-purple-400 hover:bg-purple-400/10 rounded-lg transition-all" title="Editar">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                            </svg>
                        </button>
                        <button data-id="{$user['id']}" data-name="{$user['name']}" class="open-delete p-2 text-gray-400 hover:text-red-400 hover:bg-red-400/10 rounded-lg transition-all" title="Excluir">
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
        <div class="overflow-hidden rounded-xl border border-white/5 bg-[#121214]">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/5 bg-white/[0.02]">
                        <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-wider">Usuário</th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-wider">Perfil</th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-wider">Membro desde</th>
                        <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-wider text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    {$rows}
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {$pagination}
        </div>

        <!-- Modals (kept same logic, updated styles) -->
        <div id="deleteModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm transition-all duration-300">
            <div class="bg-[#121214] border border-white/10 rounded-2xl p-6 w-full max-w-sm shadow-2xl transform scale-100 transition-all">
                <div class="flex flex-col items-center text-center gap-4">
                    <div class="p-3 bg-red-500/10 rounded-full">
                        <svg class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Excluir Usuário</h2>
                        <p class="text-sm text-gray-400 mt-2">
                            Tem certeza que deseja excluir <span id="deleteUserName" class="font-semibold text-white"></span>? Esta ação não pode ser desfeita.
                        </p>
                    </div>
                </div>
                <div class="mt-6 flex gap-3">
                    <button id="closeDeleteModal" class="flex-1 px-4 py-2.5 rounded-xl border border-white/10 text-gray-300 hover:bg-white/5 transition-colors font-medium">
                        Cancelar
                    </button>
                    <form class="flex-1" action="/VHS/api/v1/user/delete" method="POST">
                        <input type="hidden" name="user_id" id="deleteUserId">
                        <button type="submit" class="w-full px-4 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white transition-colors font-medium shadow-lg shadow-red-500/20">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div id="editModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm transition-all duration-300">
            <div class="bg-[#121214] border border-white/10 rounded-2xl p-6 w-full max-w-xl shadow-2xl">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-white">Editar Usuário</h2>
                    <button id="closeEditModalX" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <form action="/VHS/api/v1/user/update" method="POST" class="space-y-4">
                    <input type="hidden" name="user_id" id="editUserId">
                    
                    <div class="space-y-1.5">
                        <label for="editName" class="text-sm font-medium text-gray-300">Nome</label>
                        <input 
                            type="text" 
                            name="name" id="editName" 
                            class="w-full rounded-xl border border-white/10 bg-black/20 text-white px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-purple-500/50 transition-all placeholder-gray-600" 
                            required
                        >
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label for="editRole" class="text-sm font-medium text-gray-300">Perfil</label>
                            <div class="relative">
                                <select 
                                    name="role" 
                                    id="editRole" 
                                    class="w-full rounded-xl border border-white/10 bg-black/20 text-white px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-purple-500/50 transition-all appearance-none" 
                                    required
                                >
                                    <option value="ADMIN">Admin</option>
                                    <option value="USER">Usuário</option>
                                    <option value="CREATOR">Criador</option>
                                </select>
                                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label for="editStatus" class="text-sm font-medium text-gray-300">Status</label>
                            <div class="relative">
                                <select 
                                    name="status" 
                                    id="editStatus" 
                                    class="w-full rounded-xl border border-white/10 bg-black/20 text-white px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-purple-500/50 transition-all appearance-none" 
                                    required
                                >
                                    <option value=1>Ativo</option>
                                    <option value=0>Inativo</option>
                                </select>
                                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="button" id="closeEditModal" class="flex-1 px-4 py-2.5 rounded-xl border border-white/10 text-gray-300 hover:bg-white/5 transition-colors font-medium">
                            Cancelar
                        </button>
                        <button type="submit" class="flex-1 px-4 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-700 text-white transition-colors font-medium shadow-lg shadow-purple-600/20">
                            Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <script src="/VHS/src/views/pages/admin/userManagement/components/script.js"></script>
        <script>
            // Additional script to handle the X button in edit modal
            document.getElementById('closeEditModalX')?.addEventListener('click', () => {
                document.getElementById('editModal').classList.add('hidden');
            });
        </script>
    HTML;
}
