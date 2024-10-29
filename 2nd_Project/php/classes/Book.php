<?php
require_once __DIR__ . '/database.php';

class Book extends DB
{
    public function getAll()
    {
        $sql = "SELECT 
                    books.book_id AS id, 
                    books.book_title AS title, 
                    books.year_of_publication, 
                    books.number_of_pages, 
                    books.image_url, 
                    categories.title AS category, 
                    authors.first_name, 
                    authors.last_name, 
                    CONCAT(authors.first_name, ' ', authors.last_name) AS author_name,
                    books.category_id, 
                    books.author_id
                FROM books 
                JOIN categories ON books.category_id = categories.category_id
                JOIN authors ON books.author_id = authors.author_id
                WHERE books.is_deleted = 0";

        $stmt = $this->instance->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        try {
            $sql = "INSERT INTO books (book_title, category_id, author_id, year_of_publication, number_of_pages, image_url) 
                    VALUES (:book_title, :category_id, :author_id, :year_of_publication, :number_of_pages, :image_url)";
            $stmt = $this->instance->prepare($sql);
            $stmt->bindParam(':book_title', $data['book_title']);
            $stmt->bindParam(':category_id', $data['category_id']);
            $stmt->bindParam(':author_id', $data['author_id']);
            $stmt->bindParam(':year_of_publication', $data['year_of_publication']);
            $stmt->bindParam(':number_of_pages', $data['number_of_pages']);
            $stmt->bindParam(':image_url', $data['image_url']);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Log error or handle it as needed
            return false;
        }
    }

    public function update($book_id, $data)
    {
        try {
            $sql = "UPDATE books 
                    SET book_title = :book_title, category_id = :category_id, author_id = :author_id, 
                        year_of_publication = :year_of_publication, number_of_pages = :number_of_pages, image_url = :image_url 
                    WHERE book_id = :book_id";
            $stmt = $this->instance->prepare($sql);
            $stmt->bindParam(':book_title', $data['book_title']);
            $stmt->bindParam(':category_id', $data['category_id']);
            $stmt->bindParam(':author_id', $data['author_id']);
            $stmt->bindParam(':year_of_publication', $data['year_of_publication']);
            $stmt->bindParam(':number_of_pages', $data['number_of_pages']);
            $stmt->bindParam(':image_url', $data['image_url']);
            $stmt->bindParam(':book_id', $book_id);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Log error or handle it as needed
            return false;
        }
    }

    public function getByCategories($categories)
    {
        if (empty($categories)) {
            // If no categories are selected, fetch all books
            return $this->getAll();
        } else {
            // Prepare placeholders for the IN clause
            $placeholders = rtrim(str_repeat('?,', count($categories)), ',');
            $sql = "SELECT 
                        books.book_id AS id, 
                        books.book_title AS title, 
                        books.year_of_publication, 
                        books.number_of_pages, 
                        books.image_url, 
                        categories.title AS category, 
                        authors.first_name, 
                        authors.last_name, 
                        CONCAT(authors.first_name, ' ', authors.last_name) AS author_name,
                        books.category_id, 
                        books.author_id
                    FROM books 
                    JOIN categories ON books.category_id = categories.category_id
                    JOIN authors ON books.author_id = authors.author_id
                    WHERE books.is_deleted = 0 
                      AND LOWER(categories.title) IN ($placeholders)";

            $stmt = $this->instance->prepare($sql);
            // Convert categories to lowercase for case-insensitive comparison
            $categories = array_map('strtolower', $categories);
            $stmt->execute($categories);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function delete($book_id)
    {
        try {
            $sql = "UPDATE books SET is_deleted = 1 WHERE book_id = :book_id";
            $stmt = $this->instance->prepare($sql);
            $stmt->bindParam(':book_id', $book_id);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Log error or handle it as needed
            return false;
        }
    }

    public function getCategories()
    {
        $sql = "SELECT * FROM categories WHERE is_deleted = 0";
        $stmt = $this->instance->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAuthors()
    {
        $sql = "SELECT * FROM authors WHERE is_deleted = 0";
        $stmt = $this->instance->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($bookId)
    {
        $sql = "SELECT books.book_id AS id, books.book_title AS title, books.year_of_publication, 
                       books.number_of_pages, books.image_url, books.category_id, books.author_id,
                       categories.title AS category_title, authors.first_name, authors.last_name 
                FROM books 
                JOIN categories ON books.category_id = categories.category_id
                JOIN authors ON books.author_id = authors.author_id
                WHERE books.is_deleted = 0 AND books.book_id = :book_id";

        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':book_id', $bookId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
