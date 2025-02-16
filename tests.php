<?php
session_start();

// Initialize user progress if not set
if (!isset($_SESSION['progress'])) {
    $_SESSION['progress'] = [
        'Climate Action' => ['beginner' => ['completed' => false, 'score' => 0], 'intermediate' => ['completed' => false, 'score' => 0], 'advanced' => ['completed' => false, 'score' => 0]],
        'Water Management' => ['beginner' => ['completed' => false, 'score' => 0], 'intermediate' => ['completed' => false, 'score' => 0], 'advanced' => ['completed' => false, 'score' => 0]],
        'Renewable Energy' => ['beginner' => ['completed' => false, 'score' => 0], 'intermediate' => ['completed' => false, 'score' => 0], 'advanced' => ['completed' => false, 'score' => 0]],
        'Sustainable Recycling' => ['beginner' => ['completed' => false, 'score' => 0], 'intermediate' => ['completed' => false, 'score' => 0], 'advanced' => ['completed' => false, 'score' => 0]],
        'Sustainable Agriculture' => ['beginner' => ['completed' => false, 'score' => 0], 'intermediate' => ['completed' => false, 'score' => 0], 'advanced' => ['completed' => false, 'score' => 0]]
    ];
}

// Domains
$domains = ['Climate Action', 'Water Management', 'Renewable Energy', 'Sustainable Recycling', 'Sustainable Agriculture'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sustainability Quizzes</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #2e8b57, #f7f9f8);
            margin: 0;
            padding: 20px;
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
            max-width: 1000px;
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            color: #ffffff;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.1rem;
            color: #ffffff;
            margin-bottom: 40px;
        }

        /* Domain Card Styles */
        .domain-card {
            background: rgba(255, 255, 255, 0.2);
            padding: 25px;
            margin: 20px 0;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .domain-card:hover {
            transform: scale(1.05);
        }

        .domain-card h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #ffffff;
        }

        /* Levels Section */
        .levels {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            justify-items: center;
        }

        .level {
            background: rgba(255, 255, 255, 0.15);
            padding: 20px;
            margin: 10px 0;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .level:hover {
            transform: scale(1.05);
        }

        .level.disabled {
            opacity: 0.5;
            pointer-events: none;
        }

        /* Button Styles */
        .btn {
            padding: 12px 25px;
            background-color: #4caf50;
            color: white;
            font-size: 1.1rem;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .btn-disabled {
            background-color: gray !important;
            cursor: not-allowed;
        }

        /* Certificate Button */
        .btn-certificate {
            background-color: #ffa500;
            color: white;
            font-size: 1.1rem;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            display: inline-block;
        }

        .btn-certificate:hover {
            background-color: #e69500;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Home Button Added -->
        <a href="home.php" class="btn">Home</a>

        <h1>🌍 Choose a Sustainability Domain</h1>
        <p>Complete levels to unlock new challenges.</p>

        <?php foreach ($domains as $domain): ?>
            <div class="domain-card">
                <h2><?php echo $domain; ?></h2>
                <div class="levels">
                    <?php
                    $levels = ['beginner', 'intermediate', 'advanced'];
                    foreach ($levels as $level):
                        $isDisabled = false;
                        if ($level != 'beginner') {
                            $previousLevel = $levels[array_search($level, $levels) - 1];
                            if (!$_SESSION['progress'][$domain][$previousLevel]['completed']) {
                                $isDisabled = true;
                            }
                        }
                    ?>
                        <div class="level <?php echo $isDisabled ? 'disabled' : ''; ?>">
                            <h3><?php echo ucfirst($level); ?> Level</h3>
                            <p>Score: <?php echo $_SESSION['progress'][$domain][$level]['score']; ?></p>
                            <a class="btn <?php echo $isDisabled ? 'btn-disabled' : ''; ?>" 
                               href="quiz.php?domain=<?php echo urlencode($domain); ?>&level=<?php echo $level; ?>" 
                               <?php echo $isDisabled ? 'disabled' : ''; ?>>Start <?php echo ucfirst($level); ?> Quiz</a>
                        </div>
                    <?php endforeach; ?>
                    
                    <!-- Show certificate option if the advanced level is completed -->
                    <?php if ($_SESSION['progress'][$domain]['advanced']['completed']): ?>
                        <a class="btn-certificate" href="generate_certificate.php?domain=<?php echo urlencode($domain); ?>">Generate Certificate</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

