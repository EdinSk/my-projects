<?php
require 'dbclass.php';

class Book extends DB {
    public function getAll() {
        $sql = "SELECT books.id, books.title, books.year_of_publication, books.number_of_pages, books.image_url, 
                       categories.name as category, authors.name as author 
                FROM books 
                JOIN categories ON books.category_id = categories.id
                JOIN authors ON books.author_id = authors.id
                WHERE books.is_deleted = 0";
        $stmt = $this->instance->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($title, $category_id, $author_id, $year_of_publication, $number_of_pages, $image_url) {
        $sql = "INSERT INTO books (title, category_id, author_id, year_of_publication, number_of_pages, image_url) 
                VALUES (:title, :category_id, :author_id, :year_of_publication, :number_of_pages, :image_url)";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':year_of_publication', $year_of_publication);
        $stmt->bindParam(':number_of_pages', $number_of_pages);
        $stmt->bindParam(':image_url', $image_url);
        return $stmt->execute();
    }

    public function update($id, $title, $category_id, $author_id, $year_of_publication, $number_of_pages, $image_url) {
        $sql = "UPDATE books 
                SET title = :title, category_id = :category_id, author_id = :author_id, 
                    year_of_publication = :year_of_publication, number_of_pages = :number_of_pages, image_url = :image_url 
                WHERE id = :id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':year_of_publication', $year_of_publication);
        $stmt->bindParam(':number_of_pages', $number_of_pages);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "UPDATE books SET is_deleted = 1 WHERE id = :id";
        $stmt = $this->instance->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
