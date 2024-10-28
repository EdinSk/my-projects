<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class EventDetail extends Component
{
    public $event;

    // Mount method to handle the $eventId parameter passed from the route
    public function mount($eventId)
    {
        // Find the event using the provided event ID
        $this->event = Event::findOrFail($eventId);
    }

    public function render()
    {
        return view('livewire.partials.event-detail');
    }
}