<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;">
        </a>

        <!-- Toggle button for mobile nav -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ url('/about') }}" wire:navigate.hover>Информации</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ url('/latest-conference') }}" wire:navigate.hover>Годишна Конференција</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ url('/events') }}" wire:navigate.hover>Настани</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ url('/blogs') }}" wire:navigate.hover>Блог</a>
                </li>
            </ul>

            <!-- Right side of the navbar -->
            <ul class="navbar-nav ms-auto align-items-center">
                <!-- Search Icon -->
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#"><i class="fas fa-search"></i></a>
                </li>
                <!-- Notification Icon -->
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#"><i class="fas fa-bell"></i></a>
                </li>
 

                @auth
                <!-- User Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>@auth
                            {{-- Check if the authenticated user is an admin --}}
                            @if (Auth::user()->isAdmin())
                            <a
                                href="{{ route('admin.dashboard') }}" {{-- Admin Dashboard Link --}}
                                wire:navigate.hover
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Dashboard
                            </a>
                            @else
                            <a
                                href="{{ route('user.dashboard') }}" {{-- User Dashboard Link --}}
                                wire:navigate.hover
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Dashboard
                            </a>
                            @endif
                            @else
                            {{-- If the user is not authenticated, show Login and Register links --}}
                            <a
                                href="{{ route('login') }}"
                                wire:navigate.hover
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Log in
                            </a>

                            @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                wire:navigate.hover
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Register
                            </a>
                            @endif
                            @endauth
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <!-- Login and Join Now Buttons for Guests -->
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-warning text-white ms-2" href="{{ route('register') }}">Join Now</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
</nav>