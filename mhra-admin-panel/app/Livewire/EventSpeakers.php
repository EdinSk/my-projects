<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class EventSpeakers extends Component
{
    public $eventId;
    public $speakers;

    // Accept the eventId parameter in the mount method
    public function mount($eventId)
    {
        $this->eventId = $eventId;
        
        // Fetch speakers for the event ordered by 'order' from the pivot table
        $this->speakers = Event::find($eventId)
            ->speakers()
            ->orderBy('pivot_order')
            ->get();
    }

    public function render()
    {
        return view('livewire.partials.event-speakers');
    }
}
