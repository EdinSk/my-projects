<?php
session_start(); // Start the session at the top of your PHP file

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']); // Assuming user_id is used for authentication
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin'; // Check if the user is an admin
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/index.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../../../2nd_Project/js/index.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>

<body>
  <!-- NavBar -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="../../../2nd_Project/index.php">Brainster Library</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link fw-semibold" aria-current="page" href="/../2nd_Project/index.php">Home</a>
          </li>

          <!-- Show Register and Login links only if the user is not logged in -->
          <?php if (!$isLoggedIn): ?>
            <li class="nav-item">
              <a class="nav-link fw-semibold" href="/../2nd_Project/register.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-semibold" href="/../2nd_Project/login.php">Login</a>
            </li>
          <?php else: ?>
            <!-- Show User Dashboard or Admin Dashboard based on role -->
            <ul class="navbar-nav ms-auto">
              <?php if ($isAdmin): ?>
                <!-- If user is an admin, show the Admin Dashboard link -->
                <li class="nav-item">
                  <a class="nav-link fw-semibold" href="/../2nd_Project/admin_dashboard/admin.php">Dashboard</a>
                </li>
              <?php else: ?>
                <!-- If user is not an admin, show the User Dashboard link -->
                <li class="nav-item">
                  <a class="nav-link fw-semibold" href="/../2nd_Project/user_dashboard/user_dashboard.php">User Dashboard</a>
                </li>
              <?php endif; ?>

              <!-- Logout Link for all logged-in users -->
              <li class="nav-item">
                <a class="nav-link fw-semibold" href="/../2nd_Project/php/logout.php">Logout</a>
              </li>
            </ul>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- NavBar -->