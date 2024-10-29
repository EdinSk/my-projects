<?php
require_once './php/classes/Category.php';
$category = new Category();
$categories = $category->getAll();
?>

<div class="container">
    <h1>Categories</h1>
    <a href="category-create.php" class="btn btn-primary">Add New Category</a>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $cat): ?>
                <tr>
                    <td><?= htmlspecialchars($cat['category_id']) ?></td>
                    <td><?= htmlspecialchars($cat['title']) ?></td>
                    <td>
                        <a href="category-edit.php?id=<?= urlencode($cat['category_id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="category-delete.php?id=<?= urlencode($cat['category_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>