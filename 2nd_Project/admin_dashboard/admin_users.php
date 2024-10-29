<?php
require_once '../../2nd_Project/php/classes/user.php';
$userObj = new User();
$allUsers = $userObj->getAllUsers();
?>

<div class="container my-5">
    <h1>Manage Users</h1>

    <!-- User Table -->
    <h2>Users</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
            <?php foreach ($allUsers as $singleUser): ?>
                <tr id="user-<?= htmlspecialchars($singleUser['user_id']) ?>">
                    <td><?= htmlspecialchars($singleUser['user_id']) ?></td>
                    <td><?= htmlspecialchars($singleUser['username']) ?></td>
                    <td><?= htmlspecialchars($singleUser['email']) ?></td>
                    <td><?= htmlspecialchars($singleUser['role']) ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning edit-user-btn" data-user='<?= json_encode($singleUser) ?>'>Edit</button>
                        <button class="btn btn-sm btn-danger delete-user-btn" data-user-id="<?= htmlspecialchars($singleUser['user_id']) ?>">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- User Form (Add/Edit) -->
    <h2 id="formTitle">Add New User</h2>
    <form id="userForm">
        <input type="hidden" name="action" id="formAction" value="create">
        <input type="hidden" name="user_id" id="userId">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password or leave blank">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Function to load users and render the table
        function loadUsers() {
            $.ajax({
                url: 'fetch/fetch-users.php',
                type: 'GET',
                dataType: 'json',
                success: function(users) {
                    let rows = '';
                    users.forEach(function(user) {
                        rows += `
                        <tr id="user-${user.user_id}">
                            <td>${user.user_id}</td>
                            <td>${user.username}</td>
                            <td>${user.email}</td>
                            <td>${user.role}</td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-user-btn" data-user='${JSON.stringify(user)}'>Edit</button>
                                <button class="btn btn-sm btn-danger delete-user-btn" data-user-id="${user.user_id}">Delete</button>
                            </td>
                        </tr>
                    `;
                    });
                    $('#userTableBody').html(rows);
                },
                error: function() {
                    Swal.fire('Error loading users.', '', 'error');
                }
            });
        }

        // Initial load of users
        loadUsers();

        // Submit form (create or update user)
        $('#userForm').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            const action = $('#formAction').val();

            $.ajax({
                url: 'user-action.php',
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function(response) {
                    Swal.fire(response.message, '', response.success ? 'success' : 'error');

                    if (response.success) {
                        // Reload users table after add or update
                        loadUsers();
                        $('#userForm')[0].reset();
                        $('#formTitle').text('Add New User');
                        $('#formAction').val('create');
                    }
                },
                error: function() {
                    Swal.fire('Error processing request.', '', 'error');
                }
            });
        });

        // Delete user
        $(document).on('click', '.delete-user-btn', function() {
            const userId = $(this).data('user-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'user-action.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            action: 'delete',
                            user_id: userId
                        },
                        success: function(response) {
                            Swal.fire(response.message, '', response.success ? 'success' : 'error');
                            if (response.success) {
                                // Reload users table after delete
                                loadUsers();
                            }
                        },
                        error: function() {
                            Swal.fire('Error deleting user.', '', 'error');
                        }
                    });
                }
            });
        });

        // Edit user (populate form)
        $(document).on('click', '.edit-user-btn', function() {
            const user = $(this).data('user');
            $('#formTitle').text('Edit User');
            $('#formAction').val('update');
            $('#userId').val(user.user_id);
            $('#username').val(user.username);
            $('#email').val(user.email);
        });
    });
</script>