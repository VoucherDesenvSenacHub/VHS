<?php

require __DIR__ . "/vendor/autoload.php";
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();

if (isset($_GET["logout"]) && $_GET["logout"] == 1) {
    setcookie("token", "", -1, "/");
    unset($_COOKIE["token"]);
    unset($_SESSION["user"]);
}