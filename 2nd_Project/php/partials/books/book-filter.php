<?php
require_once '../2nd_Project/php/classes/Book.php';

$book = new Book();

$categories = $book->getCategories();

// Fetch selected categories from GET parameters
$selectedCategories = isset($_GET['categories']) ? $_GET['categories'] : [];

// Ensure $selectedCategories is always an array
if (!is_array($selectedCategories)) {
    $selectedCategories = [$selectedCategories];
}

// Convert categories to lowercase for case-insensitive comparison
$selectedCategories = array_map('strtolower', $selectedCategories);