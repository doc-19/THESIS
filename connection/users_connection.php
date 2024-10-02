<?php
// Database connection
$servername = "localhost";
$dbname = "resource_management_system_user";
$username = "root"; // Change this
$password = ""; // Change this

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>