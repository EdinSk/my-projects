<?php
// Initialize the session
session_start();  // Start the session

// Destroy the session and log the user out
session_unset();
session_destroy();

// Redirect to the login page or home page after logout
header("Location: ../index.php");
exit();
?>
