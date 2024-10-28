@php
    use Illuminate\Support\Facades\Auth;

    $connections = Auth::user()->connections()->get();

@endphp

<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">Recently Added Connections</h5>
        <ul class="list-group">
            @foreach (Auth::user()->connections as $connection)
                <li class="list-group-item d-flex align-items-center">
                    <img src="{{ $connection->photo_url }}" alt="{{ $connection->first_name }} {{ $connection->last_name }} Profile Image" class="rounded-circle me-2" width="40">
                    <span>{{ $connection->first_name }} {{ $connection->last_name }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
