<?php
require_once __DIR__ . "/../php/crud/categories.php";
require_once __DIR__ . "/../php/crud/books.php";
require_once __DIR__ . "/../php/crud/authors.php";

session_start();

// Fetch categories
$category = new Category();
$categories = $category->getAll();

// Fetch books
$book = new Book();
$books = $book->showBooks();

$author = new Author();
$authors = $author->showAuthors();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" aria-current="page" href="admin.php">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- NavBar -->

    <!-- Categories -->

    <div class="container mt-5">
        <h1>Manage Categories</h1>
        <!-- Add Category Form -->
        <form action="../php/crud/categories.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" name="add_category" class="btn btn-primary">Add Category</button>
        </form>

        <!-- Categories Table -->
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= htmlspecialchars($category['category_id']) ?></td>
                    <td><?= htmlspecialchars($category['title']) ?></td>
                    <td>
                        <!-- Edit Category Form -->
                        <form action="../php/crud/categories.php" method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $category['category_id'] ?>">
                            <input type="text" name="name" value="<?= $category['title'] ?>">
                            <button type="submit" name="edit_category" class="btn btn-warning">Edit</button>
                        </form>
                        <!-- Delete Category Form -->
                        <form action="../php/crud/categories.php" method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $category['category_id'] ?>">
                            <button type="submit" name="delete_category" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Books -->

    <div class="container mt-5">
    <h1>Manage Books</h1>

    <!-- Add Book Form -->
    <form action="../admin_dashboard/manage.php" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Book Title</label>
            <input type="text" class="form-control" id="title" name="book_title" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <select class="form-select" id="author" name="author_id" required>
                <option value="">Select Author</option>
                <?php foreach ($authors as $author): ?>
                    <option value="<?= htmlspecialchars($author['author_id']) ?>">
                        <?= htmlspecialchars($author['first_name'] . ' ' . $author['last_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Year of Publication</label>
            <input type="number" class="form-control" id="year" name="year_of_publication" required>
        </div>
        <div class="mb-3">
            <label for="pages" class="form-label">Number of Pages</label>
            <input type="number" class="form-control" id="pages" name="number_of_pages" required>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">Image URL</label>
            <input type="url" class="form-control" id="image_url" name="image_url">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="category_id" required>
                <!-- Option values should be dynamically populated based on categories in your database -->
                <option value="">Select Category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['category_id']) ?>">
                        <?= htmlspecialchars($category['title']) ?>
                    </option>
                <?php endforeach; ?>
                <!-- Add more options based on your categories -->
            </select>
        </div>
        <button type="submit" name="add_book" class="btn btn-primary">Add Book</button>
    </form>

    <!-- Books Table -->
    <div class="container mt-5">
        <h1>Edit Books</h1>

        <!-- Books Table -->
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year Published</th>
                    <th>Num. of Pages</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td class="book-field"><?= htmlspecialchars($book['book_id']) ?></td>
                    <td class="book-field"><?= htmlspecialchars($book['book_title']) ?></td>
                    <td class="book-field"><?= htmlspecialchars($book['first_name']) ?></td>
                    <td class="book-field"><?= htmlspecialchars($book['year_of_publication']) ?></td>
                    <td class="book-field"><?= htmlspecialchars($book['number_of_pages']) ?></td>
                    <td class="book-field"><?= htmlspecialchars($book['title']) ?></td>

                    <!-- Edit Form Fields (initially hidden) -->
                    <td class="book-edit-field d-none">
                        <input type="hidden" name="book_id" value="<?= $book['book_id'] ?>">
                        <input type="text" name="vook_title" value="<?= htmlspecialchars($book['book_title']) ?>" class="form-control">
                    </td>
                    <td class="book-edit-field d-none">
                        <select name="author_id" class="form-control">
                            <!-- Dynamically populate options based on authors -->
                            <?php foreach ($authors as $author): ?>
                                <option value="<?= $author['author_id'] ?>" <?= ($author['author_id'] == $book['author_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($author['first_name'] . ' ' . $author['last_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td class="book-edit-field d-none">
                        <input type="number" name="year_of_publication" value="<?= htmlspecialchars($book['year_of_publication']) ?>" class="form-control">
                    </td>
                    <td class="book-edit-field d-none">
                        <input type="number" name="number_of_pages" value="<?= htmlspecialchars($book['number_of_pages']) ?>" class="form-control">
                    </td>
                    <td class="book-edit-field d-none">
                        <input type="url" name="image_url" value="<?= htmlspecialchars($book['image_url']) ?>" class="form-control">
                    </td>
                    <td class="book-edit-field d-none">
                        <select name="category_id" class="form-control">
                            <!-- Dynamically populate options based on categories -->
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['category_id'] ?>" <?= ($category['category_id'] == $book['category_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category['title']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <!-- Add more edit fields as needed -->

                    <td>
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-warning edit-book">Edit</button>
                        <!-- Save Button (initially hidden) -->
                        <button type="submit" class="btn btn-primary save-book d-none">Save</button>

                        <form action="../php/crud/books.php" method="POST" style="display: inline;">
                            <input type="hidden" name="book_id" value="<?= $book['book_id'] ?>">
                            <button type="submit" name="delete_book" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Authors -->

<div class="container mt-5">
    <h1>Manage Authors</h1>

    <form action="../php/crud/authors.php" method="POST">
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea class="form-control" id="bio" name="bio" rows="3" required></textarea>
        </div>
        <button type="submit" name="add_author" class="btn btn-primary">Add Author</button>
    </form>

    <!-- Authors Table -->
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Bio</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($authors as $author): ?>
            <tr>
                <td><?= htmlspecialchars($author['author_id']) ?></td>
                <td>
                    <span class="author-field"><?= htmlspecialchars($author['first_name']) ?></span>
                    <input type="text" class="form-control author-edit-field d-none" name="first_name" value="<?= htmlspecialchars($author['first_name']) ?>">
                </td>
                <td>
                    <span class="author-field"><?= htmlspecialchars($author['last_name']) ?></span>
                    <input type="text" class="form-control author-edit-field d-none" name="last_name" value="<?= htmlspecialchars($author['last_name']) ?>">
                </td>
                <td>
                    <span class="author-field"><?= htmlspecialchars($author['bio']) ?></span>
                    <textarea class="form-control author-edit-field d-none" name="bio" rows="2"><?= htmlspecialchars($author['bio']) ?></textarea>
                </td>
                <td>
                    <button class="btn btn-warning edit-author">Edit</button>
                    <form action="../php/crud/authors.php" method="POST" style="display: inline;">
                        <input type="hidden" name="author_id" value="<?= $author['author_id'] ?>">
                        <button type="submit" name="delete_author" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    // JavaScript to toggle visibility of edit fields
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-author');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const parentRow = this.closest('tr');
                const fields = parentRow.querySelectorAll('.author-field, .author-edit-field');
                fields.forEach(field => {
                    field.classList.toggle('d-none'); // Toggle visibility
                });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-book');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const parentRow = this.closest('tr');
                const fields = parentRow.querySelectorAll('.book-field, .book-edit-field');
                fields.forEach(field => {
                    field.classList.toggle('d-none'); // Toggle visibility
                });
            });
        });
    }); 
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php require_once "../php/footer.php"?>

</body>
</html>
