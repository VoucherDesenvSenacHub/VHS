<?php
namespace Src\Application\Utils;

/**
 * retorna o dia da semana, saudação conforme horário e data formatada em português do Brasil.
 * @return array $weekday, $timeDefault, string $data
 */
function getCurrentDataTime() {
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

    return [$weekday, $timeDefault, $data];
}
