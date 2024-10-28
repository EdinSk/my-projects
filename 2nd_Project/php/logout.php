<?php
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = [];

// If the session was propagated using cookies, force the browser to delete it
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to the login page or home page
header("Location: ../index.php");
exit;
?>
