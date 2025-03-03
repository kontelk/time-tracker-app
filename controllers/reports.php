<?php
require_once "./model/model.php";

$filter = "all";

// convert input into an array
if (!empty($_GET['filter'])) {
    $filter = explode(":", $_GET['filter']);
}

$tasks = get_all_tasks($filter);
$projects = get_all_projects();

require "./views/reports.php";
