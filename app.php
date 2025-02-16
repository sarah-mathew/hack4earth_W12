<?php
// Start session
session_start();

// Database Connection
$conn = new mysqli('localhost', 'root', '', 'sustainability_platform');
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

// Authentication: Login & Signup
if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");
    header('Location: login.php');
    exit();
}
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: home.php');
            exit();
        } else {
            echo "Invalid credentials";
        }
    } else {
        echo "No user found";
    }
}

// Course Completion & Certificate Generation
if (isset($_POST['complete_course'])) {
    $user_id = $_SESSION['user']['id'];
    $course_id = $_POST['course_id'];
    $conn->query("INSERT INTO completed_courses (user_id, course_id) VALUES ('$user_id', '$course_id')");
    echo "Certificate generated for Course ID: $course_id";
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

<!-- HTML Structure -->
<!DOCTYPE html>
<html>
<head>
    <title>Sustainability Platform</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to Sustainability Platform</h1>
    <nav>
        <a href="home.php">Home</a> |
        <a href="courses.php">Courses</a> |
        <a href="community.php">Community</a> |
        <a href="settings.php">Settings</a> |
        <a href="my_account.php">My Account</a> |
        <a href="contact.php">Contact Us</a> |
        <a href="?logout=true">Logout</a>
    </nav>
</body>
</html>

<!-- Database Schema -->
-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

-- Courses Table
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    description TEXT
);

-- Completed Courses Table
CREATE TABLE completed_courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    course_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

-- Community Table
CREATE TABLE community_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    content TEXT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
