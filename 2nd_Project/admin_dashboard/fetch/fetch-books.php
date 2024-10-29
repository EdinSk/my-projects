<?php
require_once '../../../2nd_Project/php/classes/Book.php';

header('Content-Type: application/json');

$bookObj = new Book();
$allBooks = $bookObj->getAll();

echo json_encode($allBooks);
