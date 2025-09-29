<?php
namespace Src\Views\Components\Perfil_Analytics;

header('Content-Type: text/html; charset=UTF-8');

function renderPostComponent($userImagePath, $username) {
    date_default_timezone_set('America/Campo_Grande');
    setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR', 'portuguese');
    
    $weekday = date('l', time());

    switch ($weekday) {
        case 'Sunday':    $weekday = 'Domingo'; break;
        case 'Monday':    $weekday = 'Segunda-feira'; break;
        case 'Tuesday':   $weekday = 'Terça-feira'; break;
        case 'Wednesday': $weekday = 'Quarta-feira'; break;
        case 'Thursday':  $weekday = 'Quinta-feira'; break;
        case 'Friday':    $weekday = 'Sexta-feira'; break;
        case 'Saturday':  $weekday = 'Sábado'; break;
    }
    
    $timeDefault = date('H:i', time());

    if ($timeDefault < 13 && $timeDefault > 5) {
        $timeDefault = 'Bom dia';
    }
    elseif($timeDefault >= 13 && $timeDefault < 18) {
        $timeDefault = 'Boa tarde';
    }
    else {
        $timeDefault = 'Boa noite';
    }

    $data = strftime('%d de %B de %Y', strtotime('now'));
    
?>
    <div class="text-white p-4 flex items-center w-max">
        <img src="<?php echo htmlspecialchars($userImagePath, ENT_QUOTES, 'UTF-8'); ?>" alt="Foto do usuário" class="w-16 h-16 rounded-full">
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