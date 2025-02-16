<?php
session_start();

// Assuming the user's domain and level are passed through the GET request.
$domain = isset($_GET['domain']) ? $_GET['domain'] : null;
$level = isset($_GET['level']) ? $_GET['level'] : null;
$score = isset($_GET['score']) ? $_GET['score'] : 0;

if (!$domain || !$level) {
    header('Location: index.php');
    exit;
}

// Mark the quiz as completed
$_SESSION['progress'][$domain][$level]['completed'] = true;
$_SESSION['progress'][$domain][$level]['score'] = $score;

// Check if the user has completed the Advanced level of the current domain
if ($level == 'advanced' && $score >= 4) {
    // Redirect to the certificate page after completing the Advanced level
    header('Location: certificate.php');
    exit;
} else {
    // Redirect to results page for other levels
    header('Location: results.php?domain=' . urlencode($domain) . '&level=' . urlencode($level) . '&score=' . $score);
    exit;
}
