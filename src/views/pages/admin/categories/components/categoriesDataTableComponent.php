<?php

namespace Src\Views\Components\CategoriesDataTableComponent;

require_once __DIR__ . '/../../../../../application/utils/pagination.php';

use function Src\Application\Utils\paginate;

function categoriesDataTableComponent(array $categories , int $next_page_categories)
{
    $pagination = paginate($categories, $next_page_categories);
    if (empty($categories)) {
        return <<<HTML
            <div class="rounded-lg border border-gray-700 bg-[#1B1B1B] p-6 text-center">
                <p class="text-slate-400">Nenhuma categoria criada.</p>
            </div>
        HTML;
    }

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
                    <?php foreach ($categories as $category): ?>
                        <?php
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
                                    <?php echo isset($category['created_at']) ? date('d/m/Y', strtotime($category['created_at'])) : 'N/A'; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 bg-[#660BAD]/5 border-l border-[#660BAD]/20">
                                <div class="flex items-center justify-center gap-2">
                                    <button id="<?php echo $openModalId; ?>" class="h-9 w-9 p-1 flex items-center justify-center text-[#660BAD] hover:bg-[#660BAD]/50 hover:border-[#660BAD] hover:text-white transition-all border border-[#660BAD]/60 rounded" data-category-id="<?php echo htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                        </svg>
                                    </button>
                                    <button id="<?php echo $openDeleteModalId; ?>" class="h-9 w-9 p-1 flex items-center justify-center text-[#660BAD] hover:bg-red-500/30 hover:border-red-500/40 hover:text-red-500 transition-all border border-[#660BAD]/60 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php echo $pagination; ?>

    <?php foreach ($categories as $category): ?>
        <?php
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
            <div class="max-w-sm w-[300px] md:w-full flex flex-col gap-3 p-6 bg-gray-900 text-gray-50 border border-gray-700 rounded-lg transform -translate-y-12 transition-transform duration-300">
                <div class="flex justify-center items-center">
                    <h2 class="text-lg font-bold text-white cursor-default">Editar Categoria</h2>
                </div>
                <form method="POST" action="/VHS/src/application/routes/route.php/api/v1/admin/categories/update" class="edit-category-form">
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
                            <input
                                type="hidden"
                                name="categoryId"
                                value="<?php echo htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>" />
                        </div>
                        <div class=" flex justify-between gap-2">
                            <button type="button" id="<?php echo $closeModalId; ?>" class="transition-colors w-full px-4 py-2 rounded-md border border-gray-600 text-gray-300 hover:bg-gray-700">Cancelar</button>
                            <button type="submit" class="transition-colors w-full px-4 py-2 rounded-md bg-[#660BAD] text-white hover:bg-[#53088A]">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal de exclusão -->
        <div id="<?php echo $deleteOverlayId; ?>" class="absolute inset-0 bg-black bg-opacity-50 z-10 opacity-0 transition-opacity duration-300 hidden"></div>
        <div id="<?php echo $deleteModalId; ?>" class="absolute inset-0 z-20 opacity-0 transition-opacity duration-300 hidden flex items-center justify-center">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>" />
            <div class="max-w-sm w-[300px] md:w-full flex flex-col gap-3 p-6 bg-gray-900 text-gray-50 border border-gray-700 rounded-lg transform -translate-y-12 transition-transform duration-300">
                <div class="flex justify-center items-center">
                    <h2 class="text-lg font-bold text-white">Confirmar Exclusão</h2>
                </div>
                <form method="POST" action="/VHS/src/application/routes/route.php/api/v1/admin/categories/delete">
                    <input
                        type="hidden"
                        name="categoryId"
                        value="<?php echo htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>" />
                    <div class="flex flex-col gap-4 w-full">
                        <p class="text-sm text-slate-300 text-center">Tem certeza que deseja excluir a categoria <strong><?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?></strong>?</p>
                    </div>
                    <div class="flex mt-4 justify-between gap-2">
                        <button type="button" id="<?php echo $closeDeleteModalId; ?>" class="transition-colors px-4 py-2 rounded-md w-full border border-gray-600 text-gray-300 hover:bg-gray-700">Cancelar</button>
                        <button type="submit" class="transition-colors px-4 py-2 rounded-md w-full bg-red-600 text-white hover:bg-red-700">Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>

    <script>
        document.querySelectorAll("[id^=openModal-]").forEach(button => {
            const categoryId = button.dataset.categoryId;
            const modal = document.getElementById(`modal-${categoryId}`);
            const overlay = document.getElementById(`overlay-${categoryId}`);
            const closeModalButton = document.getElementById(`closeModal-${categoryId}`);
            const modalContent = modal.querySelector("div");

            button.addEventListener("click", () => {
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

        document.querySelectorAll("[id^=openModal-]").forEach(button => {
            const categoryId = button.dataset.categoryId;
            const modal = document.getElementById(`modal-${categoryId}`);
            const overlay = document.getElementById(`overlay-${categoryId}`);
            const closeModalButton = document.getElementById(`closeModal-${categoryId}`);
            const modalContent = modal.querySelector("div");

            button.addEventListener("click", () => {
                const baseUrl = window.location.origin + window.location.pathname;
                window.history.pushState({}, '', `${baseUrl}/${categoryId}`);

                modal.classList.remove("hidden");
                overlay.classList.remove("hidden");
                modal.classList.add("opacity-100");
                overlay.classList.add("opacity-100");
                modalContent.classList.remove("-translate-y-12");
                document.body.classList.add("overflow-hidden");
                modalContent.focus();
            });

            window[`closeModal${categoryId}`] = () => {
                const baseUrl = window.location.origin + window.location.pathname.split('/').slice(0, -1).join('/');
                window.history.pushState({}, '', baseUrl);

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
    </script>
<?php
}
