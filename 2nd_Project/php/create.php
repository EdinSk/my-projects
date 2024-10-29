<?php
require_once "./classes/database.php";

$db = new DB();


$username = 'admin123';
$password = password_hash('admin', PASSWORD_DEFAULT);  // Securely hash the password
$email = 'admin@example.com';
$role = 'admin';

// Insert the data into the users table
try {
    $insertStmt = $db->getInstance()->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
    $insertStmt->execute([$username, $password, $email, $role]);

    echo "User created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
