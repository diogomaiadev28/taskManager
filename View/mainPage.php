<?php
session_start();

use Controller\TaskController;

require_once __DIR__ . '/../Config/configuration.php';
require_once __DIR__ . '/../Controller/TaskController.php';

$userId = $_SESSION['id'];

$task_controller = new TaskController();

$arrayTasks = $task_controller->getTasks($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($taskName)){
        $taskName = $_POST['taskName'];
        $description = $_POST['description'];
        $date = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
        $result = $task_controller->createTask($userId, $taskName, $description, $date);
        header('Location: formSent.php');
    } else {

    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Main Page | Task Manager</title>
        <link rel="stylesheet" href="../templates/assets/css/mainPage.css">
        <link rel="shortcut icon" href="../templates/assets/img/icon.ico" type="image/x-icon">
    </head>
    <body>
        <div class="shadow">
            <form method="POST">
                <h1>Create task</h1>
                <div class="taskName">
                    <input type="text" name="taskName" id="taskName" max="35" placeholder="Task Name">
                    <p>Max 35 characters.</p>
                </div>
                <div class="description">
                    <textarea name="description" id="description" max="60" placeholder="Description"></textarea>
                    <p>Max 60 characters.</p>
                </div>
                <div class="deadline">
                    <p>Deadline<p>
                    <div class="date">
                        <input type="number" name="month" id="month" placeholder="MM">
                        <input type="number" name="day" id="day" placeholder="DD">
                        <input type="number" name="year" id="year" placeholder="AAAA">
                    </div>
                    <p>Can't be blank</p>
                </div>
                <button type="submit">Create</button>
            </form>
        </div>
        <header>
            <nav>
                <figure class="logo">
                    <img src="../templates/assets/img/logoTM.png" alt="Stylized purple and blue wave logo next to bold white text TASK MANAGER on a black background, conveying a modern and energetic tone" class="logo">
                </figure>
                <div class="rightNav">
                    <button>+</button>
                    <div class="profile">
                        <div class="names">
                            <h2><?php echo htmlspecialchars($_SESSION['user_fullname'])?></h2>
                            <h4><?php echo htmlspecialchars($_SESSION['email'])?></h4>
                        </div>
                        <figure class="pImg">
                            <img src="../templates/assets/img/profile.png" alt="Profile icon featuring a simple white outline of a person on a black circular background, conveying a neutral and professional tone, no additional text present" class="pImg">
                        </figure>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container">
                <div class="today">
                    <h2>Deadline today 🔥</h2>
                    <div class="cont">
                        <?php
                            foreach ($arrayTasks as $task){
                                if($task['deadline'] === date('Y-m-d')){
                                    $formattedDate = substr($task['deadline'], 5,2) . '/' . substr($task['deadline'],8,2) . '/' . substr($task['deadline'],0,4);
                                    echo '
                                    <div class="card" id="' . $task['id'] . '">
                                        <div class="cardData">
                                            <div class="title">
                                                <h3>'. $task['task_name'] .'</h3>
                                                <figure class="pencil"><img class="pencil" src="../templates/assets/img/pencil.png" alt="Pencil icon featuring a simple white outline of a pencil on a black circular background, conveying an editable or update action, no additional text present"></figure>
                                            </div>
                                            <h5>'. $task['description'] .'</h5>
                                            <div class="button">
                                                <h4>'. $formattedDate .'</h4>
                                                <button class="cardButton">Do</button>
                                                
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="tomorrow">
                    <h2>Tomorrow or beyond 🚀</h2>
                    <div class="cont">
                            <?php
                            foreach ($arrayTasks as $task){
                                if($task['deadline'] > date('Y-m-d')){
                                    $formattedDate = substr($task['deadline'], 5,2) . '/' . substr($task['deadline'],8,2) . '/' . substr($task['deadline'],0,4);
                                    echo '
                                    <div class="card">
                                        <div class="cardData">
                                            <div class="title">
                                                <h3>'. $task['task_name'] .'</h3>
                                                <figure class="pencil"><img class="pencil" src="../templates/assets/img/pencil.png" alt="Pencil icon featuring a simple white outline of a pencil on a black circular background, conveying an editable or update action, no additional text present"></figure>
                                            </div>
                                            <h5>'. $task['description'] .'</h5>
                                            <div class="button">
                                                <h4>'. $formattedDate .'</h4>
                                                <button class="cardButton">Do</button>
                                                
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="done">
                    <h2>Done ✅</h2>
                    <div class="cont">
                        
                    </div>
                </div>
                <div class="late">
                    <h2>Late ❌</h2>
                    <div class="cont">
                        <?php
                            foreach ($arrayTasks as $task){
                                if($task['deadline'] < date('Y-m-d')){
                                    $formattedDate = substr($task['deadline'], 5,2) . '/' . substr($task['deadline'],8,2) . '/' . substr($task['deadline'],0,4);
                                    echo '
                                    <div class="card">
                                        <div class="cardData">
                                            <div class="title">
                                                <h3>'. $task['task_name'] .'</h3>
                                                <figure class="pencil"><img class="pencil" src="../templates/assets/img/pencil.png" alt="Pencil icon featuring a simple white outline of a pencil on a black circular background, conveying an editable or update action, no additional text present"></figure>
                                            </div>
                                            <h5>'. $task['description'] .'</h5>
                                            <div class="button">
                                                <h4>'. $formattedDate .'</h4>
                                                <button class="cardButton">Do</button>
                                                
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </main>
        <script src="../templates/assets/js/mainPage.js"></script>
    </body>
</html>






<!-- <div class="card">
    <div class="cardData">
        <div class="title">
            <h3>Finish the school's slide at hello</h3>
            <figure class="pencil"><img class="pencil" src="../templates/assets/img/pencil.png" alt="Pencil icon featuring a simple white outline of a pencil on a black circular background, conveying an editable or update action, no additional text present"></figure>
        </div>
        <h5>Slide about kids health at schools and something just to fullfill the</h5>
        <div class="button">
            <h4>08/13/2025</h4>
            <button class="cardButton">Do</button>
        </div>
    </div>
</div> -->