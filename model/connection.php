<?php
function db_connect()
{
    try {
        // require "config/prod.php";
        require "config/dev.php";

        $connection = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $err) {
        echo "Database connection error. <br>" . $err->getMessage();
        exit;
    }
    return $connection;
}
