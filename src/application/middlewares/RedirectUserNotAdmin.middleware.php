<?php

namespace Src\Application\Middlewares;

require_once __DIR__ . '/../../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

require_once __DIR__ . "/../../application/utils/redirect.php";

use function Src\Application\Utils\Redirect\redirect;

class RedirectUserNotAdminMiddleware {
    public function execute() {
        if($_SESSION["user"]["role"] != "ADMIN") {
            return redirect($_SERVER['HTTP_REFERER'] ?? "/VHS/home", ["errors" => "Você não tem permissão para executar essa ação."]);
        }
    }
}