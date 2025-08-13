<?php

namespace Controller;

require_once __DIR__ . '/../Model/Task.php';
require_once __DIR__ .'/../Model/Connection.php';

use Model\Task;
use Exception;

class TaskController {
    private $taskModel;

    public function __construct() {
        $this->taskModel = new Task();
    }

    public function createTask($userId, $taskName, $description, $date): mixed{
        return $this->taskModel->createTask($userId, $taskName, $description, $date);
    }

    public function getTasks($userId){
        return $this->taskModel->getTasks($userId);
    }

    public function updateDoneState($taskId, $done) {
        return $this->taskModel->updateDoneState($taskId, $done);
    }

    public function updateTask($taskId, $taskName, $description, $date) {
        return $this->taskModel->updateTask($taskId, $taskName, $description, $date);
    }
}
?>