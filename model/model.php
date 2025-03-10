<?php
require "connection.php";

$connection = db_connect();

function titleExists($table, $title)
{
    try {
        global $connection;

        $sql =  'SELECT title FROM ' . $table . ' WHERE title = ?';
        $statement = $connection->prepare($sql);
        $statement->execute(array($title));

        if ($statement->rowCount() > 0) {
            return true;
        }
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

// --- PROJECTS ---
/**
 * @param int id
 */
function delete_project($id)
{
    try {
        global $connection;

        $sql =  'DELETE FROM projects WHERE id = ?';
        $task = $connection->prepare($sql);
        $task->bindValue(1, $id, PDO::PARAM_INT);
        $task->execute();

        return true;
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function get_all_projects()
{
    try {
        global $connection;

        $sql =  'SELECT * FROM projects ORDER BY title';
        $projects = $connection->query($sql);

        return $projects;
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function get_project($id)
{
    try {
        global $connection;

        $sql =  'SELECT * FROM projects WHERE id = ?';
        $project = $connection->prepare($sql);
        $project->bindValue(1, $id, PDO::PARAM_INT);
        $project->execute();

        return $project->fetch();
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function get_all_projects_count()
{
    try {
        global $connection;

        $sql =  'SELECT COUNT(id) AS nb FROM projects';
        $statement = $connection->query($sql)->fetch();

        $projectCount = $statement['nb'];

        return $projectCount;
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function add_project($title, $category, $id)
{
    try {
        global $connection;

        if ($id) {
            $sql = 'UPDATE projects SET title = ?, category = ? WHERE id = ?';
        } else {
            $sql =  'INSERT INTO projects(title, category) VALUES(?, ?)';
        }

        $statement = $connection->prepare($sql);
        $new_project = array($title, $category);

        if ($id) {
            $new_project = array($title, $category, $id);
        }

        $affectedLines = $statement->execute($new_project);
        // $statement->debugDumpParams($statement);
        return $affectedLines;
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

// --- TASKS ---
/**
 * @param int id
 */
function delete_task($id)
{
    try {
        global $connection;

        $sql =  'DELETE FROM tasks WHERE id = ?';
        $task = $connection->prepare($sql);
        $task->bindValue(1, $id, PDO::PARAM_INT);
        $task->execute();

        return true;
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function get_task($id)
{
    try {
        global $connection;

        $sql =  'SELECT * FROM tasks WHERE id = ?';
        $task = $connection->prepare($sql);
        $task->bindValue(1, $id, PDO::PARAM_INT);
        $task->execute();

        return $task->fetch();
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function get_all_tasks($filter = null)
{
    try {
        global $connection;

        $sql =  'SELECT t.*, p.title project 
        FROM tasks t
        INNER JOIN projects p 
        ON t.project_id = p.id';

        $where = '';
        $orderBy = ' ORDER BY t.date_task DESC';

        if (is_array($filter)) {
            switch ($filter[0]) {
                case 'project':
                    $where = ' WHERE p.id = ?';
                    break;
                case 'category':
                    $where = ' WHERE p.category = ?';
                    break;
                case 'date':
                    $where = ' WHERE DATE_FORMAT(t.date_task, "%m/%d/%y") >= ?  AND DATE_FORMAT(t.date_task, "%m/%d/%y" ) <= ?';
                    break;
            }
        }


        if ($filter) {
            $orderBy = ' ORDER BY p.title ASC, t.date_task DESC';
        }

        $tasks = $connection->prepare($sql . $where . $orderBy);
        if (is_array($filter)) {
            $tasks->bindValue(1, $filter[1], PDO::PARAM_INT);
            if ($filter[0] == 'category') {
                $tasks->bindValue(1, $filter[1], PDO::PARAM_STR);
            }
            if ($filter[0] == 'date') {
                $tasks->bindValue(1, $filter[1], PDO::PARAM_STR);
                $tasks->bindValue(2, trim($filter[2]), PDO::PARAM_STR);
            }
        }
        $tasks->execute();
        // $tasks->debugDumpParams($tasks);

        return $tasks;
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function get_all_tasks_count()
{
    try {
        global $connection;

        $sql =  'SELECT COUNT(id) AS nb FROM tasks';
        $statement = $connection->query($sql)->fetch();

        $taskCount = $statement['nb'];

        return $taskCount;
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function add_task($id, $title, $date, $time, $project_id)
{
    try {
        global $connection;

        if ($id) {
            $sql = "UPDATE tasks SET title = ?, date_task = ?, time_task = ?, project_id = ? WHERE id = ?";
        } else {
            $sql = "INSERT INTO tasks (title, date_task, time_task, project_id) VALUES (?, ?, ?, ?)";
        }
        $statement = $connection->prepare($sql);
        $new_task = array($title, $date, $time, $project_id);
        if ($id) {
            $new_task = array($title, $date, $time, $project_id, $id);
        }


        // $new_task = array(
        //     'project_id' => $project_id,
        //     'title'      => $title,
        //     'date_task'  => $date,
        //     'time_task'  => $time
        // );

        // $sql = sprintf(
        //     "INSERT INTO %s (%s) VALUES (%s)",
        //     "tasks",
        //     implode(",", array_keys($new_task)),
        //     ":" . implode(", :", array_keys($new_task))
        // );

        // $statement = $connection->prepare($sql);
        $affectedLines = $statement->execute($new_task);

        return $affectedLines;
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}
