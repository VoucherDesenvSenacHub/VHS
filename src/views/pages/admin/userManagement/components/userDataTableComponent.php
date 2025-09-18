<?php

namespace src\views\components\userDataTableComponent;
use DateTime;

function userDataTableComponent($users)
{
    $rows = '';

    foreach ($users as $user) {
        $initials = strtoupper(substr($user['name'], 0, 1) . substr(strrchr($user['name'], ' '), 1, 1));
        $profilePicture = !empty($user['avatar_url']) ? $user['avatar_url'] : null;
        $data_user = $user['created_at'];

        $date = new DateTime($data_user);
        $date = $date->format('d/m/Y H:i:s');

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
                        {$user['role']}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-slate-300">Desde {$date}</div>
                </td>
                <td class="px-6 py-4 bg-[#660BAD]/5 border-l border-[#660BAD]/20">
                    <div class="flex items-center justify-center gap-2">
                         <button data-id="{$user['id']}" data-name="{$user['name']}" data-username="{$user['username']}" data-role="{$user['role']}" class="open-edit h-8 w-8 flex items-center justify-center text-[#660BAD] hover:bg-[#660BAD] hover:text-white border border-[#660BAD]/40 rounded">
                            <img src="/VHS/public/icons/comments_studio/pencil.svg" alt="Excluir" class="h-4 w-4" />
                        </button>
                        <button data-id="{$user['id']}" data-name="{$user['name']}" class="open-delete h-8 w-8 flex items-center justify-center text-[#660BAD] hover:bg-[#660BAD] hover:text-white border border-[#660BAD]/40 rounded">
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
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Status</th>
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

        <div id="deleteModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-[#1B1B1B] border border-gray-700 rounded-lg p-6 w-full max-w-md">
                <h2 class="text-lg font-bold text-white">Excluir usuário</h2>
                <p class="text-sm text-slate-400 mt-2">
                    Tem certeza que deseja excluir o usuário <span id="deleteUserName" class="font-semibold text-white"></span>?
                </p>
                
                <div class="mt-6 flex justify-end gap-3">
                    <button id="closeDeleteModal" class="px-4 py-2 rounded-md border border-gray-600 text-gray-300 hover:bg-gray-700">Cancelar</button>
                    
                    <form action="/VHS/api/v1/user/delete" method="POST">
                        <input type="hidden" name="user_id" id="deleteUserId">
                        <button type="submit" class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700">Sim, excluir</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="editModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-[#1B1B1B] border border-gray-700 rounded-lg p-6 w-full max-w-lg">
                <h2 class="text-lg font-bold text-white">Editar usuário</h2>
                <form action="/VHS/api/v1/user/update" method="POST" class="mt-4 space-y-4">
                    <input type="hidden" name="user_id" id="editUserId">

                    <div>
                        <label for="editName" class="block text-sm text-slate-300 mb-1">Nome</label>
                        <input type="text" name="name" id="editName" 
                            class="w-full rounded-md border border-gray-600 bg-gray-800 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#660BAD]" 
                            required>
                    </div>

                    <div>
                        <label for="editUsername" class="block text-sm text-slate-300 mb-1">Username</label>
                        <input type="text" name="username" id="editUsername" 
                            class="w-full rounded-md border border-gray-600 bg-gray-800 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#660BAD]" 
                            required>
                    </div>

                    <div>
                        <label for="editRole" class="block text-sm text-slate-300 mb-1">Perfil</label>
                        <select name="role" id="editRole" 
                                class="w-full rounded-md border border-gray-600 bg-gray-800 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#660BAD]" 
                                required>
                            <option value="ADMIN">Admin</option>
                            <option value="USER">Usuário</option>
                            <option value="CREATOR">Criador</option>
                        </select>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <button type="button" id="closeEditModal" 
                                class="px-4 py-2 rounded-md border border-gray-600 text-gray-300 hover:bg-gray-700">
                            Cancelar
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 rounded-md bg-[#660BAD] text-white hover:bg-[#53088A]">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            const modal = document.getElementById("deleteModal");
            const closeBtn = document.getElementById("closeDeleteModal");
            const userIdInput = document.getElementById("deleteUserId");
            const userNameSpan = document.getElementById("deleteUserName");

            document.querySelectorAll(".open-delete").forEach(btn => {
                btn.addEventListener("click", () => {
                    const id = btn.getAttribute("data-id");
                    const name = btn.getAttribute("data-name");

                    userIdInput.value = id;
                    userNameSpan.textContent = name;
                    modal.classList.remove("hidden");
                });
            });

            closeBtn.addEventListener("click", () => {
                modal.classList.add("hidden");
            });


            const editModal = document.getElementById("editModal");
            const closeEditBtn = document.getElementById("closeEditModal");

            const editUserId = document.getElementById("editUserId");
            const editName = document.getElementById("editName");
            const editUsername = document.getElementById("editUsername");
            const editRole = document.getElementById("editRole");

            document.querySelectorAll(".open-edit").forEach(btn => {
                btn.addEventListener("click", () => {
                    const id = btn.getAttribute("data-id");
                    const name = btn.getAttribute("data-name");
                    const username = btn.getAttribute("data-username");
                    const role = btn.getAttribute("data-role");

                    editUserId.value = id;
                    editName.value = name;
                    editUsername.value = username;
                    editRole.value = role;

                    editModal.classList.remove("hidden");
                });
            });

            closeEditBtn.addEventListener("click", () => {
                editModal.classList.add("hidden");
            });
        </script>
    HTML;
}
