<?php
$servername = "localhost";
$username = "root";  // Change this if needed
$password = "";       // Change if you have a password
$database = "techlio_db"; 

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
