<div class="d-flex justify-content-between align-items-center py-5 hero-section col-9">
    <!-- Left Section: Text -->
    <div class="hero-text" style="max-width: 45%;">
        <h1 class="display-4 fw-bold">{{ $conference->title }}</h1>
        <p class="lead">{{ $conference->description }}</p>

        <!-- Speaker Information -->
        <div class="d-flex align-items-center mt-4">
            <img src="images/about/image-7.png" class="rounded-circle me-3 speaker-img" alt="Speaker Image" width="60" height="60">
            <div>
                <div class="fw-bold">{{ $conference->speaker_name }}</div>
                <div class="text-muted">Претседател на МАЧР</div> <!-- Adjust title as needed -->
            </div>
        </div>
    </div>

    <!-- Right Section: Image with Buy Ticket Button -->
    <div class="position-relative hero-image" style="max-width: 50%;">
        <img src="https://picsum.photos/1200/400" class="img-fluid rounded-circle main-image" alt="Conference Image">
        <!-- Overlaid Smaller Circular Image -->
        <div class="position-absolute small-circle" style="top: 10%; left: 60%;">
            <img src="images/about/image-5.png" class="img-fluid rounded-circle" alt="Overlay Image 1">
        </div>
        
        <!-- Buy Ticket Button -->
        <a href="#" class="btn btn-warning position-absolute buy-ticket-btn">Купи Карта</a>
    </div>

    <style>
        .hero-section {
            padding: 50px;
            position: relative;
        }

        .hero-text h1 {
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero-image {
            position: relative;
        }

        .main-image {
            width: 100%;
            max-width: 500px;
            /* Limit the size of the image */
            border-radius: 50%;
        }

        .small-circle {
            width: 100px;
            /* Adjust size as needed */
            height: 100px;
        }

        .small-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
            /* Optional: Add a border to match the design */
        }

        .buy-ticket-btn {
            bottom: 20px;
            right: 70px;
            transform: translate(50%, 50%);
            padding: 10px 20px;
            font-size: 1.1rem;
            border-radius: 50px;
        }
    </style>
</div>