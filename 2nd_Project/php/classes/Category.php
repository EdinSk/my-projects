<?php
require_once __DIR__ . '/database.php';


class Category extends DB
{
    public function getAll()
    {
        $sql = "SELECT * FROM categories WHERE is_deleted = 0";
        $stmt = $this->instance->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($categoryId)
    {
        $sql = "SELECT * FROM categories WHERE category_id = :category_id AND is_deleted = 0";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($title)
    {
        $sql = "INSERT INTO categories (title) VALUES (:title)";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function update($categoryId, $title)
    {
        $sql = "UPDATE categories SET title = :title WHERE category_id = :category_id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($categoryId)
    {
        // Soft-delete by setting is_deleted to 1
        $sql = "UPDATE categories SET is_deleted = 1 WHERE category_id = :category_id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
