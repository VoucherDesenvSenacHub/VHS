<?php
namespace Src\Views\Components\Perfil_Analytics;
date_default_timezone_set('America/Sao_Paulo');
function renderPostComponent($userImagePath, $username = "Freitasdev") {
    // Verifica se a imagem local existe, caso contrário usa uma imagem padrão
    $localImagePath = file_exists($userImagePath) ? $userImagePath : "/VHS/public/images/Avatar.svg";

    // Obtém a hora atual para determinar a saudação
    $hora = (int) date('H');
    $greeting = 'Boa tarde'; // Padrão
    if ($hora >= 0 && $hora < 12) {
        $greeting = 'Bom dia';
    } elseif ($hora >= 18) {
        $greeting = 'Boa noite';
    }

    // Obtém o dia da semana, dia, mês e ano atual da máquina
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
    $data = strftime('%d de %B de %Y'); // Exemplo: "23 de Junho de 2025"
    $dia_semana = strftime('%A'); // Exemplo: "Segunda", "Terça", etc.
    ?>
    <div class=" text-white p-4 flex items-center">
        <img src="<?php echo htmlspecialchars($localImagePath, ENT_QUOTES, 'UTF-8'); ?>" alt="Foto do usuário" class="w-10 h-10 rounded-full">
        <div class="ml-4">
            <span class="text-lg"><?php echo htmlspecialchars($greeting, ENT_QUOTES, 'UTF-8'); ?>, <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></span>
            <br>
            <span class="text-sm text-gray-400"><?php echo ucfirst($dia_semana); ?>, <?php echo $data; ?></span>
        </div>
    </div>
    <?php
}