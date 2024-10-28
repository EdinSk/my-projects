<div class="container my-5 mx-auto">
    <!-- Event Title -->
    <h1 class="fw-bold display-4 text-primary">{{ ucwords(str_replace('_', ' ', $event->event_type)) }}</h1>

    <!-- Event Theme -->
    <h2 class="mt-4 text-secondary">
        ТЕМА: „{{ $event->title }}“
    </h2>

    <div class="row mt-5 align-items-center">
        <div class="col-lg-6">
            <!-- Event Description -->
            <h3 class="text-dark fw-semibold">Опис:</h3>
            <p class="text-muted">{{ $event->description }}</p>

            <!-- Event Objective -->
            <h3 class="text-dark fw-semibold">Цел:</h3>
            <p class="text-muted">{{ $event->objective }}</p>
        </div>

        <!-- Event Image -->
        <div class="col-lg-6 d-flex justify-content-center">
            <div class="position-relative">
                <img src="{{ $event->hero_image_url }}" class="img-fluid rounded-3 shadow" alt="{{ $event->title }}">

                <!-- Call to Action Button -->
                <a href="#" class="btn btn-warning position-absolute bottom-0 start-50 translate-middle-x" style="transform: translateY(50%);">Купи карта</a>
            </div>
        </div>
    </div>
    <!-- Optional CSS -->
<style>
    .img-fluid {
        max-width: 100%;
        height: auto;
        border-radius: 1rem;
    }

    .fw-bold {
        font-weight: bold;
    }

    .fw-semibold {
        font-weight: 600;
    }

    .mt-4 {
        margin-top: 1.5rem;
    }

    .my-5 {
        margin: 3rem 0;
    }

    .shadow {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
</style>

</div>

