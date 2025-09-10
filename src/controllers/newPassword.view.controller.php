<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;

require_once __DIR__ . '/../application/core/controller.php';

class NewPasswordViewController extends Controller {

    public function index() {
        $this->view('auth/new-password/index');
    }
}