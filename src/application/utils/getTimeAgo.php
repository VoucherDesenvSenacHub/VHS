<?php
namespace Src\Application\Utils;
use DateTime;
use DateTimeZone;

/**
 * retorna quanto tempo se passou desde uma data passada
 * @return string "há X minutos/horas/dias"
 */
function getTimeAgo($created_at) {
     $tz = new DateTimeZone('America/Campo_Grande');
     $created = new DateTime($created_at, $tz);
     $now = new DateTime('now', $tz);
     $diff = $now->getTimestamp() - $created->getTimestamp();

    $time_ago = floor($diff / 86400) . " dias atrás";
    
    if ($diff < 86400) {
        $time_ago = floor($diff / 3600) . " horas atrás";
        }
    if ($diff < 3600) {
        $time_ago = floor($diff / 60) . " minutos atrás";
    }
    if ($diff < 60) {
        $time_ago = $diff . " segundos atrás";
    }

    return "há " . $time_ago;
}
