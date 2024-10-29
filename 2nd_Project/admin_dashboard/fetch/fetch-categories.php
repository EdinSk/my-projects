<?php
require_once '../../../2nd_Project/php/classes/Category.php';

header('Content-Type: application/json');

$category = new Category();
$allCategories = $category->getAll();

echo json_encode($allCategories);