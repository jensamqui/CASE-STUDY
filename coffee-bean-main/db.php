<?php
session_start();


$servername = "localhost"; 
$db_username = "your_db_username";
$db_password = "your_db_password"; 
$dbname = "user_database"; 

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
