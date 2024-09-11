<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) 
{
die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS `todolist`;";
if ($conn->query($sql) === FALSE) 
{
echo "Database error 1";
}
$conn = new mysqli($servername, $username, $password, "todolist");

if ($conn->connect_error) 
{
die("Connection failed: " . $conn->connect_error);
}


// Create Table for users
$usersTable = "CREATE TABLE IF NOT EXISTS `todolist`.`users`(
`id` INT PRIMARY KEY AUTO_INCREMENT,`username` VARCHAR(50),`email` VARCHAR(100),`password` VARCHAR(400),`varify_code` VARCHAR(400), `verify_status` INT DEFAULT 0);";
if($conn->query($usersTable)== false){
    echo "Database table error 1";
}

// Create table for tasks
$taskTable = "CREATE TABLE IF NOT EXISTS `todolist`.`tasks`(
`id` INT PRIMARY KEY AUTO_INCREMENT,`task` VARCHAR(300),`userid` INT,`time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),`status` INT DEFAULT 0);";
if($conn->query($taskTable)==false){
    echo "Database table error 2";
}
?>