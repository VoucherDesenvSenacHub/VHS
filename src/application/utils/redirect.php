<?php
namespace Src\Application\Utils\Redirect;
/**
 * Summary of redirect
 * @param string $route Caminho da rota de redirecionamento
 * @param array|null $data Salvando na sessão [redirect_data], quando salva mais de uma vez a anterior é substituida
 * @return void
 */
function redirect(string $route, array | null $data = null) {
    if(session_status() == 0) {
        session_start();
    }

    if($data) {
        echo var_dump($data);
        $_SESSION["redirect_data"] = $data;
    };

    header("Location: $route", true);
}

