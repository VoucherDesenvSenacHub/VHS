<?php

require __DIR__ . "/vendor/autoload.php";
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();

if (isset($_GET["logout"])) {
    setcookie("token", "", time() - 3600, "/");
    unset($_COOKIE["token"]);
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 3600,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    
    session_destroy();
    header("Location: /VHS/home");
    exit;
}


foreach($_GET as $key => $value) {
    $_GET[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

foreach($_POST as $key => $value) {
    $_POST[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}