<?php
require_once __DIR__ . "/../../php/classes/database.php"; 

class Author extends DB {
    public function showAuthors() {
        try {
            $sql = "SELECT * FROM authors WHERE is_deleted = 0";
            $stmt = $this->instance->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array
        } catch (PDOException $e) {
            // Handle the exception (e.g., log error, return error message)
            die("Error retrieving authors: " . $e->getMessage());
        }
    }

    public function getAuthors() {
        $sql = "SELECT * FROM authors WHERE is_deleted = 0";
        $stmt = $this->instance->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($first_name, $last_name, $bio) {
        $sql = "INSERT INTO authors (first_name, last_name, bio) VALUES (:first_name, :last_name, :bio)";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':bio', $bio);
        return $stmt->execute();
    }

    public function update($id, $first_name, $last_name, $bio) {
        $sql = "UPDATE authors SET first_name = :first_name, last_name = :last_name, bio = :bio WHERE author_id = :id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "UPDATE authors SET is_deleted = 1 WHERE author_id = :id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

$author = new Author(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_author'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $bio = $_POST['bio'];
        $author->create($first_name, $last_name, $bio);
        header("Location: ../../admin_dashboard/manage.php");
        exit();
    } elseif (isset($_POST['edit_author'])) {
        $id = $_POST['author_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $bio = $_POST['bio'];
        $author->update($id, $first_name, $last_name, $bio);
        header("Location: ../../admin_dashboard/manage.php");
        exit();
    } elseif (isset($_POST['delete_author'])) {
        $id = $_POST['author_id'];
        $author->delete($id);
        header("Location: ../../admin_dashboard/manage.php");
        exit();
    }
}

// Fetch authors
$authors = $author->getAuthors();

?>
