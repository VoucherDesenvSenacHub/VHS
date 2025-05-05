<?php
namespace src\views\components\gridUsuarios;

function GridUsuariosComponent($usuarios = []) {
    if (empty($usuarios)) {
        $usuarios = [
            ['id' => 1, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678 - 9793 - 93ab0fe'],
            ['id' => 2, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678 - 9793 - 93ab0fe'],
            ['id' => 3, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678 - 9793 - 93ab0fe'],
            ['id' => 4, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678 - 9793 - 93ab0fe'],
            ['id' => 5, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678 - 9793 - 93ab0fe'],
            ['id' => 6, 'username' => '@rafael_', 'description' => '4506022 - Ofba - 4678 - 9793 - 93ab0fe'],
        ];
    }

    echo '
    <!-- Tailwind CSS via CDN -->
    <script src="../../../styles/tailwindglobal.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <div id="grid-usuarios" class="w-full max-w-md bg-[#0C0118] rounded-lg p-4">
    ';

    foreach ($usuarios as $usuario) {
        echo '
        <div class="flex items-center py-2 border-b border-gray-700 last:border-b-0">
            <!-- Avatar -->
            <img
                src="https://via.placeholder.com/40"
                alt="User Avatar"
                class="w-10 h-10 rounded-md mr-3"
            >
            <!-- Informações do Usuário -->
            <div class="flex-1 text-white">
                <span class="block font-semibold">' . htmlspecialchars($usuario['username']) . '</span>
                <span class="block text-sm text-gray-400">' . htmlspecialchars($usuario['description']) . '</span>
            </div>
            <!-- Botão de Ação -->
            <button class="action-button text-white text-lg hover:bg-gray-700 p-1 rounded">⋮</button>
        </div>
        ';
    }

    echo '
    </div>
    <script src="./gridUsuarios/gridUsuariosScript.js"></script>
    ';




}
GridUsuariosComponent();