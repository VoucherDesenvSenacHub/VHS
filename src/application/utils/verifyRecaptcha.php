<?php

namespace Src\Application\Utils;

function verifyRecaptcha(string $token) {
    try {
        $secret = $_ENV["RECAPTCHA_SECRET"];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$token";
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $response = json_decode($response);
    
        return $response->success;
    } catch (\Throwable $th) {
        return false;
    }
}