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
        require_once __DIR__ . "/../../../src/infra/models/{$model}.php";
        $class = "Src\\Infra\\Model\\{$model}Model";
        return new $class();
    }
    
    /**
     * Método responsável por chamar view
     * 
     * @param string $viewName Nome da view, ex: (views/pages/$viewName.php)
     * @param array|null $data Dados que serão utilizados na view
     * @param string $layout Layout que a página vai usar como base, disponíveis: index, studio, admin
     * @return void
     */
    public function view(string $viewName, array | null $data = null, string $layout = "index") {
        $file = __DIR__ . "/../../../src/views/pages/{$viewName}.php";
        $layout =  __DIR__ . "/../../layouts/$layout.layout.php";
        $_SESSION["page_data"] = $data;

        if (!file_exists($file)) {
            http_response_code(404);
        }
        
        require_once $layout;        
        echo indexLayout($file);
    }

}