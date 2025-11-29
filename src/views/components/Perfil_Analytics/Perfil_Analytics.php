<?php
namespace Src\Views\Components\Perfil_Analytics;
require_once __DIR__ . '/../../../application/utils/getCurrentDataTime.php';
use function Src\Application\Utils\getCurrentDataTime;

function renderPostComponent($userImagePath, $username) {
    [$weekday, $timeDefault, $data] = getCurrentDataTime();
?>
    <div class="text-white p-4 flex items-center">
        <img src='/VHS/public/uploads/avatars/{$userImagePath}' onerror='this.src="/VHS/public/uploads/avatars/default.png"' alt="Foto do usuário" class="w-16 h-16 rounded-full">
        <div class="ml-4">
            <span class="text-2xl font-bold"><?php echo htmlspecialchars($timeDefault, ENT_QUOTES, 'UTF-8'); ?>, <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></span>
            <br>
            <div class="flex items-center gap-2">
                <img class="w-4 h-4" src="/VHS/public/icons/calendar.svg" alt="">
                <span class="text-md font-medium text-gray-400"><?php echo  htmlspecialchars(ucfirst($weekday), ENT_QUOTES, 'UTF-8'); ?>, <?php echo htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
        </div>
    </div>
<?php
}