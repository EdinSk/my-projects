<?php
require 'dbclass.php';

class Author extends DB {
    public function getAll() {
        $sql = "SELECT * FROM authors WHERE is_deleted = 0";
        $stmt = $this->instance->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($name) {
        $sql = "INSERT INTO authors (name) VALUES (:name)";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public function update($id, $name) {
        $sql = "UPDATE authors SET name = :name WHERE id = :id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "UPDATE authors SET is_deleted = 1 WHERE id = :id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
