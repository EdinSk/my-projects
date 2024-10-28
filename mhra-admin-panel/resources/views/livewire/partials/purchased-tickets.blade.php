@php
    use App\Models\TicketPurchase;
    use Illuminate\Support\Facades\Auth;

    $purchases = TicketPurchase::where('user_id', Auth::id())
        ->with('event', 'ticketType')
        ->get();
@endphp

<div class="container">
    <h2 class="mt-4">Купени карти</h2>

    @if ($purchases->isEmpty())
        <p>Немате купено карти.</p>
    @else
        <div class="row">
            @foreach ($purchases as $purchase)
                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="card h-100">
                        @if ($purchase->event->image_url)
                            <img src="{{ $purchase->event->image_url }}" class="card-img-top" alt="{{ $purchase->event->title }}">
                        @endif
                        <div class="card-body p-2">
                            <h6 class="card-title mb-1">{{ $purchase->event->title }}</h6>
                            <p class="card-text mb-1">
                                <small>
                                    Тип: {{ $purchase->ticketType->name }}<br>
                                    Цена: {{ $purchase->price }} ден.<br>
                                    Датум на купување: {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d.m.Y') }}<br>
                                    Настан: {{ \Carbon\Carbon::parse($purchase->event->date)->format('d.m.Y') }}
                                </small>
                            </p>
                            <a href="#" class="btn btn-primary btn-sm">Детали</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
