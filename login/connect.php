<?php
$host = "localhost";
$username = "root"; // Default user in AMPPS
$password = "mysql"; // Default password in AMPPS
$database = "aniboxdb"; // Database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>