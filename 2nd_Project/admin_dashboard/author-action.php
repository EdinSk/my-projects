<?php
require_once '../../2nd_Project/php/classes/Author.php';

header('Content-Type: application/json');

$authorObj = new Author();
$response = ['success' => false, 'message' => 'An error occurred.'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'create') {
        if (isset($_POST['first_name'], $_POST['last_name'], $_POST['bio'])) {
            // Sanitize and validate inputs
            $data = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'bio' => trim($_POST['bio']),
            ];
            if ($authorObj->create($data)) {
                $response['success'] = true;
                $response['message'] = 'Author created successfully.';
            } else {
                $response['message'] = 'Failed to create author.';
            }
        } else {
            $response['message'] = 'Missing data for creating author.';
        }
    } elseif ($action == 'update') {
        if (isset($_POST['author_id'], $_POST['first_name'], $_POST['last_name'], $_POST['bio'])) {
            $authorId = intval($_POST['author_id']);
            // Sanitize and validate inputs
            $data = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'bio' => trim($_POST['bio']),
            ];
            if ($authorObj->update($authorId, $data)) {
                $response['success'] = true;
                $response['message'] = 'Author updated successfully.';
            } else {
                $response['message'] = 'Failed to update author.';
            }
        } else {
            $response['message'] = 'Missing data for updating author.';
        }
    } elseif ($action == 'delete') {
        if (isset($_POST['author_id'])) {
            $authorId = intval($_POST['author_id']);
            if ($authorObj->delete($authorId)) {
                $response['success'] = true;
                $response['message'] = 'Author deleted successfully.';
            } else {
                $response['message'] = 'Failed to delete author.';
            }
        } else {
            $response['message'] = 'Author ID is missing.';
        }
    } else {
        $response['message'] = 'Invalid action.';
    }
} else {
    $response['message'] = 'Invalid request.';
}

echo json_encode($response);
