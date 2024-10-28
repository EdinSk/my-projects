@php
    $recommendations = Auth::user()
        ->recommendationsReceived()
        ->with('giver')
        ->get();
@endphp

<div>
    <h4>Recommendations</h4>

    @if($recommendations->isEmpty())
        <p>No recommendations available.</p>
    @else
        @foreach($recommendations as $recommendation)
            <div class="recommendation">
                <strong>
                    {{ $recommendation->giver->first_name }} {{ $recommendation->giver->last_name }}
                </strong>
                - {{ $recommendation->created_at->diffForHumans() }}
                <p>{{ $recommendation->content }}</p>
            </div>
        @endforeach
    @endif
</div>