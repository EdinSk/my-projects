<?php require_once '../../2nd_Project/php/classes/comments.php';

$comment = new Comment();
$pendingComments = $comment->getPendingComments();
$allComments = $comment->getAllComments();
?>

<div class="container my-5">
    <h1>Pending Comments</h1>
    <?php if (!empty($pendingComments)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Comment ID</th>
                    <th>Book Title</th>
                    <th>User</th>
                    <th>Content</th>
                    <th>Submitted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendingComments as $pendingComment): ?>
                    <tr id="comment-<?= htmlspecialchars($pendingComment['comment_id']) ?>">
                        <td><?= htmlspecialchars($pendingComment['comment_id']) ?></td>
                        <td><?= htmlspecialchars($pendingComment['book_title']) ?></td>
                        <td><?= htmlspecialchars($pendingComment['username']) ?></td>
                        <td><?= nl2br(htmlspecialchars($pendingComment['content'])) ?></td>
                        <td><?= htmlspecialchars($pendingComment['created_at']) ?></td>
                        <td>
                            <button class="btn btn-success btn-sm action-btn" data-comment-id="<?= htmlspecialchars($pendingComment['comment_id']) ?>" data-action="approve">Approve</button>
                            <button class="btn btn-danger btn-sm action-btn" data-comment-id="<?= htmlspecialchars($pendingComment['comment_id']) ?>" data-action="reject">Reject</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No pending comments.</p>
    <?php endif; ?>
</div>


<div class="container mt-5">
    <h1>All Comments</h1>
    <?php if (!empty($allComments)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Comment ID</th>
                    <th>Book Title</th>
                    <th>User</th>
                    <th>Content</th>
                    <th>Submitted At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allComments as $comment): ?>
                    <tr id="comment-<?= htmlspecialchars($comment['comment_id']) ?>">
                        <td><?= htmlspecialchars($comment['comment_id']) ?></td>
                        <td><?= htmlspecialchars($comment['book_title']) ?></td>
                        <td><?= htmlspecialchars($comment['username']) ?></td>
                        <td><?= nl2br(htmlspecialchars($comment['content'])) ?></td>
                        <td><?= htmlspecialchars($comment['created_at']) ?></td>
                        <td>
                            <?php
                            if ($comment['is_approved'] == 1) {
                                echo '<span class="badge bg-success">Approved</span>';
                            } elseif ($comment['is_rejected'] == 1) {
                                echo '<span class="badge bg-danger">Rejected</span>';
                            } else {
                                echo '<span class="badge bg-warning">Pending</span>';
                            }
                            ?>
                        </td>
                        <td>

                            <button class="btn btn-secondary btn-sm delete-comment-btn" data-comment-id="<?= htmlspecialchars($comment['comment_id']) ?>">Delete</button>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No comments found.</p>
    <?php endif; ?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to load comments dynamically
        function loadComments() {
            $.ajax({
                url: 'fetch/fetch-comments.php', // Updated path
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Populate pending comments
                    let pendingRows = '';
                    data.pendingComments.forEach(function(comment) {
                        pendingRows += `
                        <tr id="comment-${comment.comment_id}">
                            <td>${comment.comment_id}</td>
                            <td>${comment.book_title}</td>
                            <td>${comment.username}</td>
                            <td>${comment.content}</td>
                            <td>${comment.created_at}</td>
                            <td>
                                <button class="btn btn-success btn-sm action-btn" data-comment-id="${comment.comment_id}" data-action="approve">Approve</button>
                                <button class="btn btn-danger btn-sm action-btn" data-comment-id="${comment.comment_id}" data-action="reject">Reject</button>
                            </td>
                        </tr>
                    `;
                    });
                    $('#pendingCommentsTableBody').html(pendingRows);

                    // Populate all comments
                    let allRows = '';
                    data.allComments.forEach(function(comment) {
                        const statusBadge = comment.is_approved == 1 ?
                            '<span class="badge bg-success">Approved</span>' :
                            (comment.is_rejected == 1 ? '<span class="badge bg-danger">Rejected</span>' : '<span class="badge bg-warning">Pending</span>');

                        allRows += `
                        <tr id="comment-${comment.comment_id}">
                            <td>${comment.comment_id}</td>
                            <td>${comment.book_title}</td>
                            <td>${comment.username}</td>
                            <td>${comment.content}</td>
                            <td>${comment.created_at}</td>
                            <td>${statusBadge}</td>
                            <td>
                                <button class="btn btn-secondary btn-sm delete-comment-btn" data-comment-id="${comment.comment_id}">Delete</button>
                            </td>
                        </tr>
                    `;
                    });
                    $('#allCommentsTableBody').html(allRows);
                },
                error: function() {
                    Swal.fire('Error loading comments.', '', 'error');
                }
            });
        }

        // Initial load of comments
        loadComments();

        // Approve/Reject button handler
        $(document).on('click', '.action-btn', function() {
            const commentId = $(this).data('comment-id');
            const action = $(this).data('action');

            $.ajax({
                url: 'comment-action.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    comment_id: commentId,
                    action: action
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: `Comment ${action}d successfully.`,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        loadComments(); // Reload comments after action
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'An error occurred while processing the request.',
                        icon: 'error',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });
        });

        // Delete button handler
        $(document).on('click', '.delete-comment-btn', function() {
            const commentId = $(this).data('comment-id');

            $.ajax({
                url: 'comment-action.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    comment_id: commentId,
                    action: 'delete'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: response.message,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        loadComments(); // Reload comments after delete
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'An error occurred while trying to delete the comment.',
                        icon: 'error',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });
        });
    });
</script>