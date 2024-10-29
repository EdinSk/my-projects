<?php
session_start();
header('Content-Type: application/json');

require_once  __DIR__ . '/../../classes/Note.php';

// Function to send JSON responses
function sendResponse($status, $message) {
    echo json_encode(['status' => $status, 'message' => $message]);
    exit();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    sendResponse('error', 'Unauthorized access.');
}

// Validate CSRF token
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    sendResponse('error', 'Invalid CSRF token.');
}

// Validate and sanitize inputs
if (isset($_POST['book_id']) && is_numeric($_POST['book_id']) && isset($_POST['content'])) {
    $bookId = intval($_POST['book_id']);
    $content = trim($_POST['content']);

    if (empty($content)) {
        sendResponse('error', 'Note content cannot be empty.');
    }

    $userId = $_SESSION['user_id'];

    $noteObj = new Note();
    $result = $noteObj->addNote($userId, $bookId, $content);

    if ($result) {
        sendResponse('success', 'Note added successfully.');
    } else {
        sendResponse('error', 'Failed to add note. Please try again.');
    }
} else {
    sendResponse('error', 'Invalid input.');
}
?>