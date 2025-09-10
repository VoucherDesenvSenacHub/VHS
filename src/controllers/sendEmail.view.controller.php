<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;

require_once __DIR__ . '/../application/core/controller.php';

class SendEmailViewController extends Controller {

    public function index() {
        $this->view('auth/send-email/index');
    }
}