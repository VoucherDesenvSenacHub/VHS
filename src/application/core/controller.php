<?php

namespace Src\Application\Core;

abstract class Controller {
    abstract public function index();
    
    /**
     * Método para pegar o modelo do controller
     * @param string $model Nome do modelo, ex: (src/infra/models/{$model}.php)
     * @return object
     */
    public function model(string $model) {
        require __DIR__ . "/../../../src/infra/models/{$model}.php";
        $class = "Src\\Infra\\Models\\{$model}Model";
        return new $class();
    }
    
    /**
     * Método responsável por chamar view
     * 
     * @param string $viewName Nome da view, ex: (views/pages/$viewName.php)
     * @param array|null $data Dados que serão utilizados na view
     * @return void
     */
    public function view(string $viewName, array | null $data = null) {
        $file = __DIR__ . "/../../../src/views/pages/{$viewName}.php";

        if(session_status() === PHP_SESSION_DISABLED) session_start();

        $_SESSION["page_data"] = $data;

        if (file_exists($file)) {
            require $file;
        }

        http_response_code(404);
    }
}