<?php

namespace Src\Application\Utils;

function formatViews(int $views): string {
    if ($views >= 1000000) {
        return round($views / 1000000, 1) . 'M';
    } 
    
    if ($views >= 1000) {
        return round($views / 1000, 1) . 'K';
    }
    
    return (string)$views;
}