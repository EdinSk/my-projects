<?php
require_once '../../2nd_Project/php/classes/Category.php';

$response = ['success' => false, 'message' => 'An error occurred.'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $category = new Category();
    $action = $_POST['action'];

    if ($action == 'create') {
        // Create new category
        $title = $_POST['title'];
        if ($category->create($title)) {
            $response['success'] = true;
            $response['message'] = 'Category created successfully.';
        } else {
            $response['message'] = 'Failed to create category.';
        }
    } elseif ($action == 'update') {
        // Update existing category
        $category_id = $_POST['category_id'];
        $title = $_POST['title'];
        if ($category->update($category_id, $title)) {
            $response['success'] = true;
            $response['message'] = 'Category updated successfully.';
        } else {
            $response['message'] = 'Failed to update category.';
        }
    } elseif ($action == 'delete') {
        // Delete category
        $category_id = $_POST['category_id'];
        if ($category->delete($category_id)) {
            $response['success'] = true;
            $response['message'] = 'Category deleted successfully.';
        } else {
            $response['message'] = 'Failed to delete category.';
        }
    } else {
        $response['message'] = 'Invalid action.';
    }
}

header('Content-Type: application/json');
echo json_encode($response);
