<?php
session_start();
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = trim($_POST['task']);
    if ($task !== '') {
        $_SESSION['tasks'][] = ['name' => $task, 'status' => 'Pending','timestamp'=>time()];
    }
    header("Location: index.php");
    exit();
}

if (isset($_GET['toggle']) && is_numeric($_GET['toggle'])) {
    $index = $_GET['toggle'];
    if (isset($_SESSION['tasks'][$index])) {
        $_SESSION['tasks'][$index]['status'] =
            ($_SESSION['tasks'][$index]['status'] === 'Pending') ? 'Completed' : 'Pending';
    }
    header("Location: index.php");
    exit();
}

if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $index = $_GET['delete'];
    if (isset($_SESSION['tasks'][$index])) {
        array_splice($_SESSION['tasks'], $index, 1);
    }
    header("Location: index.php");
    exit();
}
?>
