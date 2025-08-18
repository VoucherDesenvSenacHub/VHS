<?php
session_start();

print_r($_GET["logout"]);

if(isset($_GET["logout"]) && $_GET["logout"] == 1) {
    setcookie("token", "", -1, "/");
    unset($_COOKIE["token"]);
}
?>