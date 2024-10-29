<?php
require_once '../../2nd_Project/php/classes/Category.php';
?>

<div class="container my-5">
    <h1>Manage Categories</h1>

    <!-- Categories Table -->
    <h2>Categories</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Category ID</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="categoryTableBody">
            <!-- Categories will be dynamically loaded here -->
        </tbody>
    </table>

    <!-- Category Form (Add/Edit) -->
    <h2 id="formTitle">Add New Category</h2>
    <form id="categoryForm">
        <input type="hidden" name="action" id="formAction" value="create">
        <input type="hidden" name="category_id" id="categoryId">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Function to load categories dynamically
        function loadCategories() {
            $.ajax({
                url: 'fetch/fetch-categories.php', // Adjust the path if necessary
                type: 'GET',
                dataType: 'json',
                success: function(categories) {
                    let rows = '';
                    categories.forEach(function(category) {
                        rows += `
                        <tr id="category-${category.category_id}">
                            <td>${category.category_id}</td>
                            <td>${category.title}</td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-category-btn" data-category='${JSON.stringify(category)}'>Edit</button>
                                <button class="btn btn-sm btn-danger delete-category-btn" data-category-id="${category.category_id}">Delete</button>
                            </td>
                        </tr>
                    `;
                    });
                    $('#categoryTableBody').html(rows);
                },
                error: function() {
                    Swal.fire('Error loading categories.', '', 'error');
                }
            });
        }

        // Initial load of categories
        loadCategories();

        // Submit form (create or update category)
        $('#categoryForm').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url: 'category-action.php', // Ensure this path is correct
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function(response) {
                    Swal.fire(response.message, '', response.success ? 'success' : 'error');
                    if (response.success) {
                        loadCategories(); // Reload categories after add or update
                        $('#categoryForm')[0].reset();
                        $('#formTitle').text('Add New Category');
                        $('#formAction').val('create');
                    }
                },
                error: function() {
                    Swal.fire('Error processing request.', '', 'error');
                }
            });
        });

        // Delete category
        // Delete category
        $(document).on('click', '.delete-category-btn', function() {
            const categoryId = $(this).data('category-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'category-action.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            action: 'delete',
                            category_id: categoryId
                        },
                        success: function(response) {
                            Swal.fire(response.message, '', response.success ? 'success' : 'error');
                            if (response.success) {
                                loadCategories(); // Reload categories after delete
                            }
                        },
                        error: function() {
                            Swal.fire('Error deleting category.', '', 'error');
                        }
                    });
                }
            });
        });
        // Edit category (populate form)
        $(document).on('click', '.edit-category-btn', function() {
            const category = $(this).data('category');
            $('#formTitle').text('Edit Category');
            $('#formAction').val('update');
            $('#categoryId').val(category.category_id);
            $('#title').val(category.title);
        });
    });
</script>