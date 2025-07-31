<?php
namespace Src\Views\Components\Perfil_Analytics;

// Definir cabeçalho HTTP para UTF-8
header('Content-Type: text/html; charset=UTF-8');

function renderPostComponent($userImagePath, $username = "Freitasdev!", $horaPadrao = "Olá ", $diaSemana = "Terça-feira", $data = "24 de Junho de 2025") {
    $localImagePath = file_exists($userImagePath) ? $userImagePath : "/VHS/public/images/Avatar.svg";
?>
    <div class="text-white p-4 flex items-center w-max">
        <img src="<?php echo htmlspecialchars($localImagePath, ENT_QUOTES, 'UTF-8'); ?>" alt="Foto do usuário" class="w-16 h-16 rounded-full ring-2 ring-purple-400/50">
        <div class="ml-4">
            <span class="text-2xl font-bold"><?php echo htmlspecialchars($horaPadrao, ENT_QUOTES, 'UTF-8'); ?>, <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></span>
            <br>
            <div class="flex items-center gap-2"">
                <img class="w-4 h-4" src="../../../../public/icons/calendar.svg" alt="">
                <span class="text-md font-medium text-gray-400"><?php echo htmlspecialchars(ucfirst($diaSemana), ENT_QUOTES, 'UTF-8'); ?>, <?php echo htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
        </div>
    </div>
<?php
}

// Se for uma requisição AJAX, processar os dados
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['horaPadrao'], $_POST['diaSemana'], $_POST['data'])) {
    $horaPadrao = $_POST['horaPadrao'];
    $diaSemana = $_POST['diaSemana'];
    $data = $_POST['data'];
    $userImagePath = $_POST['userImagePath'] ?? '/VHS/public/images/Avatar.svg';
    $username = $_POST['username'] ?? 'Freitasdev';

    // Renderizar o componente com os dados recebidos
    renderPostComponent($userImagePath, $username, $horaPadrao, $diaSemana, $data);
    exit;
}
?>