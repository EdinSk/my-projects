<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <footer>
            <p id="random-quote" class="fixed-bottom text-center bg-dark text-white mb-0">Loading...</p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Include jQuery library (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script to fetch random quote and update footer -->
<script>
$(document).ready(function() {
    // Function to fetch random quote
    function fetchRandomQuote() {
        $.ajax({
            url: 'https://api.quotable.io/random',
            dataType: 'json',
            success: function(data) {
                // Update the random quote element
                $('#random-quote').text(data.content);
            },
            error: function() {
                $('#random-quote').text('Failed to fetch random quote.'); // Error handling
            }
        });
    }

    // Fetch random quote when the page loads
    fetchRandomQuote();
});
</script>

</body>

</html>