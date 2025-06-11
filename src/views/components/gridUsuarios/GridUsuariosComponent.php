<?php
namespace src\views\components\gridUsuarios;

function GridUsuariosComponent($usuarios = []) {
    if (empty($usuarios)) {
        $usuarios = [
            ['id' => 1, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678 - 9793 - 93ab0fe', 'profession' => 'Criador de conteúdo'],
            ['id' => 2, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678 - 9793 - 93ab0fe', 'profession' => 'Criador de conteúdo'],
            ['id' => 3, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678 - 9793 - 93ab0fe', 'profession' => 'Criador de conteúdo'],
            ['id' => 4, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678 - 9793 - 93ab0fe', 'profession' => 'Criador de conteúdo'],
            ['id' => 5, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678 - 9793 - 93ab0fe', 'profession' => 'Criador de conteúdo'],
            ['id' => 6, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678 - 9793 - 93ab0fe', 'profession' => 'Criador de conteúdo'],
            ['id' => 7, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678 - 9793 - 93ab0fe', 'profession' => 'Criador de conteúdo'],
            ['id' => 8, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678 - 9793 - 93ab0fe', 'profession' => 'Criador de conteúdo'],
        ];
    }

    echo '
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <div id="grid-usuarios" class="w-full bg-[#0C0118] rounded-lg p-4">
    ';

    foreach ($usuarios as $usuario) {
        echo '
        <div class="flex items-center py-2 last:border-b-0 relative">
            <!-- Avatar -->
            <img
                src="https://github.com/shadcn.png"
                alt="User Avatar"
                class="w-10 h-10 rounded-md mr-3"
            >
            <!-- Informações do Usuário -->
            <div class="flex-1 text-white">
                <span class="block font-semibold">' . htmlspecialchars($usuario['username']) . '</span>
                <span class="block text-sm text-gray-400">' . htmlspecialchars($usuario['description']) . '</span>
                <span class="block text-sm text-gray-400">' . htmlspecialchars($usuario['profession']) . '</span>
            </div>
            
            <div class="flex justify-between w-[3.56rem]">
                <button class="w-5 h-5 flex-justify-center" data-user-id="' . $usuario['id'] . '" data-action="user_menu">
                    <img src="/VHS/public/icons/User_id.svg" alt="">
                </button>
                <button class="w-5 h-5 flex-justify-center" data-user-id="' . $usuario['id'] . '" data-action="delete">
                    <img src="/VHS/public/icons/User_block.svg" alt="">
                </button>
            </div>

            <!-- Card de Banir -->
            <div class="bg-[#1B1B1B] text-white rounded-lg flex items-center p-4 w-26 h-10 absolute hidden top-14 right-0 mt-2 border-2 border-gray-600 z-10" data-user-id="' . $usuario['id'] . '" data-card="delete">
                <div class="flex items-center">
                    <img src="../../../../public/icons/Shield_Warning.svg" class="w-6 h-6 text-gray-400 mr-4" alt="Shield Warning">
                    <span class="font-semibold">Banir</span>
                </div>
            </div>

            <!-- Card de Usuário -->
            <div class="bg-[#1B1B1B] text-white rounded-lg flex flex-col p-4 w-48 absolute hidden top-14 right-0  border-2 border-gray-600 z-10" data-user-id="' . $usuario['id'] . '" data-card="user_menu">
                <div class="flex flex-col space-y-4">
                    <div class="flex flex-row items-center space-x-2">
                        <img src="../../../../public/icons/User.svg" class="w-6 h-6 text-gray-400 mr-4" alt="Usuário">
                        <span class="font-semibold">Usuário</span>
                    </div>
                    <div class="flex flex-row items-center space-x-2">
                        <img src="../../../../public/icons/play.svg" class="w-6 h-6 text-gray-400 mr-4" alt="Criador">
                        <span class="font-semibold">Criador</span>
                    </div>
                    <div class="flex flex-row items-center space-x-2">
                        <img src="../../../../public/icons/crown.svg" class="w-6 h-6 text-gray-400 mr-4" alt="Admin">
                        <span class="font-semibold">Admin</span>
                    </div>
                </div>
            </div>
        </div>
        ';
    }

    echo '
    </div>

    <script>
        document.addEventListener(\'DOMContentLoaded\', () => {
            const buttons = document.querySelectorAll(\'[data-action]\');
            buttons.forEach(button => {
                button.addEventListener(\'click\', () => {
                    const userId = button.getAttribute(\'data-user-id\');
                    const action = button.getAttribute(\'data-action\');
                    const card = document.querySelector(`[data-user-id="${userId}"][data-card="${action}"]`);

                    // Fecha todos os cards abertos
                    document.querySelectorAll(\'[data-card]\').forEach(c => c.classList.add(\'hidden\'));

                    // Exibe o card correspondente
                    if (card) {
                        card.classList.remove(\'hidden\');
                    }
                });
            });

            // Fecha o card se clicar fora
            document.addEventListener(\'click\', (e) => {
                if (!e.target.closest(\'[data-action]\') && !e.target.closest(\'[data-card]\')) {
                    document.querySelectorAll(\'[data-card]\').forEach(c => c.classList.add(\'hidden\'));
                }
            });
        });
    </script>
    ';
}
?>