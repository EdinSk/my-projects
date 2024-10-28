<?php
session_start();
require_once "../php/crud/categories.php";
require_once "../php/crud/books.php"; 

$categoryDAO = new Category(); 
$categories = $categoryDAO->getAll();

$bookDAO = new Book(); 
$books = $bookDAO->showBooks();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Public Library</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/index.css">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <h4 class="me-3">Public Library</h4>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link fw-semibold" aria-current="page" href="user_dashboard.php">Home</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link fw-semibold" aria-current="page" href="../php/logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  <!-- Categories -->
  <div class="categories d-flex flex-column flex-lg-row flex-wrap">
    <?php if (!empty($categories)) : ?>
      <?php foreach ($categories as $category) : ?>
        <div class="category-item bg-info text-white fw-bold d-flex justify-content-between p-3 col-2 col-2 flex-wrap mt-3 mt-2 ms-1">
          <label class="fs-5 col-10" for="category-<?= htmlspecialchars($category['category_id']) ?>"><?= htmlspecialchars($category['title']) ?></label>
          <input type="checkbox" class="form-check-input m-2 rounded-2 category-checkbox" id="category-<?= htmlspecialchars($category['category_id']) ?>">
          <i class="fa-solid fa-circle-check fa-2x align-self-center"></i>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <p>No categories found.</p>
    <?php endif; ?>
  </div>
  <!-- End Categories -->

  <!-- Books Table -->
  <div class="container my-5">
    <h1 class="mb-4">Explore Books</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($books as $book) : ?>
        <div class="col-8 mt-4 book-item <?= 'category-' . htmlspecialchars($book['category_id']) ?>">
          <div class="card col-8">
            <img src="<?= htmlspecialchars($book['image_url']) ?>" class="card-img-top h-200" alt="Book Cover">
            <div class="card-body h-200">
              <h5 class="card-title"><?= htmlspecialchars($book['book_title']) ?></h5>
              <p class="card-text fw-semibold">By <?= htmlspecialchars($book['first_name'] . ' ' . $book['last_name']) ?></p>
              <p class="card-text fw-semibold">Category: <?= htmlspecialchars($book['title']) ?></p>
              <p class="card-text fw-semibold">Published Year: <?= htmlspecialchars($book['year_of_publication']) ?></p>
              <p class="card-text fw-semibold">Pages: <?= htmlspecialchars($book['number_of_pages']) ?></p>
              <a href="../user_dashboard/book_details.php?book_id=<?= htmlspecialchars($book['book_id']) ?>" class="btn btn-primary">View Details</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <!-- End Books Table -->

  <?php require_once "../php/footer.php" ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>  $(document).ready(function() {

    $('.category-checkbox').change(function() {
        var selectedCategories = [];


        $('.category-checkbox:checked').each(function() {
            var categoryId = $(this).attr('id').split('-')[1];
            selectedCategories.push(categoryId);
        });

        if (selectedCategories.length > 0) {

            $('.book-item').each(function() {
                var showBook = false;
                var classes = $(this).attr('class').split(' ');


                $.each(classes, function(index, className) {
                    if (className.startsWith('category-')) {
                        var bookCategoryId = className.split('-')[1];
                        if ($.inArray(bookCategoryId, selectedCategories) !== -1) {
                            showBook = true;
                            return false; 
                        }
                    }
                });


                if (showBook) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        } else {

            $('.book-item').show();
        }
    });
});
</script>

</body>

</html>