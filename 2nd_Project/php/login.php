<?php
require_once "./classes/user.php";

session_start();

$user = new USER();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['inputEmail'], $_POST['inputPassword'])) {
        $email = filter_var($_POST['inputEmail'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['inputPassword'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $userData = $user->loginUser($email, $password);

        

            if ($userData) {
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['username'] = $userData['username'];
                $_SESSION['role'] = $userData['role'];

                if ($userData['role'] == 'admin') {
                    header("Location: ../admin_dashboard/admin.php");
                    exit();
                } else {
                    header("Location: ../user_dashboard/user_dashboard.php");
                    exit();
                }
            } else {
                // Authentication failed
                header("Location: ../login.html?error=Invalid email or password.");
                exit();
            }
        } else {
            // Invalid email format
            header("Location: ../login.html?error=Invalid email format.");
            exit();
        }
    } else {
        // Missing POST data
        header("Location: ../login.html?error=Missing email or password.");
        exit();
    }
} else {
    header("Location: ../login.html?error=Invalid request.");
    exit();
}
?>
