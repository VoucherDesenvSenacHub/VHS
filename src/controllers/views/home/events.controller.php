<?php

namespace Src\Application\Controllers;

require_once __DIR__ . '/../../../infra/models/event.php';
require_once __DIR__ . '/../../../application/core/controller.php';

use Src\Application\Core\Controller;
use Src\Infra\Model\EventModel;

class EventsController extends Controller {

    private EventModel $eventModel;

    public function index() {
        $this->eventModel = $this->model("event");
        $events = $this->eventModel->read();

        $this->view('/home/events/index', [
            "events" => $events
        ]);
    }
    
}