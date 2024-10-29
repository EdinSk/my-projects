<?php

require_once './php/partials/nav-bar.php';
require_once './php/partials/books/book-details.php';
require_once './php/classes/Note.php'; // Include the Note class


// Initialize variables
$error = '';
$bookDetails = null;
$comments = [];
$hasPendingComment = false;
$commentMessage = '';
$commentError = '';
$hasPendingNote = false;
$noteMessage = '';
$noteError = '';

// CSRF Token Generation
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Get the book ID
$bookId = isset($_GET['id']) ? intval($_GET['id']) : null;
if ($bookId) {
    $bookObj = new Book();
    $bookDetails = $bookObj->getById($bookId);

    if (!$bookDetails) {
        $error = 'Book not found.';
    } else {
        $commentObj = new Comment();
        $comments = $commentObj->getApprovedCommentsByBookId($bookId);

        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $hasPendingComment = $commentObj->hasPendingComment($bookId, $userId);
            $noteObj = new Note();
            $userNotes = $noteObj->getNotesByUserAndBook($userId, $bookId);
        }
    }
} else {
    $error = 'Invalid book ID.';
}

// Messages from GET or session
if (isset($_GET['message'])) echo '<div class="alert alert-success">' . htmlspecialchars(urldecode($_GET['message'])) . '</div>';
if (isset($_GET['error'])) echo '<div class="alert alert-danger">' . htmlspecialchars(urldecode($_GET['error'])) . '</div>';
if (isset($_SESSION['comment_submitted'])) {
    $commentMessage = 'Your comment has been submitted and is awaiting approval.';
    unset($_SESSION['comment_submitted']);
}
if (isset($_SESSION['comment_error'])) {
    $commentError = $_SESSION['comment_error'];
    unset($_SESSION['comment_error']);
}
if (isset($_SESSION['note_submitted'])) {
    $noteMessage = 'Your note has been added successfully.';
    unset($_SESSION['note_submitted']);
}
if (isset($_SESSION['note_error'])) {
    $noteError = $_SESSION['note_error'];
    unset($_SESSION['note_error']);
}
?>

<div class="container my-5">
    <?php if ($error): ?>
        <h1 class="text-danger"><?= htmlspecialchars($error) ?></h1>
        <a href="index.php" class="btn btn-secondary">Back to Book List</a>
    <?php elseif ($bookDetails): ?>
        <h1 class="text-center mb-4"><?= htmlspecialchars($bookDetails['title']) ?></h1>
        <div class="row">
            <div class="col-md-4">
                <img src="<?= htmlspecialchars($bookDetails['image_url']) ?>" alt="<?= htmlspecialchars($bookDetails['title']) ?>" class="img-fluid">
            </div>
            <div class="col-md-8">
                <p><strong>Author:</strong> <?= htmlspecialchars($bookDetails['first_name'] . ' ' . $bookDetails['last_name']) ?></p>
                <p><strong>Year of Publication:</strong> <?= htmlspecialchars($bookDetails['year_of_publication']) ?></p>
                <p><strong>Number of Pages:</strong> <?= htmlspecialchars($bookDetails['number_of_pages']) ?></p>
                <p><strong>Category:</strong> <?= htmlspecialchars($bookDetails['category_title']) ?></p>
                <a href="index.php" class="btn btn-secondary mt-3">Back to Book List</a>
            </div>
        </div>

        <!-- notes -->

        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="notes-section mt-5">
                <h3>Your Notes</h3>
                <div id="notes-container">
                    <!-- Notes will be loaded here via AJAX -->
                    <p>Loading your notes...</p>
                </div>

                <h4 class="mt-4">Add a New Note</h4>
                <form id="add-note-form">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">
                    <textarea id="note-content" rows="3" class="form-control" required></textarea>
                    <button type="submit" class="btn btn-success mt-2">Add Note</button>
                </form>
            </div>
        <?php endif; ?>

        <!-- Comment Section -->
        <div class="add-comment mt-5">
            <h3>Leave a Comment</h3>
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if ($hasPendingComment): ?>
                    <p>Your previous comment is awaiting approval.</p>
                <?php else: ?>
                    <form action="php/partials/books/add-comment.php" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">
                        <input type="hidden" name="book_id" value="<?= htmlspecialchars($bookDetails['id']) ?>">
                        <textarea name="content" id="comment-content" rows="5" class="form-control" required></textarea>
                        <button type="submit" class="btn btn-primary mt-2">Submit Comment</button>
                    </form>
                <?php endif; ?>
            <?php else: ?>
                <p>Please <a href="../2nd_Project/login.php">log in</a> to leave a comment.</p>
            <?php endif; ?>
        </div>

        <!-- Display Comments -->
        <div class="comments mt-5">
            <h3>Comments</h3>
            <?php if ($comments): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($comment['username']) ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars(date('F j, Y, g:i a', strtotime($comment['created_at']))) ?></h6>
                                <p class="card-text"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No comments yet. Be the first to comment!</p>
            <?php endif; ?>
        </div>



