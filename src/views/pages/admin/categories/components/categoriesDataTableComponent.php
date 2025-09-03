<?php

namespace Src\Views\Components\CategoriesDataTableComponent;

function copyNotify(): string
{
    return '
        <div id="copy-notification" class="fixed bottom-4 right-4 bg-gray-800 text-white p-4 rounded-md shadow-lg hidden opacity-0 translate-y-5 transition-all duration-300">
            <div class="title font-bold"></div>
            <div class="subtitle text-sm"></div>
        </div>';
}

function categoriesDataTableComponent(array $categories, int $page = 1, int $perPage = 7): void
{
    $totalCategories = count($categories);
    $totalPages = ceil($totalCategories / $perPage);
    $offset = ($page - 1) * $perPage;
    $displayCategories = array_slice($categories, $offset, $perPage);

?>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <div class="overflow-hidden rounded-lg border border-gray-700 bg-[#1B1B1B] backdrop-blur-sm">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-700 bg-gray-800/80">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Nome</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Data de Criação</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-white bg-[#660BAD] border-l border-[#660BAD]/30">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <?php foreach ($displayCategories as $category): ?>
                        <?php
                        if (!isset($category['id'])) {
                            continue; // Pula categorias sem ID para evitar erros
                        }
                        $modalId = 'modal-' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
                        $overlayId = 'overlay-' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
                        $openModalId = 'openModal-' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
                        $closeModalId = 'closeModal-' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
                        $openDeleteModalId = 'openDeleteModal-' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
                        ?>
                        <tr class="group transition-colors hover:bg-[#660BAD]/10">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-white"><?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-slate-300">
                                    <?php echo isset($category['criado_em']) ? date('d/m/Y', strtotime($category['criado_em'])) : 'N/A'; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 bg-[#660BAD]/5 border-l border-[#660BAD]/20">
                                <div class="flex items-center justify-center gap-2">
                                    <button id="<?php echo $openModalId; ?>" class="h-8 w-8 p-0 flex items-center justify-center text-[#660BAD] hover:bg-[#660BAD] hover:text-white transition-all border border-[#660BAD]/40 rounded" data-category-id="<?php echo htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <i data-lucide="edit" class="h-4 w-4"></i>
                                    </button>
                                    <button id="<?php echo $openDeleteModalId; ?>" class="h-8 w-8 p-0 flex items-center justify-center text-[#660BAD] hover:bg-[#660BAD] hover:text-white transition-all border border-[#660BAD]/40 rounded">
                                        <i data-lucide="trash-2" class="h-4 w-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php foreach ($displayCategories as $category): ?>
        <?php
        if (!isset($category['id'])) {
            continue; // Pula categorias sem ID
        }
        $modalId = 'modal-' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
        $overlayId = 'overlay-' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
        $closeModalId = 'closeModal-' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
        $deleteModalId = 'delete-modal-' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
        $deleteOverlayId = 'delete-overlay-' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
        $closeDeleteModalId = 'cancel-delete-' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
        ?>

        <!-- Modal de edição -->
        <div id="<?php echo $overlayId; ?>" class="absolute inset-0 bg-black bg-opacity-50 opacity-0 transition-opacity duration-300 hidden"></div>
        <div id="<?php echo $modalId; ?>" class="absolute inset-0 z-20 opacity-0 transition-opacity duration-400 hidden flex items-center justify-center">
            <div class="min-w-[400px] flex flex-col gap-4 p-8 bg-gray-900 text-gray-50 border border-gray-700 rounded-lg transform -translate-y-12 transition-transform duration-300">
                <div class="flex justify-center items-center">
                    <h2 class="text-2xl font-bold text-white cursor-default">Editar Categoria</h2>
                </div>
                <form method="POST" action="/VHS/src/application/routes/route.php/api/v1/admin?update=<?php echo htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>" class="edit-category-form">
                    <!-- <input type="hidden" name="update" value="<?php echo htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>"> -->
                    <div class="flex flex-col gap-4 w-full">
                        <div class="flex flex-col w-full justify-start">
                            <div class="flex w-full justify-start">
                                <label class="text-right text-gray-300">Nome</label>
                            </div>
                            <input
                                name="updateCategory"
                                class="col-span-3 bg-gray-800 border border-gray-700 text-gray-50 p-2 rounded"
                                value="<?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>"
                                required />
                        </div>
                    </div>
                    <div class="mt-4 flex justify-between gap-2">
                        <button type="button" id="<?php echo $closeModalId; ?>" class="outline outline-1 px-4 py-2 outline-[#660BAD] rounded-md transition-colors hover:bg-gray-800 w-[200px] h-[50px]">Cancelar</button>
                        <button type="submit" class="bg-[#660BAD] transition-colors hover:bg-purple-700 text-gray-50 px-4 py-2 rounded-md w-[200px] h-[50px]">Salvar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal de exclusão -->
        <div id="<?php echo $deleteOverlayId; ?>" class="absolute inset-0 bg-black bg-opacity-50 z-10 opacity-0 transition-opacity duration-300 hidden"></div>
        <form id="<?php echo $deleteModalId; ?>" method="POST" action="/api/v1/admin/categories/delete" class="absolute inset-0 z-20 opacity-0 transition-opacity duration-300 hidden flex items-center justify-center">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>" />
            <div class="min-w-[300px] flex flex-col gap-4 p-8 bg-gray-900 text-gray-50 border border-gray-700 rounded-lg transform -translate-y-12 transition-transform duration-300">
                <div class="flex justify-center items-center">
                    <h2 class="text-2xl font-bold text-white cursor-default">Confirmar Exclusão</h2>
                </div>
                <div class="flex flex-col gap-4 w-full">
                    <p class="text-gray-300 text-center">Tem certeza que deseja excluir a categoria <br><strong><?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?></strong>?</p>
                </div>
                <div class="mt-4 flex justify-between gap-2">
                    <button type="button" id="<?php echo $closeDeleteModalId; ?>" class="outline outline-1 px-4 py-2 outline-[#660BAD] rounded-md hover:bg-gray-800 w-full transition-colors h-[50px]">Cancelar</button>
                    <button type="submit" class="bg-[#660BAD] transition-colors hover:bg-purple-700 text-gray-50 px-4 py-2 rounded-md w-full h-[50px]">Excluir</button>
                </div>
            </div>
        </form>
    <?php endforeach; ?>

    <?php if ($totalCategories > $perPage): ?>
        <div class="mt-6 flex items-center justify-between text-sm text-slate-400">
            <div>Mostrando <?php echo ($offset + 1); ?> a <?php echo min($offset + $perPage, $totalCategories); ?> de <?php echo $totalCategories; ?> categorias</div>
            <div class="flex items-center gap-2">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo ($page - 1); ?>" class="border border-slate-700 text-slate-400 bg-transparent px-3 py-1 rounded text-sm">Anterior</a>
                <?php else: ?>
                    <button class="border border-slate-700 text-slate-400 bg-transparent px-3 py-1 rounded text-sm cursor-not-allowed" disabled>Anterior</button>
                <?php endif; ?>
                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo ($page + 1); ?>" class="border border-slate-700 text-slate-400 bg-transparent px-3 py-1 rounded text-sm">Próximo</a>
                <?php else: ?>
                    <button class="border border-slate-700 text-slate-400 bg-transparent px-3 py-1 rounded text-sm cursor-not-allowed" disabled>Próximo</button>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="mt-6 flex items-center justify-between text-sm text-slate-400">
            <div>Mostrando <?php echo $totalCategories; ?> de <?php echo $totalCategories; ?> categorias</div>
            <div class="flex items-center gap-2">
                <button class="border border-slate-700 text-slate-400 bg-transparent px-3 py-1 rounded text-sm cursor-not-allowed" disabled>Anterior</button>
                <button class="border border-slate-700 text-slate-400 bg-transparent px-3 py-1 rounded text-sm cursor-not-allowed" disabled>Próximo</button>
            </div>
        </div>
    <?php endif; ?>

    <script>
        lucide.createIcons();

        // Inicializa modais de edição dinamicamente
        document.querySelectorAll("[id^=openModal-]").forEach(button => {
            const categoryId = button.dataset.categoryId;
            const modal = document.getElementById(`modal-${categoryId}`);
            const overlay = document.getElementById(`overlay-${categoryId}`);
            const closeModalButton = document.getElementById(`closeModal-${categoryId}`);
            const modalContent = modal.querySelector("div");

            button.addEventListener("click", () => {
                // Atualiza a URL com o parâmetro update=id
                const newUrl = new URL(window.location.href);
                newUrl.searchParams.set('update', categoryId);
                window.history.pushState({}, '', newUrl);

                modal.classList.remove("hidden");
                overlay.classList.remove("hidden");
                modal.classList.add("opacity-100");
                overlay.classList.add("opacity-100");
                modalContent.classList.remove("-translate-y-12");
                document.body.classList.add("overflow-hidden");
                modalContent.focus();
            });

            window[`closeModal${categoryId}`] = () => {
                // Remove o parâmetro update da URL ao fechar o modal
                const newUrl = new URL(window.location.href);
                newUrl.searchParams.delete('update');
                window.history.pushState({}, '', newUrl);

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

            closeModalButton.addEventListener("click", window[`closeModal${categoryId}`]);

            modal.addEventListener("click", (event) => {
                if (event.target === modal || event.target === overlay) {
                    window[`closeModal${categoryId}`]();
                }
            });

            document.addEventListener("keydown", (event) => {
                if (event.key === "Escape" && !modal.classList.contains("hidden")) {
                    window[`closeModal${categoryId}`]();
                }
            });
        });

        // Inicializa modais de exclusão dinamicamente
        document.querySelectorAll("[id^=openDeleteModal-]").forEach(button => {
            const categoryId = button.id.replace("openDeleteModal-", "");
            const modal = document.getElementById(`delete-modal-${categoryId}`);
            const overlay = document.getElementById(`delete-overlay-${categoryId}`);
            const cancelButton = document.getElementById(`cancel-delete-${categoryId}`);
            const modalContent = modal.querySelector("div");

            button.addEventListener("click", () => {
                modal.classList.remove("hidden");
                overlay.classList.remove("hidden");
                modal.classList.add("opacity-100");
                overlay.classList.add("opacity-100");
                modalContent.classList.remove("-translate-y-12");
                document.body.classList.add("overflow-hidden");
                modalContent.focus();
            });

            window[`closeDeleteModal${categoryId}`] = () => {
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

            cancelButton.addEventListener("click", window[`closeDeleteModal${categoryId}`]);

            modal.addEventListener("click", (event) => {
                if (event.target === modal || event.target === overlay) {
                    window[`closeDeleteModal${categoryId}`]();
                }
            });

            document.addEventListener("keydown", (event) => {
                if (event.key === "Escape" && !modal.classList.contains("hidden")) {
                    window[`closeDeleteModal${categoryId}`]();
                }
            });
        });

        // Manipula envio do formulário via AJAX
        document.querySelectorAll(".edit-category-form").forEach(form => {
            form.addEventListener("submit", async (event) => {
                event.preventDefault();
                const formData = new FormData(form);
                const actionUrl = form.getAttribute("action");

                try {
                    const response = await fetch(actionUrl, {
                        method: "POST",
                        body: formData
                    });
                    const result = await response.json();

                    if (result.success) {
                        showNotification("Sucesso", result.message);
                        setTimeout(() => {
                            window.location.href = result.redirect;
                        }, 2000);
                    } else {
                        showNotification("Erro", result.message);
                    }
                } catch (error) {
                    showNotification("Erro", "Ocorreu um erro ao processar a solicitação.");
                }
            });
        });

        function showNotification(title, subtitle) {
            const existing = document.getElementById("copy-notification");
            if (existing) existing.remove();

            document.body.insertAdjacentHTML("beforeend", <?php echo json_encode(copyNotify()); ?>);
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
    </script>
<?php
}
