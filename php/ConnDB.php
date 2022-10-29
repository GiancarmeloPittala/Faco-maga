<?php

$servername = "localhost";
$username = "root";
$password = "ZY0R6hICLb$!O7Yl0b2w";
$dbname = "faco";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>