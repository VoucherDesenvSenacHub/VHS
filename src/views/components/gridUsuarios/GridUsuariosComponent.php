<?php
namespace src\views\components\gridUsuarios;

function GridUsuariosComponent($usuarios = []) {
    if (empty($usuarios)) {
        $usuarios = [
            ['id' => 1, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678', 'profession' => 'Criador de conteúdo'],
            ['id' => 2, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678', 'profession' => 'Criador de conteúdo'],
            ['id' => 3, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678', 'profession' => 'Criador de conteúdo'],
            ['id' => 4, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678', 'profession' => 'Usuário'],
            ['id' => 5, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678', 'profession' => 'Criador de conteúdo'],
            ['id' => 6, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678', 'profession' => 'Criador de conteúdo'],
            ['id' => 7, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678', 'profession' => 'Usuário'],
            ['id' => 8, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678', 'profession' => 'Admin'],
        ];
    }

    echo '
    <script src="https://cdn.tailwindcss.com"></script>
    <div id="grid-usuarios" class="w-full bg-[#0C0118] rounded-lg ">
    ';

    foreach ($usuarios as $usuario) {
        echo '
        <div class="flex items-center py-2 last:border-b-0 relative">
            <img
                src="https://github.com/shadcn.png"
                alt="User Avatar"
                class="w-10 h-10 rounded-md mr-3"
            >
            <div class="flex-1 text-white">
                <span class="block font-semibold">' . htmlspecialchars($usuario['username']) . '</span>
                <span class="block text-sm text-gray-400">' . htmlspecialchars($usuario['description']) . '</span>
                <span class="block text-sm text-gray-400">' . htmlspecialchars($usuario['profession']) . '</span>
            </div>

            <div class="flex justify-between w-[3.56rem]">
                <button type="button" class="w-5 h-5 flex items-center justify-center" data-user-id="' . $usuario['id'] . '" data-action="user_menu">
                    <img src="/VHS/public/icons/User_id.svg" alt="">
                </button>
                <button type="button" class="w-5 h-5 flex items-center justify-center" data-user-id="' . $usuario['id'] . '" data-action="show_ban_card">
                    <img src="/VHS/public/icons/User_block.svg" alt="">
                </button>
            </div>

            <div class="bg-[#1B1B1B] text-white rounded-lg flex flex-col p-4 w-48 absolute hidden top-14 right-0 border-2 border-gray-600 z-10" data-user-id="' . $usuario['id'] . '" data-card="user_menu">
                <button type="button" class="flex flex-row items-center space-x-2 mb-2 rounded px-2 py-1" data-action="request_role_change" data-role="Usuário" data-user-id="' . $usuario['id'] . '">
                    <img src="../../../../public/icons/User.svg" class="w-6 h-6 text-gray-400" alt="Usuário">
                    <span class="font-semibold">Usuário</span>
                </button>
                <button type="button" class="flex flex-row items-center space-x-2 mb-2 rounded px-2 py-1" data-action="request_role_change" data-role="Criador" data-user-id="' . $usuario['id'] . '">
                    <img src="../../../../public/icons/play.svg" class="w-6 h-6 text-gray-400" alt="Criador">
                    <span class="font-semibold">Criador</span>
                </button>
                <button type="button" class="flex flex-row items-center space-x-2 rounded px-2 py-1" data-action="request_role_change" data-role="Admin" data-user-id="' . $usuario['id'] . '">
                    <img src="../../../../public/icons/crown.svg" class="w-6 h-6 text-gray-400" alt="Admin">
                    <span class="font-semibold">Admin</span>
                </button>
            </div>

            <div class="bg-[#1B1B1B] text-white rounded-lg flex items-center p-4 w-26 h-10 absolute hidden top-14 right-0 mt-2 border-2 border-gray-600 z-20" data-user-id="' . $usuario['id'] . '" data-card="banir">
                <div class="flex items-center cursor-pointer" data-action="request_delete_confirmation" data-user-id="' . $usuario['id'] . '">
                    <img src="../../../../public/icons/Shield_Warning.svg" class="w-6 h-6 text-gray-400 mr-4" alt="Shield Warning">
                    <span class="font-semibold">Banir</span>
                </div>
            </div>

            <div class="bg-[#1B1B1B] text-white text-xl rounded-lg p-6 w-96 h-48 fixed hidden top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 border-2 border-gray-600 z-50 flex flex-col justify-between" data-user-id="' . $usuario['id'] . '" data-card="confirm">
                <p class="text-center text-lg font-semibold" data-confirm-text></p>
                <div class="flex justify-center gap-6">
                    <button type="button" class="w-52 h-10 bg-[#202024] rounded border border-purple-700 hover:bg-[#2a2a2e]" data-action="confirm_no" data-user-id="' . $usuario['id'] . '">Não</button>
                    <button type="button" class="w-52 h-10 bg-purple-700 rounded hover:bg-purple-800" data-action="confirm_yes" data-user-id="' . $usuario['id'] . '">Sim</button>
                </div>
            </div>
        </div>
        ';
    }

    echo '
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const buttons = document.querySelectorAll("[data-action]");
            const allCards = document.querySelectorAll("[data-card]");

            function closeAllCards() {
                allCards.forEach(c => c.classList.add("hidden"));
            }

            function toggleCard(card) {
                if (!card) return;
                const isHidden = card.classList.contains("hidden");
                closeAllCards();
                if (isHidden) card.classList.remove("hidden");
            }

            buttons.forEach(button => {
                button.addEventListener("click", (e) => {
                    e.stopPropagation();
                    const userId = button.getAttribute("data-user-id");
                    const action = button.getAttribute("data-action");

                    const banCard = document.querySelector(`[data-user-id="${userId}"][data-card="banir"]`);
                    const confirmCard = document.querySelector(`[data-user-id="${userId}"][data-card="confirm"]`);
                    const userMenuCard = document.querySelector(`[data-user-id="${userId}"][data-card="user_menu"]`);
                    const confirmTextElem = confirmCard ? confirmCard.querySelector("[data-confirm-text]") : null;

                    if (action === "avatar_click") {
                        toggleCard(confirmCard);
                    } else if (action === "user_menu") {
                        toggleCard(userMenuCard);
                    } else if (action === "show_ban_card") {
                        toggleCard(banCard);
                    } else if (action === "request_delete_confirmation") {
                        if (banCard) banCard.classList.add("hidden");
                        if (confirmTextElem) confirmTextElem.textContent = `Deseja realmente banir o usuário ${userId}?`;
                        toggleCard(confirmCard);
                    } else if (action === "request_role_change") {
                        if (userMenuCard) userMenuCard.classList.add("hidden");
                        const role = button.getAttribute("data-role") || "esta ação";
                        if (confirmTextElem) confirmTextElem.textContent = `Deseja realmente alterar o papel para "${role}"?`;
                        toggleCard(confirmCard);
                    } else if (action === "confirm_no") {
                        if (confirmCard) confirmCard.classList.add("hidden");
                    } else if (action === "confirm_yes") {
                        if (confirmCard) confirmCard.classList.add("hidden");

                        const confirmText = confirmTextElem ? confirmTextElem.textContent : "";

                        if (confirmText.includes("banir")) {
                            showNotification("Usuário banido com sucesso!!", "O usuário foi banido com sucesso");
                        } else if (confirmText.includes("alterar o papel para")) {
                            const papel = confirmText.match(/"(.+?)"/)?.[1] || "papel";
                            showNotification(`Papel alterado para ${papel}`, "O papel do usuário foi atualizado");
                        }
                    }
                });
            });

            document.addEventListener("click", (e) => {
                if (!e.target.closest("[data-action]") && !e.target.closest("[data-card]")) {
                    closeAllCards();
                }
            });
        });

        function showNotification(title, subtitle) {
            const existing = document.getElementById("copy-notification");
            if (existing) existing.remove();

            document.body.insertAdjacentHTML("beforeend", `
                <div id="copy-notification" class="overflow-hidden fixed flex bottom-0 right-0 mb-4 mr-4 min-w-20 min-h-10 bg-[#202024] rounded-xl items-center p-4 gap-4 border-b-4 border-[#660BAD] translate-y-5 opacity-0 transition-all duration-300">
                    <div class="w-12 h-12 bg-[#373450] rounded-full flex items-center justify-center p-2" style="box-shadow: 0 0 75px 0 #660BAD;">
                        <svg width="100%" height="100%" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <img src="../../../../public/icons/warning.svg" alt="">
                        </svg>
                    </div>
                    <div class="flex flex-col text-white">
                        <h1 class="title text-xl">${title}</h1>
                        <span class="subtitle text-gray-500 text-base">${subtitle}</span>
                    </div>
                </div>
            `);

            const notification = document.getElementById("copy-notification");
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
    ';
}
?>
