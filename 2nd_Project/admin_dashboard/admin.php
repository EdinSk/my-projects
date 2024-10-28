<?php
require_once "../php/crud/categories.php"; // Include your functions file
require_once "../php/crud/books.php"; // Include your functions file
session_start();


$categoryDAO = new Category(); // Assuming $instance is your PDO instance

$categories = $categoryDAO->getAll();

$book = new Book(); // Assuming $instance is your PDO instance

$books = $book->showBooks();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/index.css">
  <style>
    .h-200 {
      height: 200px;
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
            <a class="nav-link fw-semibold" aria-current="page" href="admin.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold" aria-current="page" href="manage.php">Manage Library</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- NavBar -->

  <!-- categories -->
  <div class="categories d-flex flex-column flex-lg-row flex-wrap">
    <?php if (!empty($categories)) : ?>
      <?php foreach ($categories as $category) : ?>
        <div class="category-item bg-info text-white fw-bold d-flex justify-content-between p-3 col-2 col-2 flex-wrap mt-3 mt-2 ms-1">
          <label class="fs-5 col-10" for="category-<?= htmlspecialchars($category['category_id']) ?>"><?= htmlspecialchars($category['title']) ?></label>
          <input type="checkbox" class="form-check-input m-2 rounded-2" id="category-<?= htmlspecialchars($category['category_id']) ?>">
          <i class="fa-solid fa-circle-check fa-2x align-self-center"></i>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <p>No categories found.</p>
    <?php endif; ?>
  </div>
  <!-- categories -->

  <!-- categories -->
  <!-- Books Table -->
  <div class="container mt-5">
    <h1>Explore Books</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
      <!-- PHP loop to dynamically populate books -->
      <?php foreach ($books as $book) : ?>
        <div class="col col-8">
          <div class="card col-8">
            <img src="<?= htmlspecialchars($book['image_url']) ?>" class="card-img-top h-200" alt="Book Cover">
            <div class="card-body h-200">
              <h5 class="card-title"><?= htmlspecialchars($book['book_title']) ?></h5>
              <p class="card-text fw-semibold">By <?= htmlspecialchars($book['first_name'] . ' ' . $book['last_name']) ?></p>
              <p class="card-text fw-semibold">Category: <?= htmlspecialchars($book['title']) ?></p>
              <p class="card-text fw-semibold">Published Year: <?= htmlspecialchars($book['year_of_publication']) ?></p>
              <p class="card-text fw-semibold">Pages: <?= htmlspecialchars($book['number_of_pages']) ?></p>
              <!-- Link to book details page -->
              <a href="../user_dashboard/book_details.php?book_id=<?= htmlspecialchars($book['book_id']) ?>" class="btn btn-primary">View Details</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <!-- categories -->



  <?php require_once "../php/footer.php"?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="./js/index.js"></script>
</body>

</html>