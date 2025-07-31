<?php

namespace Src\Application\Core;

require_once __DIR__ . "/database.php";
use Src\Application\Core\Database;

abstract class Model {
    protected Database $database;

    public function __construct() {
        $this->database = new Database();
    }
}