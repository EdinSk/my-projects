<?php

session_start();  // Make sure session is started

// Check if user_id is set in session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Now you can use $user_id in this file
    echo "User ID: " . $user_id;
} else {
    // Redirect or handle case where user is not logged in
    echo "no user";
    
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_comment'])) {
//     if (!isset($_SESSION['user_id'])) {
//         echo "User session not found. Please login first.";
//         exit();
//     }
    
//     $book_id = isset($_POST['book_id']) ? intval($_POST['book_id']) : null;

//     $content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : '';

//     if (!$book_id || empty($content)) {
//         echo "Invalid input data.";
//         exit();
//     }

//     try {
//         require_once '../classes/database.php'; 
//         $db = new DB(); 
//         $instance = $db->getInstance(); 
        
//         $sql = "INSERT INTO comments (user_id, book_id, content, is_approved) VALUES (:user_id, :book_id, :content, 0)";
//         $stmt = $instance->prepare($sql);
//         $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
//         $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
//         $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        
//         // Execute the statement
//         if ($stmt->execute()) {
//             // Successful insertion, redirect back to the page where the comment was submitted from
//             header("Location: ../user_dashboard/book_details.php?book_id=$book_id");
//             exit();
//         } else {
//             // Error inserting comment
//             echo "Error adding comment.";
//         }
//     } catch (PDOException $e) {
//         echo "Database error: " . var_dump($_SESSION['user_id']);
//     }
// } else {
//     // Handle invalid request if not coming from POST method or without 'add_comment' parameter
//     echo "Invalid request.";
// }
?>
