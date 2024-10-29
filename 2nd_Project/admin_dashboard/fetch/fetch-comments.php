<?php
require_once '../../../2nd_Project/php/classes/comments.php';

header('Content-Type: application/json');

$comment = new Comment();

// Fetch pending and all comments
$pendingComments = $comment->getPendingComments();
$allComments = $comment->getAllComments();

echo json_encode([
    'pendingComments' => $pendingComments,
    'allComments' => $allComments
]);