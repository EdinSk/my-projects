<?php
require_once __DIR__ . '/database.php';

class Comment extends DB
{
    public function getAllComments()
    {
        $sql = "SELECT comments.comment_id, comments.user_id, comments.book_id, comments.content, comments.created_at, comments.is_approved, comments.is_rejected, 
                       books.book_title, users.username
                FROM comments
                JOIN books ON comments.book_id = books.book_id
                JOIN users ON comments.user_id = users.user_id
                ORDER BY comments.created_at DESC";

        $stmt = $this->instance->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getApprovedCommentsByBookId($bookId)
    {
        $sql = "SELECT comments.*, users.username
                FROM comments
                JOIN users ON comments.user_id = users.user_id
                WHERE comments.book_id = :book_id AND comments.is_approved = 1
                ORDER BY comments.created_at DESC";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':book_id', $bookId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Fetch comments for a specific book
    public function getCommentsByBookId($bookId)
    {
        $sql = "SELECT comments.comment_id, comments.user_id, comments.book_id, comments.content, comments.created_at, users.username, books.book_title AS book_title
                FROM comments
                JOIN users ON comments.user_id = users.user_id
                JOIN books ON comments.book_id = books.book_id 
                WHERE comments.book_id = :book_id AND comments.is_approved = 1 AND comments.is_rejected = 0
                ORDER BY comments.created_at DESC";

        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':book_id', $bookId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommentById($commentId)
    {
        $sql = "SELECT * FROM comments WHERE comment_id = :comment_id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addComment($userId, $bookId, $content)
    {
        $sql = "INSERT INTO comments (user_id, book_id, content, is_approved, is_rejected, created_at)
            VALUES (:user_id, :book_id, :content, 0, 0, NOW())";

        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':book_id', $bookId, PDO::PARAM_INT);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function deleteComment($commentId)
    {
        $sql = "DELETE FROM comments WHERE comment_id = :comment_id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getPendingComments()
    {
        $sql = "SELECT comments.comment_id, comments.user_id, comments.book_id, comments.content, comments.created_at, users.username, books.book_title AS book_title
            FROM comments
            JOIN users ON comments.user_id = users.user_id
            JOIN books ON comments.book_id = books.book_id
            WHERE comments.is_approved = 0 AND comments.is_rejected = 0
            ORDER BY comments.created_at ASC";

        $stmt = $this->instance->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function hasPendingComment($userId, $bookId)
    {
        $sql = "SELECT COUNT(*) FROM comments
            WHERE user_id = :user_id AND book_id = :book_id AND is_approved = 0 AND is_rejected = 0";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':book_id', $bookId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function approveComment($commentId)
    {
        $sql = "UPDATE comments SET is_approved = 1 WHERE comment_id = :comment_id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function rejectComment($commentId)
    {
        $sql = "UPDATE comments SET is_rejected = 1 WHERE comment_id = :comment_id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
