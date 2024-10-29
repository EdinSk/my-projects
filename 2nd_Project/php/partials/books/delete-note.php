<?php
session_start();
header('Content-Type: application/json');
require_once '../../classes/Note.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in."]);
    exit;
}

// Check for note_id in the request
if (!isset($_POST['note_id'])) {
    echo json_encode(["status" => "error", "message" => "Note ID missing."]);
    exit;
}

// Check for CSRF token and validate it
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    echo json_encode(["status" => "error", "message" => "CSRF token mismatch."]);
    exit;
}

$noteId = intval($_POST['note_id']);
$userId = $_SESSION['user_id'];

// Initialize the Note class and attempt to delete the note
$noteObj = new Note();
if ($noteObj->deleteNoteById($noteId, $userId)) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to delete the note in the database."]);
}
