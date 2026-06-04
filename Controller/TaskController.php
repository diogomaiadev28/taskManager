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

    public function createTask(
        $userId,
        $taskName,
        $description,
        $date
    ): bool{
        return $this->taskModel->createTask(
            $userId,
            $taskName,
            $description,
            $date
        );
    }

    public function editTask(
        int $taskId,
        string $taskName,
        string $description,
        string $date
    ): bool{
        return $this->taskModel->editTask(
            $taskId,
            $taskName,
            $description,
            $date
        );
    }

    public function getTasksFromUser(
        int $userId
    ): array{
        return $this->taskModel->getTasksFromUser(
            $userId
        );
    }

    public function markTaskDone(
        int $taskId
    ): bool{
        return $this->taskModel->markTaskDone(
            $taskId
        );
    }

    public function markTaskNotDone(
        int $taskId
    ): bool{
        return $this->taskModel->markTaskNotDone(
            $taskId
        );
    }

    public function deleteAllDones(): bool{
        return $this->taskModel->deleteAllDones();
    }
}
?>