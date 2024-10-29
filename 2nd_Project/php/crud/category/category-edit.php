<?php
require_once './php/classes/Category.php';
$category = new Category();

if (isset($_GET['id'])) {
    $categoryId = intval($_GET['id']);
    $cat = $category->getById($categoryId);

    if (!$cat) {
        header('Location: categories-list.php');
        exit();
    }
} else {
    header('Location: categories-list.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    if (!empty($title)) {
        $category->update($categoryId, $title);
        header('Location: categories-list.php');
        exit();
    } else {
        $error = 'Title is required.';
    }
}
?>


<div class="container">
    <h1>Edit Category</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="category-edit.php?id=<?= urlencode($categoryId) ?>" method="POST">
        <div class="form-group">
            <label for="title">Category Title</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($cat['title']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
</div>