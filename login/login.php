<?php 
// Check if form is submitted
require_once '../connection/users_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Query to check the admin table
    $sql = "SELECT * FROM admin WHERE username='$input_username' AND password='$input_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header(header: "Location: ../admindash.html");
        exit;
    } else {
        header(header: "Location: ../index.html?error=Invalid username or password");
    }
}
$conn->close();
?>