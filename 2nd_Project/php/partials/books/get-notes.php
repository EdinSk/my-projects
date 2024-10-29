<?php
session_start();

require_once '../../classes/Note.php';

header('Content-Type: application/json');


// Assume user_id and book_id are provided in GET or SESSION
$userId = $_SESSION['user_id']; // or however you're managing user sessions
$bookId = isset($_GET['book_id']) ? intval($_GET['book_id']) : null;

if ($bookId && $userId) {
    $noteObj = new Note();
    $notes = $noteObj->getNotesByUserAndBook($userId, $bookId);
    echo json_encode($notes);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid user ID or book ID."]);
}