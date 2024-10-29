<?php
require_once './php/classes/Author.php';
$author = new Author();
$authors = $author->getAll();
?>


<div class="container mt-5">
        <h1>Authors</h1>
        <a href="author-create.php" class="btn btn-primary mb-3">Add New Author</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($authors as $auth): ?>
                    <tr>
                        <td><?= htmlspecialchars($auth['author_id']) ?></td>
                        <td><?= htmlspecialchars($auth['first_name']) ?></td>
                        <td><?= htmlspecialchars($auth['last_name']) ?></td>
                        <td>
                            <a href="author-edit.php?id=<?= urlencode($auth['author_id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="author-delete.php?id=<?= urlencode($auth['author_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this author?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>