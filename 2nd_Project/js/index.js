document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll('#filter-form input[type="checkbox"]');
    const books = document.querySelectorAll('.book-item');

    function filterBooks() {
        let selectedCategory = '';

        // Find the first checkbox that is checked
        checkboxes.forEach(function (checkbox) {
            if (checkbox.checked) {
                selectedCategory = checkbox.value.toLowerCase();
            }
        });

        books.forEach(function (bookItem) {
            const bookCategory = bookItem.dataset.category;

            if (selectedCategory === '') {
                // If no checkbox is selected, show all books
                bookItem.style.display = 'block';
            } else if (bookCategory === selectedCategory) {
                // Show books that match the selected category
                bookItem.style.display = 'block';
            } else {
                // Hide books that don't match
                bookItem.style.display = 'none';
            }
        });
    }

    // Add event listeners to the checkboxes
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', filterBooks);
    });

    // Initial filter on page load
    filterBooks();
});


