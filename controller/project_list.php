<?php
require_once "../model/model.php";

$projects = get_all_projects();
$projectCount =  get_all_projects_count();

require "../view/project_list.php";
