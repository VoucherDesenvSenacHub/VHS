<?php

namespace Src\Application\Controllers;

require_once __DIR__ . "/../../../application/core/controller.php";

use Src\Application\Core\Controller;

class AdminAnalyticsViewController extends Controller {
    public function index() {
        $this->view("admin/analytics/index");   
    }
}