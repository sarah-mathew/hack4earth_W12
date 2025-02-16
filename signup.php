<?php
session_start();
require 'config.php'; // Database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $password)) {
        $error = "Password must be at least 8 characters long and include a number, uppercase letter, and special character.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Encrypt password

        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['user'] = $username;
            header("Location: home.php?signup_success=1");
            exit();
        } else {
            $error = "Username or Email already exists!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - TechLio</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: linear-gradient(to right, #007BFF, #00C851);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            color: #007BFF;
            margin-bottom: 15px;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            text-align: left;
            font-weight: bold;
            margin: 8px 0 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: 0.3s;
        }

        input:focus {
            border-color: #007BFF;
            outline: none;
            box-shadow: 0px 0px 8px rgba(0, 123, 255, 0.5);
        }

        .btn {
            background: #007BFF;
            color: white;
            padding: 12px;
            border: none;
            font-size: 1.1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 15px;
        }

        .btn:hover {
            background: #0056b3;
        }

        p {
            margin-top: 15px;
            font-size: 0.9rem;
        }

        a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                return false;
            }

            var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
            if (!passwordRegex.test(password)) {
                alert("Password must be at least 8 characters long, include a number, an uppercase letter, and a special character.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<div class="container">
    <h1>Create an Account</h1>

    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    
    <form method="POST" action="signup.php" onsubmit="return validateForm()">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type="submit" class="btn">Sign Up</button>
    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>
</div>

</body>
</html>
