<?php
require_once "./model/model.php";

$tasks = get_all_tasks();
$taskCount = get_all_tasks_count();

if (isset($_POST['delete'])) {
    if (delete_task($_POST['delete'])) {
        header('location: task_list.php?msg=Task+deleted');
        exit;
    } else {
        header('location: task_list.php?msg=Couldn\'t+delete+the+task');
        exit;
    }
}

if (isset($_GET['msg'])) {
    $error_message = $_GET['msg'];
}

require "./views/task_list.php";
