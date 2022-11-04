<?php

$env = parse_ini_file('../../config.ini', true)['DATABASE'];
$servername = $env['DB_SERVERNAME'];
$username = $env['DB_SURNAME'];
$password = $env['DB_PASSWORD'];
$dbname = $env['DB_NAME'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>