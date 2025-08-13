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
            $sql = 'INSERT INTO task (user_id, task_name, description, deadline, done) VALUES (:user_id, :task_name, :description, :deadline, 0)';
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
    public function getTasks($userId){
        try{
            $sql = 'SELECT * FROM task WHERE user_id = :user_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error while getting tasks: '. $e->getMessage());
        }
    }
    public function updateDoneState($taskId, $done) {
        try{
            if($done == 0){
                $sql = 'UPDATE task SET done = 1 WHERE id = :id';
            } else {
                $sql = 'UPDATE task SET done = 0 WHERE id = :id';
            }
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $taskId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error while updating state: '. $e->getMessage());
        }
    }
    public function updateTask($taskId, $taskName, $description, $date){
        try{
            $sql = 'UPDATE task SET task_name = :task_name, description = :description, deadline = :deadline WHERE id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $taskId, PDO::PARAM_INT);
            $stmt->bindParam(':task_name', $taskName, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':deadline', $date, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Error while editing task: '. $e->getMessage());
        }
    }
}

?>