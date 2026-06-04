<?php
session_start();

use Controller\TaskController;

require_once __DIR__ . '/../Config/configuration.php';
require_once __DIR__ . '/../Controller/TaskController.php';

$userId = $_SESSION['id'];

if (empty($userId)) {
    header('Location: ../index.php');
    exit();
}

$task_controller = new TaskController();
$arrayTasks = $task_controller->getTasksFromUser($userId);

// Post actions

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['taskName']) &&
        isset($_POST['description']) &&
        isset($_POST['year']) &&
        isset($_POST['month']) &&
        isset($_POST['day']) &&
        isset($_POST['type'])
    ) {
        $taskName = $_POST['taskName'];
        $description = $_POST['description'];
        $date = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];

        if ($_POST['type'] === 'create') {
            $task_controller->createTask($userId, $taskName, $description, $date);
        } else {
            $taskId = $_POST['type'];
            $task_controller->editTask($taskId, $taskName, $description, $date);
        }

        header('Location: formSent.php');
        exit;
    }

    if (isset($_POST['done'])) {
        $task_controller->markTaskDone($_POST['done']);
        header('Location: formSent.php');
        exit;
    }

    if (isset($_POST['undo'])) {
        $task_controller->markTaskNotDone($_POST['undo']);
        header('Location: formSent.php');
        exit;
    }

    if (isset($_POST['deleteAllDones'])) {
        $task_controller->deleteAllDones();
        header('Location: formSent.php');
        exit;
    }
}

// Helpers

function formatDate($date) {
    return date('m/d/Y', strtotime($date));
}

function renderTaskCard($task, $formattedDate, $buttonHtml) {
?>
    <div class="card" id="<?= $task['task_id'] ?>">
        <div class="cardData">

            <div class="title">
                <h3><?= htmlspecialchars($task['task_name']) ?></h3>

                <figure class="pencil">
                    <img class="pencil"
                         id="<?= $task['task_id'] ?>"
                         src="../templates/assets/img/pencil.png"
                         alt="edit">
                </figure>
            </div>

            <h5><?= htmlspecialchars($task['description']) ?></h5>

            <div class="button">
                <h4><?= $formattedDate ?></h4>
                <?= $buttonHtml ?>
            </div>

        </div>
    </div>
<?php
}

// Grouping logic

$today = date('Y-m-d');

$groups = [
    'today' => [],
    'future' => [],
    'done' => [],
    'late' => []
];

foreach ($arrayTasks as $task) {

    if ($task['done'] == 1) {
        $groups['done'][] = $task;
    }
    elseif ($task['deadline'] === $today) {
        $groups['today'][] = $task;
    }
    elseif ($task['deadline'] > $today) {
        $groups['future'][] = $task;
    }
    else {
        $groups['late'][] = $task;
    }
}

$totalTasks = count($arrayTasks);
$totalToday = count($groups['today']);
$totalDone = count($groups['done']);
$totalLate = count($groups['late']);
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
            <form class="mainForm" method="POST">
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
                <input type="hidden" name="type" id="type">
                <button type="submit">Create</button>
            </form>
        </div>
        <header>
            <nav>
                <figure class="logo">
                    <img src="../templates/assets/img/logoTM.png" alt="Stylized purple and blue wave logo next to bold white text TASK MANAGER on a black background, conveying a modern and energetic tone" class="logo">
                </figure>
                <div class="rightNav">
                    <button class="floatingButton">+</button>
                    <div class="profile">
                        <div class="names">
                            <h2><?= htmlspecialchars($_SESSION['user_fullname'])?></h2>
                            <h4><?= htmlspecialchars($_SESSION['email'])?></h4>
                        </div>
                        <a href="profile.php">
                            <figure class="pImg">
                                <img src="../templates/assets/img/profile.png" alt="Profile icon featuring a simple white outline of a person on a black circular background, conveying a neutral and professional tone, no additional text present" class="pImg">
                            </figure>
                        </a>
                    </div>
                </div>
            </nav>
        </header>
        <section class="stats">

            <div class="statCard">
                <h3><?= $totalTasks ?></h3>
                <p>Total Tasks</p>
            </div>

            <div class="statCard">
                <h3><?= $totalToday ?></h3>
                <p>Today</p>
            </div>

            <div class="statCard">
                <h3><?= $totalDone ?></h3>
                <p>Done</p>
            </div>

            <div class="statCard">
                <h3><?= $totalLate ?></h3>
                <p>Late</p>
            </div>

        </section>
        <main>
        <div class="container">

            <div class="today">
                <h2>Deadline today 🔥</h2>
                <div class="cont">

                    <?php foreach ($groups['today'] as $task): ?>

                        <?php
                            $date = formatDate($task['deadline']);

                            ob_start();
                        ?>
                            <form method="POST">
                                <button class="cardButton" name="done" value="<?= $task['task_id'] ?>">Do</button>
                            </form>
                        <?php
                            $button = ob_get_clean();
                            renderTaskCard($task, $date, $button);
                        ?>

                    <?php endforeach; ?>

                </div>
            </div>

            <div class="tomorrow">
                <h2>Tomorrow or beyond 🚀</h2>
                <div class="cont">

                    <?php foreach ($groups['future'] as $task): ?>

                        <?php
                            $date = formatDate($task['deadline']);

                            ob_start();
                        ?>
                            <form method="POST">
                                <button class="cardButton" name="done" value="<?= $task['task_id'] ?>">Do</button>
                            </form>
                        <?php
                            $button = ob_get_clean();
                            renderTaskCard($task, $date, $button);
                        ?>

                    <?php endforeach; ?>

                </div>
            </div>

            <div class="done">
                <h2>Done ✅</h2>

                
                <div class="cont">
                    <?php if(!empty($groups['done'])):?>   
                        <form method="POST">
                            <button class="deleteButton" name="deleteAllDones">Delete all dones</button>
                        </form>
                    <?php endif;?>
                    <?php foreach ($groups['done'] as $task): ?>

                        <?php
                            $date = formatDate($task['deadline']);

                            ob_start();
                        ?>
                            <form method="POST">
                                <button class="cardButton1" name="undo" value="<?= $task['task_id'] ?>">Undo</button>
                            </form>
                        <?php
                            $button = ob_get_clean();
                            renderTaskCard($task, $date, $button);
                        ?>

                    <?php endforeach; ?>

                </div>
            </div>

            <div class="late">
                <h2>Late ❌</h2>
                <div class="cont">

                    <?php foreach ($groups['late'] as $task): ?>

                        <?php
                            $date = formatDate($task['deadline']);

                            ob_start();
                        ?>
                            <form method="POST">
                                <button class="cardButton2" name="done" value="<?= $task['task_id'] ?>">Do</button>
                            </form>
                        <?php
                            $button = ob_get_clean();
                            renderTaskCard($task, $date, $button);
                        ?>

                    <?php endforeach; ?>

                </div>
            </div>

        </div>
        </main>
        <script src="../templates/assets/js/mainPage.js"></script>
    </body>
</html>