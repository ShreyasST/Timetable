<?php
$servername = "localhost"; // Change if necessary
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "devops"; // Database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database,3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
