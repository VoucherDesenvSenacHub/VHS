<?php

namespace Src\Application\Utils;
 
function verifyRecaptcha(string $token) {
    $secret = getenv("RECAPTCHA_SECRET");
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$token";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    curl_close($ch);

    return $response["success"];
}