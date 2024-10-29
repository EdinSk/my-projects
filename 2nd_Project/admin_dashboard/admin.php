<?php

require_once __DIR__ . '/../php/partials/nav-bar.php';


require_once '../../2nd_Project/php/partials/admin_navbar.php';


require_once __DIR__ . '/../php/partials/footer.php';

?>

<script>
    $(document).ready(function() {
        // Handle sidebar link clicks
        $('#admin-sidebar a.nav-link').click(function(event) {
            event.preventDefault(); // Prevent the default link action

            // Get the page to load from the data attribute
            var page = $(this).data('page');

            // Load the content from the selected page into #admin-content
            $('#admin-content').load(page, function(response, status, xhr) {
                if (status == "error") {
                    $('#admin-content').html("<p>Error loading page.</p>");
                }
            });

            // Highlight the active link
            $('#admin-sidebar a.nav-link').removeClass('active');
            $(this).addClass('active');
        });

        // Optionally, load a default page when the dashboard loads
        $('#admin-content').load('categories.php');
    });
</script>