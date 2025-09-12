<?php

namespace Src\Controllers;

require_once __DIR__ . "/../../../application/core/controller.php";

use Src\Application\Core\Controller;

class SignInViewController extends Controller {
    public function index() {
        $this->view("auth/login/index");   
    }
}