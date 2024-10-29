<?php
require_once './php/classes/Author.php';
$author = new Author();

if (isset($_GET['id'])) {
    $authorId = intval($_GET['id']);
    $auth = $author->getById($authorId);

    if (!$auth) {
        header('Location: authors-list.php');
        exit();
    }
} else {
    header('Location: authors-list.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);

    if (!empty($firstName) && !empty($lastName)) {
        $author->update($authorId, $firstName, $lastName);
        header('Location: authors-list.php');
        exit();
    } else {
        $error = 'First Name and Last Name are required.';
    }
}
?>


<div class="container mt-5">
    <h1>Edit Author</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="author-edit.php?id=<?= urlencode($authorId) ?>" method="POST">
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="<?= htmlspecialchars($auth['first_name']) ?>" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="<?= htmlspecialchars($auth['last_name']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
</div>