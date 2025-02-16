<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TechLio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background-color:rgb(129, 174, 125);
            color: #333;
            scroll-behavior: smooth;
        }

        /* Header */
        header {
            background: linear-gradient(to right, #2c5f2d, #45a049);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            animation: fadeInDown 1s ease-in-out;
        }

        /* Navigation Bar */
        nav {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            background-color:rgb(56, 73, 56);
            padding: 10px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            font-size: 1rem;
            font-weight: bold;
            transition: 0.3s;
            display: flex;
            align-items: center;
            border-radius: 5px;
        }

        nav a i {
            margin-right: 8px;
        }

        nav a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        /* Main Content */
        main {
            max-width: 900px;
            margin: 60px auto;
            padding: 25px;
            background: white;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1.2s ease-in-out;
        }

        .welcome {
            font-size: 1.8rem;
            font-weight: bold;
            color: #2c5f2d;
            margin-bottom: 20px;
        }

        /* Feature Image */
        .feature-image {
            width: 100%;
            max-width: 600px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            display: block;
        }

        /* Button Container */
        .button-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        /* Call to Action Buttons */
        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            width: 220px;
            background-color: #ff8800;
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 8px;
            transition: 0.3s;
            animation: pulse 1.5s infinite;
        }

        .btn i {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        .btn:hover {
            background: #ffbb33;
            transform: scale(1.05);
        }

        .btn-blue {
            background-color: #007bff;
        }

        .btn-blue:hover {
            background-color: #0056b3;
        }

        .btn-green {
            background-color: #28a745;
        }

        .btn-green:hover {
            background-color: #218838;
        }

        /* Floating Interactive Learning Button */
        .floating-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #ff5722;
            color: white;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            border-radius: 50%;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            text-decoration: none;
            animation: bounce 1.5s infinite;
        }

        .floating-btn:hover {
            background: #e64a19;
            transform: scale(1.1);
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
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

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
    </header>

    <!-- Navigation -->
    <nav>
        <a href="home.php"><i class="fas fa-home"></i> Home</a>
        <a href="courses.php"><i class="fas fa-book"></i> Courses</a>
        <a href="tests.php"><i class="fas fa-file-alt"></i> Tests & Quizzes</a> 
        <a href="community.php"><i class="fas fa-users"></i> Community</a>
        <a href="interactive_learning.php"><i class="fas fa-lightbulb"></i> Interactive Learning</a>
        <a href="contact.php"><i class="fas fa-envelope"></i> Contact Us</a>
        <a href="settings.php"><i class="fas fa-cog"></i> Settings</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>

    <!-- Main Content -->
    <main>
        <p class="welcome">Explore our courses, take quizzes, and earn achievements.</p>

        <!-- Feature Image -->
        <img src="istockphoto-1435661938-612x612.jpg" alt="Learning Platform" class="feature-image">

        <!-- Button Options -->
        <div class="button-container">
            <a href="courses.php" class="btn"><i class="fas fa-graduation-cap"></i> Start Learning</a>
            <a href="tests.php" class="btn btn-blue"><i class="fas fa-brain"></i> Take a Test</a>
            <a href="interactive_learning.php" class="btn btn-green"><i class="fas fa-lightbulb"></i> Interactive Learning</a>
        </div>
    </main>

    <!-- Floating Interactive Learning Button -->
    <a href="interactive_learning.php" class="floating-btn" title="Interactive Learning">
        <i class="fas fa-lightbulb"></i>
    </a>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 TechLio. All rights reserved.</p>
    </footer>

</body>
</html>
