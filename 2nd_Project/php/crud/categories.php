<?php
require_once __DIR__ . "/../../php/classes/database.php";

class Category extends DB {
    public function showCategories() {
        try {
            $sql = "SELECT * FROM categories WHERE is_deleted = 0";
            $stmt = $this->instance->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array
        } catch (PDOException $e) {
            // Handle the exception (e.g., log error, return error message)
            die("Error retrieving categories: " . $e->getMessage());
        }
    }

    public function getAll() {
        $sql = "SELECT * FROM categories WHERE is_deleted = 0";
        $stmt = $this->instance->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($name) {
        // Check if a soft-deleted category with the same name exists
        $checkSql = "SELECT category_id FROM categories WHERE title = :name AND is_deleted = 1";
        $checkStmt = $this->instance->prepare($checkSql);
        $checkStmt->bindParam(':name', $name);
        $checkStmt->execute();
        $existingCategory = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
        // If a soft-deleted category with the same name exists, update is_deleted to 0
        if ($existingCategory) {
            $id = $existingCategory['category_id'];
            $updateSql = "UPDATE categories SET is_deleted = 0 WHERE category_id = :id";
            $updateStmt = $this->instance->prepare($updateSql);
            $updateStmt->bindParam(':id', $id);
            return $updateStmt->execute();
        } else {
            $sql = "INSERT INTO categories (title) VALUES (:name)";
            $stmt = $this->instance->prepare($sql);
            $stmt->bindParam(':name', $name);
            return $stmt->execute();
        }
    
        // If no soft-deleted category found, proceed with inserting a new category
        $sql = "INSERT INTO categories (title) VALUES (:name)";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public function update($id, $name) {
        $sql = "UPDATE categories SET title = :name WHERE category_id = :id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "UPDATE categories SET is_deleted = 1 WHERE category_id = :id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}


$category = new Category(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_category'])) {
        $name = $_POST['name'];
        $category->create($name);
        header("Location: ../../admin_dashboard/manage.php");
        exit();
    } elseif (isset($_POST['edit_category'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $category->update($id, $name);
        header("Location: ../../admin_dashboard/manage.php");
        exit();
    } elseif (isset($_POST['delete_category'])) {
        $id = $_POST['id'];
        $category->delete($id);
        header("Location: ../../admin_dashboard/manage.php");
        exit();
    }
}



// Fetch categories
$categories = $category->getAll();

?>
