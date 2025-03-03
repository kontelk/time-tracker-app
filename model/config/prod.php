<?php

/**
 * Configuration for remote production database connection
 *
 */

$host       = "127.0.0.1:3306";  // mysql prod database
$username   = "root";
$password   = "Qwerty!23";
$dbname     = "tracker";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
