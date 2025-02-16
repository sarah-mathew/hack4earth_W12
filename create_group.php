<?php
session_start();
require 'config.php'; // Database connection file

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle group creation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $group_name = trim($_POST['group_name']);
    $group_desc = trim($_POST['group_desc']);
    $created_by = $_SESSION['user_id'];

    // Validate input
    if (empty($group_name)) {
        $error = "Group name is required.";
    } else {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO groups (name, description, created_by) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $group_name, $group_desc, $created_by);
        if ($stmt->execute()) {
            $success = "Group created successfully!";
        } else {
            $error = "Error creating group.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Group - TechLio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <h2>Create a New Group</h2>

    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <?php if (isset($success)) echo "<p style='color: green;'>$success</p>"; ?>

    <form method="POST" action="">
        <label>Group Name:</label>
        <input type="text" name="group_name" required>
        
        <label>Description:</label>
        <textarea name="group_desc" rows="4"></textarea>

        <button type="submit">Create Group</button>
    </form>

    <br>
    <a href="dashboard.php">Back to Dashboard</a>

</body>
</html>
