<div class="container my-5 mx-auto">
    <!-- Check if the agenda exists -->
    @if($agenda)
        <!-- Display the Agenda Title and Description -->
        <h2 class="fw-bold mb-4 text-primary">{{ $agenda->title }}</h2>
        <p class="agenda-description text-muted mb-5">{{ $agenda->description }}</p>

        <!-- Agenda Items -->
        <h3 class="fw-bold mt-5 text-secondary">Агенда на настанот:</h3>
        
        @if($agendaItems->isEmpty())
            <p class="text-danger">No agenda items available for this event.</p>
        @else
            <ul class="agenda-list mt-4">
                @foreach($agendaItems as $item)
                    <li class="agenda-item p-4 mb-4 rounded shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="agenda-time text-success mb-0">{{ $item->start_time }} - {{ $item->end_time }}</h5>
                            <h5 class="text-dark mb-0">{{ $item->title }}</h5>
                        </div>
                        <p class="agenda-description mt-3 text-muted">{{ $item->description }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    @else
        <p class="text-warning">No agenda found for this event.</p>
    @endif

    <!-- Optional CSS -->
    <style>
        .agenda-description {
            margin-top: 1rem;
            font-size: 1.1rem;
        }

        .agenda-list {
            list-style-type: none;
            padding-left: 0;
        }

        .agenda-item {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
        }

        .agenda-time {
            font-weight: bold;
            font-size: 1rem;
        }
    </style>
</div>
