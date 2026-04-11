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

    public function createTask($userId, $taskName, $description, $date){
        try{
            $sql = 'INSERT INTO task (user_id_fk, task_name, description, deadline, done) VALUES (:user_id, :task_name, :description, :deadline, false)';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':task_name', $taskName, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':deadline', $date, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            return throw new Exception('Error creating task: ' . $e->getMessage());
        }
    }

    public function editTask($taskId, $taskName, $description, $date){
        try{
            $sql = 'UPDATE task SET task_id = :task_id, description = :description, deadline = :deadline WHERE task_id = :task_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':task_id', $taskId, PDO::PARAM_INT);
            $stmt->bindParam(':task_name', $taskName, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':deadline', $date, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            return throw new Exception('Error creating task: ' . $e->getMessage());
        }
    }

    public function getTasks($userId){
        try{
            $sql = 'SELECT * FROM task WHERE user_id_fk = :user_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error while getting tasks: '. $e->getMessage());
        }
    }

    public function markTaskDone($taskId){
        try {
            $sql = 'UPDATE task SET done = 1 WHERE task_id = :task_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':task_id', $taskId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Não foi possível marcar tarefa como feita, erro correspondente: ' . $e);
        }
    }

    public function markTaskNotDone($taskId){
        try {
            $sql = 'UPDATE task SET done = 0 WHERE task_id = :task_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':task_id', $taskId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Não foi possível marcar tarefa como feita, erro correspondente: ' . $e);
        }
    }

    public function deleteAllDones() {
        try {
            $sql = 'DELETE FROM task WHERE done = 1';
            $stmt = $this->db->prepare($sql);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Não foi possível deletar todas as tarefas feitas, erro correspondente: ' . $e);
        }
    }
}

?>