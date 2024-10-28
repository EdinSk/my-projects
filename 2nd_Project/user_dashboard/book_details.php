<?php
// book_details.php
session_start();

require_once __DIR__ . "../../php/crud/books.php";
$database = new DB();
$instance = $database->getInstance();

$book = new Book();

// Get book_id from URL parameter
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    // Fetch book details
    $bookModel = $book->getBookById($book_id);

    // Fetch approved comments for the book
    $sql_book = "SELECT b.book_title, b.year_of_publication, b.number_of_pages, b.image_url, a.first_name, a.last_name, c.title 
                 FROM books b
                 JOIN authors a ON b.author_id = a.author_id
                 JOIN categories c ON b.category_id = c.category_id
                 WHERE b.book_id = :book_id";
    $stmt_book = $instance->prepare($sql_book);
    $stmt_book->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $stmt_book->execute();
    $book = $stmt_book->fetch(PDO::FETCH_ASSOC); // Fetch as associative array

    // Fetch approved comments for the book
    $sql_comments = "SELECT u.username, c.content, c.created_at 
                     FROM comments c 
                     JOIN users u ON c.user_id = u.user_id 
                     WHERE c.book_id = :book_id AND c.is_approved = 1";
    $stmt_comments = $instance->prepare($sql_comments);
    $stmt_comments->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $stmt_comments->execute();
    $comments = $stmt_comments->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .h-400 {
            height: 400px;
        }
    </style>
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
                        <a class="nav-link fw-semibold" aria-current="page" href="user_dashboard.php">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- NavBar -->

    <div class="div d-flex flex-row my-5 col-10 mx-auto ">
        <?php if ($book) : ?>
            <img src="<?= htmlspecialchars($book['image_url']) ?>" alt="Book Cover" class="h-400">

            <div class="div">
                <h1><?= htmlspecialchars(ucfirst(strtolower($book['book_title']))) ?></h1>
                <p>Author: <?= htmlspecialchars($book['first_name'] . ' ' . $book['last_name']) ?></p>
                <p>Category: <?= htmlspecialchars($book['title']) ?></p>
                <p>Published Year: <?= htmlspecialchars($book['year_of_publication']) ?></p>
                <p>Pages: <?= htmlspecialchars($book['number_of_pages']) ?></p>
            </div>




    </div>

    <!-- Add Comment Form -->
    <h3 class="mt-5">Add a Comment</h3>
    <h2>Comments</h2>
    <?php if ($comments) : ?>
        <?php foreach ($comments as $comment) : ?>
            <div class="comment">
                <p><strong><?= htmlspecialchars($comment['username']) ?></strong> (<?= htmlspecialchars($comment['created_at']) ?>):</p>
                <p><?= htmlspecialchars($comment['content']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No comments yet.</p>
    <?php endif; ?>
    <form action="#" method="post"> <!-- Adjust path -->
        <input type="hidden" name="book_id" value="<?php echo $_GET['book_id']; ?>"> <!-- Assuming book_id is passed via GET -->
        <textarea name="content" rows="4" placeholder="Write your comment here..." required></textarea>
        <br>
        <button type="submit" name="add_comment">Add Comment</button>
    </form>
<?php else : ?>
    <p>Book not found.</p>
<?php endif; ?>



<div class="book">
    <h2>Book Title</h2>
    <div class="notes-list">
        <!-- Existing notes will be loaded here dynamically -->
    </div>
    <form id="add-note-form">
        <textarea name="note" id="note" placeholder="Add a note"></textarea>
        <button type="submit">Add Note</button>
    </form>
</div>


<?php require_once "../php/footer.php"?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>