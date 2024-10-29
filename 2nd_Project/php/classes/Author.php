<?php
require_once __DIR__ . '/database.php';

class Author extends DB
{
    public function getAll()
    {
        $sql = "SELECT * FROM authors WHERE is_deleted = 0";
        $stmt = $this->instance->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($authorId)
    {
        $sql = "SELECT * FROM authors WHERE author_id = :author_id AND is_deleted = 0";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':author_id', $authorId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO authors (first_name, last_name, bio) VALUES (:first_name, :last_name, :bio)";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':first_name', $data['first_name'], PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $data['last_name'], PDO::PARAM_STR);
        $stmt->bindParam(':bio', $data['bio'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function update($authorId, $data)
    {
        $sql = "UPDATE authors SET first_name = :first_name, last_name = :last_name, bio = :bio WHERE author_id = :author_id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':first_name', $data['first_name'], PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $data['last_name'], PDO::PARAM_STR);
        $stmt->bindParam(':bio', $data['bio'], PDO::PARAM_STR);
        $stmt->bindParam(':author_id', $authorId, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public function delete($authorId)
    {
        // Soft-delete by setting is_deleted to 1
        $sql = "UPDATE authors SET is_deleted = 1 WHERE author_id = :author_id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':author_id', $authorId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
