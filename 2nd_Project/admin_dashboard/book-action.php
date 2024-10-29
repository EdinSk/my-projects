<?php
require_once '../../2nd_Project/php/classes/Book.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

$bookObj = new Book();
$response = ['success' => false, 'message' => 'An error occurred.'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? null;

    if ($action == 'create') {
        // Handle file upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $uploadDir = '../images/book-images/';
            $fileName = basename($_FILES['image']['name']);
            $targetFilePath = $uploadDir . $fileName;

            // Check if the file is an image
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array(strtolower($fileType), $allowedTypes)) {
                // Move the file to the upload directory
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                    $image_url = 'images/book-images/' . $fileName;
                } else {
                    $response['message'] = 'Failed to upload image.';
                    echo json_encode($response);
                    exit;
                }
            } else {
                $response['message'] = 'Invalid image file type.';
                echo json_encode($response);
                exit;
            }
        } else {
            $image_url = null; // or set a default image path
        }

        // Collect and sanitize data
        $data = [
            'book_title' => trim($_POST['book_title']),
            'category_id' => intval($_POST['category_id']),
            'author_id' => intval($_POST['author_id']),
            'year_of_publication' => intval($_POST['year_of_publication']),
            'number_of_pages' => intval($_POST['number_of_pages']),
            'image_url' => $image_url,
        ];

        if ($bookObj->create($data)) {
            $response['success'] = true;
            $response['message'] = 'Book created successfully.';
        } else {
            $response['message'] = 'Failed to create book.';
        }
    } elseif ($action == 'update') {
        $book_id = intval($_POST['book_id']);

        // Handle file upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $uploadDir = '/images/book-images/';
            $fileName = basename($_FILES['image']['name']);
            $targetFilePath = $uploadDir . $fileName;

            // Check if the file is an image
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array(strtolower($fileType), $allowedTypes)) {
                // Move the file to the upload directory
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                    $image_url = '/images/book-images/' . $fileName;
                } else {
                    $response['message'] = 'Failed to upload image.';
                    echo json_encode($response);
                    exit;
                }
            } else {
                $response['message'] = 'Invalid image file type.';
                echo json_encode($response);
                exit;
            }
        } else {
            // If no new image is uploaded, keep the existing image URL
            $existingBook = $bookObj->getById($book_id);
            $image_url = $existingBook['image_url'];
        }

        // Collect and sanitize data
        $data = [
            'book_title' => trim($_POST['book_title']),
            'category_id' => intval($_POST['category_id']),
            'author_id' => intval($_POST['author_id']),
            'year_of_publication' => intval($_POST['year_of_publication']),
            'number_of_pages' => intval($_POST['number_of_pages']),
            'image_url' => $image_url,
        ];

        if ($bookObj->update($book_id, $data)) {
            $response['success'] = true;
            $response['message'] = 'Book updated successfully.';
        } else {
            $response['message'] = 'Failed to update book.';
        }
    } elseif ($action == 'delete') {
        if (isset($_POST['book_id'])) {
            $book_id = intval($_POST['book_id']);
            if ($bookObj->delete($book_id)) {
                $response['success'] = true;
                $response['message'] = 'Book deleted successfully.';
            } else {
                $response['message'] = 'Failed to delete book.';
            }
        } else {
            $response['message'] = 'Book ID is missing.';
        }
    } else {
        $response['message'] = 'Invalid action.';
    }
} else {
    $response['message'] = 'Invalid request.';
}

echo json_encode($response);
