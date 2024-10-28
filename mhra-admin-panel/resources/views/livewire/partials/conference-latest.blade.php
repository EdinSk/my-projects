<div>
    <div class="conference-container">
        @if($conference)
        <div class="hero" style="background-image: url('{{ $conference->hero_image_url }}');">
            <div class="overlay">
                <h2>{{ $conference->title }}</h2>
                <p>{{ \Carbon\Carbon::parse($conference->start_date)->format('d-m-Y') }} to
                    {{ \Carbon\Carbon::parse($conference->end_date)->format('d-m-Y') }}
                </p>
                <p>{{ $conference->location }}</p>
                <p>{{ $conference->description }}</p>
            </div>
        </div>
        @else
        <p>No latest conference available.</p>
        @endif
    </div>
    <!-- badges -->
    <div class="my-4 border-top">
        @livewire('event-badges')
    </div>


    @livewire('event-detail', ['eventId' => $conference->id])

    <!-- event agenda -->

    @livewire('event-agenda', ['eventId' => $conference->id])

    <!-- event speakers -->

    @livewire('event-speakers', ['eventId' => $conference->id])

    <style>
        .conference-container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .hero {
            width: 100%;
            height: 400px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h2,
        p {
            margin: 10px 0;
        }
    </style>

</div>