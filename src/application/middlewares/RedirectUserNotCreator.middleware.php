<?php

namespace Src\Application\Middlewares;

require_once __DIR__ . '/../../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../../..");
$dotenv->load();

require_once __DIR__ . "/../../application/helpers/redirect.php";

use function Src\Application\Utils\Redirect\redirect;

class RedirectUserNotCreatorMiddleware {
    public function execute() {
        if(empty($_SESSION["user"])) {
            http_response_code(401);
            return redirect("/VHS/home");
        }

        if($_SESSION["user"]["role"] === "USER") {
            http_response_code(403);
            return redirect("/VHS/home");
        }
    }
}