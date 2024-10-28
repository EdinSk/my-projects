@php
    use Illuminate\Support\Facades\Auth;

    // Fetch the authenticated user's badges
    $badges = Auth::user()->badges()->get();
@endphp
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">Your Badges</h5>
        <ul class="list-group">
            @foreach($badges as $badge)
                <li class="list-group-item d-flex align-items-center">
                    <img src="{{ $badge->icon_url }}" alt="Badge Icon" class="me-2" width="40">
                    <span>{{ $badge->name }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
