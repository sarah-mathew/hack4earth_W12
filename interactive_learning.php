<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['fullname'] ?? ''; // Ensure fullname is set

// Handle new group creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_group'])) {
    $group_name = trim($_POST['group_name']);
    $group_desc = trim($_POST['group_desc']);

    if (!empty($group_name)) {
        $stmt = $conn->prepare("INSERT INTO groups (name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $group_name, $group_desc);
        if ($stmt->execute()) {
            echo "<script>alert('Group created successfully!'); window.location.href='interactive_learning.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: Group name cannot be empty!";
    }
}

// Fetch all groups
$groups = $conn->query("SELECT * FROM groups ORDER BY created_at DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Interactive Learning - TechLio</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background:rgb(146, 210, 151);
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 40px auto;
            background: rgb(91, 117, 94);;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            color: #1E3A5F;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .group-card {
            background: #fff;
            padding: 15px;
            margin: 15px 0;
            border-radius: 8px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
            transition: 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .group-card:hover {
            background: #f0f0f0;
            transform: scale(1.03);
        }

        .group-card a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            font-size: 18px;
        }

        .group-card p {
            color: #555;
            font-size: 14px;
            margin-top: 5px;
        }

        .create-group-form {
            margin-top: 20px;
            background:rgb(153, 194, 158);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input, textarea, button {
            width: 90%;
            max-width: 500px;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        button {
            background: #28a745;
            color: white;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            border: none;
            transition: 0.3s;
        }

        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2><i class="fas fa-users"></i> Interactive Learning</h2>

        <!-- Create Group Form -->
        <div class="create-group-form">
            <h3>Create a New Group</h3>
            <form method="post">
                <input type="text" name="group_name" placeholder="Group Name" required>
                <textarea name="group_desc" placeholder="Group Description"></textarea>
                <button type="submit" name="create_group">Create Group</button>
            </form>
        </div>

        <h3>Available Groups</h3>
        <?php while ($group = $groups->fetch_assoc()): ?>
            <div class="group-card">
                <h4>
                    <a href="group_posts.php?group_id=<?= htmlspecialchars($group['id']) ?>">
                        <i class="fas fa-users"></i> <?= htmlspecialchars($group['name']) ?>
                    </a>
                </h4>
                <p><?= htmlspecialchars($group['description']) ?></p>
            </div>
        <?php endwhile; ?>
    </div>

</body>
</html>
