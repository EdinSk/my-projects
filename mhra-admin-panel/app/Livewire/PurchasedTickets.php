<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TicketPurchase;
use Illuminate\Support\Facades\Auth;

class PurchasedTickets extends Component
{
    public $purchases;

    public function mount($purchases)
    {
        // Load the purchased tickets for the authenticated user
        $this->purchases = $purchases; // Initialize purchases

    }

    public function render()
    {
        return <<<'blade'
        <div class="container">
            <h2 class="mt-4">Купени карти</h2>

            @if ($this->purchases->isEmpty())
                <p>Немате купено карти.</p>
            @else
                @foreach ($this->purchases as $purchase)
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <!-- Assuming the event has an image -->
                                <img src="{{ $purchase->event->image_url }}" alt="{{ $purchase->event->title }}" class="img-fluid rounded-start">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $purchase->event->title }}</h5>
                                    <p class="card-text">
                                        Тип на карта: {{ $purchase->ticketType->name }} <br>
                                        Цена: {{ $purchase->price }} ден. <br>
                                        Дата на купување: {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d.m.Y') }} <br>
                                        Настан: {{ \Carbon\Carbon::parse($purchase->event->date)->format('d.m.Y') }}
                                    </p>
                                    <a href="#" class="btn btn-primary">Погледни детали</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    blade;
    }
}