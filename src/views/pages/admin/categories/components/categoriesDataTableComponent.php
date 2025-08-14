<?php

namespace src\views\components\categoriesDataTableComponent;

function copyNotify()
{
    return '
        <div id="copy-notification" class="fixed bottom-4 right-4 bg-gray-800 text-white p-4 rounded-md shadow-lg hidden opacity-0 translate-y-5 transition-all duration-300">
            <div class="title font-bold"></div>
            <div class="subtitle text-sm"></div>
        </div>';
}

function categoriesDataTableComponent($categories, $page = 1, $perPage = 7)
{
    $totalCategories = count($categories);
    $totalPages = ceil($totalCategories / $perPage);
    $offset = ($page - 1) * $perPage;
    $displayCategories = array_slice($categories, $offset, $perPage);

    echo '
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <div class="overflow-hidden rounded-lg border border-gray-700 bg-[#1B1B1B] backdrop-blur-sm">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700 bg-gray-800/80">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Nome</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Data de Criação</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-white bg-[#660BAD]/50 border-l border-[#660BAD]/30">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">';

    foreach ($displayCategories as $category) {
        $modalId = 'modal-' . $category['id'];
        $overlayId = 'overlay-' . $category['id'];
        $openModalId = 'openModal-' . $category['id'];
        $closeModalId = 'closeModal-' . $category['id'];
        $openDeleteModalId = 'openDeleteModal-' . $category['id'];

        echo '
        <tr class="group transition-colors hover:bg-[#660BAD]/10">
            <td class="px-6 py-4">
                <div class="font-semibold text-white">' . htmlspecialchars($category['name']) . '</div>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-slate-300">' . htmlspecialchars($category['created_at']) . '</div>
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

    foreach ($displayCategories as $category) {
        $modalId = 'modal-' . $category['id'];
        $overlayId = 'overlay-' . $category['id'];
        $closeModalId = 'closeModal-' . $category['id'];
        $deleteModalId = 'delete-modal-' . $category['id'];
        $deleteOverlayId = 'delete-overlay-' . $category['id'];
        $closeDeleteModalId = 'cancel-delete-' . $category['id'];

        // Modal de edição
        echo '
        <div id="' . $overlayId . '" class="absolute h-screen w-screen button-0 inset-0 bg-black bg-opacity-50 opacity-0 transition-opacity duration-300 hidden"></div>
        <div id="' . $modalId . '" class="absolute inset-0 z-20 opacity-0 transition-opacity duration-400 hidden flex items-center justify-center">
            <div class="min-w-[400px] flex flex-col gap-4 p-8 px-10 bg-gray-900 text-gray-50 border border-gray-700 p-4 rounded-lg transform -translate-y-12 transition-transform duration-300">
                <div class="flex justify-center items-center">
                    <h2 class="text-2xl font-bold text-white cursor-default">Editar Categoria</h2>
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <div class="flex flex-col w-full">
                        <div class="flex w-full justify-start">
                            <label for="name-' . $category['id'] . '" class="text-right text-gray-300">Nome</label>
                        </div>
                        <input id="name-' . $category['id'] . '" class="col-span-3 bg-gray-800 border border-gray-700 text-gray-50 p-2 rounded" value="' . htmlspecialchars($category['name']) . '" />
                    </div>
                </div>
                <div class="mt-4 flex justify-between gap-2">
                    <button id="' . $closeModalId . '" class="outline outline-1 px-4 py-2 outline-purple-500 rounded-md hover:bg-gray-800 w-[200px] h-[50px]">Cancelar</button>
                    <button onclick="showNotification(\'Sucesso!\', \'Categoria editada com sucesso.\'); closeModal' . $category['id'] . '();" class="bg-purple-600 hover:bg-purple-700 text-gray-50 px-4 py-2 rounded-md w-[200px] h-[50px]">Salvar</button>
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
                    <p class="text-gray-300 text-center">Tem certeza que deseja excluir a categoria <br><strong>' . htmlspecialchars($category['name']) . '</strong>?</p>
                </div>
                <div class="mt-4 flex justify-between gap-2">
                    <button id="' . $closeDeleteModalId . '" class="outline outline-1 px-4 py-2 outline-purple-500 rounded-md hover:bg-gray-800 w-full h-[50px]">Cancelar</button>
                    <button onclick="showNotification(\'Sucesso!\', \'Categoria excluída com sucesso.\'); window[\'closeDeleteModal' . $category['id'] . '\']();" class="bg-purple-600 hover:bg-purple-700 text-gray-50 px-4 py-2 rounded-md w-full h-[50px]">Excluir</button>
                </div>
            </div>
        </div>';
    }

    if ($totalCategories > 7) {
        echo '
        <div class="mt-6 flex items-center justify-between text-sm text-slate-400">
            <div>Mostrando ' . ($offset + 1) . ' a ' . min($offset + $perPage, $totalCategories) . ' de ' . $totalCategories . ' categorias</div>
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
            <div>Mostrando ' . $totalCategories . ' de ' . $totalCategories . ' categorias</div>
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
        const categoryId = button.id.replace("openModal-", "");
        const modal = document.getElementById("modal-" + categoryId);
        const overlay = document.getElementById("overlay-" + categoryId);
        const closeModalButton = document.getElementById("closeModal-" + categoryId);
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

        window["closeModal" + categoryId] = function() {
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

        closeModalButton.addEventListener("click", window["closeModal" + categoryId]);

        modal.addEventListener("click", function(event) {
          if (event.target === modal || event.target === overlay) {
            window["closeModal" + categoryId]();
          }
        });

        document.addEventListener("keydown", function(event) {
          if (event.key === "Escape" && !modal.classList.contains("hidden")) {
            window["closeModal" + categoryId]();
          }
        });
      });

      // Inicializa modais de exclusão dinamicamente
      document.querySelectorAll("[id^=openDeleteModal-]").forEach(button => {
        const categoryId = button.id.replace("openDeleteModal-", "");
        const modal = document.getElementById("delete-modal-" + categoryId);
        const overlay = document.getElementById("delete-overlay-" + categoryId);
        const cancelButton = document.getElementById("cancel-delete-" + categoryId);
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

        window["closeDeleteModal" + categoryId] = function() {
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

        cancelButton.addEventListener("click", window["closeDeleteModal" + categoryId]);

        modal.addEventListener("click", function(event) {
          if (event.target === modal || event.target === overlay) {
            window["closeDeleteModal" + categoryId]();
          }
        });

        document.addEventListener("keydown", function(event) {
          if (event.key === "Escape" && !modal.classList.contains("hidden")) {
            window["closeDeleteModal" + categoryId]();
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
