<?php

namespace Model;

use Model\Connection;
use PDO;
use PDOException;
use Exception;

class Task{
    private $db;

    public function __construct(){
        $this->db = Connection::getInstance();
    }

    public function createTask(
        int $userId,
        string $taskName,
        string $description,
        string $date
    ): bool{
        try {

            $sql = ' INSERT INTO task
            (
                user_id_fk,
                task_name,
                description,
                deadline
            ) VALUES (
                :user_id,
                :task_name,
                :description,
                :deadline
            )';

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ':user_id' => $userId,
                ':task_name' => $taskName,
                ':description' => $description,
                ':deadline' => $date
            ]);

        } catch (PDOException $e) {
            throw new Exception(
                "Error creating task for user ID {$userId}",
                0,
                $e
            );
        }
    }

    public function editTask(
        int $taskId,
        string $taskName,
        string $description,
        string $date
    ): bool{
        try{

            $sql = 'UPDATE task SET
            task_name = :task_name,
            description = :description,
            deadline = :deadline
            WHERE
            task_id = :task_id';

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ':task_name' => $taskName,
                ':description' => $description,
                ':deadline' => $date,
                ':task_id' => $taskId
            ]);

        } catch (PDOException $e) {
            throw new Exception(
                "Error editing task {$taskName}",
                0,
                $e
            );
        }
    }

    public function getTasksFromUser(
        int $userId
    ): array{
        try {
            $sql = 'SELECT * FROM task
            WHERE
            user_id_fk = :user_id';

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':user_id' => $userId
            ]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            throw new Exception(
                'Error while getting tasks from user',
                0,
                $e
            );
        }
    }

    public function markTaskDone(
        int $taskId
    ): bool{
        try {
            $sql = 'UPDATE task SET
            done = 1
            WHERE
            task_id = :task_id';

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ':task_id' => $taskId
            ]);

        } catch (PDOException $e) {
            throw new Exception(
                'Error while marking task as done',
                0,
                $e
            );
        }
    }

    public function markTaskNotDone(
        int $taskId
    ): bool{
        try {
            $sql = 'UPDATE task SET
            done = 0
            WHERE
            task_id = :task_id';

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ':task_id' => $taskId
            ]);

        } catch (PDOException $e) {
            throw new Exception(
                'Error while marking task as undone',
                0,
                $e
            );
        }
    }

    public function deleteAllDones(): bool{
        try {
            $sql = 'DELETE FROM task
            WHERE
            done = 1';

            return $this->db->query($sql);
        } catch (PDOException $e) {
            throw new Exception(
                'Error while deleting all done tasks',
                0,
                $e
            );
        }
    }
}

?>