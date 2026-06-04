<?php

use Controller\UserController;

require_once __DIR__ . '/../Config/configuration.php';
require_once __DIR__ . '/../Controller/UserController.php';

$user_controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userFullName = $_POST['firstName'] . ' ' . $_POST['lastName'];
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];
    $result = $user_controller->createUser($userFullName, $userEmail, $userPassword);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager | Register</title>

    <link rel="icon" href="../templates/assets/img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../templates/assets/css/register.css">
</head>

<body>

    <main class="container">

        <section class="leftSide">

            <figure class="logoContainer">
                <img
                    src="../templates/assets/img/logo.png"
                    alt="Task Manager Logo"
                    class="logo"
                >
            </figure>

            <div class="leftContent">
                <h2>Task Manager</h2>

                <p class="description">
                    Organize your projects, manage deadlines and keep your productivity under control.
                </p>

                <div class="features">
                    <div class="feature">
                        <span>✓</span>
                        <h4>Create and manage tasks</h4>
                    </div>

                    <div class="feature">
                        <span>✓</span>
                        <h4>Track deadlines easily</h4>
                    </div>

                    <div class="feature">
                        <span>✓</span>
                        <h4>Stay productive every day</h4>
                    </div>
                </div>
            </div>

        </section>

        <section class="rightSide">

            <div class="loginCard">

                <h1>Welcome!</h1>

                <h3>
                    Register to start managing your tasks.
                </h3>

                <form method="POST">

                    <div class="names">
                        <div class="field">

                            <input
                                type="text"
                                name="firstName"
                                id="firstName"
                                placeholder="Name"
                            >

                            <p>Can't be blank</p>

                        </div>
                        <div class="field">

                            <input
                                type="Text"
                                name="lastName"
                                id="lastName"
                                placeholder="Surname"
                            >

                            <p>Can't be blank</p>

                        </div>
                    </div>

                    <div class="field">

                        <input
                            type="email"
                            name="email"
                            id="email"
                            placeholder="Email"
                        >

                        <p>Can't be blank</p>

                    </div>

                    <div class="field">

                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Password"
                        >

                        <p>Can't be blank</p>

                    </div>

                    <button
                        class="submitBtn"
                        type="submit"
                    >
                        Sign Up
                    </button>

                </form>

                <h5>
                    Already have an account?
                    <a href="../index.php">
                        Login
                    </a>
                </h5>

            </div>

        </section>

    </main>

    <script src="../templates/assets/js/index.js"></script>

</body>
</html>