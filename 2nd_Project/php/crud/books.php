<?php
require_once __DIR__ . "/../../php/classes/database.php";

class Book extends DB
{
    public function showBooks()
    {
        try {
            $sql = "SELECT b.book_id, b.book_title, b.author_id, b.year_of_publication, b.number_of_pages, b.image_url, b.category_id, a.first_name, a.last_name, c.title 
                    FROM books b
                    LEFT JOIN authors a ON b.author_id = a.author_id
                    LEFT JOIN categories c ON b.category_id = c.category_id
                    WHERE b.is_deleted = 0";
            $stmt = $this->instance->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error retrieving books: " . $e->getMessage());
        }
    }

    public function getBookById($book_id) {
        try {
            $sql = "SELECT b.*, a.first_name, a.last_name, c.title AS category_title 
                    FROM books b
                    JOIN authors a ON b.author_id = a.author_id
                    JOIN categories c ON b.category_id = c.category_id
                    WHERE b.book_id = :book_id";
            $stmt = $this->instance->prepare($sql);
            $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(); // Fetch a single row as an associative array
        } catch (PDOException $e) {
            // Handle database errors (log, throw, etc.)
            throw new PDOException("Error fetching book details: " . $e->getMessage());
        }
    }

    public function create($title, $author_id, $year_of_publication, $number_of_pages, $image_url, $category_id)
    {
        try {
            // Check if a soft-deleted book with the same attributes exists
            $checkSql = "SELECT book_id FROM books 
                         WHERE book_title = :title 
                         AND author_id = :author_id 
                         AND year_of_publication = :year_of_publication 
                         AND number_of_pages = :number_of_pages 
                         AND image_url = :image_url 
                         AND category_id = :category_id 
                         AND is_deleted = 1";

            $checkStmt = $this->instance->prepare($checkSql);
            $checkStmt->bindParam(':title', $title);
            $checkStmt->bindParam(':author_id', $author_id);
            $checkStmt->bindParam(':year_of_publication', $year_of_publication);
            $checkStmt->bindParam(':number_of_pages', $number_of_pages);
            $checkStmt->bindParam(':image_url', $image_url);
            $checkStmt->bindParam(':category_id', $category_id);
            $checkStmt->execute();

            $existingBook = $checkStmt->fetch(PDO::FETCH_ASSOC);

            // If a soft-deleted book with the same attributes exists, restore it (is_deleted = 0)
            if ($existingBook) {
                $id = $existingBook['book_id'];
                $updateSql = "UPDATE books SET is_deleted = 0 WHERE book_id = :id";
                $updateStmt = $this->instance->prepare($updateSql);
                $updateStmt->bindParam(':id', $id);
                return $updateStmt->execute();
            } else {
                // Otherwise, insert a new book
                $sql = "INSERT INTO books (book_title, author_id, year_of_publication, number_of_pages, image_url, category_id) 
                        VALUES (:title, :author_id, :year_of_publication, :number_of_pages, :image_url, :category_id)";

                $stmt = $this->instance->prepare($sql);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':author_id', $author_id);
                $stmt->bindParam(':year_of_publication', $year_of_publication);
                $stmt->bindParam(':number_of_pages', $number_of_pages);
                $stmt->bindParam(':image_url', $image_url);
                $stmt->bindParam(':category_id', $category_id);
                return $stmt->execute();
            }
        } catch (PDOException $e) {
            // Handle the exception (e.g., log error, return error message)
            die("Error creating book: " . $e->getMessage());
        }
    }


    public function update($book_id, $title, $author_id, $year_of_publication, $number_of_pages, $image_url, $category_id)
    {
        try {
            $sql = "UPDATE books SET book_title = :title, author_id = :author_id, year_of_publication = :year_of_publication, number_of_pages = :number_of_pages, image_url = :image_url, category_id = :category_id WHERE book_id = :book_id";
            $stmt = $this->instance->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':author_id', $author_id);
            $stmt->bindParam(':year_of_publication', $year_of_publication);
            $stmt->bindParam(':number_of_pages', $number_of_pages);
            $stmt->bindParam(':image_url', $image_url);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':book_id', $book_id);
            $stmt->execute();
            return true; // or handle success as needed
        } catch (PDOException $e) {
            // Handle exception, e.g., log error, return false
            return false;
        }
    }

    public function delete($id)
    {
        $sql = "UPDATE books SET is_deleted = 1 WHERE book_id = :id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}


$book = new Book();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_book'])) {
        $title = $_POST['book_title'];
        $author_id = $_POST['author_id'];
        $year_of_publication = $_POST['year_of_publication'];
        $number_of_pages = $_POST['number_of_pages'];
        $image_url = isset($_POST['image_url']) ? $_POST['image_url'] : '';
        $category_id = $_POST['category_id'];

        // Create the book using the Book class method
        $result = $book->create($title, $author_id, $year_of_publication, $number_of_pages, $image_url, $category_id);

        // Redirect to manage page after book creation
        
        } elseif (isset($_POST['edit_book'])) {
            $book_id = $_POST['book_id'];
            $title = $_POST['book_title'];
            $author_id = $_POST['author_id'];
            $year_of_publication = $_POST['year_of_publication'];
            $number_of_pages = $_POST['number_of_pages'];
            $image_url = $_POST['image_url'];
            $category_id = $_POST['category_id'];

            // Update book details
            $book->update($book_id, $title, $author_id, $year_of_publication, $number_of_pages, $image_url, $category_id);

            // Redirect back to the manage page or wherever appropriate
            header("Location: ../../admin_dashboard/manage.php");
            exit();
        } elseif (isset($_POST['delete_book'])) {
            $book_id = $_POST['book_id'];

            // Delete book
            $book->delete($book_id);

            // Redirect back to the manage page or wherever appropriate
            header("Location: ../../admin_dashboard/manage.php");
            exit();
        }
    }

// Fetch books
$books = $book->showBooks();
