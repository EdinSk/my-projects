<?php
require_once "./classes/User.php"; // Ensure the correct path and class name
session_start();

$user = new User(); // Use the correct class name

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['inputName'], $_POST['inputEmail'], $_POST['inputPassword'])) {
        // Sanitize user inputs
        $username = trim($_POST['inputName']);
        $email = trim($_POST['inputEmail']);
        $password = $_POST['inputPassword']; // Do not trim passwords

        // Validate inputs
        if (empty($username) || empty($email) || empty($password)) {
            header("Location: ../register.php?error=" . urlencode("All fields are required."));
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../register.php?error=" . urlencode("Invalid email format."));
            exit;
        }

        if (strlen($password) < 6) {
            header("Location: ../register.php?error=" . urlencode("Password must be at least 6 characters."));
            exit;
        }

        // Check if email already exists
        if ($user->emailExists($email)) {
            header("Location: ../register.php?error=" . urlencode("Email already exists."));
            exit;
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $data = [
                'username' => $username,
                'email'    => $email,
                'password' => $hashedPassword
            ];

            if ($user->createUser($data)) {
                // Log the user in by setting session variables
                $_SESSION['user_id'] = $user->getUserIinstanceByEmail($email); // Assuming this method exists
                $_SESSION['username'] = $username;

                header("Location: ../user_dashboard/user_dashboard.php");
                exit;
            } else {
                header("Location: ../register.php?error=" . urlencode("Failed to create user. Please try again later."));
                exit;
            }
        }
    } else {
        header("Location: ../register.php?error=" . urlencode("Missing required fields."));
        exit;
    }
} else {
    // Redirect to register page if not a POST request
    header("Location: ../register.php");
    exit;
}
?>
