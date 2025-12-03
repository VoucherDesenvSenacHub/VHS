<?php

namespace Src\Views\Components\CategoriesDataTableComponent;

require_once __DIR__ . '/../../../../../application/utils/pagination.php';

use function Src\Application\Utils\paginate;

function categoriesDataTableComponent(array $categories, int $next_page_categories)
{
    $pagination = paginate($categories, $next_page_categories);
    if (empty($categories)) {
        return <<<HTML
            <div class="rounded-2xl border border-white/5 bg-[#121214] p-12 text-center">
                <div class="flex flex-col items-center justify-center gap-4">
                    <div class="p-4 rounded-full bg-white/5">
                        <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-white">Nenhuma categoria encontrada</h3>
                        <p class="text-gray-400 mt-1">Crie novas categorias para organizar o conteúdo.</p>
                    </div>
                </div>
            </div>
        HTML;
    }

?>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <div class="overflow-hidden rounded-xl border border-white/5 bg-[#121214]">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/5 bg-white/[0.02]">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Data de Criação</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <?php foreach ($categories as $category): ?>
                        <?php
                        $modalId = 'modal-' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
                        $overlayId = 'overlay-' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
                        $openModalId = 'openModal-' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
                        $closeModalId = 'closeModal-' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
                        $openDeleteModalId = 'openDeleteModal-' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8');
                        ?>
                        <tr class="group transition-colors hover:bg-white/[0.02]">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 rounded-lg bg-[#660BAD]/10 text-[#660BAD]">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                    </div>
                                    <span class="font-medium text-white"><?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-400">
                                    <?php echo isset($category['created_at']) ? date('d/m/Y', strtotime($category['created_at'])) : 'N/A'; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button id="<?php echo $openModalId; ?>" class="p-2 rounded-lg text-gray-400 hover:text-white hover:bg-white/10 transition-all" title="Editar" data-category-id="<?php echo htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button id="<?php echo $openDeleteModalId; ?>" class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-500/10 transition-all" title="Excluir">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
    <div class="mt-6">
        <?php echo $pagination; ?>
    </div>

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
        <div id="<?php echo $overlayId; ?>" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden transition-opacity duration-300 z-40"></div>
        <div id="<?php echo $modalId; ?>" class="fixed inset-0 flex items-center justify-center hidden z-50 p-4">
            <div class="w-full max-w-md bg-[#121214] border border-white/10 rounded-2xl p-6 shadow-2xl transform scale-95 opacity-0 transition-all duration-300">
                <div class="flex flex-col gap-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-white">Editar Categoria</h2>
                        <button id="<?php echo $closeModalId; ?>" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form method="POST" action="/VHS/src/application/routes/route.php/api/v1/admin/categories/update">
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col gap-2">
                                <label class="text-sm font-medium text-gray-300">Nome</label>
                                <input
                                    name="updateCategory"
                                    class="w-full bg-[#09090B] border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-[#660BAD] focus:ring-1 focus:ring-[#660BAD] transition-all"
                                    value="<?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>"
                                    required />
                                <input
                                    type="hidden"
                                    name="categoryId"
                                    value="<?php echo htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>" />
                            </div>

                            <div class="flex gap-3 mt-2">
                                <button type="button" onclick="document.getElementById('<?php echo $closeModalId; ?>').click()" class="flex-1 px-4 py-2.5 rounded-xl border border-white/10 text-gray-300 hover:bg-white/5 transition-colors font-medium">
                                    Cancelar
                                </button>
                                <button type="submit" class="flex-1 px-4 py-2.5 rounded-xl bg-[#660BAD] hover:bg-[#7a15c5] text-white transition-colors font-medium shadow-lg shadow-purple-900/20">
                                    Salvar Alterações
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal de exclusão -->
        <div id="<?php echo $deleteOverlayId; ?>" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden transition-opacity duration-300 z-40"></div>
        <div id="<?php echo $deleteModalId; ?>" class="fixed inset-0 flex items-center justify-center hidden z-50 p-4">
            <div class="w-full max-w-md bg-[#121214] border border-white/10 rounded-2xl p-6 shadow-2xl transform scale-95 opacity-0 transition-all duration-300">
                <div class="flex flex-col items-center text-center gap-4">
                    <div class="p-3 bg-red-500/10 rounded-full">
                        <svg class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Excluir Categoria</h2>
                        <p class="text-sm text-gray-400 mt-2">
                            Tem certeza que deseja excluir a categoria <span class="font-semibold text-white"><?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?></span>?
                        </p>
                    </div>
                </div>

                <form method="POST" action="/VHS/src/application/routes/route.php/api/v1/admin/categories/delete">
                    <input type="hidden" name="categoryId" value="<?php echo htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>" />
                    <div class="mt-6 flex gap-3">
                        <button type="button" id="<?php echo $closeDeleteModalId; ?>" class="flex-1 px-4 py-2.5 rounded-xl border border-white/10 text-gray-300 hover:bg-white/5 transition-colors font-medium">
                            Cancelar
                        </button>
                        <button type="submit" class="flex-1 px-4 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white transition-colors font-medium shadow-lg shadow-red-500/20">
                            Sim, excluir
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>

    <script>
        function setupModal(triggerBtn, modal, overlay, closeBtn, content) {
            triggerBtn.addEventListener("click", () => {
                modal.classList.remove("hidden");
                overlay.classList.remove("hidden");
                // Force reflow
                void modal.offsetWidth;

                modal.classList.remove("opacity-0");
                overlay.classList.remove("opacity-0"); // Fix: overlay opacity class
                content.classList.remove("scale-95", "opacity-0");
                content.classList.add("scale-100", "opacity-100");
                document.body.classList.add("overflow-hidden");
            });

            const close = () => {
                modal.classList.add("opacity-0");
                overlay.classList.add("opacity-0"); // Fix: overlay opacity class
                content.classList.remove("scale-100", "opacity-100");
                content.classList.add("scale-95", "opacity-0");

                setTimeout(() => {
                    modal.classList.add("hidden");
                    overlay.classList.add("hidden");
                    document.body.classList.remove("overflow-hidden");
                }, 300);
            };

            if (closeBtn) closeBtn.addEventListener("click", close);
            overlay.addEventListener("click", close);
        }

        document.querySelectorAll("[id^=openModal-]").forEach(button => {
            const id = button.dataset.categoryId;
            const modal = document.getElementById(`modal-${id}`);
            const overlay = document.getElementById(`overlay-${id}`);
            const closeBtn = document.getElementById(`closeModal-${id}`);
            const content = modal.querySelector("div");

            setupModal(button, modal, overlay, closeBtn, content);
        });

        document.querySelectorAll("[id^=openDeleteModal-]").forEach(button => {
            const id = button.id.replace("openDeleteModal-", "");
            const modal = document.getElementById(`delete-modal-${id}`);
            const overlay = document.getElementById(`delete-overlay-${id}`);
            const closeBtn = document.getElementById(`cancel-delete-${id}`);
            const content = modal.querySelector("div");

            setupModal(button, modal, overlay, closeBtn, content);
        });
    </script>
<?php
}
