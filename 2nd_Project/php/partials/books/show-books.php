<?php require_once "../2nd_Project/php/partials/books/get-books.php" ?>

<div class="container my-4 py-3">
    <div class="row" id="books-list-container">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $bookRow): ?>
                <div class="col-md-4 mb-4 d-flex book-item" data-category="<?= $bookRow['category'] ?>">
                    <div class="card h-100 col-10 mx-auto">
                        <div class="card-img-wrapper" style="height: 200px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                            <img src="<?= htmlspecialchars($bookRow['image_url']) ?>" class="card-img-top w-100" alt="<?= htmlspecialchars($bookRow['title']) ?>" style="height: 100%; width: auto;">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-center flex-grow-1">
                                <?= htmlspecialchars($bookRow['title']) ?>
                            </h5>
                            <p class="card-text"><strong>Author:</strong> <?= htmlspecialchars($bookRow['author_name']) ?></p>
                            <p class="card-text"><strong>Year of Publication:</strong> <?= htmlspecialchars($bookRow['year_of_publication']) ?></p>
                            <p class="card-text"><strong>Number of Pages:</strong> <?= htmlspecialchars($bookRow['number_of_pages']) ?></p>
                            <p class="card-text"><strong>Category:</strong> <?= htmlspecialchars($bookRow['category']) ?></p>
                            <a href="book-single.php?id=<?= urlencode($bookRow['id']) ?>" class="btn btn-primary mt-auto align-self-center">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No books found.</p>
        <?php endif; ?>
    </div>
</div>
