<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;

require_once __DIR__ . '/../application/core/controller.php';

class CreatePasswordController extends Controller {
    public function index() {
        $this->view("/auth/register/password/index");
    }
}   