<div class="container my-5 mx-auto">
    <h2 class="fw-bold">Говорници на настанот:</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($speakers as $speaker)
        <div class="col text-center">
            <div class="card shadow-sm">
                <!-- Speaker Photo -->
                <img src="https://picsum.photos/1200" class="card-img-top rounded-circle mx-auto d-block mt-4" style="width: 150px; height: 150px;" alt="{{ $speaker->first_name }} {{ $speaker->last_name }}">

                <div class="card-body">
                    <h5 class="card-title">{{ $speaker->first_name }} {{ $speaker->last_name }}</h5>
                    <p class="card-text">{{ $speaker->title }}<br>{{ $speaker->company }}</p>

                    <!-- Social Media Links -->
                    <div class="d-flex justify-content-center">
                        @if($speaker->x_url)
                            <a href="{{ $speaker->x_url }}" class="mx-2"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if($speaker->linkedin_url)
                            <a href="{{ $speaker->linkedin_url }}" class="mx-2"><i class="fab fa-linkedin"></i></a>
                        @endif
                        @if($speaker->facebook_url)
                            <a href="{{ $speaker->facebook_url }}" class="mx-2"><i class="fab fa-facebook"></i></a>
                        @endif
                        @if($speaker->instagram_url)
                            <a href="{{ $speaker->instagram_url }}" class="mx-2"><i class="fab fa-instagram"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Optional CSS for Styling -->
    <style>
        .card {
            border-radius: 30px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #FF6F61; /* Customize as needed */
        }

        .card-text {
            color: #6c757d;
        }

        .card-img-top {
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .social-links i {
            font-size: 1.5rem;
            color: #007bff; /* Customize color */
        }
    </style>
</div>
