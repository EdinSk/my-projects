@extends('layouts.app')

@section('content')
<!-- hero -->
<div class="container mt-5">
    <div class="row">
        <!-- Event Main Section -->
        <div class="col-12">
            <div class="position-relative rounded-4 overflow-hidden shadow-sm">
                <!-- Background Image -->
                <img src="https://picsum.photos/1200/400" alt="Event Image" class="img-fluid w-100" style="object-fit: cover; height: 400px;">

                <!-- Text Overlay -->
                <div class="position-absolute top-0 start-0 p-5 text-white" style="background: rgba(0, 0, 0, 0.6); width: 100%; height: 100%;">
                    <p class="small">Настан</p>
                    <h2 class="fw-bold">{{ str_replace('_', ' ', $event->event_type) }}</h2>
                    <!-- Dynamically display the event title -->
                    <p>{{ \Carbon\Carbon::parse($event->start_date)->format('d F, Y') }}</p> <!-- Dynamically display the event date -->
                </div>

                <!-- Social Media Section -->
                <div class="position-absolute bottom-0 end-0 p-3" style="background: rgba(0, 0, 0, 0.7);">
                    <span class="text-white me-3">Заследи не на социјалните медиуми:</span>
                    <a href="#" class="text-white me-2"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- badges -->
<div class="my-4 border-top">
    @livewire('event-badges')
</div>

<!-- event deteails -->

@livewire('event-detail', ['eventId' => $event->id])

<!-- event agenda -->

@livewire('event-agenda', ['eventId' => $event->id])

<!-- event speakers -->

@livewire('event-speakers', ['eventId' => $event->id])


@endsection