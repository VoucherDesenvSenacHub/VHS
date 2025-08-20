<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\UserModel;

require_once __DIR__ . '/../application/core/controller.php';

class HomeController extends Controller {

    public function index() {
        $this->view('home/index');
    }
}