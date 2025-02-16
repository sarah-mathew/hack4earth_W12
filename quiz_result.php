<?php
session_start();

$domain = isset($_GET['domain']) ? $_GET['domain'] : null;
$level = isset($_GET['level']) ? $_GET['level'] : null;
$score = isset($_GET['score']) ? $_GET['score'] : 0;

if (!$domain || !$level) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #2e8b57, #f7f9f8);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #084b23;
        }

        .container {
            background: rgba(255, 255, 255, 0.15);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            width: 100%;
            max-width: 800px;
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            color: #ffffff;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            color: #ffffff;
            margin-bottom: 30px;
        }

        .score {
            font-size: 2rem;
            font-weight: bold;
            color: #4caf50;
            margin: 20px 0;
        }

        /* Result Styles */
        .result {
            background: rgba(255, 255, 255, 0.2);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .result.success {
            background: rgba(0, 128, 0, 0.2);
            color: #4caf50;
        }

        .result.failure {
            background: rgba(255, 0, 0, 0.2);
            color: #f44336;
        }

        .btn {
            padding: 12px 25px;
            background-color: #4caf50;
            color: white;
            font-size: 1.1rem;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Quiz Results for <?php echo $domain . ' - ' . ucfirst($level); ?></h1>
        <div class="score">
            Your score: <?php echo $score; ?>/5
        </div>

        <div class="result <?php echo $score >= 4 ? 'success' : 'failure'; ?>">
            <?php if ($score >= 4): ?>
                <p>🎉 Congratulations, you've completed this level!</p>
                <p>You have unlocked the next level!</p>
            <?php else: ?>
                <p>😞 Sorry, you need at least 4 correct answers to proceed to the next level.</p>
                <p>Keep trying, you'll get it next time!</p>
            <?php endif; ?>
        </div>

        <a href="index.php" class="btn">Back to Domains</a>
    </div>
</body>
</html>
