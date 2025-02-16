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
    <title>Settings | TechLio</title>
    <style>
        /* Color Scheme */
        :root {
            --primary-color:rgb(8, 102, 0); /* Dark Blue */
            --secondary-color:rgb(130, 168, 125); /* White */
            --accent-color:rgb(26, 153, 0); /* Lighter Blue */
            --hover-color:rgb(80, 118, 77); /* Darker Blue */
            --danger-color:rgb(11, 70, 16); /* Red for Logout */
            --text-color: #f4f4f4;
        }

        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--secondary-color);
            color: var(--primary-color);
        }

        /* Navigation Bar */
        header {
            background:rgb(51, 69, 53);
            color: var(--text-color);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-links li {
            display: inline;
        }

        .nav-links a {
            color: var(--text-color);
            text-decoration: none;
            font-weight: bold;
        }

        .nav-links .active {
            text-decoration: underline;
        }

        .logout-btn {
            background: var(--danger-color);
            padding: 5px 10px;
            border-radius: 5px;
            color: var(--secondary-color);
        }

        /* Main Content */
        .settings-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .settings-options {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .settings-card {
            background: var(--primary-color);
            color: var(--text-color);
            padding: 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            width: 30%;
            text-align: center;
            transition: background 0.3s ease-in-out;
        }

        .settings-card:hover {
            background: var(--hover-color);
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 10px;
            background: var(--primary-color);
            color: var(--text-color);
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">TechLio</div>
            <ul class="nav-links">
                <li><a href="home.php">Dashboard</a></li>
                <li><a href="settings.php" class="active">Settings</a></li>
                <li><a href="logout.php" class="logout-btn">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="settings-container">
        <h1>Account Settings</h1>
        <p>Manage your account preferences and security settings.</p>

        <div class="settings-options">
            <a href="privacy.php" class="settings-card">Privacy Settings</a>
            <a href="help.php" class="settings-card">Help & Support</a>
            <a href="aboutus.php" class="settings-card">About Us</a>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> TechLio. All rights reserved.</p>
    </footer>
</body>
</html>
