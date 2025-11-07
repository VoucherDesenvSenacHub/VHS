<?php

namespace Src\Application\Utils\Purify;

use DateTime;

function purifyProperty($property) {
    if (is_int($property) || is_float($property)) {
        return $property;
    }

    return htmlspecialchars(string: $property ?? "");
}

function purifyNumbers($num) {
    $num = (int) $num;

    if ($num >= 1000000000) {
        return round($num / 1000000000, 1) . 'B';
    } elseif ($num >= 1000000) {
        return round($num / 1000000, 1) . 'M';
    } elseif ($num >= 1000) {
        return round($num / 1000, 1) . 'K';
    }

    return (string) $num;
}

function purifyDuration($seconds) {
    if (!is_numeric($seconds)) {
        return '00:00';
    }

    $total = max(0, (int) round($seconds));
    $h = intdiv($total, 3600);
    $m = intdiv($total % 3600, 60);
    $s = $total % 60;

    if ($h > 0) {
        return sprintf('%d:%02d:%02d', $h, $m, $s);
    }

    return sprintf('%02d:%02d', $m, $s);
}

function purifyCreatedAt(string $date) {
    try {
        date_default_timezone_set('America/Campo_Grande');
        $dt = new DateTime($date);

        $now = new DateTime();
        $diff = $now->diff($dt);

        if ($diff->y > 0) {
            return "há {$diff->y} ano" . ($diff->y > 1 ? 's' : '');
        }

        if ($diff->m > 0) {
            return "há {$diff->m} mês" . ($diff->m > 1 ? 'es' : '');
        }

        if ($diff->d > 0) {
            return "há {$diff->d} dia" . ($diff->d > 1 ? 's' : '');
        }

        if ($diff->h > 0) {
            return "há {$diff->h} hora" . ($diff->h > 1 ? 's' : '');
        }

        if ($diff->i > 0) {
            return "há {$diff->i} minuto" . ($diff->i > 1 ? 's' : '');
        }
        
        return "Agora";
    } catch (\Exception $e) {
        return purifyProperty($date);
    }
}

function purifyDateTime(string $date) {
    try {
        $dt = new DateTime($date);
        return $dt->format('d/m \à\s H:i');
    } catch (\Exception $e) {
        return purifyProperty($date);
    }
}