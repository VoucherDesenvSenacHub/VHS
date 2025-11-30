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
        $sort = $_GET["sort"] ?? 'desc';

        $page = $_GET["page"] ?? 0;
        if (!is_numeric($page) || $page < 0) {
            $page = 0;
        }

        $limit = 8;
        $offset = $page * $limit;

        $idUser = $_SESSION["user"]["id"];

        $users = $this->userModel->getUsers($offset, $limit + 1, $idUser, $filterName, $sort);
        
        $nextPage = 0;

        if (count($users) > $limit) {
            array_pop($users);
            $nextPage = 1;
        }

        $this->view("admin/userManagement/index", [
            "users" => $users,
            "next_page" => $nextPage,
            "search" => $filterName,
            "sort" => $sort
        ]);   
    }
}