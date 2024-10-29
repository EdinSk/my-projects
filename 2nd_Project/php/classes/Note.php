<?php
require_once __DIR__ . '/database.php';


class Note extends DB
{

    // Add a new note
    public function addNote($user_id, $book_id, $content)
    {
        $stmt = $this->instance->prepare("INSERT INTO notes (user_id, book_id, content, created_at) VALUES (?, ?, ?, NOW())");
        return $stmt->execute([$user_id, $book_id, $content]);
    }

    // Get notes by user and book
    public function getNotesByUserAndBook($user_id, $book_id) {
        $stmt = $this->instance->prepare("SELECT note_id, user_id, book_id, content, created_at FROM notes WHERE user_id = ? AND book_id = ?");
        $stmt->execute([$user_id, $book_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Edit a note
    public function editNote($note_id, $user_id, $content)
    {
        $stmt = $this->instance->prepare("UPDATE notes SET content = ? WHERE note_id = ? AND user_id = ?");
        return $stmt->execute([$content, $note_id, $user_id]);
    }

    // Delete a note
    public function deleteNoteById($noteId, $userId) {
        $stmt = $this->instance->prepare("DELETE FROM notes WHERE note_id = ? AND user_id = ?");
        return $stmt->execute([$noteId, $userId]);
    }
    
}
