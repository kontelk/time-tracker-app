<?php
require_once "../model/model.php";
require "common.php";

$project_title = $category = '';

if (isset($_GET['id'])) {
    list($id, $project_title, $category) = get_project($_GET['id']);
}
if (isset($_POST['submit'])) {
    $id = null;
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);

    if (empty($title) || empty($category)) {
        $error_message = "Title or category empty";
    } else {
        if (titleExists("projects", $title)) {
            $error_message = "I'm sorry, but looks like \"" . escape($title) . "\" already exists";
        } else {
            if (add_project($title, $category, $id)) {
                header('Refresh:4; url=project_list.php');
                if (!empty($id)) {
                    $confirm_message = escape($title) . ' updated successfully';
                } else {
                    $confirm_message = escape($title) . ' added successfully';
                }
            } else {
                $error_message = "There's somthing wrong'";
            }
        }
    }
}

require "../view/project.php";
