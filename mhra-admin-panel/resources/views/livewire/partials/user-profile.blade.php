<div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- Left Column: User Profile Image and Basic Info -->
                <div class="col-md-4 text-center">
                    <img
                        src="{{ Auth::user()->photo_url ? asset('storage/' . Auth::user()->photo_url) : asset('images/about/foto.png') }}"
                        alt="Profile Image"
                        class="img-fluid rounded-bottom mx-auto">
                    <h3>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                    <p>{{ Auth::user()->title }}</p>
                    <p>{{ Auth::user()->email }}</p>
                    <p>{{ Auth::user()->phone }}</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userSettingsModal">
                        Поставки
                    </button>

                    @livewire('user-settings')

                </div>

                <!-- Right Column: Additional User Info -->
                <div class="col-md-8">
                    <h4>About</h4>
                    <p>{{ Auth::user()->bio }}</p>

                    <h4>Location</h4>
                    <p>{{ Auth::user()->city }}, {{ Auth::user()->country }}</p>

                    <h4>Role</h4>
                    <p>{{ Auth::user()->role }}</p>

                    <h4>CV</h4>
                    @if(Auth::user()->cv_url)
                    <a href="{{ Auth::user()->cv_url }}" target="_blank">Download CV</a>
                    @else
                    <p>No CV available</p>
                    @endif

                    @livewire('partials.user-recommendations')

                </div>
            </div>
        </div>
    </div>



    <style>
        .card {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .card-body {
            padding: 30px;
        }

        .img-fluid {
            max-width: 150px;
            height: auto;
            margin-bottom: 15px;
            border-radius: 50%;
            border: 3px solid #ddd;
        }

        h3 {
            margin-top: 10px;
            color: #333;
        }

        h4 {
            margin-top: 20px;
            color: #333;
        }
    </style>
</div>