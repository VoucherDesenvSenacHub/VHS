<?php

namespace Src\Views\Components\Perfil_Analytics;
function renderPostComponent($username, $message, $date, $profilePic = 'profile-pic.jpg') {
    ?>
    <div class="bg-gray-900 text-white p-4 flex items-center">
        <img src="<?php echo htmlspecialchars($profilePic); ?>" alt="Profile" class="w-10 h-10 rounded-full mr-3">
        <div>
            <p class="font-semibold"><?php echo htmlspecialchars($message); ?></p>
            <p class="text-sm text-gray-400"><?php echo htmlspecialchars($date); ?></p>
        </div>
    </div>
    <?php
}

// Exemplo de uso
renderPostComponent("Freitadev", "Boa tarde, Freitadev", "Quinta, 15 de agosto");
?>