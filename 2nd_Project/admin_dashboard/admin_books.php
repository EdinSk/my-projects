<?php
require_once '../../2nd_Project/php/classes/Book.php';

$bookObj = new Book();
$categories = $bookObj->getCategories();
$authors = $bookObj->getAuthors();
?>

<div class="container my-5">
    <h1>Manage Books</h1>

    <!-- Books Table -->
    <h2>Books</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Year of Publication</th>
                <th>Number of Pages</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="bookTableBody">
            <!-- Books will be dynamically loaded here -->
        </tbody>
    </table>

    <!-- Book Form (Add/Edit) -->
    <h2 id="formTitle">Add New Book</h2>
    <form id="bookForm" enctype="multipart/form-data">
        <input type="hidden" name="action" id="formAction" value="create">
        <input type="hidden" name="book_id" id="bookId">
        <div class="form-group">
            <label for="book_title">Title:</label>
            <input type="text" name="book_title" id="book_title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="author_id">Author:</label>
            <select name="author_id" id="author_id" class="form-control" required>
                <option value="">Select Author</option>
                <?php foreach ($authors as $author): ?>
                    <option value="<?= $author['author_id']; ?>">
                        <?= htmlspecialchars($author['first_name'] . ' ' . $author['last_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="category_id">Category:</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Select Category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['category_id']; ?>">
                        <?= htmlspecialchars($category['title']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="year_of_publication">Year of Publication:</label>
            <input type="number" name="year_of_publication" id="year_of_publication" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="number_of_pages">Number of Pages:</label>
            <input type="number" name="number_of_pages" id="number_of_pages" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="image">Book Image:</label>
            <input type="file" name="image" id="image" accept="image/*" class="form-control-file">
            <img id="previewImage" src="#" alt="Book Image" style="display: none; max-width: 100px; margin-top: 10px;">
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
        // Function to load books dynamically
        function loadBooks() {
            $.ajax({
                url: 'fetch/fetch-books.php',
                type: 'GET',
                dataType: 'json',
                success: function(books) {
                    let rows = '';
                    books.forEach(function(book) {
                        rows += `
                        <tr id="book-${book.id}">
                            <td>${book.id}</td>
                            <td>${book.title}</td>
                            <td>${book.first_name} ${book.last_name}</td>
                            <td>${book.category}</td>
                            <td>${book.year_of_publication}</td>
                            <td>${book.number_of_pages}</td>
                            <td><img src="../${book.image_url}" alt="Book Image" style="max-width: 50px;"></td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-book-btn"
                                    data-book-id="${book.id}"
                                    data-book-title="${htmlEscape(book.title)}"
                                    data-author-id="${book.author_id}"
                                    data-category-id="${book.category_id}"
                                    data-year-of-publication="${book.year_of_publication}"
                                    data-number-of-pages="${book.number_of_pages}"
                                    data-image-url="${book.image_url}"
                                >Edit</button>
                                <button class="btn btn-sm btn-danger delete-book-btn" data-book-id="${book.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                    });
                    $('#bookTableBody').html(rows);
                },
                error: function() {
                    Swal.fire('Error loading books.', '', 'error');
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
                .replace(/>/g, '&gt;');
        }

        // Initial load of books
        loadBooks();

        // Preview selected image
        $('#image').on('change', function() {
            const file = this.files[0];
            if (file) {
                $('#previewImage').attr('src', URL.createObjectURL(file)).show();
            }
        });

        // Submit form (create or update book)
        $('#bookForm').on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                url: 'book-action.php',
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false, // Important for file upload
                processData: false, // Important for file upload
                success: function(response) {
                    Swal.fire(response.message, '', response.success ? 'success' : 'error');
                    if (response.success) {
                        // Reset form and reload books
                        loadBooks();
                        $('#bookForm')[0].reset();
                        $('#formTitle').text('Add New Book');
                        $('#formAction').val('create');
                        $('#bookId').val('');
                        $('#previewImage').hide();
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error processing request.', '', 'error');
                    console.error('AJAX Error:', error);
                }
            });
        });

        // Delete book
        $(document).on('click', '.delete-book-btn', function() {
            const bookId = $(this).data('book-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'book-action.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            action: 'delete',
                            book_id: bookId
                        },
                        success: function(response) {
                            Swal.fire(response.message, '', response.success ? 'success' : 'error');
                            if (response.success) {
                                loadBooks();
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error processing request: ' + xhr.responseText, '', 'error');
                            console.error('AJAX Error:', error);
                        }
                    });
                }
            });
        });

        // Edit book (populate form)
        $(document).on('click', '.edit-book-btn', function() {
            const bookId = $(this).data('book-id');
            const bookTitle = $(this).data('book-title');
            const authorId = $(this).data('author-id');
            const categoryId = $(this).data('category-id');
            const yearOfPublication = $(this).data('year-of-publication');
            const numberOfPages = $(this).data('number-of-pages');
            const imageUrl = $(this).data('image-url');

            $('#formTitle').text('Edit Book');
            $('#formAction').val('update');
            $('#bookId').val(bookId);
            $('#book_title').val(bookTitle);
            $('#author_id').val(authorId);
            $('#category_id').val(categoryId);
            $('#year_of_publication').val(yearOfPublication);
            $('#number_of_pages').val(numberOfPages);
            $('#previewImage').attr('src', '../' + imageUrl).show();
        });
    });
</script>