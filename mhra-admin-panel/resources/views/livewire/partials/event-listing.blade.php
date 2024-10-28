<div class="event-listing container">
    <!-- HR кафе Section -->
    <h2 class="my-5 border-top">HR кафе</h2>
    <div class="row row-cols-1 py-3 row-cols-md-2 g-4 hr-coffee">
        @foreach($hrCoffeeEvents as $event)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="{{ $event->hero_image_url }}" class="card-img-top" alt="{{ $event->title }}">
                <div class="card-body">
                    <h3 class="card-title">{{ $event->title }}</h3>
                    <p class="card-text">{{ $event->description }}</p>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if(\App\Models\Event::where('event_type', \App\Models\Event::TYPE_HR_COFFEE)->count() > $hrCoffeeVisibleCount)
    <div class="text-center my-4">
        <button wire:click="loadMoreCoffee" class="btn btn-outline-primary mb-3">View More</button>
    </div>
    @endif

    <!-- HR Викенд Section -->
    <h2 class="my-5 border-top">HR Викенд</h2>
    <div class="row row-cols-1 py-3 row-cols-md-2 g-4 hr-weekend">
        @foreach($hrWeekendEvents as $event)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="{{ $event->hero_image_url }}" class="card-img-top" alt="{{ $event->title }}">
                <div class="card-body">
                    <h3 class="card-title">{{ $event->title }}</h3>
                    <p class="card-text">{{ $event->description }}</p>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if(\App\Models\Event::where('event_type', \App\Models\Event::TYPE_HR_WEEKEND)->count() > $hrWeekendVisibleCount)
    <div class="text-center my-4">
        <button wire:click="loadMoreWeekend" class="btn btn-outline-primary mb-3">View More</button>
    </div>
    @endif

    <!-- HR Webinar Section -->
    <h2 class="my-5 border-top">HR Вебинар</h2>
    <div class="row row-cols-1 py-3 row-cols-md-2 g-4 hr-webinar">
        @foreach($hrWebinarEvents as $event)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="{{ $event->hero_image_url }}" class="card-img-top" alt="{{ $event->title }}">
                <div class="card-body">
                    <h3 class="card-title">{{ $event->title }}</h3>
                    <p class="card-text">{{ $event->description }}</p>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if(\App\Models\Event::where('event_type', \App\Models\Event::TYPE_HR_WEBINAR)->count() > $hrWebinarVisibleCount)
    <div class="text-center my-4">
        <button wire:click="loadMoreWebinar" class="btn btn-outline-primary mb-3">View More</button>
    </div>
    @endif

    <!-- HR Conference Section -->
    <h2 class="my-5 border-top">HR Конференции</h2>
    <div class="row row-cols-1 py-3 row-cols-md-2 g-4 hr-conference">
        @foreach($hrConferenceEvents as $event)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="{{ $event->hero_image_url }}" class="card-img-top" alt="{{ $event->title }}">
                <div class="card-body">
                    <h3 class="card-title">{{ $event->title }}</h3>
                    <p class="card-text">{{ $event->description }}</p>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if(\App\Models\Event::where('event_type', \App\Models\Event::TYPE_HR_CONFERENCE)->count() > $hrConferenceVisibleCount)
    <div class="text-center my-4">
        <button wire:click="loadMoreConference" class="btn btn-outline-primary mb-3">View More</button>
    </div>
    @endif

    <!-- Optional CSS to style the layout -->
    <style>
        .card-img-top {
            border-bottom-left-radius: 50%;
            border-bottom-right-radius: 50%;
            object-fit: cover;
            height: 200px;
        }

        .card-title {
            font-size: 1.25rem;
            margin-bottom: 10px;
        }
    </style>
</div>
