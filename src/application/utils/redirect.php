<?php

namespace Src\Application\Utils\Redirect;

/**
 * Summary of redirect
 * @param string $route Caminho da rota de redirecionamento
 * @param array|null $data Salvando na sessão [redirect_data], quando salva mais de uma vez a anterior é substituida
 * @return void
 */
function redirect (
    string $route,
    array | null $data = null,
    int $status_code = 302
) {
    
    if (session_status() == 0) session_start();
    if ($data) $_SESSION["redirect_data"] = $data;

    header("Location: $route", true, $status_code);
}