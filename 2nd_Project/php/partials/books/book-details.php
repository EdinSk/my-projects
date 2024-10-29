<?php
require_once '../2nd_Project/php/classes/Book.php';
require_once '../2nd_Project/php/classes/comments.php';

// Initialize variables
$bookDetails = null;
$comments = [];
$hasPendingComment = false;
$error = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $bookId = intval($_GET['id']);

    $book = new Book();
    $bookDetails = $book->getById($bookId);

    if ($bookDetails) {
        $comment = new Comment();
        $comments = $comment->getCommentsByBookId($bookId);

        // Check if the user is logged in before checking for a pending comment
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $hasPendingComment = $comment->hasPendingComment($userId, $bookId);
        }
    } else {
        header('HTTP/1.0 404 Not Found');
        $error = 'Book not found.';
    }
} else {
    // Invalid or missing ID
    header('HTTP/1.0 400 Bad Request');
    $error = 'Invalid book ID.';
}   