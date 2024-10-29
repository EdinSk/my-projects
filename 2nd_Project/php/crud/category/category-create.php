<?php require_once './php/classes/Category.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    if (!empty($title)) {
        $category = new Category();
        $category->create($title);
        header('Location: categories-list.php');
        exit();
    } else {
        $error = 'Title is required.';
    }
}
?>

<div class="container">
    <h1>Create Category</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="category-create.php" method="POST">
        <div class="form-group">
            <label for="title">Category Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Create</button>
    </form>
</div>