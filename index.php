<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit();
}

require 'db_connect.php'; // Ensure this file connects to your database

// Fetch total registered users
$sql = "SELECT COUNT(*) as user_count FROM users";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$user_count = $row['user_count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to TechLio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-color: #f4f7fa;
            color: #333;
        }

        /* Hero Section */
        .hero {
            position: relative;
            width: 100%;
            height: 100vh;
            background: linear-gradient(to right, #007BFF, #00C851);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            color: white;
            padding: 20px;
            animation: fadeIn 1.5s ease-in-out;
        }

        .hero h1 {
            font-size: 3.5rem;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
            animation: slideIn 1.2s ease-in-out;
        }

        .hero p {
            font-size: 1.4rem;
            margin-top: 10px;
            opacity: 0.9;
            animation: fadeIn 1.5s ease-in-out;
        }

        .stats {
            margin-top: 15px;
            font-size: 1.3rem;
            background: rgba(0, 0, 0, 0.2);
            padding: 10px 20px;
            border-radius: 10px;
            display: inline-block;
        }

        .btn {
            display: inline-block;
            background: #ff8800;
            color: white;
            padding: 14px 30px;
            font-size: 1.3rem;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.4s;
            font-weight: bold;
            margin-top: 20px;
            animation: pulse 1.5s infinite;
        }

        .btn:hover {
            background: #ffbb33;
            transform: scale(1.05);
        }

        /* Navigation Bar */
        nav {
            background: rgba(0, 0, 0, 0.8);
            padding: 12px 0;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            justify-content: center;
            transition: background 0.4s ease-in-out;
        }

        nav ul {
            list-style: none;
            display: flex;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 10px 15px;
            transition: 0.3s ease-in-out;
            display: inline-flex;
            align-items: center;
            border-radius: 5px;
        }

        nav ul li a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        /* Main Content */
        .main-content {
            max-width: 1100px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .main-content h2 {
            font-size: 2.5rem;
            color: #007BFF;
            margin-bottom: 20px;
        }

        .main-content p {
            font-size: 1.3rem;
            line-height: 1.8;
            color: #555;
        }

        .main-content img {
            width: 100%;
            border-radius: 12px;
            margin-top: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Footer */
        footer {
            margin-top: 50px;
            background: #222;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 1rem;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>

<!-- Hero Section -->
<div class="hero">
    <h1>Welcome to TechLio</h1>
    <p>Your gateway to sustainability education & community engagement.</p>
    <div class="stats">
        <p><i class="fas fa-user"></i> Registered Users: <strong><?php echo $user_count; ?></strong></p>
    </div>
    <a href="signup.php" class="btn">Join Us Today</a>
</div>

<!-- Navigation Bar -->
<nav>
    <ul>
        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="courses.php"><i class="fas fa-book"></i> Courses</a></li>
        <li><a href="community.php"><i class="fas fa-users"></i> Community</a></li>
        <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
        <li><a href="signup.php"><i class="fas fa-user-plus"></i> Sign Up</a></li>
    </ul>
</nav>

<!-- Main Content -->
<div class="main-content">
    <h2>Learn, Grow, and Connect</h2>
    <p>Join our sustainability community to gain knowledge, participate in discussions, and make a difference! Our platform offers structured courses, interactive quizzes, and a vibrant community where ideas come to life.</p>
    <img src="sustainability.avif" alt="Sustainability Learning">
</div>

<!-- Footer -->
<footer>
    &copy; <?php echo date("Y"); ?> TechLio - Empowering Sustainability for a Better Future.
</footer>

</body>
</html>
