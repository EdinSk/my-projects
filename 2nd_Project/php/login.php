<?php
require_once "./classes/user.php";

session_start();

$user = new USER();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['inputEmail'], $_POST['inputPassword']) && !empty($_POST['inputPassword'])) {
        // Sanitize and validate email
        $email = filter_var($_POST['inputEmail'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['inputPassword'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Attempt to authenticate the user
            $userData = $user->loginUser($email, $password);

            if ($userData) {
                // Set session variables on successful login
                $_SESSION['user_id'] = $userData['user_id'];
                $_SESSION['username'] = $userData['username'];
                $_SESSION['role'] = $userData['role'];
                $_SESSION['email'] = $userData['email']; // Add email to session

                // Regenerate session ID to prevent session fixation
                session_regenerate_id(true);

                // Redirect based on user role
                $redirectUrl = $userData['role'] === 'admin' ? "../admin_dashboard/admin.php" : "../user_dashboard/user_dashboard.php";
                header("Location: $redirectUrl");
                exit();
            } else {
                // Redirect for failed authentication
                header("Location: ../login.php?error=Invalid email or password.");
                exit();
            }
        } else {
            // Redirect for invalid email format
            header("Location: ../login.php?error=Invalid email format.");
            exit();
        }
    } else {
        // Redirect for missing email or password
        header("Location: ../login.php?error=Missing email or password.");
        exit();
    }
} else {
    // Redirect for invalid request method
    header("Location: ../login.php?error=Invalid request.");
    exit();
}
