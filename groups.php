<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['fullname'];

// Handle new group creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_group'])) {
    $group_name = trim($_POST['group_name']);
    $group_desc = trim($_POST['group_desc']);

    if (!empty($group_name)) {
        $stmt = $conn->prepare("INSERT INTO groups (name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $group_name, $group_desc);
        if ($stmt->execute()) {
            echo "<script>alert('Group created successfully!'); window.location.href='groups.php';</script>";
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
    <title>TechLio Groups</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: "Poppins", sans-serif;
        }
        .container {
            margin-top: 30px;
        }
        .group-card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: 0.3s ease-in-out;
        }
        .group-card:hover {
            transform: scale(1.03);
        }
        .btn-primary {
            background: #28a745;
            border: none;
        }
        .btn-primary:hover {
            background: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center"><i class="fas fa-users"></i> TechLio Groups</h2>

    <!-- Create Group Form -->
    <div class="card p-3 my-3">
        <h5>Create a New Group</h5>
        <form method="post">
            <input type="text" class="form-control mb-2" name="group_name" placeholder="Group Name" required>
            <textarea class="form-control mb-2" name="group_desc" placeholder="Group Description"></textarea>
            <button type="submit" class="btn btn-primary w-100" name="create_group">Create Group</button>
        </form>
    </div>

    <h3>Available Groups</h3>
    <div class="row">
        <?php while ($group = $groups->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card group-card p-3">
                    <h4><a href="group_posts.php?group_id=<?= $group['group_id'] ?>" class="text-decoration-none text-dark">
                        <i class="fas fa-users"></i> <?= htmlspecialchars($group['name']) ?>
                    </a></h4>
                    <p><?= htmlspecialchars($group['description']) ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
