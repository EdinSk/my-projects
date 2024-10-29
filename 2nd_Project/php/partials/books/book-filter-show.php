<?php require_once "../2nd_Project/php/partials/books/book-filter.php" ?>

<form method="GET" id="filter-form" class="p-5 border rounded shadow-lg bg-white">
    <div class="row justify-content-center" >
        <div class="col-12">
            <h3 class="mb-4 text-center text-primary">Filter by Category</h3>
            <div class="filters row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 gap-3 justify-content-center">
                <?php
                if (is_array($categories) && count($categories) > 0):
                    foreach ($categories as $row): ?>
                        <div class="filter-item bg-tuna text-white fw-bold d-flex justify-content-between align-items-center p-3 col position-relative" >
                            <input type="checkbox"
                                class="form-check-input m-2 rounded-2"
                                name="categories[]"
                                value="<?= htmlspecialchars(strtolower($row['title'])) ?>"
                                id="category-<?= htmlspecialchars($row['title']) ?>"
                                <?= in_array(strtolower($row['title']), $selectedCategories) ? 'checked' : '' ?>>
                            <label class="fs-5 mb-0 flex-grow-1 text-truncate text-center"
                                for="category-<?= htmlspecialchars($row['title']) ?>" style="flex-basis: 0;">
                                <?= htmlspecialchars($row['title']) ?>
                            </label>
                            <i class="fa-solid fa-circle-check fa-2x align-self-center"></i>
                        </div>
                    <?php endforeach;
                else: ?>
                    <p class="text-muted">No categories found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</form>

<style>
    .bg-tuna {
        background-color: #343a40;
    }

    .filter-item {
        position: relative;
    }

    .filter-item:hover {
        cursor: pointer;
        background-color: #495057;
    }

    .filter-item input[type="checkbox"] {
        opacity: 0;
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        margin: 0;
        cursor: pointer;
    }

    .filter-item input[type="checkbox"]:checked+label+i {
        color: #0d6efd;
    }
</style>

<script>
    $(document).ready(function() {
        $('#filter-form input[type="checkbox"]').change(function() {
            const parentDiv = $(this).closest('.filter-item');
            if ($(this).is(':checked')) {
                parentDiv.css({
                    'background-color': '#0d6efd',
                    'color': 'white'
                });
                parentDiv.find('i').addClass('text-white');
            } else {
                parentDiv.css({
                    'background-color': '#343a40',
                    'color': 'white'
                });
                parentDiv.find('i').removeClass('text-white');
            }

            const formData = $('#filter-form').serialize();
            const newUrl = `${window.location.pathname}?${formData}`;
            window.history.pushState(null, '', newUrl);

            // Reload the page to apply the filter
            location.reload();
        });

        // Apply initial styles to checked checkboxes on page load
        $('#filter-form input[type="checkbox"]:checked').each(function() {
            const parentDiv = $(this).closest('.filter-item');
            parentDiv.css({
                'background-color': '#0d6efd',
                'color': 'white'
            });
            parentDiv.find('i').addClass('text-white');
        });
    });
</script>