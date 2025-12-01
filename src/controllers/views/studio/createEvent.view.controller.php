<?php

namespace Src\Application\Controllers;

require_once __DIR__ . '/../../../application/core/controller.php';
require_once __DIR__ . '/../../../infra/models/event.php';
require_once __DIR__ . '/../../../infra/models/category.php';

use Src\Application\Core\Controller;
use Src\Infra\Model\EventModel;
use Src\Infra\Model\CategoryModel;

class StudioCreateEventsViewController extends Controller {

    public EventModel $eventModel;
    public CategoryModel $categoryModel;
    
    public function __construct() {
        $this->eventModel = new EventModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index() {
        $categories = $this->categoryModel->getAllCategories();

        $this->view("/studio/content/create/event/index", [
            "categories" => $categories
        ]);
    }
    
}