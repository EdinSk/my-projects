<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'MHRA' }}</title>

    <!-- Include Vite assets for CSS and JavaScript -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @fluxStyles

    <!-- Include Font Awesome for Icons (Optional) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="font-sans antialiased">

    <!-- Include the Livewire navigation component -->
    @livewire('layout.navigation')

    <!-- Yield content -->
    <div>
        @yield('content')
    </div>

    @auth
    @if (!auth()->user()->isAdmin())
    @livewire('layout.footer')
    @endif
    @endauth

    <!-- Include Livewire Scripts -->
    @livewireScripts
    @fluxScripts

    <!-- Include Bootstrap JS and dependencies (optional, if not using Vite) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.min.js"></script>
    <script data-navigate-once src="bootstrap.js"></script>


    <script>
        document.addEventListener('livewire:navigated', function() {
            const navbarCollapse = document.getElementById('navbarNav');
            const navbarToggler = document.querySelector('.navbar-toggler');

            // Function to update the navbar state based on window size
            function updateNavbarState() {
                if (window.innerWidth >= 992) { // Desktop width (lg and up)
                    navbarCollapse.classList.add('collapse-show');
                    navbarCollapse.classList.remove('collapse');
                } else {
                    navbarCollapse.classList.add('collapse');
                    navbarCollapse.classList.remove('collapse-show');
                }
            }

            // Initial check when the page loads
            updateNavbarState();

            // Adjust the navbar on window resize
            window.addEventListener('resize', updateNavbarState);

            // Toggle navbar on hamburger menu click
            navbarToggler.addEventListener('click', function() {
                navbarCollapse.classList.toggle('collapse-show');
                navbarCollapse.classList.remove('collapse show');
            });
        });
    </script>

</body>

</html>