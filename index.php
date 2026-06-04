<?php

use Controller\UserController;

require_once __DIR__ . '/Config/configuration.php';
require_once __DIR__ . '/Controller/UserController.php';

$user_controller = new UserController();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $user_controller->loginUser($email, $password);

    if($user){
        session_start();
        $_SESSION['id'] = $user['user_id'];
        $_SESSION['user_fullname'] = $user['user_fullname'];
        $_SESSION['email'] = $user['email'];
        header("Location: View/mainPage.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager | Login</title>

    <link rel="icon" href="templates/assets/img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="templates/assets/css/index.css">
</head>

<body>

    <main class="container">

        <section class="leftSide">

            <figure class="logoContainer">
                <img
                    src="templates/assets/img/logo.png"
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

                <h1>Welcome Back</h1>

                <h3>
                    Sign in to continue managing your tasks.
                </h3>

                <form method="POST">

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
                        Sign In
                    </button>

                </form>

                <h5>
                    Don't have an account?
                    <a href="View/register.php">
                        Sign Up
                    </a>
                </h5>

            </div>

        </section>

    </main>

    <script src="templates/assets/js/index.js"></script>

</body>
</html>