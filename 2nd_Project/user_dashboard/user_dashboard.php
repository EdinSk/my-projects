<?php

require_once __DIR__ . '/../php/partials/nav-bar.php';

?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                            <i class="bi bi-house-door"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-person"></i> Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-book"></i> My Books
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-chat-left-text"></i> Comments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-sticky"></i> Notes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-gear"></i> Settings
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-calendar"></i> This Week
                    </button>
                </div>
            </div>

            <div class="row">
                <!-- Profile Summary Card -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Profile Overview</h5>
                            <p class="card-text">Manage your personal details and update your profile.</p>
                            <a href="#" class="btn btn-primary">View Profile</a>
                        </div>
                    </div>
                </div>

                <!-- My Books Card -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">My Books</h5>
                            <p class="card-text">View the books you've saved or purchased.</p>
                            <a href="#" class="btn btn-primary">View Books</a>
                        </div>
                    </div>
                </div>

                <!-- Comments Card -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Comments</h5>
                            <p class="card-text">See your comments and manage them.</p>
                            <a href="#" class="btn btn-primary">View Comments</a>
                        </div>
                    </div>
                </div>

                <!-- Notes Card -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Notes</h5>
                            <p class="card-text">Keep track of your notes on various books.</p>
                            <a href="#" class="btn btn-primary">View Notes</a>
                        </div>
                    </div>
                </div>

                <!-- Settings Card -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Settings</h5>
                            <p class="card-text">Customize your dashboard settings and preferences.</p>
                            <a href="#" class="btn btn-primary">Go to Settings</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php
require_once __DIR__ . '/../php/partials/footer.php'; ?>