<?php
require_once "../model/model.php";

$projects = get_all_projects();
$projectCount =  get_all_projects_count();

if (isset($_POST['delete'])) {
    if (delete_project($_POST['delete'])) {
        header('location: project_list.php?msg=Task+deleted');
        exit;
    } else {
        header('location: project_list.php?msg=Couldn\'t+delete+the+task');
        exit;
    }
}

if (isset($_GET['msg'])) {
    $error_message = $_GET['msg'];
}

require "../view/project_list.php";