</div>
<?php endif; ?>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() {
        const bookId = <?= $bookId ? intval($bookId) : 'null'; ?>;
        const csrfToken = '<?= htmlspecialchars($_SESSION['csrf_token']); ?>';

        function loadNotes() {
            $.get("php/partials/books/get-notes.php", {
                book_id: bookId
            }, function(data) {
                $('#notes-container').empty();
                if (Array.isArray(data) && data.length) {
                    data.forEach(note => {
                        const noteElement = $('<div>').addClass('note mb-2 p-2 border rounded');
                        const content = $('<p>').text(note.content);
                        const date = $('<small>').addClass('text-muted').text(new Date(note.created_at).toLocaleString());

                        const deleteButton = $('<button>')
                            .text('Delete')
                            .addClass('btn btn-danger btn-sm delete-note mx-2')
                            .data('note-id', note.note_id);

                        noteElement.append(content, date, deleteButton);
                        $('#notes-container').append(noteElement);
                    });
                } else {
                    $('#notes-container').html("<p>You have no notes for this book.</p>");
                }
            }, "json").fail(() => $('#notes-container').html("<p>Error loading notes. Please try again later.</p>"));
        }

        $('#add-note-form').on('submit', function(e) {
            e.preventDefault();
            const content = $('#note-content').val().trim();
            if (!content) return Swal.fire("Warning", "Note content cannot be empty.", "warning");

            $.post("php/partials/books/add-notes.php", {
                book_id: bookId,
                content,
                csrf_token: csrfToken
            }, function(res) {
                if (res.status === 'success') {
                    $('#note-content').val('');
                    loadNotes();
                    Swal.fire("Success", "Note added successfully.", "success");
                } else {
                    Swal.fire("Error", "Failed to add note: " + res.message, "error");
                }
            }, "json").fail(() => Swal.fire("Error", "Failed to add note. Try again.", "error"));
        });

        // Delete note functionality with SweetAlert confirmation
        $(document).on('click', '.delete-note', function() {
            const noteId = $(this).data('note-id');
            Swal.fire({
                title: "Are you sure?",
                text: "This note will be permanently deleted.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "php/partials/books/delete-note.php",
                        method: "POST",
                        data: {
                            note_id: noteId,
                            csrf_token: csrfToken
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status === 'success') {
                                loadNotes();
                                Swal.fire("Deleted!", "Your note has been deleted.", "success");
                            } else {
                                Swal.fire("Error", "Failed to delete note: " + response.message, "error");
                            }
                        },
                        error: function() {
                            Swal.fire("Error", "Failed to delete note. Please try again.", "error");
                        }
                    });
                }
            });
        });
        loadNotes();
    });
</script>

<?php require_once './php/partials/footer.php'; ?>