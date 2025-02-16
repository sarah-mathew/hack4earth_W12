<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['fullname'] ?? '';

// Ensure group ID is passed in URL
if (!isset($_GET['group_id'])) {
    echo "Invalid Group!";
    exit();
}

$group_id = intval($_GET['group_id']);

// Fetch group details
$group_query = $conn->prepare("SELECT * FROM groups WHERE id = ?");
$group_query->bind_param("i", $group_id);
$group_query->execute();
$group = $group_query->get_result()->fetch_assoc();

if (!$group) {
    echo "Group not found!";
    exit();
}

// Fetch posts related to the selected group
$posts_query = $conn->prepare("SELECT p.*, u.fullname FROM posts p JOIN users u ON p.user_id = u.id WHERE p.group_id = ? ORDER BY p.created_at DESC");
$posts_query->bind_param("i", $group_id);
$posts_query->execute();
$posts_result = $posts_query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= htmlspecialchars($group['name']) ?> - Group Posts</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
</head>
<body>

    <h2><?= htmlspecialchars($group['name']) ?> - Posts</h2>

    <h3>All Posts in this Group</h3>
    <?php while ($post = $posts_result->fetch_assoc()): ?>
        <div>
            <h4><?= htmlspecialchars($post['fullname']) ?></h4>
            <p><?= htmlspecialchars($post['content']) ?></p>
            <small>Posted on: <?= $post['created_at'] ?></small>
        </div>
    <?php endwhile; ?>

</body>
</html>
