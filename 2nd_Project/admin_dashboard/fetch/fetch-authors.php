<?php 

require_once '../../../2nd_Project/php/classes/Author.php';

header('Content-Type: application/json');

$author = new Author();
$allAuthors = $author->getAll();

echo json_encode($allAuthors);