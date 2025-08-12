<?php

namespace Controller;

require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/Connection.php';

use Model\User;
use Exception;

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function createUser($userFullName, $email, $password):mixed {
        return $this->userModel->registerUser($userFullName, $email, $password);
    }
    public function loginUser($email, $password) {
        return $this->userModel->loginUser($email, $password);
    }
}
?>