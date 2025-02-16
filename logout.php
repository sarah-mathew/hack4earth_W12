<?php
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_unset();
session_destroy();

// Delete session cookie (if exists)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Close session write to avoid potential session issues
session_write_close();

// Redirect to login page
header("Location: index.php");
exit();
?>
