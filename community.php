<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user'])) {
    die("Please log in first.");
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['user'];

// Handle Post Submission
if (isset($_POST['post'])) {
    $message = trim($_POST['message']);
    if (!empty($message)) {
        $stmt = $conn->prepare("INSERT INTO community_posts (user_id, username, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $username, $message);
        $stmt->execute();
        header("Location: community.php");
        exit();
    }
}

// Handle Feedback Submission
if (isset($_POST['feedback_submit'])) {
    $feedback = trim($_POST['feedback']);
    if (!empty($feedback)) {
        $stmt = $conn->prepare("INSERT INTO community_feedback (user_id, username, feedback) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $username, $feedback);
        $stmt->execute();
        header("Location: community.php");
        exit();
    }
}

// Fetch Posts
$posts = $conn->query("SELECT * FROM community_posts ORDER BY created_at DESC");

// Fetch Feedback
$feedbacks = $conn->query("SELECT * FROM community_feedback ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Techlio Community</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background:rgb(128, 163, 130);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            background: #02672c;
            color: white;
            text-align: center;
            padding: 20px;
            width: 100%;
            font-size: 24px;
            font-weight: bold;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #222;
            font-size: 22px;
        }

        textarea, button {
            width: 100%;
            padding: 12px;
            margin-bottom: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            background: #028a34;
            color: white;
            font-size: 18px;
            cursor: pointer;
            border: none;
            transition: 0.3s;
            padding: 10px;
        }

        button:hover {
            background: #02672c;
        }

        .post, .feedback-box {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Techlio Community</h1>
        <p>Welcome, <strong><?php echo htmlspecialchars($username); ?></strong>!</p>
    </header>

    <div class="container">
        <h2>📬 Community Posts</h2>
        <form method="post">
            <textarea name="message" placeholder="Share something with the community..." rows="3" required></textarea>
            <button type="submit" name="post">Post</button>
        </form>
        <?php while ($post = $posts->fetch_assoc()): ?>
            <div class='post'>
                <strong><?php echo htmlspecialchars($post['username']); ?>:</strong>
                <p><?php echo nl2br(htmlspecialchars($post['message'])); ?></p>
            </div>
        <?php endwhile; ?>

        <h2>💡 Community Feedback</h2>
        <form method="post">
            <textarea name="feedback" placeholder="Your feedback about the community..." rows="3" required></textarea>
            <button type="submit" name="feedback_submit">Submit Feedback</button>
        </form>
        <?php while ($feedback = $feedbacks->fetch_assoc()): ?>
            <div class="feedback-box">
                <strong><?php echo htmlspecialchars($feedback['username']); ?>:</strong>
                <p><?php echo nl2br(htmlspecialchars($feedback['feedback'])); ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
