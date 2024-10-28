<?php
require_once "./classes/user.php";
session_start();

$user = new USER();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['inputName'], $_POST['inputEmail'], $_POST['inputPassword'])) {
        $username = $_POST['inputName'];
        $email = $_POST['inputEmail'];
        $password = $_POST['inputPassword'];

        if (strlen($password) < 6) {
            header("Location: ../register.html?error=Password too short.");
            exit;
        }

        if ($user->emailExists($email)) {
            header("Location: ../register.html?error=Email already exists.");
            exit;
        } else {
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $password
            ];

            if ($user->createUser($data)) {
                header("Location: ../user_dashboard/user_dashboard.php");
                exit;
            } else {
                echo "Failed to create user. Please try again later.";
            }
        }
    } else {
        echo "Missing POST data.";
    }
}
?>
