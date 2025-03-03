<?php

$request = $_SERVER['REQUEST_URI'];
require_once "./utils/common.php";

switch ($request) {

    case '':
    case '/':
        require __DIR__ . '/views/index.php';
        break;

    case '/projects/list':
        require __DIR__ . '/controllers/project_list.php';
        break;

    case '/tasks/list':
        require __DIR__ . '/controllers/task_list.php';
        break;

    case '/projects/add':
        require __DIR__ . '/controllers/project.php';
        break;

    case '/tasks/add':
        require __DIR__ . '/controllers/task.php';
        break;

    case '/reports':
        require __DIR__ . '/controllers/reports.php';
        break;

    case (preg_match('/\/projects\/add\?id=\d/', $request) ? true : false):
        require __DIR__ . '/controllers/project.php';
        break;

    case (preg_match('/\/tasks\/add\?id=\d/', $request) ? true : false):
        require __DIR__ . '/controllers/task.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}
