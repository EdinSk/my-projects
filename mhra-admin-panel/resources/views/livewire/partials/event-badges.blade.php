@php
    $chunks = collect($badges)->chunk(3); // Convert array to collection and chunk into groups of 3
@endphp

<div class="container mt-5">
    <div id="badgeCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicators -->
        <div class="carousel-indicators">
            @foreach($chunks as $index => $chunk)
                <button type="button" data-bs-target="#badgeCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            @foreach($chunks as $chunkIndex => $badgeChunk)
                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                    <div class="row">
                        @foreach($badgeChunk as $badge)
                            <div class="col-md-4">
                                <div class="badge-circle d-flex align-items-center justify-content-center" style="background-image: url('{{ $badge->icon_url }}');">
                                    <div class="text-center text-white">
                                        <h4>{{ $badge->name }}</h4>
                                        <p>{{ $badge->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#badgeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#badgeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <style>
        .badge-circle {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background-size: cover;
            margin: 20px auto;
            position: relative;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .badge-circle h4,
        .badge-circle p {
            margin: 0;
            color: white;
        }

        .badge-circle:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myCarousel = document.querySelector('#badgeCarousel');
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: 2000, // Cycle every 2 seconds
                wrap: true // Continuous cycle
            });
        });
    </script>
</div>
