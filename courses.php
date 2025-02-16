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
    <title>Courses - TechLio</title>
    <link rel="stylesheet" href="css/styles.css">
    <script defer src="js/script.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:rgb(153, 180, 140);
        }

        header {
            background-color: #2c5f2d;
            color: white;
            padding: 20px;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 5px;
            background: #4c9a2a;
            transition: 0.3s;
        }

        nav a:hover {
            background: #3d7b20;
        }

        main {
            text-align: center;
            padding: 20px;
        }

        .course-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            padding: 20px;
            max-width: 1000px;
            margin: auto;
        }

        .course-card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            text-align: center;
        }

        .course-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .course-card h3 {
            color: #2c5f2d;
            font-size: 20px;
            margin-top: 10px;
        }

        .course-card p {
            font-size: 14px;
            color: #555;
            margin: 10px 0;
        }

        iframe {
            width: 100%;
            height: 200px;
            border-radius: 5px;
            margin-top: 10px;
        }

        @media (max-width: 900px) {
            .course-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .course-container {
                grid-template-columns: repeat(1, 1fr);
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Explore Sustainability Courses</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="courses.php">Courses</a>
            <a href="community.php">Community</a>
            <a href="contact.php">Contact Us</a>
            <a href="settings.php">Settings</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <div class="course-container">
        <?php
$courses = [
    ["Climate Action", "Advancing Climate Change Mitigation and Adaptation", "DUMNsOxTTuo"],
    ["Water Management", "The Impact of Climate Change in Water Management in Agriculture", "pTnJQWae8eE"],
    ["Renewable Energy", "A Water-Energy-Food Nexus Perspective", "KYWY9xy_h-g"],
    ["Sustainable Recycling", "Water Use, Energy, and Waste Management for Sustainable Agriculture", "ncPgxLiU1ms"],
    ["Sustainable Agriculture", "Regenerative Agriculture: A Sustainable Solution to Climate Change", "fprAyoH9Hdw"]
];

foreach ($courses as $course) {
    echo '
    <div class="course-card">
        <h3>' . $course[0] . '</h3>
        <p>' . $course[1] . '</p>
        <iframe src="https://www.youtube.com/embed/' . $course[2] . '" allowfullscreen></iframe>
    </div>';
}
?>
        </div>
    </main>
</body>
</html>
