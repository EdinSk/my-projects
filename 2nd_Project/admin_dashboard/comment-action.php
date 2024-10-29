<?php 
session_start();
require_once '../../2nd_Project/php/classes/comments.php';

header('Content-Type: application/json');

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit();
}

// Check if the necessary POST data is provided
if (isset($_POST['comment_id'], $_POST['action'])) {
    $commentId = intval($_POST['comment_id']);
    $action = $_POST['action'];
    $comment = new Comment();

    // Perform the action based on the action type
    if ($action === 'approve') {
        $result = $comment->approveComment($commentId);
        $actionText = "approved";
    } elseif ($action === 'reject') {
        $result = $comment->rejectComment($commentId);
        $actionText = "rejected";
    } elseif ($action === 'delete') {
        $result = $comment->deleteComment($commentId);
        $actionText = "deleted";
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action specified.']);
        exit();
    }

    // Return JSON response
    if ($result) {
        echo json_encode(['success' => true, 'message' => "Comment $actionText successfully."]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to process the action.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
