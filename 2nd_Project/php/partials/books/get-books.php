<?php 
require_once '../2nd_Project/php/classes/Book.php';

$book = new Book();

// Fetch selected categories from GET parameters
$selectedCategories = isset($_GET['categories']) ? $_GET['categories'] : [];

// Ensure $selectedCategories is always an array
if (!is_array($selectedCategories)) {
    $selectedCategories = [$selectedCategories];
}

// Fetch books based on selected categories
$books = $book->getByCategories($selectedCategories);

// Preprocess data
foreach ($books as &$bookRow) {
    // Ensure all expected keys exist to avoid undefined index warnings
    $bookRow['category'] = isset($bookRow['category']) ? htmlspecialchars(strtolower($bookRow['category'])) : '';
    $bookRow['image_url'] = isset($bookRow['image_url']) ? htmlspecialchars($bookRow['image_url']) : '';
    $bookRow['title'] = isset($bookRow['title']) ? htmlspecialchars($bookRow['title']) : '';
    $bookRow['author_name'] = isset($bookRow['author_name']) ? htmlspecialchars($bookRow['author_name']) : '';
    $bookRow['year_of_publication'] = isset($bookRow['year_of_publication']) ? htmlspecialchars($bookRow['year_of_publication']) : '';
    $bookRow['number_of_pages'] = isset($bookRow['number_of_pages']) ? htmlspecialchars($bookRow['number_of_pages']) : '';
    $bookRow['id'] = isset($bookRow['id']) ? urlencode($bookRow['id']) : '';
}
unset($bookRow); // Unset reference to avoid issues
