<?php
session_start();
require_once __DIR__ . '/../../classes/comments.php';

$commentMessage = '';
if (isset($_GET['message'])) {
    $commentMessage = htmlspecialchars(urldecode($_GET['message']));
}
if (isset($_POST['book_id'], $_POST['content']) && isset($_SESSION['user_id'])) {
    $bookId = intval($_POST['book_id']);
    $content = trim($_POST['content']);
    $userId = $_SESSION['user_id'];

    if (!empty($content)) {
        $comment = new Comment();
        $result = $comment->addComment($userId, $bookId, $content);

        if ($result) {
            // Set a session variable to indicate that the comment was submitted
            $_SESSION['comment_submitted'] = true;
            // Redirect back to the book page
            header("Location:  ../../../book-single.php?id=$bookId&message=" . urlencode('Your comment has been submitted and is awaiting approval.'));
            exit();
        } else {
            // Handle error
            $_SESSION['comment_error'] = 'Error adding comment.';
            header("Location:  ../../../book-single.php?id=$bookId");
            exit();
        }
    } else {
        // Handle empty content
        $_SESSION['comment_error'] = 'Comment cannot be empty.';
        header("Location:  ../../../book-single.php?id=$bookId");
        exit();
    }
} else {
    // Invalid request
    header('HTTP/1.0 400 Bad Request');
    echo 'Invalid request.';
}
