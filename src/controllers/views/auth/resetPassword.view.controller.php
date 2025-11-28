<?php

namespace Src\Application\Controllers;


use Src\Application\Core\Controller;

class ResetPasswordViewController extends Controller {
    public function index() {
        $this->view("auth/reset-password/index");   
    }
}