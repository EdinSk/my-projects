<div class="container py-5">
    <h2 class="mb-4">Актуелни настани</h2>

    <div class="row">
        @foreach ($events as $event)
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="row g-0">
                    <!-- Image section -->
                    <div class="col-md-6">
                        <img src="https://picsum.photos/400" class="img-fluid rounded-start" alt="{{ $event->title }}">
                    </div>

                    <!-- Event Info section -->
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($event->description, 80) }}</p>
                            <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none text-primary">Прочитај повеќе</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Show "View All Events" button only if we're not on the events.index route -->
    <div class="text-center mt-4">
        <a href="{{ route('events.index') }}" class="btn btn-primary">View All Events</a>
    </div>

</div>