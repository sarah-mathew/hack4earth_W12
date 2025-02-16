<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    exit("Unauthorized access");
}

$userId = $_SESSION['user_id'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Invalid email format.");
}

// If password is provided, hash it and update
if (!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("UPDATE users SET email = ?, password_hash = ? WHERE id = ?");
    $stmt->bind_param("ssi", $email, $hashedPassword, $userId);
} else {
    $stmt = $conn->prepare("UPDATE users SET email = ? WHERE id = ?");
    $stmt->bind_param("si", $email, $userId);
}

if ($stmt->execute()) {
    echo "Account Updated Successfully!";
} else {
    echo "Error updating account: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
