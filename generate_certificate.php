<?php
session_start();

// Ensure the user is logged in and domain is valid
if (!isset($_SESSION['user_id']) || !isset($_SESSION['progress'])) {
    header("Location: index.php");
    exit;
}

$domain = isset($_GET['domain']) ? $_GET['domain'] : null;
if (!$domain || !in_array($domain, ['Climate Action', 'Water Management', 'Renewable Energy', 'Sustainable Recycling', 'Sustainable Agriculture'])) {
    echo "Invalid domain.";
    exit;
}

// Check if the advanced level is completed
if (!isset($_SESSION['progress'][$domain]['advanced']) || !$_SESSION['progress'][$domain]['advanced']['completed']) {
    echo "You must complete the advanced level to generate a certificate.";
    exit;
}

// Default user name, can be updated by the user
$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion</title>
    <style>
        /* Styling for the entire page */
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #f7fafc;
            color: #2e2e2e;
        }

        .certificate-container {
            background: #fff;
            width: 800px;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            border: 10px solid #4caf50; /* Green border */
        }

        h1 {
            font-size: 50px;
            color: #4caf50;
            font-weight: 600;
        }

        h3 {
            font-size: 26px;
            margin-bottom: 25px;
            color: #333;
        }

        p {
            font-size: 20px;
            margin-bottom: 30px;
            color: #555;
        }

        .certificate-form {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 30px;
            width: 400px;
        }

        .certificate-form input {
            padding: 12px 20px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 2px solid #ccc;
            border-radius: 5px;
            width: 80%;
        }

        .certificate-form button {
            background-color: #4caf50;
            color: white;
            padding: 12px 25px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .certificate-form button:hover {
            background-color: #45a049;
        }

        /* Adding Techlio branding */
        .techlio-logo {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            color: #4caf50;
            text-transform: uppercase;
        }

        .signature {
            margin-top: 40px;
            font-style: italic;
            font-size: 18px;
            color: #333;
        }

        .footer {
            margin-top: 20px;
            font-size: 16px;
            color: #888;
        }

        .certificate-border {
            margin: 20px auto;
            width: 70%;
            border-bottom: 2px solid #4caf50;
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <?php if (empty($user_name)): ?>
        <!-- Form for User to Input Name -->
        <div class="certificate-form">
            <h2>Enter Your Name to Generate Certificate</h2>
            <form method="POST" action="generate_certificate.php?domain=<?php echo urlencode($domain); ?>">
                <input type="text" name="user_name" placeholder="Your Full Name" required>
                <button type="submit">Generate Certificate</button>
            </form>
        </div>
    <?php else: ?>
        <!-- Certificate Display -->
        <div class="certificate-container" id="certificate">
            <!-- Techlio Logo -->
            <div class="techlio-logo">Techlio</div>
            <h1>Certificate of Completion</h1>
            <h3>Congratulations,</h3>
            <p><strong><?php echo htmlspecialchars($user_name); ?></strong></p>
            <p>For successfully completing the <strong><?php echo ucfirst($domain); ?></strong> Advanced Level Quiz</p>
            <div class="certificate-border"></div>
            <div class="signature">
                <p>Authorized Signature</p>
            </div>
            <div class="footer">
                <p>Issued on: <?php echo date("F j, Y"); ?></p>
            </div>
        </div>
    <?php endif; ?>

</body>
</html>
