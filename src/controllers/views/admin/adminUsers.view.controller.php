<?php

namespace Src\Application\Controllers;

use Src\Infra\Model\UserModel;

require_once __DIR__ . "/../../../application/core/controller.php";

use Src\Application\Core\Controller;

class AdminUsersViewController extends Controller {   
    private UserModel $userModel;

    public function index() {
        $this->userModel = $this->model("user");
        $filterName = $_GET["name"] ?? "";
        $ordering = isset($_GET["ordering"]) ? "DESC" : "ASC";


        $page = $_GET["page"] ?? 0;
        $page = $page > 0 ? $page * 7 : $page;
        
        $idUser = $_SESSION["user"]["id"];

        $users = $this->userModel->getUsers($page, 7, $idUser, $filterName, $ordering);
        $users = array_slice($users, 0, 7);

        $this->view("admin/userManagement/index", ["users" => $users]);   
    }
}