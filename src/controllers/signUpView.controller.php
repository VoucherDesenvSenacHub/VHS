<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;

require_once __DIR__ . '/../application/core/controller.php';

class SignUpViewController extends Controller {
    public function index() {
        $this->view("/auth/register/index");
    }
}