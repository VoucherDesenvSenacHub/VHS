<?php

namespace Src\Application\Controllers;

require_once __DIR__ . '/../infra/models/event.php';
require_once __DIR__ . '/../application/core/controller.php';

use Src\Infra\Model\EventModel;
use Src\Application\Core\Controller;

class ViewEventsController extends Controller {
    private EventModel $eventModel;

    public function index() {
        try {
            $this->eventModel = $this->model("event");
            $events = $this->eventModel->getAllEvents();
            $this->view('/home/events/index', $events);
            return;

        } catch (\Throwable $exception) {
            print_r($exception->getMessage());
        }
    }
}