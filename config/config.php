<?php
// config/config.php
// Database connection settings

$host = "localhost";
$dbname = "aquanest";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
