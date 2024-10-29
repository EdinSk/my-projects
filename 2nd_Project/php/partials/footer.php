<footer>
    <p id="random-quote" class="fixed-bottom text-center bg-dark text-white mb-0">Loading...</p>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Include jQuery library (if not already included) -->

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>

</html>