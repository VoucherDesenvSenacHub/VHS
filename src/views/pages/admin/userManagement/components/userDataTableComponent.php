<?php

namespace src\views\components\userDataTableComponent;

function copyNotify()
{
    return '
        <div id="copy-notification" class="fixed bottom-4 right-4 bg-gray-800 text-white p-4 rounded-md shadow-lg hidden opacity-0 translate-y-5 transition-all duration-300">
            <div class="title font-bold"></div>
            <div class="subtitle text-sm"></div>
        </div>';
}

function userDataTableComponent($users, $page = 1, $perPage = 7)
{
    $totalUsers = count($users);
    $totalPages = ceil($totalUsers / $perPage);
    $offset = ($page - 1) * $perPage;
    $displayUsers = array_slice($users, $offset, $perPage);

    echo '
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

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
                <tbody class="divide-y divide-gray-700">';

    foreach ($displayUsers as $user) {
        $initials = strtoupper(substr($user['name'], 0, 1) . substr(strrchr($user['name'], ' '), 1, 1));
        $statusClass = $user['status'] === 'Ativo' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-red-500/20 text-red-400 border border-red-500/30';
        $roleClass = $user['role'] === 'Administrador' ? 'bg-blue-600/20 text-blue-physics' : 'users';
        $roleIcon = $user['role'] === 'Administrador' ? 'Shield' : 'users';
        $profilePicture = isset($user['profile_picture']) && !empty($user['profile_picture']) ? $user['profile_picture'] : null;
        $modalId = 'modal-' . $user['id'];
        $overlayId = 'overlay-' . $user['id'];
        $openModalId = 'openModal-' . $user['id'];
        $closeModalId = 'closeModal-' . $user['id'];
        $openDeleteModalId = 'openDeleteModal-' . $user['id'];

        echo '
        <tr class="group transition-colors hover:bg-[#660BAD]/10">
            <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full ring-2 ring-slate-600 transition-all group-hover:ring-slate-500 flex items-center justify-center overflow-hidden">';

        if ($profilePicture) {
            echo '<img src="' . htmlspecialchars($profilePicture) . '" alt="Foto de perfil" class="h-full w-full object-cover" />';
        } else {
            echo '<div class="bg-slate-700 text-slate-300 flex items-center justify-center h-full w-full">' . $initials . '</div>';
        }

        echo '
                    </div>
                    <div>
                        <div class="font-semibold text-white">' . htmlspecialchars($user['name']) . '</div>
                        <div class="text-sm text-slate-400">@' . htmlspecialchars($user['username']) . '</div>
                        <div class="text-xs text-slate-500 font-mono">' . substr(htmlspecialchars($user['id']), 0, 8) . '...</div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4">
                <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-semibold ' . $statusClass . ' hover:bg-' . ($user['status'] === 'Ativo' ? 'emerald' : 'red') . '-500/30">' . htmlspecialchars($user['status']) . '</span>
            </td>
            <td class="px-6 py-4">
                <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-semibold ' . $roleClass . ' bg-purple-600/20 text-purple-300 border border-purple-400/50 hover:bg-' . ($user['role'] === 'Administrador' ? 'purple' : ($user['role'] === 'Criador de conteúdo' ? 'purple' : 'purple')) . '-600/30">
                    <i data-lucide="' . $roleIcon . '" class="mr-1 h-3 w-3"></i>
                    ' . htmlspecialchars($user['role']) . '
                </span>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-slate-300">Desde ' . htmlspecialchars($user['joined']) . '</div>
            </td>
            <td class="px-6 py-4 bg-[#660BAD]/5 border-l border-[#660BAD]/20">
                <div class="flex items-center justify-center gap-2">
                    <button id="' . $openModalId . '" class="h-8 w-8 p-0 flex items-center justify-center text-[#660BAD] hover:bg-[#660BAD] hover:text-white transition-all border border-[#660BAD]/40 rounded">
                        <i data-lucide="edit" class="h-4 w-4"></i>
                    </button>
                    <button id="' . $openDeleteModalId . '" class="h-8 w-8 p-0 flex items-center justify-center text-[#660BAD] hover:bg-[#660BAD] hover:text-white transition-all border border-[#660BAD]/40 rounded">
                        <i data-lucide="Trash2" class="h-4 w-4"></i>
                    </button>
                </div>
            </td>
        </tr>';
    }

    echo '
                </tbody>
            </table>
        </div>
    </div>';

    foreach ($displayUsers as $user) {
        $modalId = 'modal-' . $user['id'];
        $overlayId = 'overlay-' . $user['id'];
        $closeModalId = 'closeModal-' . $user['id'];
        $deleteModalId = 'delete-modal-' . $user['id'];
        $deleteOverlayId = 'delete-overlay-' . $user['id'];
        $closeDeleteModalId = 'cancel-delete-' . $user['id'];

        // Modal de edição
        echo '
        <div id="' . $overlayId . '" class="absolute h-screen w-screen button-0 inset-0 bg-black bg-opacity-50 opacity-0 transition-opacity duration-300 hidden"></div>
        <div id="' . $modalId . '" class="absolute inset-0 z-20 opacity-0 transition-opacity duration-400 hidden flex items-center justify-center">
            <div class="min-w-[400px] flex flex-col gap-4 p-8 px-10 bg-gray-900 text-gray-50 border border-gray-700 p-4 rounded-lg transform -translate-y-12 transition-transform duration-300">
                <div class="flex justify-center items-center">
                    <h2 class="text-2xl font-bold text-white cursor-default">Editar Usuário</h2>
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex flex-col w-full">
                        <div class="flex w-full justify-start">
                            <label for="name-' . $user['id'] . '" class="text-right text-gray-300">Nome Completo</label>
                        </div>
                        <input id="name-' . $user['id'] . '" class="col-span-3 bg-gray-800 border border-gray-700 text-gray-50 p-2 rounded" value="' . htmlspecialchars($user['name']) . '" />
                    </div>
                    <div class="flex flex-col w-full">
                        <div class="flex w-full justify-start">
                            <label for="username-' . $user['id'] . '" class="text-right text-gray-300">Nome de Usuário</label>
                        </div>
                        <input id="username-' . $user['id'] . '" class="col-span-3 bg-gray-800 border border-gray-700 text-gray-50 p-2 rounded" value="' . htmlspecialchars($user['username']) . '" />
                    </div>
                    <div class="flex flex-col w-full">
                        <div class="flex w-full justify-start">
                            <label for="status-' . $user['id'] . '" class="text-right text-gray-300">Status</label>
                        </div>
                        <select id="status-' . $user['id'] . '" class="col-span-3 bg-gray-800 border border-gray-700 text-gray-50 p-2 rounded">
                            <option value="Ativo"' . ($user['status'] === 'Ativo' ? ' selected' : '') . '>Ativo</option>
                            <option value="Suspenso"' . ($user['status'] === 'Suspenso' ? ' selected' : '') . '>Suspenso</option>
                        </select>
                    </div>
                    <div class="flex flex-col w-full">
                        <div class="flex w-full justify-start">
                            <label for="profile-' . $user['id'] . '" class="text-right text-gray-300">Perfil</label>
                        </div>
                        <select id="profile-' . $user['id'] . '" class="col-span-3 bg-gray-800 border border-gray-700 text-gray-50 p-2 rounded">
                            <option value="Usuário"' . ($user['role'] === 'Usuário' ? ' selected' : '') . '>Usuário</option>
                            <option value="Administrador"' . ($user['role'] === 'Administrador' ? ' selected' : '') . '>Administrador</option>
                            <option value="Criador de conteúdo"' . ($user['role'] === 'Criador de conteúdo' ? ' selected' : '') . '>Criador de conteúdo</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex justify-between gap-2">
                    <button id="' . $closeModalId . '" class="outline outline-1 px-4 py-2 outline-purple-500 rounded-md hover:bg-gray-800 w-[200px] h-[50px]">Cancelar</button>
                    <button onclick="showNotification(\'Sucesso!\', \'Usuário editado com sucesso.\'); closeModal' . $user['id'] . '();" class="bg-purple-600 hover:bg-purple-700 text-gray-50 px-4 py-2 rounded-md w-[200px] h-[50px]">Salvar</button>
                </div>
            </div>
        </div>';

        echo '
        <div id="' . $deleteOverlayId . '" class="absolute h-screen w-screen inset-0 bg-black bg-opacity-50 z-10 opacity-0 transition-opacity duration-300 hidden"></div>
        <div id="' . $deleteModalId . '" class="absolute inset-0 z-20 opacity-0 transition-opacity duration-300 hidden flex items-center justify-center">
            <div class="min-w-[300px] flex flex-col gap-4 p-8 px-10 bg-gray-900 text-gray-50 border border-gray-700 p-4 rounded-lg transform -translate-y-12 transition-transform duration-300">
                <div class="flex justify-center items-center">
                    <h2 class="text-2xl font-bold text-white cursor-default">Confirmar Exclusão</h2>
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <p class="text-gray-300 text-center">Tem certeza que deseja excluir o usuário <br><strong>' . htmlspecialchars($user['name']) . '</strong>?</p>
                </div>
                <div class="mt-4 flex justify-between gap-2">
                    <button id="' . $closeDeleteModalId . '" class="outline outline-1 px-4 py-2 outline-purple-500 rounded-md hover:bg-gray-800 w-full h-[50px]">Cancelar</button>
                    <button onclick="showNotification(\'Sucesso!\', \'Usuário excluído com sucesso.\'); window[\'closeDeleteModal' . $user['id'] . '\']();" class="bg-purple-600 hover:bg-purple-700 text-gray-50 px-4 py-2 rounded-md w-full h-[50px]">Excluir</button>
                </div>
            </div>
        </div>';
    }

    if ($totalUsers > 7) {
        echo '
        <div class="mt-6 flex items-center justify-between text-sm text-slate-400">
            <div>Mostrando ' . ($offset + 1) . ' a ' . min($offset + $perPage, $totalUsers) . ' de ' . $totalUsers . ' usuários</div>
            <div class="flex items-center gap-2">';

        if ($page > 1) {
            echo '<a href="?page=' . ($page - 1) . '" class="border border-slate-700 text-slate-400 bg-transparent px-3 py-1 rounded text-sm">Anterior</a>';
        } else {
            echo '<button class="border border-slate-700 text-slate-400 bg-transparent px-3 py-1 rounded text-sm cursor-not-allowed">Anterior</button>';
        }

        if ($page < $totalPages) {
            echo '<a href="?page=' . ($page + 1) . '" class="border border-slate-700 text-slate-400 bg-transparent px-3 py-1 rounded text-sm">Próximo</a>';
        } else {
            echo '<button class="border border-slate-700 text-slate-400 bg-transparent px-3 py-1 rounded text-sm cursor-not-allowed">Próximo</button>';
        }

        echo '
            </div>
        </div>';
    } else {
        echo '
        <div class="mt-6 flex items-center justify-between text-sm text-slate-400">
            <div>Mostrando ' . $totalUsers . ' de ' . $totalUsers . ' usuários</div>
            <div class="flex items-center gap-2">
                <button class="border border-slate-700 text-slate-400 bg-transparent px-3 py-1 rounded text-sm cursor-not-allowed">Anterior</button>
                <button class="border border-slate-700 text-slate-400 bg-transparent px-3 py-1 rounded text-sm cursor-not-allowed">Próximo</button>
            </div>
        </div>';
    }

    echo '
    <script>
      lucide.createIcons();

      // Inicializa modais de edição dinamicamente
      document.querySelectorAll("[id^=openModal-]").forEach(button => {
        const userId = button.id.replace("openModal-", "");
        const modal = document.getElementById("modal-" + userId);
        const overlay = document.getElementById("overlay-" + userId);
        const closeModalButton = document.getElementById("closeModal-" + userId);
        const modalContent = modal.querySelector("div");

        button.addEventListener("click", function() {
          modal.classList.remove("hidden");
          overlay.classList.remove("hidden");
          modal.classList.add("opacity-100");
          overlay.classList.add("opacity-100");
          modalContent.classList.remove("-translate-y-12");
          document.body.classList.add("overflow-hidden");
          modalContent.focus();
        });

        window["closeModal" + userId] = function() {
          modal.classList.remove("opacity-100");
          overlay.classList.remove("opacity-100");
          modalContent.classList.add("-translate-y-12");
          setTimeout(() => {
            modal.classList.add("hidden");
            overlay.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
            button.focus();
          }, 300);
        };

        closeModalButton.addEventListener("click", window["closeModal" + userId]);

        modal.addEventListener("click", function(event) {
          if (event.target === modal || event.target === overlay) {
            window["closeModal" + userId]();
          }
        });

        document.addEventListener("keydown", function(event) {
          if (event.key === "Escape" && !modal.classList.contains("hidden")) {
            window["closeModal" + userId]();
          }
        });
      });

      // Inicializa modais de exclusão dinamicamente
      document.querySelectorAll("[id^=openDeleteModal-]").forEach(button => {
        const userId = button.id.replace("openDeleteModal-", "");
        const modal = document.getElementById("delete-modal-" + userId);
        const overlay = document.getElementById("delete-overlay-" + userId);
        const cancelButton = document.getElementById("cancel-delete-" + userId);
        const modalContent = modal.querySelector("div");

        button.addEventListener("click", function() {
          modal.classList.remove("hidden");
          overlay.classList.remove("hidden");
          modal.classList.add("opacity-100");
          overlay.classList.add("opacity-100");
          modalContent.classList.remove("-translate-y-12");
          document.body.classList.add("overflow-hidden");
          modalContent.focus();
        });

        window["closeDeleteModal" + userId] = function() {
          modal.classList.remove("opacity-100");
          overlay.classList.remove("opacity-100");
          modalContent.classList.add("-translate-y-12");
          setTimeout(() => {
            modal.classList.add("hidden");
            overlay.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
            button.focus();
          }, 300);
        };

        cancelButton.addEventListener("click", window["closeDeleteModal" + userId]);

        modal.addEventListener("click", function(event) {
          if (event.target === modal || event.target === overlay) {
            window["closeDeleteModal" + userId]();
          }
        });

        document.addEventListener("keydown", function(event) {
          if (event.key === "Escape" && !modal.classList.contains("hidden")) {
            window["closeDeleteModal" + userId]();
          }
        });
      });

      function showNotification(title, subtitle) {
        console.log("showNotification chamada com:", title, subtitle);
        const existing = document.getElementById("copy-notification");
        if (existing) existing.remove();

        document.body.insertAdjacentHTML("beforeend", `' . copyNotify() . '`);
        const notification = document.getElementById("copy-notification");

        notification.querySelector(".title").textContent = title;
        notification.querySelector(".subtitle").textContent = subtitle;

        notification.classList.remove("hidden");

        requestAnimationFrame(() => {
            notification.classList.remove("opacity-0", "translate-y-5");
            notification.classList.add("opacity-100", "translate-y-0");
        });

        setTimeout(() => {
            notification.classList.remove("opacity-100", "translate-y-0");
            notification.classList.add("opacity-0", "translate-y-5");

            setTimeout(() => notification.remove(), 300);
        }, 2000);
      }
    </script>';
}
