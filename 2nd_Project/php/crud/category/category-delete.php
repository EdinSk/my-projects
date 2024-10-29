<?php
require_once './php/classes/Category.php';

if (isset($_GET['id'])) {
    $categoryId = intval($_GET['id']);
    $category = new Category();
    $category->delete($categoryId);
}

header('Location: categories-list.php');
exit();
?>