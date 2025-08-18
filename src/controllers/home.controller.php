<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;

require_once __DIR__ . '/../application/core/controller.php';

class HomeController extends Controller {

    public function index() {
        $this->view('home/index', ["id" => $_GET['id']]);
    }
}