<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Respect\Validation\Validator as v;

use function Src\Application\Utils\Redirect\redirect;

require_once __DIR__ . '/../application/core/controller.php';


class CreatePasswordController extends Controller {
    public function index() {
        $schema = 
        v::key(
            'name',
            v::stringType()->length(3, 150)->setTemplate("Nome inválido!")
        )->key(
            'username',
            v::stringType()->length(3, 60)->setTemplate("Nome de usuário inválido!")
        )->key(
            'email',
            v::email()->setTemplate("Email inválido!"),
        )->key(
            'date_birthday',
            v::stringType()->date()->setTemplate("Data de nascimento inválida!"),
        );

        if(!$schema->validate($_SESSION["redirect_data"]["fields"]) || !empty($_SESSION["redirect_data"]["errors"])) {
            return redirect("/VHS/auth/signup");
        }

        $this->view("/auth/register/password/index");
    }
}   