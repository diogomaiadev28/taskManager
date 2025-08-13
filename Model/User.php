<?php

namespace Model;

use Model\Connection;
use PDO;
use PDOException;
use Exception;

class User{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function registerUser($userFullName, $email, $password){
        try{
            if ($this->getUserByEmail($email)){
                throw new Exception('This e-mail is already registered');
            }else{
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = 'INSERT INTO user (user_fullname, email, password, created_at, done) VALUES (:user_fullname, :email, :password, NOW())';
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':user_fullname', $userFullName, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
                return $stmt->execute();
            }
        } catch (PDOException $e) {
            throw new Exception('Error registering user' . $e->getMessage());
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getUserByEmail($email){
        try{
            $sql = 'SELECT * FROM user WHERE email = :email LIMIT 1';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            throw new Exception("Error getting user info: " . $error->getMessage());
        }
    }
    public function loginUser($email, $password){
        try{
            $user = $this->getUserByEmail($email);
            if ($user && password_verify($password, $user["password"])) {
                unset($user['password']);
                return $user;
            } else {
                return false;
            } 
        } catch (PDOException $error) {
            throw new Exception("Error trying to login: " . $error->getMessage());
        }
    }
}

?>