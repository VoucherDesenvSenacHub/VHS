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
    <script src="../../../styles/tailwindglobal.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <div id="grid-usuarios" class="w-full bg-[#0C0118] rounded-lg p-4">
    ';
 
    foreach ($usuarios as $usuario) {
        echo '
        <div class="flex items-center py-2   last:border-b-0">
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
            <!-- Botão de Ação -->
            <button class="action-button text-white text-lg hover:bg-gray-700 p-1 rounded">
                <div class="flex items-center gap-2">
                    <img src="../../../../public/icons/User_id.svg" alt="User ID" class="w-6 h-6">
                </div>
            </button>
            <button class="action-button text-white text-lg hover:bg-gray-700 p-1 rounded">
                <div class="flex items-center gap-2">
                    <img src="../../../../public/icons/User_block.svg" alt="User Block" class="w-6 h-6">
                </div>
            </button>
        </div>
        ';
    }
 
    echo '
    </div>
    <script src="./gridUsuarios/gridUsuariosScript.js"></script>
    ';
}
?>
 