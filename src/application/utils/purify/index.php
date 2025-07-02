<?php

namespace Src\Application\Utils\Purify;

function purifyProperty($property) {
    return htmlspecialchars(strip_tags($property), ENT_QUOTES, 'UTF-8');
}