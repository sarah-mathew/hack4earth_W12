<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch user data
$stmt = $conn->prepare("SELECT username, email, profile_picture, posts, upvotes, comments, badges, progress FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
    $userData['badges'] = json_decode($userData['badges'], true);
} else {
    echo "User not found!";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - TechLio</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fc;
            color: #495057;
            margin: 0;
            padding: 0;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dark-mode {
            background-color: #212529;
            color: #f8f9fc;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .dark-mode .container {
            background-color: #343a40;
        }

        h1 {
            color: #007bff;
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 3px solid #007bff;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }

        .stat-box {
            background-color: #007bff;
            color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            width: 30%;
            text-align: center;
            font-size: 1.1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .badge {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 6px 12px;
            margin: 8px;
            border-radius: 20px;
            font-size: 14px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        .progress-container {
            width: 100%;
            background-color: #e9ecef;
            border-radius: 8px;
            height: 10px;
            margin-bottom: 20px;
        }

        .progress-bar {
            height: 100%;
            background-color: #007bff;
            width: 0;
            transition: width 0.5s ease;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            background-color: #f8f9fc;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background-color: #007bff;
            color: white;
            font-size: 1.1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .stats {
                flex-direction: column;
                align-items: center;
            }

            .stat-box {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <button onclick="toggleDarkMode()" style="position: fixed; top: 20px; right: 20px; padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 25px; cursor: pointer;">Toggle Dark Mode</button>

    <div class="container">
        <h1>My Account</h1>
        <p>Welcome back, <strong><?php echo htmlspecialchars($userData['username']); ?></strong>!</p>

        <img src="<?php echo htmlspecialchars($userData['profile_picture']); ?>" class="profile-pic" alt="Profile Picture">

        <div class="stats">
            <div class="stat-box">
                <p><?php echo $userData['posts']; ?></p>
                <small>Posts</small>
            </div>
            <div class="stat-box">
                <p><?php echo $userData['upvotes']; ?></p>
                <small>Upvotes</small>
            </div>
            <div class="stat-box">
                <p><?php echo $userData['comments']; ?></p>
                <small>Comments</small>
            </div>
        </div>

        <h3>Badges</h3>
        <div>
            <?php foreach ($userData['badges'] as $badge): ?>
                <span class="badge">🏆 <?php echo htmlspecialchars($badge); ?></span>
            <?php endforeach; ?>
        </div>

        <h3>Progress</h3>
        <div class="progress-container">
            <div class="progress-bar" style="width: <?php echo $userData['progress']; ?>%;"></div>
        </div>

        <h2>Update Account</h2>
        <form id="updateForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter new password">
            </div>

            <div class="form-group">
                <label for="profile_picture">Update Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
            </div>

            <button type="submit" class="submit-btn">Update</button>
        </form>

        <p id="statusMessage"></p>
    </div>

    <script>
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
        }

        if (localStorage.getItem('darkMode') === 'true') {
            document.body.classList.add('dark-mode');
        }

        document.getElementById("updateForm").addEventListener("submit", function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            fetch("update_account.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("statusMessage").innerHTML = data;
                location.reload();
            })
            .catch(error => caonsole.error('Error:', error));
        });
    </script>
</body>
</html>
