<?php
require_once '../../2nd_Project/php/classes/Author.php';
?>

<div class="container my-5">
    <h1>Manage Authors</h1>

    <!-- Authors Table -->
    <h2>Authors</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Author ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Bio</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="authorTableBody">
            <!-- Authors will be dynamically loaded here -->
        </tbody>
    </table>

    <!-- Author Form (Add/Edit) -->
    <h2 id="formTitle">Add New Author</h2>
    <form id="authorForm">
        <input type="hidden" name="action" id="formAction" value="create">
        <input type="hidden" name="author_id" id="authorId">
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="bio">Bio:</label>
            <textarea name="bio" id="bio" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Include jQuery and SweetAlert2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- JavaScript Code -->
<script>
$(document).ready(function() {
    // Function to load authors dynamically
    function loadAuthors() {
        $.ajax({
            url: 'fetch/fetch-authors.php',
            type: 'GET',
            dataType: 'json',
            success: function(authors) {
                let rows = '';
                authors.forEach(function(author) {
                    rows += `
                        <tr id="author-${author.author_id}">
                            <td>${author.author_id}</td>
                            <td>${author.first_name}</td>
                            <td>${author.last_name}</td>
                            <td>${author.bio}</td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-author-btn"
                                    data-author-id="${author.author_id}"
                                    data-first-name="${htmlEscape(author.first_name)}"
                                    data-last-name="${htmlEscape(author.last_name)}"
                                    data-bio="${htmlEscape(author.bio)}"
                                >Edit</button>
                                <button class="btn btn-sm btn-danger delete-author-btn" data-author-id="${author.author_id}">Delete</button>
                            </td>
                        </tr>
                    `;
                });
                $('#authorTableBody').html(rows);
            },
            error: function() {
                Swal.fire('Error loading authors.', '', 'error');
            }
        });
    }

    // Function to escape HTML special characters
    function htmlEscape(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/\n/g, '&#10;'); // Preserve new lines
    }

    // Initial load of authors
    loadAuthors();

    // Submit form (create or update author)
    $('#authorForm').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: 'author-action.php',
            type: 'POST',
            dataType: 'json',
            data: formData,
            success: function(response) {
                Swal.fire(response.message, '', response.success ? 'success' : 'error');
                if (response.success) {
                    loadAuthors();
                    $('#authorForm')[0].reset();
                    $('#formTitle').text('Add New Author');
                    $('#formAction').val('create');
                    $('#authorId').val('');
                }
            },
            error: function() {
                Swal.fire('Error processing request.', '', 'error');
            }
        });
    });

    // Delete author
    $(document).on('click', '.delete-author-btn', function() {
        const authorId = $(this).data('author-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'author-action.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { action: 'delete', author_id: authorId },
                    success: function(response) {
                        Swal.fire(response.message, '', response.success ? 'success' : 'error');
                        if (response.success) {
                            loadAuthors();
                        }
                    },
                    error: function() {
                        Swal.fire('Error deleting author.', '', 'error');
                    }
                });
            }
        });
    });

    // Edit author (populate form)
    $(document).on('click', '.edit-author-btn', function() {
        const authorId = $(this).data('author-id');
        const firstName = $(this).data('first-name');
        const lastName = $(this).data('last-name');
        const bio = $(this).data('bio').replace(/&#10;/g, '\n');

        $('#formTitle').text('Edit Author');
        $('#formAction').val('update');
        $('#authorId').val(authorId);
        $('#first_name').val(firstName);
        $('#last_name').val(lastName);
        $('#bio').val(bio);
    });
});
</script>
