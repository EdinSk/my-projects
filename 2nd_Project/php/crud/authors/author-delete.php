<?php
require_once './php/classes/Author.php';

if (isset($_GET['id'])) {
    $authorId = intval($_GET['id']);
    $author = new Author();
    $author->delete($authorId);
}

header('Location: authors-list.php');
exit();
?>