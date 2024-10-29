<?php
session_start();
require_once '../../2nd_Project/php/classes/user.php';

header('Content-Type: application/json');

// Ensure the user is authorized
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit();
}

$userObj = new User();
$action = $_POST['action'] ?? null;

// Perform actions based on `action` parameter
switch ($action) {
    case 'create':
        if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
            ];
            if ($userObj->emailExists($data['email'])) {
                echo json_encode(['success' => false, 'message' => 'Email already exists.']);
            } elseif ($userObj->createUser($data)) {
                echo json_encode(['success' => true, 'message' => 'User created successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to create user.']);
            }
        }
        break;

    case 'update':
        if (isset($_POST['user_id'], $_POST['username'], $_POST['email'])) {
            $data = [
                'user_id' => intval($_POST['user_id']),
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
            ];
            if (!empty($_POST['password'])) {
                $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
            if ($userObj->updateUser($data['user_id'], $data['username'], $data['email'], $data['password'] ?? null)) {
                echo json_encode(['success' => true, 'message' => 'User updated successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update user.']);
            }
        }
        break;

    case 'delete':
        if (isset($_POST['user_id'])) {
            $userId = intval($_POST['user_id']);
            if ($userObj->deleteUser($userId)) {
                echo json_encode(['success' => true, 'message' => 'User deleted successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete user.']);
            }
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
}
